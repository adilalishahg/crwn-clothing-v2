<?php
include_once('../DBAccess/Database.inc.php');
	$dri_code = $_GET['dri_code'];
	$a	=	$_GET['a'];
	$b	=	$_GET['b'];
/*$smarty->assign("dri_code",$dri_code);
$smarty->assign("a",$a);
$smarty->assign("b",$b);
$smarty->assign("geocode",$udata['google_coordinates']);
$smarty->display('rpaneltpl/onedriver.tpl');


*/
?>
<html>
<head>
<script> var drv_id =<?php echo $dri_code?>;//'{/literal}{$dri_code}{literal}';
var pickadd =<?php echo $a;?>;//'{/literal}{$a}{literal}';
var dropadd =<?php echo $b;?>;//'{/literal}{$b}{literal}';
</script>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script type="text/javascript">
var overlay;
var map;
var markersArray = [];
var row = new Array();
var b = new Array();
var a = new Array();
var alldata = new Array();
var setdata = [];

//direction panel
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var oldDirections = [];
  var currentDirections = null;
//end of direction panel
function fetchdata()
{	var ABC = 'onedriver';
	 var driver_id = '<?php echo $dri_code?>';
	
$.post("fetchdriverslocations.php", {sheetid: ""+ABC,driver_id: ""+driver_id}, function(data){ 
			if(data.length > 0)
			{	var testdata = data;
			 alldata = testdata; 
				}  
	}); 
}
function initialize() {
  geocoder = new google.maps.Geocoder();
 
  var haightAshbury = new google.maps.LatLng(<?php echo $udata['google_coordinates']?>);//
  var mapOptions = {
    zoom: 10,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
  //geo code
   geocoder = new google.maps.Geocoder();
  //new code for direction panel
      directionsDisplay = new google.maps.DirectionsRenderer({
        'map': map,
        'preserveViewport': true,
        'draggable': true
    });
	directionsDisplay.setPanel(document.getElementById("directions_panel"));
	   google.maps.event.addListener(directionsDisplay, 'directions_changed',
      function() {
        if (currentDirections) {
          oldDirections.push(currentDirections);
          setUndoDisabled(false);
        }
        currentDirections = directionsDisplay.getDirections();
      });
    setUndoDisabled(true);
    calcRoute();
  //end of direction panel
//geo code
   setupEvents();
   centerChanged();
   geocode();
}
//code for direction map
  function calcRoute() {
    var start 	= '<?php echo $a;?>';
    var end 	= '<?php echo $b;?>';
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      }
    });
  }
  function undo() {
    currentDirections = null;
    directionsDisplay.setDirections(oldDirections.pop());
    if (!oldDirections.length) {
      setUndoDisabled(true);
    }
  }
  function setUndoDisabled(value) {
    document.getElementById("undo").disabled = value;
  }  
//end of direction map
// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
}
// Shows any overlays currently in the array
function showOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(map);
    }
  }
}
// Deletes all markers in the array by removing references to them
function deleteOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
    markersArray.length = 0;
  }
}
function loopmaker(){ 
fetchdata();
	//alert(alldata);
	clearOverlays();
	//nae code
				row = alldata.split('@');
				//var tttt = row.length+Number(1);
				for (var i = 0; i < row.length; i++) { 
				var t =  new Object();
				var onerec = row[i];
				driverrec = onerec.split('^');
				t.lat =  driverrec[1]; 
				t.lng =  driverrec[2];
				t.name = driverrec[3];
				t.assignment=  driverrec[4];
				t.status 	=  driverrec[5];
				t.firstname	=  driverrec[6];
				t.lastname 	=  driverrec[7];
				setdata[i] = t; //alert(setdata[i]);
				} //alert(setdata.length);
	//end of new code
	var yarana = setdata; //alert(yarana);
  for (var j = 0; j < yarana.length; j++) {
        var latlng = new google.maps.LatLng(yarana[j].lat, yarana[j].lng);
		//addMarker(yarana[j].name,latlng);  
		map.addMarker(createMarker(yarana[j].name,latlng,yarana[j].assignment,yarana[j].status,yarana[j].firstname,yarana[j].lastname));
     }
	     console.log(map.getMarkers());    
//  console.log(map.getMarkers());
	  }
var infowindow;
(function () {
  google.maps.Map.prototype.markers = new Array();
 /**/ google.maps.Map.prototype.addMarker = function(marker) {
    this.markers[this.markers.length] = marker;  markersArray.push(marker);
  };
  google.maps.Map.prototype.getMarkers = function() {
    return this.markers
  };
  google.maps.Map.prototype.clearMarkers = function() {
    if(infowindow) {
      infowindow.close();
    }
    for(var i=0; i<this.markers.length; i++){
      this.markers[i].set_map(null);
    }
  };
})();
// Removes the overlays from the map, but keeps them in the array
function clearOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(null);
    }
  }
}
 function createMarker(name, latlng, assignment, status,firstname,lastname) {
	 //alert(status);
	 if(assignment == '1'){ 
	 	  if(status == 9) var image = 'pointer/orange.png'; 	//Trip assign but not picked
	 else if(status == 5) var image = 'pointer/orange.png'; 	//Trip is Inprogress 
	 else if(status == 6) var image = 'pointer/green.png'; 		//Trip is Picked
	 else if(status == 4) var image = 'pointer/blue.png'; 		//Trip is Droped
	 else if(status == 3) var image = 'pointer/purple.png'; 	//Trip is Cancelled
	 else if(status == 7) var image = 'pointer/purple.png'; 	//Trip is Not at home
	 else if(status == 8) var image = 'pointer/purple.png'; 	//Trip is Not going
	 else var image = 'pointer/gray.png'; 						//Undefine status
	 }
	 else var image = 'pointer/red.png'; //vacant drivers
    //var marker = new google.maps.Marker({position: latlng, map: map,icon: image});
	var driver = 'https://chart.googleapis.com/chart?chst=d_map_spin&chld=2.1|0|FFFF42|13|b|'+firstname+'|'+lastname;
     var marker = new google.maps.Marker({position: latlng, map: map,icon:driver });
    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content: name});
      infowindow.open(map, marker);
    });
    return marker;
  }
 
  
</script>
<style>
.lables {color:#000; font-family:Verdana, Geneva, sans-serif;  font-size:12px; font-weight:bold;} </style>
</head>
<body onLoad="initialize()">
<div style=" width:240px; height:70px; float:left;"><a href="http://hybridtracktrans.com" target="_blank"><img src="../images/logo.png" style="max-height:70px; max-width:200px;"></a>

</div>
<div style="float:left; width:75%; margin-top:6px; border: solid 0px #F00;">
<table width="76%" border="0">
<tr>
<td><img src="pointer/red.png" height="25px" width="20" />&nbsp;</td><td class="lables">&nbsp;Vacant Drivers</td>
<td><img src="pointer/orange.png" height="25px" width="20" />&nbsp;</td><td class="lables">&nbsp;Trip assign but not picked yet</td>
<td><img src="pointer/green.png" height="25px" width="20" />&nbsp;</td><td class="lables">&nbsp;Picked</td>
</tr>
<tr>
<td><img src="pointer/blue.png" height="25px" width="20" />&nbsp;</td><td class="lables">&nbsp;Droped</td>
<td><img src="pointer/purple.png" height="25px" width="20" />&nbsp;</td><td class="lables">&nbsp;Cancelled/Not going/Not at home</td>
<td><img src="pointer/gray.png" height="25px" width="20" />&nbsp;</td><td class="lables">&nbsp;Undefine</td>
</tr>
  
</table></div>
 <div id="map_canvas" style="float:left;width:70%;height:100%"></div>
<div style="float:right;width:30%;height:100%;overflow:auto">
  <button id="undo" style="display:block;margin:auto" onClick="undo()">Previous Root
  </button>
  <div id="directions_panel" style="width:100%"></div></div>
  <!-- <div id="directions_panel" style="width:100%"></div>-->
 <br style="clear: both;"/>
 </body>
</html>
<script type="text/javascript">
setInterval("loopmaker();", 3000);
loopmaker();
</script>	