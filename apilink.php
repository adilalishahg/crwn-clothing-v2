<?php 
//include_once('administrator/DBAccess/Database.inc.php');
?>
<!DOCTYPE html >

    <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Vehicle Tracking</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.css"/>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.3.1/dt-1.10.18/datatables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.19/sorting/time.js"></script>

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
.marialabels, div[style="color: rgb(0, 0, 0); font-size: 14px; font-family: Roboto, Arial, sans-serif;"] {
	background-color:#FFF;
	color:#000;
	font-size:12px;
	padding:8px;
	margin-top:-45px;
}
div[style="color: rgb(0, 0, 0); font-size: 14px; font-family: Roboto, Arial, sans-serif;"]:after {
	top: -10px;
	left: 3%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	border-color: rgba(185, 9, 8, 0);
	border-top-color: #FFF;
	border-width: 10px;
	margin-left: -10px;
}
.group-list > li.online
{ background-color:#F33;}


#sidebar.collapsed .group-heading > .group-title.btn-collapse::after, #widgets.collapsed .group-heading > .group-title.btn-collapse::after, .group-heading > .group-title.collapsed::after, .ico-map::before, .icon.map::before, .icon.map::before{ content: "\e041";}
#sidebar [data-device="speed"] {
    color: #000;
    font-size: .9em;
}
td{ font-size:12px;}
</style>
    <link rel="stylesheet" href="light-blue.css">
    <style>
	#sidebar [data-device="speed"] {
    color: #000;
    font-size: .9em;
}
.group-list > li > .name [data-device="time"] {
    font-size: .7em;
    display: block;
    color: #000;
}
#sidebar {

    width: 95%;
    height: 250px;

}

.fa-angle-up::before {
    content: "\f105" !important;
	font-family:FontAwesome !important;
	font: normal normal normal 14px/1 FontAwesome !important;
    font-weight: normal !important;
    font-size: 18px !important;
    line-height: 1 !important;

text-rendering: auto !important;
line-height: inherit !important;
}
</style>
    <script>
    function ChangeWidth()
	{
		var width = document.getElementById('sidebar').style.width;
		if(width=='0px')
		{
			document.getElementById('sidebar').style.width = '95%';
			document.getElementById('address').style.display = 'block';
			document.getElementById('searchtab').style.display = 'block';
			document.getElementById('searchbutton').style.visibility = 'visible';
			document.getElementById('addbutton').style.visibility = 'visible';
			
		}
		else
		{
			document.getElementById('sidebar').style.width = '0px';	
			document.getElementById('address').style.display = 'none';
			document.getElementById('searchtab').style.display = 'none';
			document.getElementById('searchbutton').style.visibility = 'hidden';
			document.getElementById('addbutton').style.visibility = 'hidden';
		}
	}
	 function ChangeHeight()
	{
		console.log('teste');
		var height = document.getElementById('sidebar').style.height;
		console.log(height);
		if(height=='250px')
		{
			document.getElementById('sidebar').style.height = '450px';
			document.getElementById('tab-pane-body').style.height = "350px";
			//tab-pane-body
			
		}
		else
		{
			document.getElementById('sidebar').style.height = '250px';	
			document.getElementById('tab-pane-body').style.height = "150.2px";
			
		}
	}
    </script>
    </head>

    <body>
<div id="sidebar" style="padding-bottom: 0px; height:250px;" class=""> 
<a class="btn-collapse" onClick="ChangeWidth()"><i></i></a>
<a class="btn-collapse" onClick="ChangeHeight()" style="top: -30px;left: 50%;transform: rotate(270deg);"><i class="fa fa-angle-up"></i></a>
  <div class="sidebar-content">
    <ul class="nav nav-tabs nav-default">
      <li role="presentation" class="active" id="searchtab"> <a href="#objects_tab" type="button" data-toggle="tab">Search</a> </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="objects_tab">
        <div class="tab-pane-header">
          <div class="form">
            <div class="input-group ">
              <div class="form-group">
              <label style="float:left; line-height:20px;">Search Address&nbsp;&nbsp;</label>
                <input class="form-control" placeholder="Search" autocomplete="off" name="search" type="text" id="address" style="width:60%;">
                <span class="input-group-btn" id="searchbuttons">
              <button class="btn btn-primary" type="button" onClick="geocode()" id="searchbutton"> <i class="icon search"></i> </button>
              <button class="btn btn-primary" type="button" onClick="addMarkerAtCenter()" id="addbutton"> <i class="icon map"></i> </button>
              </span>
              </div>
               </div>
          </div>
        </div>
        <div class="tab-pane-body" style="height: 150.2px;" id="tab-pane-body">
          <div id="ajax-items" style="position: relative;">
            <div>
              <div class="group">
                <!--<div class="group-heading">
                  <div class="group-title"> Results</div>
                </div>-->
                <div id="device-group-0">
                  <div class="group-body">
                    <ul class="group-list" id="group-list">
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="float:left; width:80%; height:100%; margin-top:0px; border: solid 0px #F00;">
  <div id="map"></div>
</div>

<script>
function searchme() {
 autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('address')),
     { types: ['geocode'] });
}

      	var customLabel = {restaurant: {label: 'R'},bar: {label: 'Car'}};
		var map;
		var markerCluster = null;
		var mymarkers = new Array();
		var myonlinemarkers = new Array();
		var infoWindow;
		 var directionsService;// = new google.maps.DirectionsService;
        var directionsDisplay;// = new google.maps.DirectionsRenderer;
		var onlineackcounter = 0;
		var PrevMarker = null;
		var car = "M17.402,0H5.643C2.526,0,0,3.467,0,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759c3.116,0,5.644-2.527,5.644-5.644 V6.584C23.044,3.467,20.518,0,17.402,0z M22.057,14.188v11.665l-2.729,0.351v-4.806L22.057,14.188z M20.625,10.773 c-1.016,3.9-2.219,8.51-2.219,8.51H4.638l-2.222-8.51C2.417,10.773,11.3,7.755,20.625,10.773z M3.748,21.713v4.492l-2.73-0.349 V14.502L3.748,21.713z M1.018,37.938V27.579l2.73,0.343v8.196L1.018,37.938z M2.575,40.882l2.218-3.336h13.771l2.219,3.336H2.575z M19.328,35.805v-7.872l2.729-0.355v10.048L19.328,35.805z";
		var mycariconActive;var mycariconAck;var mycariconOffline;
        function initMap() {
			
         	map = new google.maps.Map(document.getElementById('map'), {
          		center: new google.maps.LatLng(39.9720752,-75.2836743), //36.4642336,-106.5901618
          		zoom: 8,
				 mapTypeId: google.maps.MapTypeId.ROADMAP,

        	});
			markerCluster = new MarkerClusterer(map,mymarkers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
			geocoder = new google.maps.Geocoder();
			searchme();
     		/*   var trafficLayer = new google.maps.TrafficLayer();
  			trafficLayer.setMap(map);*/
			mycariconActive = {path: car,scale: .7,strokeColor: 'white',strokeWeight: .10,fillOpacity: 2,fillColor: '#000000',offset: '5%',
  			// rotation: parseInt(heading[i]),
  			anchor: new google.maps.Point(10, 25) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
			};

			mycariconAck = {path: car,scale: .7,strokeColor: 'white',strokeWeight: .10,fillOpacity: 2,fillColor: '#0000FF',offset: '5%',
		  	// rotation: parseInt(heading[i]),
		  	anchor: new google.maps.Point(10, 25) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
			};

			mycariconOffline = {path: car,scale: .7,strokeColor: 'white',strokeWeight: .10,fillOpacity: 2,fillColor: '#ff0000',offset: '5%',
   			rotation: parseInt(75),
  			anchor: new google.maps.Point(10, 25) // orig 10,50 back of car, 10,0 front of car, 10,25 center of car
			};

			directionsService = new google.maps.DirectionsService;
			directionsDisplay = new google.maps.DirectionsRenderer;
			directionsDisplay.setMap(map);
			loadMarkers();		
		}
		function downloadUrl(url, callback) {
			var request = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest;
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
			mymarkers = new Array();
		}

	  	function loadMarkers() {
		  	infoWindow = new google.maps.InfoWindow;
		  	// Change this depending on the name of your PHP or XML file
          	downloadUrl('/jsonresponce.php', function(data) {
				markerCluster.clearMarkers();
			setMapOnAll(null);	
				 
            
			var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
			var id;var name; var isOnline; var dname;var address; var speed; var type ; var point;var infowincontent;var strong; var davailabel;
			var text; var text2; var text3;var icon;var mycaricon;var marker;
			  
            Array.prototype.forEach.call(markers, function(markerElem) {
				id = markerElem.getAttribute('id');
				name = markerElem.getAttribute('name');
				isOnline = markerElem.getAttribute('online');
				dname = markerElem.getAttribute('drivername');
				address = markerElem.getAttribute('address');
				speed = markerElem.getAttribute('speed');
				type = markerElem.getAttribute('type');
				davailabel = markerElem.getAttribute('driveravailabel');
				var latestposition = markerElem.getAttribute('latestpositions');
				point = new google.maps.LatLng(parseFloat(markerElem.getAttribute('lat')),parseFloat(markerElem.getAttribute('lng')));  
 var  content = '<div class="marker-form"><div class="head" id="marker-header">'+name+'</div><div id="marker-info">'+address+'<br>'+speed+'<br>'+dname+'</div></div>';			
				
				icon = customLabel[type] || {};	
			  	if(isOnline=="online")
			  		mycaricon = mycariconActive;
				else
				{
					if(isOnline=="ack") mycaricon = mycariconAck;else mycaricon = mycariconOffline;					
				}
              	marker = new google.maps.Marker({map: map,icon: mycaricon,position: point,label: name, customInfo: dname,customInfodrivera:davailabel});
              	//marker.addListener('click', function() {infoWindow.setContent(infowincontent);infoWindow.open(map, marker);});				
				// Add Click Event to Marker
    			google.maps.event.addListener(marker, 'click', function(){		
					infoWindow.setContent(content);		
					infoWindow.open(map, this);        
    			});	
				if(isOnline=="online")
				{
					var flightPlanCoordinates = [];
					//39.917306666667/-76.69658;
					var array = latestposition.split(";");
					var array2 = '';
					
					for(i=0;i<2 && i<array.length ;i++)
					{
						array2 = array[i].split('/');
						flightPlanCoordinates.push({'lat': parseFloat(array2[0]), 'lng': parseFloat(array2[1])});
					}
					//console.log(flightPlanCoordinates);
					var flightPath = new google.maps.Polyline({
					  path: flightPlanCoordinates,
					  geodesic: true,
					  strokeColor: '#33cc33',
					  strokeOpacity: 1.0,
					  strokeWeight: 1
					});
			
					flightPath.setMap(map);

				}
			   	mymarkers[id] = marker;
				if(isOnline=='online' || isOnline=='ack')
				{	myonlinemarkers[onlineackcounter] = marker; onlineackcounter++;}

            });
			//console.log(mymarkers);
			 // Add a marker clusterer to manage the markers.			 
			 markerCluster.addMarkers(mymarkers);
          });		  
	  }
	  setInterval('loadMarkers()',15000);
	  
	  //new variable
  var geocoder;
  var centerChangedLast;
  var reverseGeocodedLast;
  var currentReverseGeocodeResponse;
//end of new code
	  //New code
	function geocode() {
    	var address = document.getElementById("address").value;
    	geocoder.geocode({'address': address,'partialmatch': true}, geocodeResult);
  	}

  	function geocodeResult(results, status) {
    if (status == 'OK' && results.length > 0) {
      map.fitBounds(results[0].geometry.viewport);
    } else {
      alert("Geocode was not successful for the following reason: " + status);
    }
  }
  function addMarkerAtCenter() {
    var marker = new google.maps.Marker({
        position: map.getCenter(),
        map: map
    });
	if(PrevMarker!=null)
						PrevMarker.setMap(null);
PrevMarker =marker;
	var origin = {lat:marker.getPosition().lat(),lng:marker.getPosition().lng()};
	
 calculateAndDisplayRoute(directionsService, directionsDisplay,origin);

   
  }
  function secondsToTime(inputSeconds) {
   var secondsInAMinute = 60;
   var secondsInAnHour  = 60 * secondsInAMinute;
   var hours = Math.floor(inputSeconds / secondsInAnHour);
   var minuteSeconds = inputSeconds % secondsInAnHour;
   var minutes = Math.floor(minuteSeconds / secondsInAMinute);
   var Seconds = minuteSeconds % secondsInAMinute;
   var obj = hours+':'+minutes+':'+Seconds;
   return obj;
   }
   function calculateAndDisplayRoute(directionsService, directionsDisplay,startMarker) {
        var service = new google.maps.DistanceMatrixService;
		 var destinationIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=D|FF0000|000000';
        var originIcon = 'https://chart.googleapis.com/chart?' +
            'chst=d_map_pin_letter&chld=O|FFFF00|000000';
		var destination = [];
		var counter = 1;
		myonlinemarkers.forEach(function(element) {
			if(counter <= 21 )
			destination.push({lat:element.getPosition().lat(),lng:element.getPosition().lng()});			
			counter++;
		});
        service.getDistanceMatrix({
          origins: [startMarker],
          destinations: destination,
          travelMode: 'DRIVING',
          unitSystem: google.maps.UnitSystem.METRIC,
          avoidHighways: false,
          avoidTolls: false
        }, function(response, status) {
          if (status !== 'OK') {
            alert('Error was: ' + status);
          } else {
            var originList = response.originAddresses;
            var destinationList = response.destinationAddresses;
           // var outputDiv = document.getElementById('group-list');
           // outputDiv.innerHTML = '';
           // deleteMarkers(markersArray);

            var showGeocodedAddressOnMap = function(asDestination) {
              var icon = asDestination ? destinationIcon : originIcon;
              return function(results, status) {
                if (status === 'OK') {
					
                 // map.fitBounds(map.getBounds().extend(results[0].geometry.location));
                 /* mymarkers.push(new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: icon
                  }));*/
                } else {
                  alert('Geocode was not successful due to: ' + status);
                }
              };
            };
var myclasser = '';
var dataSet = [ ];
            for (var i = 0; i < originList.length; i++) {
              var results = response.rows[i].elements;
			  
             /* geocoder.geocode({'address': originList[i]},
                  showGeocodedAddressOnMap(false));*/
				  console.log(results);
              for (var j = 0; j < results.length; j++) {
             /*   geocoder.geocode({'address': destinationList[j]},
                    showGeocodedAddressOnMap(true));*/
					if(myonlinemarkers[j].getLabel().indexOf('online')>0)
						myclasser = 'online';
					else
						myclasser = '';	
					//	console.log(results[j].distance.value * 0.000621371);
              /*  outputDiv.innerHTML += "<li class='"+myclasser+"'><div class=\"name\"> <span data-device=\"name\"> "+myonlinemarkers[j].getLabel()+" "+destinationList[j] + '</span> <span data-device="time">' + originList[i] +
                    '</span> </div><div class="details"> <span data-device="speed">' + parseFloat(results[j].distance.value * 0.000621371).toFixed(2) + ' miles ('+results[j].duration.text +')</span> </div></li>';*/
					
					var fruits = [myonlinemarkers[j].getLabel(),destinationList[j],originList[i], parseFloat(results[j].distance.value * 0.000621371).toFixed(2), secondsToTime(results[j].duration.value),myonlinemarkers[j].customInfo,myonlinemarkers[j].customInfodrivera ];
						dataSet.push(fruits);
              }
            }
			//outputDiv.style.display = 'none';
			$('#device-group-0').html('<table id="example" class="display" width="100%"></table>');
			 $('#example').DataTable( {
        data: dataSet,
        columns: [
            { title: "Vehicle" },
			{ title: "Current Location" },
			{ title: "Destination" },
            { title: "Distance" },
            { title: "Time" },
			{ title: "Driver" },
			{ title: "Driver Availability" },
            
            
        ],
		"order": [[ 3, "asc" ]],
		 columnDefs: [
       			{ type: 'time-uni', targets: 4 }
     		]
    } );
	
	
	
          }
        });
		//});
   }
  
    </script> 
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script> 
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw&callback=initMap&sensor=false&libraries=geometry,places&ext=.js"></script> 
<script src="https://cdn.rawgit.com/googlemaps/v3-utility-library/master/markerwithlabel/src/markerwithlabel.js"></script>
</body>
</html>