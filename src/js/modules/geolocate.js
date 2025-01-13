const lookup = require('country-code-lookup')

const GeoLocate = () => {

  //query cloudflare to obtain IP
  async function getCloudflareJSON() {
    let data = await fetch('https://one.one.one.one/cdn-cgi/trace').then(res => res.text())
    let arr = data.trim().split('\n').map(e => e.split('='))
    return Object.fromEntries(arr)
  }

  getCloudflareJSON().then(function(arr) {
    console.log(arr)
    console.log('hello')

    let nameElement = document.querySelectorAll('.location-name');
    let regionElement = document.querySelectorAll('.location-region');
    let continentElement = document.querySelectorAll('.location-continent');
    let languageElement = document.querySelectorAll('.location-lang');
    let ipElement = document.querySelectorAll('.location-ip');
    let locationLink = document.querySelectorAll('.location-link');

    nameElement.forEach(el => {
      el.append(lookup.byIso(arr['loc'])['country']);
    });
    
    regionElement.forEach(el => {
      el.append(lookup.byIso(arr['loc'])['region']);
    });
    
    continentElement.forEach(el => {
      el.append(lookup.byIso(arr['loc'])['continent']);
    });
    
    let locale = new Intl.Locale('und', { region: arr['loc'] });
    let lang = locale.maximize().language
    let languageNames = new Intl.DisplayNames(["en"], { type: "language" });
    let languageName = languageNames.of(lang)

    languageElement.forEach(el => {
      el.append(languageName);
    });
    
    ipElement.forEach(el => {
      el.append(arr['ip']);
    });
    
    locationLink.forEach(el => {
      el.setAttribute("href", tofinoJS.siteURL + "/location/" + arr['loc'].toLowerCase());
    });

    let localResourcesGrid = document.getElementById('local-resources-grid')
    
    //ajax call to return the relevant resources to the location
    $.ajax({
      url: tofinoJS.ajaxUrl,
      type: 'POST',
      cache: false,
      data: {
        action: 'getPopularResources',
        value: {
          location: arr['loc'].toLowerCase()
        }
      },
      dataType: 'json',
      success: function (response) {

        response.forEach(item => {
          let content = ''
          content += '<div class="col-span-12 md:col-span-4"><div class="card"><div class="h-0 pt-2/3 relative"><div class="absolute inset-0 bg-gray-300" ></div></div><div class="p-3 space-y-2">'

          if(item.terms) {
            content += '<div class="flex space-x-3 items-center">';
            item.terms.forEach(term => {
              content +='<a class="no-underline flex items-center space-x-1 text-sm" href="' + term.link + '"><img class="h-3 w-auto" src="' + term.image + '"><span>' + term.name + '</span></a>'
            })
            content += '</div>';
          }
          
          content += '<h3 class="h4"><a href="' + item.permalink + '">' + item.title + '</a></h3>'

          if(item.excerpt) {
            content += '<div>' + item.excerpt + '</div>'
          }

          content += '<a class="btn btn-tertiary block text-center" href="' + item.permalink + '">Read Guide</a></div>'

          localResourcesGrid.innerHTML += content;
        });
      },
      error: function (jqxhr, status, exception) {
        console.log('JQXHR:', jqxhr);
        console.log('Status:', status);
        console.log('Exception:', exception);
      }
    })
  })
}

export default GeoLocate;

