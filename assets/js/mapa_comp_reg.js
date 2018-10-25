 function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(setloc, error);
  } else {
    alert("ne radi");
  }

}
function setloc(position){
    $("#latitude").val(position.coords.latitude);
    $("#longitude").val(position.coords.longitude);
  initmap(position.coords.latitude, position.coords.longitude);
}
function error(err) {
    $.getJSON('http://gd.geobytes.com/GetCityDetails?callback=?', function(data) {
      initmap(data["geobyteslatitude"], data["geobyteslongitude"]);
    });
}
function initmap(latitude, longitude) {
    mapboxgl.accessToken = 'pk.eyJ1IjoibGF6YXJzdDk2IiwiYSI6ImNqaXBqbTVueDB5ZDAzcXJ2bnRxMm93Zm8ifQ.ixJNC4guYVgeYxNTzqAghg';
      var map = new mapboxgl.Map({
        container: 'mapa',
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
        });

        map.on('mousedown', 'point', function(e) {
            // Prevent the default map drag behavior.
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
getLocation();