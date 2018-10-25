$(document).ready(function(){
      $("body").on('click','a.fas',function(){
		var s = $(this).attr("data");
		if (s=="izmenibroj1"){
      		$("#pozivni").prop('disabled',false);
      		$("#mobilni").prop('disabled',false);
      		$("body").find("#pozivni").css("color", 'black');
      		$("body").find("#pozivni").css("background-color", 'white');
      		$("body").find("#mobilni").css("color", 'black');
      		$("body").find("#mobilni").css("background-color", 'white');
      	} else if (s=="izmenibroj2"){
      		$("#pozivni2").prop('disabled',false);
      		$("#mobilni2").prop('disabled',false);
      		$("body").find("#pozivni2").css("color", 'black');
      		$("body").find("#pozivni2").css("background-color", 'white');
      		$("body").find("#mobilni2").css("color", 'black');
      		$("body").find("#mobilni2").css("background-color", 'white');
      	}
      	else{
      		$("body").find("#"+s).prop('disabled',false);
      		$("body").find("#"+s).css("color", 'black');
      		$("body").find("#"+s).css("background-color", 'white');	
      	}		
      });
      $("body").on('keyup','input.lozinka',function(){
      	var loz1 = $("#novalozinka1").val();
      	var loz2 = $("#novalozinka2").val();
      	if (loz1!=loz2){
      		$("#provera").html("<p style='color:red'> Lozinke se ne podudaraju</p>");
      	}else{
      		if (loz1.length < 8){
      			$("#provera").html("<p style='color:red'> Nova lozinka prekratka</p>");
      		}else{
      			$("#provera").html("<p style='color:green'> Lozinke se podudaraju</p>")
      		}
      	}
      });
      $(".zabrisanje").hide();
      $("body").on('change','input.radio1',function(){
            if ($('#radio2').prop('checked')){
                  $(".zabrisanje").show();
                  $(".inputzaprofil").hide();
                  $("#dugmebrisanje").html('<div class="m-auto text-light"><i class="fas fa-trash-alt mr-2"></i>Obriši</div>');
                  $("#dugmebrisanje").val("2");
            }else{
                  $(".zabrisanje").hide();
                  $(".inputzaprofil").show();
                  $("#dugmebrisanje").html('<div class="m-auto text-light"><i class="fas fa-portrait mr-2"></i>Postavi profilnu</div>');
                  $("#dugmebrisanje").val("1");
            }
      });
      $("#upload_image").change(function(){
            $("#image_form").submit();
      });

});
function initmap() {
    var latitude = parseFloat($("#latitude").val());
    var longitude = parseFloat($("#longitude").val());   
    mapboxgl.accessToken = 'pk.eyJ1IjoibGF6YXJzdDk2IiwiYSI6ImNqaXBqbTVueDB5ZDAzcXJ2bnRxMm93Zm8ifQ.ixJNC4guYVgeYxNTzqAghg';
      var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/lazarst96/cjirs4bab1ifj2rpmg27ayglj',
        center: [longitude, latitude],
        zoom: 6
      }); 

    var canvas = map.getCanvasContainer();

    var geojson = {
        "type": "FeatureCollection",
        "features": [{
            "type": "Feature",
            "geometry": {
                "type": "Point",
                "coordinates": [longitude, latitude]
            }
        }]
    };

    function onMove(e) {
        var coords = e.lngLat;

        // Set a UI indicator for dragging.
        canvas.style.cursor = 'grabbing';

        // Update the Point feature in `geojson` coordinates
        // and call setData to the source layer `point` on it.
        geojson.features[0].geometry.coordinates = [coords.lng, coords.lat];
        map.getSource('point').setData(geojson);
    }

    function onUp(e) {
        var coords = e.lngLat;

        // Print the coordinates of where the point had
        // finished being dragged to on the map.
        canvas.style.cursor = '';
        $("#latitude").val(coords.lat);
        $("#longitude").val(coords.lng);

        // Unbind mouse/touch events
        map.off('mousemove', onMove);
        map.off('touchmove', onMove);
    }

    map.on('load', function() {

        // Add a single point to the map
        map.addSource('point', {
            "type": "geojson",
            "data": geojson
        });

        map.addLayer({
            "id": "point",
            "type": "circle",
            "source": "point",
            "paint": {
                "circle-radius": 10,
                "circle-color": "#3887be"
            }
        });

        // When the cursor enters a feature in the point layer, prepare for dragging.
        map.on('mouseenter', 'point', function() {
            map.setPaintProperty('point', 'circle-color', '#3bb2d0');
            canvas.style.cursor = 'move';
        });

        map.on('mouseleave', 'point', function() {
            map.setPaintProperty('point', 'circle-color', '#3887be');
            canvas.style.cursor = '';
            // Prevent the default map drag behavior.
        });

        map.on('mousedown', 'point', function(e) {
            e.preventDefault();
            
            canvas.style.cursor = 'grab';

            map.on('mousemove', onMove);
            map.once('mouseup', onUp);
        });

        map.on('touchstart', 'point', function(e) {
            if (e.points.length !== 1) return;

            // Prevent the default map drag behavior.
            e.preventDefault();

            map.on('touchmove', onMove);
            map.once('touchend', onUp);
        });
    });
}
initmap();
$(document).ready(function(){
            // PO DIFOLTU NA POCETAK OSTAVLJA RADIO BUTTONE ZA PROFIL 
            $(".zabrisanje").hide();
            // -----------------------
            
            // OVO JE ZA RADIO KAD SE MENJA DA BRISE I OSTAVLJA STA TREBA
            
            // ---------------------------------------------------
      });