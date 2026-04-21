<?php
/**
 * MaxMind GeoLite2 country lookup + DB updater.
 *
 * License key must be defined in wp-config.php:
 *   define('MAXMIND_LICENSE_KEY', 'xxxx');
 */

use GeoIp2\Database\Reader;

function xinc_geoip_db_path() {
  $upload_dir = wp_upload_dir();
  return trailingslashit($upload_dir['basedir']) . 'geoip/GeoLite2-Country.mmdb';
}

function xinc_geoip_license_key() {
  if (defined('MAXMIND_LICENSE_KEY') && MAXMIND_LICENSE_KEY) {
    return MAXMIND_LICENSE_KEY;
  }
  $env = getenv('MAXMIND_LICENSE_KEY');
  return $env ?: '';
}

/**
 * Look up a country ISO code for an IP via the MaxMind .mmdb.
 *
 * @param string $ip
 * @return string|false Lowercase ISO code or false.
 */
function xinc_geoip_lookup($ip) {
  if (!$ip || !filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
    return false;
  }

  $db_path = xinc_geoip_db_path();
  if (!file_exists($db_path) || !class_exists('GeoIp2\\Database\\Reader')) {
    return false;
  }

  try {
    $reader = new Reader($db_path);
    $record = $reader->country($ip);
    $iso = $record->country->isoCode;
    return $iso ? strtolower($iso) : false;
  } catch (Exception $e) {
    return false;
  }
}

/**
 * Resolve the visitor's IP, taking common proxy headers into account.
 */
function xinc_get_visitor_ip() {
  $candidates = [
    'HTTP_CF_CONNECTING_IP',
    'HTTP_X_FORWARDED_FOR',
    'HTTP_X_REAL_IP',
    'REMOTE_ADDR',
  ];

  foreach ($candidates as $key) {
    if (empty($_SERVER[$key])) continue;
    $raw = $_SERVER[$key];
    $ip = trim(explode(',', $raw)[0]);
    if (filter_var($ip, FILTER_VALIDATE_IP)) {
      return $ip;
    }
  }
  return '';
}

/**
 * Download and install the latest GeoLite2-Country database.
 *
 * @return array { ok: bool, message: string }
 */
function xinc_geoip_update_db() {
  $license_key = xinc_geoip_license_key();
  if (!$license_key) {
    return ['ok' => false, 'message' => 'MAXMIND_LICENSE_KEY is not defined.'];
  }

  $db_path = xinc_geoip_db_path();
  $db_dir = dirname($db_path);
  if (!wp_mkdir_p($db_dir)) {
    return ['ok' => false, 'message' => "Could not create $db_dir"];
  }

  $url = add_query_arg([
    'edition_id'  => 'GeoLite2-Country',
    'license_key' => $license_key,
    'suffix'      => 'tar.gz',
  ], 'https://download.maxmind.com/app/geoip_download');

  $tmp_tar = download_url($url, 60);
  if (is_wp_error($tmp_tar)) {
    return ['ok' => false, 'message' => 'Download failed: ' . $tmp_tar->get_error_message()];
  }

  // Extract .mmdb from the tar.gz (MaxMind tarballs contain a versioned folder)
  $extract_dir = $db_dir . '/tmp_' . uniqid();
  if (!wp_mkdir_p($extract_dir)) {
    @unlink($tmp_tar);
    return ['ok' => false, 'message' => "Could not create $extract_dir"];
  }

  try {
    $gz = new PharData($tmp_tar);
    $gz->extractTo($extract_dir, null, true);

    $found = null;
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($extract_dir, FilesystemIterator::SKIP_DOTS));
    foreach ($rii as $file) {
      if (substr($file->getFilename(), -5) === '.mmdb') {
        $found = $file->getPathname();
        break;
      }
    }

    if (!$found) {
      throw new Exception('No .mmdb in tar');
    }

    // Atomic replace: write to tmp then rename
    $tmp_mmdb = $db_path . '.tmp';
    copy($found, $tmp_mmdb);
    rename($tmp_mmdb, $db_path);
  } catch (Exception $e) {
    @unlink($tmp_tar);
    xinc_geoip_rrmdir($extract_dir);
    return ['ok' => false, 'message' => 'Extract failed: ' . $e->getMessage()];
  }

  @unlink($tmp_tar);
  xinc_geoip_rrmdir($extract_dir);

  update_option('xinc_geoip_updated', time(), false);

  return ['ok' => true, 'message' => 'GeoLite2-Country.mmdb updated at ' . $db_path];
}

function xinc_geoip_rrmdir($dir) {
  if (!is_dir($dir)) return;
  $rii = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
    RecursiveIteratorIterator::CHILD_FIRST
  );
  foreach ($rii as $f) {
    $f->isDir() ? @rmdir($f->getPathname()) : @unlink($f->getPathname());
  }
  @rmdir($dir);
}

/**
 * Weekly wp-cron updater.
 */
add_action('xinc_geoip_weekly_update', 'xinc_geoip_update_db');

add_action('init', function () {
  if (!wp_next_scheduled('xinc_geoip_weekly_update')) {
    // Next Wednesday 03:00 UTC
    $next = strtotime('next wednesday 03:00 UTC');
    wp_schedule_event($next, 'weekly', 'xinc_geoip_weekly_update');
  }
});

/**
 * WP-CLI: wp resources update-geoip
 */
if (defined('WP_CLI') && WP_CLI) {
  WP_CLI::add_command('resources update-geoip', function () {
    $result = xinc_geoip_update_db();
    if ($result['ok']) {
      WP_CLI::success($result['message']);
    } else {
      WP_CLI::error($result['message']);
    }
  });
}

/**
 * Admin page: Tools → GeoIP Database
 */
add_action('admin_menu', function () {
  add_management_page(
    'GeoIP Database',
    'GeoIP Database',
    'manage_options',
    'xinc-geoip',
    'xinc_geoip_render_admin_page'
  );
});

add_action('admin_post_xinc_geoip_update', function () {
  if (!current_user_can('manage_options')) wp_die('Unauthorized.', 403);
  check_admin_referer('xinc_geoip_update');

  $result = xinc_geoip_update_db();
  $redirect = add_query_arg([
    'page'          => 'xinc-geoip',
    'geoip_status'  => $result['ok'] ? 'success' : 'error',
    'geoip_message' => rawurlencode($result['message']),
  ], admin_url('tools.php'));
  wp_safe_redirect($redirect);
  exit;
});

function xinc_geoip_render_admin_page() {
  if (!current_user_can('manage_options')) return;

  $db_path    = xinc_geoip_db_path();
  $db_exists  = file_exists($db_path);
  $db_size    = $db_exists ? size_format(filesize($db_path)) : '—';
  $db_mtime   = $db_exists ? date_i18n('Y-m-d H:i:s', filemtime($db_path)) : '—';
  $license    = xinc_geoip_license_key() ? 'set' : 'missing';
  $next_cron  = wp_next_scheduled('xinc_geoip_weekly_update');

  $status  = isset($_GET['geoip_status']) ? sanitize_key($_GET['geoip_status']) : '';
  $message = isset($_GET['geoip_message']) ? sanitize_text_field(rawurldecode($_GET['geoip_message'])) : '';
  ?>
  <div class="wrap">
    <h1>GeoIP Database</h1>

    <?php if ($status === 'success') : ?>
      <div class="notice notice-success"><p><?php echo esc_html($message); ?></p></div>
    <?php elseif ($status === 'error') : ?>
      <div class="notice notice-error"><p><?php echo esc_html($message); ?></p></div>
    <?php endif; ?>

    <table class="widefat striped" style="max-width:720px;margin-top:1em;">
      <tbody>
        <tr><th scope="row">License key</th><td><?php echo esc_html($license); ?></td></tr>
        <tr><th scope="row">Database path</th><td><code><?php echo esc_html($db_path); ?></code></td></tr>
        <tr><th scope="row">Database exists</th><td><?php echo $db_exists ? 'yes' : 'no'; ?></td></tr>
        <tr><th scope="row">Database size</th><td><?php echo esc_html($db_size); ?></td></tr>
        <tr><th scope="row">Last modified</th><td><?php echo esc_html($db_mtime); ?></td></tr>
        <tr><th scope="row">Next scheduled update</th><td><?php echo $next_cron ? esc_html(date_i18n('Y-m-d H:i:s', $next_cron)) : '—'; ?></td></tr>
      </tbody>
    </table>

    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" style="margin-top:1.5em;">
      <input type="hidden" name="action" value="xinc_geoip_update" />
      <?php wp_nonce_field('xinc_geoip_update'); ?>
      <?php submit_button('Refresh database now', 'primary', 'submit', false); ?>
    </form>
  </div>
  <?php
}
