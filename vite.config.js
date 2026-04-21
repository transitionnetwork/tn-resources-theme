import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'
import path from 'path'
import { copyFileSync, mkdirSync, readdirSync, readFileSync, writeFileSync, statSync, chmodSync } from 'fs'

function copyAssets() {
  return {
    name: 'copy-assets',
    closeBundle() {
      const copyDir = (src, dest) => {
        mkdirSync(dest, { recursive: true })
        for (const entry of readdirSync(src)) {
          const srcPath = path.join(src, entry)
          const destPath = path.join(dest, entry)
          if (statSync(srcPath).isDirectory()) {
            copyDir(srcPath, destPath)
          } else {
            copyFileSync(srcPath, destPath)
            chmodSync(destPath, 0o644)
          }
        }
      }

      // Copy images, SVGs, and fonts
      copyDir('src/img', 'dist/img')
      copyDir('src/svgs', 'dist/svg')
      copyDir('fonts', 'dist/fonts')

      // Generate SVG spritemap from src/svgs/sprites/
      const spriteDir = 'src/svgs/sprites'
      const symbols = []
      for (const file of readdirSync(spriteDir)) {
        if (!file.endsWith('.svg')) continue
        const id = file.replace('.svg', '')
        let svg = readFileSync(path.join(spriteDir, file), 'utf8')

        // Strip XML declaration, DOCTYPE, and comments before the <svg> tag
        svg = svg
          .replace(/<\?xml[^?]*\?>\s*/g, '')
          .replace(/<!DOCTYPE[^>]*>\s*/g, '')
          .replace(/<!--[\s\S]*?-->\s*/g, '')

        // Extract attributes from the outer <svg> tag
        const svgTagMatch = svg.match(/<svg([^>]*)>/)
        const svgAttrs = svgTagMatch ? svgTagMatch[1] : ''
        const viewBoxMatch = svgAttrs.match(/viewBox="([^"]*)"/)
        const viewBox = viewBoxMatch ? viewBoxMatch[1] : '0 0 24 24'
        const fillMatch = svgAttrs.match(/\bfill="([^"]*)"/)
        const fill = fillMatch ? fillMatch[1] : null
        const strokeMatch = svgAttrs.match(/\bstroke="([^"]*)"/)
        const stroke = strokeMatch ? strokeMatch[1] : null
        const strokeWidthMatch = svgAttrs.match(/stroke-width="([^"]*)"/)
        const strokeWidth = strokeWidthMatch ? strokeWidthMatch[1] : null

        // Strip the outer <svg> wrapper, keep inner content
        let inner = svg
          .replace(/<svg[^>]*>/, '')
          .replace(/<\/svg>\s*$/, '')
          .trim()

        // Convert React camelCase attributes to kebab-case
        inner = inner
          .replace(/strokeWidth=/g, 'stroke-width=')
          .replace(/strokeLinecap=/g, 'stroke-linecap=')
          .replace(/strokeLinejoin=/g, 'stroke-linejoin=')
          .replace(/fillRule=/g, 'fill-rule=')
          .replace(/clipRule=/g, 'clip-rule=')
          .replace(/className=/g, 'class=')

        // Wrap inner content in <g> with fill/stroke for reliable inheritance
        let gAttrs = ''
        if (fill) gAttrs += ` fill="${fill}"`
        if (stroke) gAttrs += ` stroke="${stroke}"`
        if (strokeWidth) gAttrs += ` stroke-width="${strokeWidth}"`
        if (gAttrs) {
          inner = `<g${gAttrs}>${inner}</g>`
        }

        symbols.push(`<symbol id="${id}" viewBox="${viewBox}">${inner}</symbol>`)
      }
      const sprite = `<svg xmlns="http://www.w3.org/2000/svg" style="display:none">${symbols.join('')}</svg>`
      mkdirSync('dist/svg', { recursive: true })
      writeFileSync('dist/svg/sprite.svg', sprite)
      chmodSync('dist/svg/sprite.svg', 0o644)
    },
  }
}

export default defineConfig({
  plugins: [tailwindcss(), copyAssets()],
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    manifest: true,
    rollupOptions: {
      input: {
        app: path.resolve(__dirname, 'src/js/app.js'),
        'wp-admin': path.resolve(__dirname, 'src/js/wp-admin.js'),
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/chunks/[name].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name && assetInfo.name.endsWith('.css')) {
            return 'css/[name][extname]'
          }
          return 'assets/[name][extname]'
        },
      },
    },
  },
  base: './',
})
