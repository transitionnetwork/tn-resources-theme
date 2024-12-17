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
    let ipElement = document.querySelectorAll('.location-ip');

    nameElement.forEach(el => {
      el.append(arr['loc']);
    });
    
    ipElement.forEach(el => {
      el.append(arr['ip']);
    });

    //carry out ajax call here which returns all the shit and adds it to the grid. We need to know how many to return here!

  })
}

export default GeoLocate;
