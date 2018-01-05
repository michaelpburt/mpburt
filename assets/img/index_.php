<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Custom marker icons</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v2.2.3/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
</head>
<body>

<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-omnivore/v0.2.0/leaflet-omnivore.min.js'></script>

<div id='map'></div>
<script>

L.mapbox.accessToken = 'pk.eyJ1IjoibWljaGFlbHBidXJ0IiwiYSI6ImNpZ2hnaGFiMDg2OXd0a20wMXMyZHRrM24ifQ.sBc3tBbrMQTPYsgpdtrJIw';
var map = L.mapbox.map('map', 'mapbox.streets-satellite')

// var myLayer = L.mapbox.featureLayer().addTo(map);

// var customLayer = L.geoJson(null, {
//     // http://leafletjs.com/reference.html#geojson-style
//     style: function(feature) {
//         return {
//             color: '#f00'
//         };
//     }
// });

// var runLayer = omnivore.kml('http://localhost:5000/v0.1/updates?user=michael', null, customLayer)
//   .on('ready', function() {
//     map.fitBounds(runLayer.getBounds());
//   })
//   .addTo(map);

omnivore.kml('http://localhost:5000/v0.1/updates?user=michael')
    .on('ready', function(layer) {
        // An example of customizing marker styles based on an attribute.
        // In this case, the data, a CSV file, has a column called 'state'
        // with values referring to states. Your data might have different
        // values, so adjust to fit.
        // if (layer instanceof L.Marker) {
        this.eachLayer(function(marker) {
            if (marker.toGeoJSON().properties.name.indexOf("Landowners") > -1){  
                // The argument to L.mapbox.marker.icon is based on the
                // simplestyle-spec: see that specification for a full
                // description of options.
                marker.setIcon(L.icon({
                    'iconUrl': 'http://mpburt.com/img/landowner-confirm.png',
                    'iconSize': [30, 30]
                }));
            } else {
                marker.setIcon(L.icon({
                    'iconUrl': 'http://mpburt.com/img/landowner-not-confirm.png',
                    'iconSize': [30, 30]
                }));
            }
          // Bind a popup to each icon based on the same properties
          marker.bindPopup(marker.toGeoJSON().properties.name + ', ' +
              marker.toGeoJSON().properties.description);
        });
      // }
    })
    .addTo(map);

// Set a custom icon on each marker based on feature properties.
// myLayer.on('layeradd', function(e) {
//     var marker = e.layer,
//         feature = marker.feature;

//     marker.setIcon(L.icon(feature.properties.icon));
// });

// // Add features to the map.
// myLayer.setGeoJSON(geoJson);

  </script>
</body>
</html>