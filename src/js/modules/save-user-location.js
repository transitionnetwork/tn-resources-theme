const saveUserLocation = () => {

  //query cloudflare to obtain IP
  async function getCloudflareJSON() {
    let data = await fetch('https://one.one.one.one/cdn-cgi/trace').then(res => res.text())
    let arr = data.trim().split('\n').map(e => e.split('='))
    return Object.fromEntries(arr)
  }

  getCloudflareJSON().then(function(arr) {
    let loc = arr["loc"].toLowerCase()   
    let userID = tofinoJS.userID

    $.ajax({
      url: tofinoJS.ajaxUrl,
      type: 'POST',
      cache: false,
      data: {
        action: 'writeLocationToUser',
        value: {
          userID: userID,
          location: loc
        }
      },
      dataType: 'json',
      success: function (response) {
        console.log("country_iso written to db");
        console.log(response);
      },
      error: function (jqxhr, status, exception) {
        console.log('JQXHR:', jqxhr);
        console.log('Status:', status);
        console.log('Exception:', exception);
      }
    })
  })
}

export default saveUserLocation;
