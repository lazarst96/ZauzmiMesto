$('.sliderobjekat').slick({
  dots: true,
  infinite: true,
  speed: 300,
  slidesToShow: 1,
  adaptiveHeight: true,
  prevArrow: $('.owl-prev'),
  nextArrow: $('.owl-next'),
});
$(function () {
	$('[data-toggle="popover"]').popover()
});
$('.regular').slick({
		infinite: true,
		speed: 500,
		slidesToShow: 3,
		slidesToScroll: 1,
		swipeToSlide:true,
		autoplay: true,
  		autoplaySpeed: 4000,
  		arrows: false,
		
		responsive: [
			{
			    breakpoint: 768,
			    settings: {
			    	slidesToShow: 1,
			    	slidesToScroll: 1,
			    	speed: 500,
				}
			},
			{
			    breakpoint: 960,
			    settings: {
			    	slidesToShow: 2,
			    	slidesToScroll: 1,
			    	speed: 500,
				}
			},
			{
			    breakpoint: 1920,
			    settings: {
			    	slidesToShow: 3,
			    	slidesToScroll: 1,
			    	speed: 500,
				}
			}

		]
});
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
    center: [longitude, latitude],
    zoom: 14
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
$(document).ready(function(){
	var object = [{
		latitude : parseFloat($("#map-info").attr("data-latitude")),
		longitude : parseFloat($("#map-info").attr("data-longitude")),
		city : $("#city").attr("title"),
		name : $("#name").text(),
		type : $("#map-info").attr("data-type"),
		link : "",
		free : parseInt($("#map-info").attr("data-free")),
		country : $("#map-info").attr("data-country"),
		address: $("#map-info").attr("data-address"),
		image : $("#map-info").attr("data-image"),

	}];
	var latitude = parseFloat($("#map-info").attr("data-latitude"));
	var longitude = parseFloat($("#map-info").attr("data-longitude"));
	var city = $("#city").attr("title");
	var name = $("#name").text();
	var type = parseInt($("#map-info").attr("data-type"));
	var link = "";
	var free = parseInt($("#map-info").attr("data-free"));
	var country = $("#map-info").attr("data-country");
	var a
	initmap(latitude,longitude,object)



});

function table(data){
  var html = '';
  

  for(var i in data.tables){
    html+='<tr><td><div class="time_table">'+(i%24 +1)+':00</div></td>';
    //console.log(data.tables[i]);
    for(var j in data.tables[i]){
      if(parseInt(data.tables[i][j])){
         html+='<td><div class="td_content click_allow" data-table="'+j+'" data-hour="'+i+'">'+parseInt(data.tables[i][j])+'</div></td>';
       }else{
         html+='<td><div class="td_content bg-danger" data-table="'+j+'">'+parseInt(data.tables[i][j])+'</div></td>';
       }
     
    }
    html+="</tr>";
  }
  return html;
}
function start_table(open,start_time,tables){
  var html = "<div class='p-3 text-weight-bold m-2'>Izabrali ste neradan dan za ovaj objekat.</div>";
  if(open){
    if(Object.keys(tables).length){
      html = '<table id="zakazivanje_sati" class="ml-auto mr-auto mt-4 mb-4"><tr><td><div class="time_table">'+start_time+':00</div></td><th><div class="td_content darkblue_bg text-white">2</div></th><th><div class="td_content darkblue_bg text-white">4</div></th><th><div class="td_content darkblue_bg text-white">6</div></th><th><div class="td_content darkblue_bg text-white">8</div></th><th><div class="td_content darkblue_bg text-white">10</div></th><th><div class="td_content darkblue_bg text-white">12</div></th></tr></table>'
    }else{
      var html = "<div class='p-3 text-weight-bold m-2'>Objekat je trenutno zatvoren.</div>";
    }
  }
  return html;
}
$('#day').change(function(){
  var date1 = $('#day').val();
  var id = $("#company_infi").attr("data-num");
  var csrf = $("input[name=csrf_test_name]").val();
  date = date1.split("-");
  var modal = $('#mymodal');
  $.ajax({
    method: "POST",
    url:"http://localhost/ZauzmiMesto/Ajax/company_tables_state",
    data: {csrf_test_name:csrf, id:id, date:date1},
    error: function(xhr, status, error) {
      console.log(xhr.responseText);
    }
  }).done(function(data){
    data = JSON.parse(data);
    $("input[name=csrf_test_name]").val(data.csrf);
    $("#za_tabelu").html(start_table(parseInt(data.data.open), data.data.start_hour, data.data.tables));
    $("#zakazivanje_sati").append(table(data.data));
    add_event();
      
  });
  modal.find('.modal-title').text('Zakazivanje za ' + date[2]+"."+date[1]+"."+date[0]+".");
  $('#mymodal').modal('show');
  

});
var set_table = -1;
var num_hours = 0;
var min_hour = -1;
var max_hour = -1;
function add_event(){
  set_table = -1;
  num_hours = 0;
  min_hour = -1;
  max_hour = -1;
  $('.click_allow').on("click", function(){
    var table = parseInt($(this).attr("data-table"));
    var hour = parseInt($(this).attr("data-hour"));
    if($(this).hasClass("clicked_hour") && (hour==max_hour || hour == min_hour)){
      num_hours--;
      if(!num_hours){
        set_table = -1;
      }
      if(hour == min_hour) min_hour++; 
      if(hour == max_hour) max_hour--;
      $(this).text(parseInt($(this).text())+1);
      $(this).removeClass("clicked_hour");
    }else{
      if(set_table <0){
        set_table = table;
        num_hours++;
        min_hour=max_hour=parseInt(hour);
        $(this).addClass("clicked_hour");
        $(this).text(parseInt($(this).text())-1);
      }else{
        if(set_table==table && (hour == min_hour-1 || hour == max_hour+1) ){
          $(this).addClass("clicked_hour");
          num_hours++;
          $(this).text(parseInt($(this).text())-1);
          
          if(hour == min_hour-1) min_hour = hour; 
          if(hour == max_hour+1) max_hour = hour;
        }
      }
    }
     
  })
}

$("#rezervisi").click(function(){
  if(num_hours>0){
      var id = $("#company_infi").attr("data-num");
      var csrf = $("input[name=csrf_test_name]").val();
      var date = $('#day').val();
      var capacity = set_table;
      var start = date+" "+min_hour%24+":00:00";
      var end = date+" "+(max_hour+1)%24+":00:00";
      var next_day_end = Math.floor((max_hour+1)/24);
      var next_day_start = Math.floor(min_hour/24);
      //alert(next_day_start+" "+next_day_end);
      $.ajax({
        method: "POST",
        url:"http://localhost/ZauzmiMesto/Ajax/make_reservation",
        data: {csrf_test_name:csrf, id:id, start:start, end:end, capacity:capacity ,next_day_end:next_day_end, next_day_start:next_day_start,},
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      }).done(function(data){
        data = JSON.parse(data);
        $("input[name=csrf_test_name]").val(data.csrf);
        $("#result_text").text("Uspešno ste poslali rezervaciju za "+date+" od "+min_hour%24+":00 do " +(max_hour+1)%24+":00.");
          
      });
  }
});