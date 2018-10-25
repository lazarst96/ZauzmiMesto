function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(setloc,error);
  } else {
    alert("ne radi");
  }

}
function data_form(){
    var keywords = $("#inputGroupSelect00").val();
    if(keywords){
       keywords = keywords.map(function(i){
          return parseInt(i);
      });
    }else{
      keywords = [];
    }
    var city = parseInt($("#inputGroupSelect01").val());
    var type = parseInt($("#inputGroupSelect02").val());
    var distance = parseInt($("#inputGroupSelect03").val());
    var csrf = $("input[name=csrf_test_name]").val();
    var latitude = $("#infolat").attr("data-latitude");
    var longitude = $("#infolat").attr("data-longitude");
    return [keywords,city,type,distance,latitude,longitude,csrf];
  }
function setloc(position){
  var ret = data_form();
  var csrf = ret[6];
  var longitude = ret[5];
  var latitude = ret[4];
  var distance = ret[3];
  var type = ret[2];
  var city = ret[1];
  var keywords = ret[0];
  $("#map").html("");
  $.ajax({
    method: "POST",
    url:"http://localhost/ZauzmiMesto/Ajax/allobjects",
    data: {csrf_test_name:csrf, keywords:JSON.stringify(keywords), city:city, distance:distance, type:type, latitude:latitude, longitude:longitude},
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  }).done(function(data){
      data = JSON.parse(data);
      $("input[name=csrf_test_name]").val(data.csrf);
      initmap(position.coords.latitude, position.coords.longitude, data.data);
      $("#infolat").attr("data-latitude", position.coords.latitude);
      $("#infolat").attr("data-longitude", position.coords.longitude);
  });
  
}
var lat = 0;
function loc(position){
  initmap(position.coords.latitude, position.coords.longitude, []);
  var latitude = $("#infolat").attr("data-latitude", position.coords.latitude);
  var longitude = $("#infolat").attr("data-longitude", position.coords.longitude);
  lat = latitude;
}

function html_popup(title, img_src, address, href, free){
  var address = address.split(",");
  var ret = '<div class="popup_image_div">';
  ret+='<img src="'+img_src+'" alt="">';
  ret+='<div class="overlay_popup_div"></div>'
  if (free) {
    ret+='<div class="blue_bg text-white font-weight-bold free_place">Slobodno</div></div>';
  }else{
    ret+='<div class="bg-danger text-white font-weight-bold free_place">Zauzeto</div></div>';
  }
  ret+='<div class="popup_info_div">';
  ret+='<a href="'+href+'" class="text-dark"><h2>'+title+'</h2><a>';
  ret+='<p class="">'+address[0]+', <span class="blue_text font-weight-bold">'+address[1]+'</span>, '+address[2]+'</p></div>'
  return ret;
}
function marker(type){
  switch(type){
    case "1":
      return "marker-restaurant";
    case "2":
      return "marker-pub";
    case "3":
      return "marker-caffe";
    case "4":
      return "marker-cakeshop";
    case "5":
      return "marker-pizzeria";
    case "6":
      return "marker-kafana";
    case "7":
      return "marker-disco";
  }
}
function error(err) {
    $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
      initmap(data["geobyteslatitude"], data["geobyteslongitude"],[]);
    });
}
function initmap(latitude,longitude,object) {
  mapboxgl.accessToken = 'pk.eyJ1IjoibGF6YXJzdDk2IiwiYSI6ImNqaXBqbTVueDB5ZDAzcXJ2bnRxMm93Zm8ifQ.ixJNC4guYVgeYxNTzqAghg';
  var features = [];
  for(i=0;i<object.length;++i){
    features.push({
      type: 'Feature',
      class: marker(object[i].type),
      geometry: {
        type: 'Point',
        coordinates: [object[i].longitude, object[i].latitude]
      },
      properties: {
        title: object[i].name,
        address: object[i].country+', '+object[i].city+', '+object[i].address,
        image: object[i].image,
        free: parseInt(object[i].free),
        href: object[i].link
      }
    });
  }
  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/lazarst96/cjirs4bab1ifj2rpmg27ayglj',
    //center: [position.coords.longitude, position.coords.latitude],
    center: [longitude, latitude],
    zoom: 13
  }); 
  var user_position = {
    type: 'FeatureCollection',
    features: [
    {
      type: 'Feature',

      geometry: {
        type: 'Point',
        coordinates: [longitude, latitude]
      },
      properties: {
        title: 'Your position',
        description: 'Washington, D.C.'
      }
    },
   ]
  };
  user_position.features.forEach(function(marker) {

    // create a HTML element for each feature
    var el = document.createElement('div');
    el.className = 'pulse';

    // make a marker for each feature and add to the map
    new mapboxgl.Marker(el)
    .setLngLat(marker.geometry.coordinates)
    .addTo(map);
  });
  var objects_positions = {
    type: 'FeatureCollection',
    features: features
  };
  objects_positions.features.forEach(function(marker) {

    // create a HTML element for each feature
    var el = document.createElement('div');
    el.className = "marker "+marker.class;

    // make a marker for each feature and add to the map
    new mapboxgl.Marker(el)
    .setLngLat(marker.geometry.coordinates)
    .setPopup(new mapboxgl.Popup({ offset: 25 })
    .setHTML(html_popup(marker.properties.title, marker.properties.image, marker.properties.address, marker.properties.href, marker.properties.free)))
    .addTo(map);
  });
  
}
function getObjects(keywords, city, type, distance, latitude, longitude, csrf){
  $.ajax({
    method: "POST",
    url:"http://localhost/ZauzmiMesto/Ajax/allobjects",
    data: {csrf_test_name:csrf, keywords:JSON.stringify(keywords), city:city, distance:distance, type:type, latitude:latitude, longitude:longitude},
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  }).done(function(data){
      data = JSON.parse(data);
      $("input[name=csrf_test_name]").val(data.csrf);
      return data.data;
  });

} 
getLocation();
