<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Using MySQL and PHP with Google Maps</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>

  <body>
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'Car'
        }
      };
var map;
var mymarkers = [];

        function initMap() {
			 var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;


         map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(39.9720752,-75.2836743), //36.4642336,-106.5901618
          zoom: 7
        });
		 directionsDisplay.setMap(map);

       
loadMarkers();
        calculateAndDisplayRoute(directionsService, directionsDisplay);
  
        }

 function calculateAndDisplayRoute(directionsService, directionsDisplay) {
        var waypts = [];
       

        directionsService.route({
          origin: "<?=$_REQUEST['a']?>",
          destination: "<?=$_REQUEST['b']?>",
          waypoints: waypts,
          optimizeWaypoints: true,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
           /* var summaryPanel = document.getElementById('directions-panel');
            summaryPanel.innerHTML = '';
            // For each route, display summary information.
            for (var i = 0; i < route.legs.length; i++) {
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment +
                  '</b><br>';
              summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
            }*/
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }


      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }

      function doNothing() {}
	   // Sets the map on all markers in the array.
      function setMapOnAll(map) {
        for (var i = 0; i < mymarkers.length; i++) {
          mymarkers[i].setMap(map);
        }
      }

	  function loadMarkers() {
		// alert('Called');
		  
		




		   var infoWindow = new google.maps.InfoWindow;
		  // Change this depending on the name of your PHP or XML file
          downloadUrl('/jsonresponcesimple.php?drvid=<?=$_REQUEST['dri_code']?>&a=<?=$_REQUEST['a']?>&b=<?=$_REQUEST['b']?>', function(data) {
			  setMapOnAll(null);
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute('id');
              var name = markerElem.getAttribute('name');
			   var isOnline = markerElem.getAttribute('online');
			   var dname = markerElem.getAttribute('drivername');
              var address = markerElem.getAttribute('address');
			    var speed = markerElem.getAttribute('speed');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
              text.textContent = address
              infowincontent.appendChild(text);
			   infowincontent.appendChild(document.createElement('br'));
			  
			    var text2 = document.createElement('text');
              text2.textContent = speed
              infowincontent.appendChild(text2);
			   infowincontent.appendChild(document.createElement('br'));
			  
			    var text3 = document.createElement('text');
              text3.textContent = dname
              infowincontent.appendChild(text3);
			  
              var icon = customLabel[type] || {};
			
	
var car = "M17.402,0H5.643C2.526,0,0,3.467,0,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759c3.116,0,5.644-2.527,5.644-5.644 V6.584C23.044,3.467,20.518,0,17.402,0z M22.057,14.188v11.665l-2.729,0.351v-4.806L22.057,14.188z M20.625,10.773 c-1.016,3.9-2.219,8.51-2.219,8.51H4.638l-2.222-8.51C2.417,10.773,11.3,7.755,20.625,10.773z M3.748,21.713v4.492l-2.73-0.349 V14.502L3.748,21.713z M1.018,37.938V27.579l2.73,0.343v8.196L1.018,37.938z M2.575,40.882l2.218-3.336h13.771l2.219,3.336H2.575z M19.328,35.805v-7.872l2.729-0.355v10.048L19.328,35.805z";
if(isOnline=="online")
{
var mycaricon = {
  path: car,
  scale: .7,
  strokeColor: 'white',
  strokeWeight: .10,
  fillOpacity: 1,
  fillColor: '#00ff00',
  offset: '5%',
  // rotation: parseInt(heading[i]),
  anchor: new google.maps.Point(10, 25) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
};
}
else
{
	var mycaricon = {
  path: car,
  scale: .7,
  strokeColor: 'white',
  strokeWeight: .10,
  fillOpacity: 1,
  fillColor: '#ff0000',
  offset: '5%',
  // rotation: parseInt(heading[i]),
  anchor: new google.maps.Point(10, 25) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
};
}
              var marker = new google.maps.Marker({
                map: map,
				icon: mycaricon,
                position: point,
                label: ""
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
			   mymarkers.push(marker);

            });
          });
		  
		  
	  }
	  setInterval('loadMarkers()',50000);
    </script>
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw&callback=initMap"></script> 
  </body>
</html>