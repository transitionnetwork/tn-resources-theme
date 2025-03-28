const lookup = require('country-code-lookup')

const GeoLocate = () => {

  //query cloudflare to obtain IP
  async function getCloudflareJSON() {
    let data = await fetch('https://geo.transition-space.org/json').then(res => res.text())
    return JSON.parse(data)
  }

  getCloudflareJSON().then(function(arr) {
    if(arr) {
      console.log(arr)
  
      let regionElement = document.querySelectorAll('.location-region');
      let continentElement = document.querySelectorAll('.location-continent');
      let languageElement = document.querySelectorAll('.location-lang');
      let ipElement = document.querySelectorAll('.location-ip');
      let locationLink = document.querySelectorAll('.location-link');

      let isoCode = arr['country']['iso_code'];
      
      continentElement.forEach(el => {
        el.append(arr['continent']['names']['en']);
      });
      
      let locale = new Intl.Locale('und', { region: isoCode });
      let lang = locale.maximize().language
      let languageNames = new Intl.DisplayNames(["en"], { type: "language" });
      let languageName = languageNames.of(lang)
  
      languageElement.forEach(el => {
        el.append(languageName);
      });
      
      locationLink.forEach(el => {
        el.setAttribute("href", tofinoJS.siteURL + "/location/" + isoCode.toLowerCase());
      });

      let getTarget = document.getElementById('geolocated-content').dataset.target;
      
      //ajax call to return the relevant resources to the location
      $.ajax({
        url: tofinoJS.ajaxUrl,
        type: 'POST',
        cache: false,
        data: {
          action: 'getLocalResources',
          value: {
            location: isoCode.toLowerCase(),
            target: getTarget
          }
        },
        dataType: 'json',
        success: function (response) {

          console.log(response)
          let spinner = document.getElementById('loader-container')
          spinner.classList.add('hidden')

          let localResourcesGrid = document.getElementById('local-resources-grid')
          
          response.resources.forEach(item => {
            let content = ''
            content += item.html
  
            localResourcesGrid.innerHTML += content;
          });

          let nameElement = document.querySelectorAll('.location-name')
          
          let label

          if(response.country.location === 'global') {
            label = 'Worldwide Resources'
          } else {
            label = 'Resources from ' + arr['country']['names']['en']
          }

          nameElement.forEach(el => {
            el.append(label);
          });

          //add target to links for iframes
          if(response.target) {
            let links = document.getElementById('local-resources-grid').getElementsByTagName('a');

            links = Array.from(links);

            links.forEach(item => {
              item.setAttribute('target', response.target)
            })
          }
        },
        error: function (jqxhr, status, exception) {
          console.log('JQXHR:', jqxhr);
          console.log('Status:', status);
          console.log('Exception:', exception);
        }
      })
    }
  })
}

export default GeoLocate;

