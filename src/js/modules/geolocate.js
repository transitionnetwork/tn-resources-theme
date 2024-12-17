const lookup = require('country-code-lookup')

const GeoLocate = () => {

  //query cloudflare to obtain IP
  async function getCloudflareJSON() {
    let data = await fetch('https://one.one.one.one/cdn-cgi/trace').then(res => res.text())
    let arr = data.trim().split('\n').map(e => e.split('='))
    return Object.fromEntries(arr)
  }

  getCloudflareJSON().then(function(arr) {
    // console.log(arr)

    let nameElement = document.querySelectorAll('.location-name');
    let regionElement = document.querySelectorAll('.location-region');
    let continentElement = document.querySelectorAll('.location-continent');
    let languageElement = document.querySelectorAll('.location-lang');
    let ipElement = document.querySelectorAll('.location-ip');

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
    console.log(languageName);

    languageElement.forEach(el => {
      el.append(languageName);
    });
    
    ipElement.forEach(el => {
      el.append(arr['ip']);
    });
  


    
    //carry out ajax call here which returns all the shit and adds it to the grid. We need to know how many to return here!

  })
}

export default GeoLocate;
