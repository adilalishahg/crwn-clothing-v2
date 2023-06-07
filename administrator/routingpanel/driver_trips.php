<?php
include_once('../DBAccess/Database.inc.php');
$db = new Database;	
	$db->connect();
$dri_code = $_GET['dri_code'];  if($dri_code==''){$dri_code=0;}
	$a	=	$_GET['a'];
	$b	=	$_GET['b'];
	$date=date("Y-m-d");
/*$qu = "UPDATE trip_details SET pick_latlong = '', drop_latlong = '' WHERE date='".$date."'";
		$db->execute($qu); exit;*/

$Q2="SELECT tdid,pck_add FROM trip_details WHERE (date='".$date."'  AND drv_id='".$dri_code."' AND pick_latlong='') OR (date='".$date."'  AND drv_id='".$dri_code."' AND pick_latlong=',') ";
if($db->query($Q2) && $db->get_num_rows() > 0){		$address2 =  $db->fetch_all_assoc(); 		
 for($i=0;$i<sizeof($address2);$i++){
	 sleep(1);
		$c = getCoordinates($address2[$i]['pck_add']); 
		if($c !='' && $c !=','){
		$qu = "UPDATE trip_details SET pick_latlong = '$c' WHERE pck_add = '".$address2[$i]['pck_add']."'";
		$db->execute($qu);
		$qu = "UPDATE trip_details SET drop_latlong = '$c' WHERE drp_add = '".$address2[$i]['pck_add']."'";
		$db->execute($qu);
		}
	}
}

$Q2="SELECT tdid,drp_add FROM trip_details WHERE (date='".$date."'  AND drv_id='".$dri_code."' AND drop_latlong='') OR (date='".$date."'  AND drv_id='".$dri_code."' AND drop_latlong=',') ";
if($db->query($Q2) && $db->get_num_rows() > 0){		$address2 =  $db->fetch_all_assoc(); 		
 for($i=0;$i<sizeof($address2);$i++){
	 sleep(1);
		$c = getCoordinates($address2[$i]['drp_add']); 
		if($c !='' && $c !=','){
		$qu = "UPDATE trip_details SET drop_latlong = '$c' WHERE drp_add = '".$address2[$i]['drp_add']."'";
		$db->execute($qu);
		$qu = "UPDATE trip_details SET pick_latlong = '$c' WHERE pck_add = '".$address2[$i]['drp_add']."'";
		$db->execute($qu);
		
		}
	}
}


/*$Q2="SELECT tdid,pck_add,drp_add FROM trip_details WHERE date='".$date."'  AND drv_id='".$dri_code."' AND pick_latlong='' ";
if($db->query($Q2) && $db->get_num_rows() > 0){		$address2 =  $db->fetch_all_assoc(); 		
 for($i=0;$i<sizeof($address2);$i++){
	 sleep(1);
		  $c = getCoordinates($address2[$i]['pck_add']); sleep(1);
		  $c2 = getCoordinates($address2[$i]['drp_add']); 
		 if($c !=''){
		$qu = "UPDATE trip_details SET pick_latlong = '$c', drop_latlong = '$c2' WHERE tdid = '".$address2[$i]['tdid']."'";
		$db->execute($qu);
		}
	}
}	*/


function getCoordinates($address){
	$letters1 	= array(' ','#');
	$replace1 	= array('+','No');	
	$add1 		= str_replace($letters1,$replace1,$address);
	$geocode1	= file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$add1.'&sensor=false&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw'); 
	$output1	= json_decode($geocode1);  	
return	$output1->results[0]->geometry->location->lat.','.$output1->results[0]->geometry->location->lng; 
	}
$Q="SELECT pck_add,drp_add,pick_latlong,drop_latlong FROM trip_details WHERE drv_id='".$dri_code."' AND date='".$date."' ORDER BY pck_time ASC";
if($db->query($Q) && $db->get_num_rows() > 0){		$address =  $db->fetch_all_assoc(); 	}

//echo '<pre>';	print_r($address);

?> 
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta http-equiv="refresh" content="500">
<script src="//maps.google.com/maps/api/js?sensor=false&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw"></script>
<script src="../scripts/jquery-1.2.6.js"></script>
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
	 var driver_id = $('#dri_code').val();
	if(driver_id){
$.post("fetchdriverslocations.php", {sheetid: ""+ABC,driver_id: ""+driver_id}, function(data){ 
			if(data.length > 0)
			{	var testdata = data;
			 alldata = testdata;  //alert(alldata);
				}  
	}); }
}
function initialize11() {
  geocoder = new google.maps.Geocoder();
  var haightAshbury = new google.maps.LatLng(<?php echo $udata['google_coordinates']?>);//42.0058862,-88.1714097
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

  //end of direction panel
//geo code
   setupEvents();
   centerChanged();
   geocode();
}
function initialize() {
      var myOptions = { zoom: 11, center: new google.maps.LatLng(<?php echo $udata['google_coordinates']?>), mapTypeId: google.maps.MapTypeId.ROADMAP };
        my.maps.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		//map =  new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
		<?php for($i=0;$i<sizeof($address);$i++){?>
		my.routes.r<?php echo $i?> = new Route([[<?php echo $address[$i]['pick_latlong'] ?>],[<?php echo $address[$i]['drop_latlong'] ?>]]).drawRoute(my.maps.map);
		<?php }?>
		
        //my.routes.r0 = new Route([[55.930385, -3.118425],[50.909700, -1.40435]]).drawRoute(my.maps.map);
        //my.routes.r1 = new Route([[51.454513, -2.58790],[52.6308859, 1.2973550]]).drawRoute(my.maps.map);
        my.routes.rx=new Route();
    }


// Shows any overlays currently in the array
function showOverlays() {
  if (markersArray) {
    for (i in markersArray) {
      markersArray[i].setMap(my.maps.map);
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
	deleteOverlays();
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
		my.maps.addMarker(createMarker(yarana[j].name,latlng,yarana[j].assignment,yarana[j].status,yarana[j].firstname,yarana[j].lastname));
     }
	     console.log(my.maps.map.getMarkers());    
//  console.log(map.getMarkers());
	  }
var infowindow;
(function () {
  google.maps.Map.prototype.markers = new Array();
 /**/ google.maps.Map.prototype.addMarker = function(marker) {
    this.markers[this.markers.length] = marker;  markersArray.push(marker); //alert(marker);
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
  if (markersArray) { //alert(markersArray);
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
   // var marker = new google.maps.Marker({position: latlng, map: my.maps.map,icon: image});
   	 var driver = 'https://chart.googleapis.com/chart?chst=d_map_spin&chld=2.1|0|FFFF42|13|b|'+firstname+'|'+lastname;
     var marker = new google.maps.Marker({position: latlng, map: my.maps.map,icon:driver });
    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content: name});
      infowindow.open(my.maps.map, marker);
    });
    return marker;
  }

//New code for multiple routes

    var my={directionsSVC:new google.maps.DirectionsService(),maps:{},routes:{}};
    /**
        * base-class     
        * @param points optional array array of lat+lng-values defining a route
        * @return object Route
    **/                     
    function Route(points) {
        this.origin       = null;
        this.destination  = null;
        this.waypoints    = [];
        if(points && points.length>1) { this.setPoints(points);}
        return this; 
    };

    /**
        *  draws route on a map 
        *              
        * @param map object google.maps.Map 
        * @return object Route
    **/                    
    Route.prototype.drawRoute = function(map) {
        var _this=this;
        my.directionsSVC.route(
          {"origin": this.origin,
           "destination": this.destination,
           "waypoints": this.waypoints,
           "travelMode": google.maps.DirectionsTravelMode.DRIVING
          },
          function(res,sts) {
                if(sts==google.maps.DirectionsStatus.OK){
                    if(!_this.directionsRenderer) { _this.directionsRenderer=new google.maps.DirectionsRenderer({ "draggable":true }); }
                    _this.directionsRenderer.setMap(map);
                    _this.directionsRenderer.setDirections(res);
                    google.maps.event.addListener(_this.directionsRenderer,"directions_changed", function() { _this.setPoints(); } );
                }   
          });
        return _this;
    };

    /**
    * sets map for directionsRenderer     
    * @param map object google.maps.Map
    **/             
    Route.prototype.setGMap = function(map){ this.directionsRenderer.setMap(map); };

    /**
    * sets origin, destination and waypoints for a route 
    * from a directionsResult or the points-param when passed    
    * 
    * @param points optional array array of lat+lng-values defining a route
    * @return object Route        
    **/
    Route.prototype.setPoints = function(points) {
        this.origin = null;
        this.destination = null;
        this.waypoints = [];
        if(points) {
          for(var p=0;p<points.length;++p){
            this.waypoints.push({location:new google.maps.LatLng(points[p][0], points[p][1]),stopover:false});
          }
          this.origin=this.waypoints.shift().location;
          this.destination=this.waypoints.pop().location;
        }
        else {
          var route=this.directionsRenderer.getDirections().routes[0];
          for(var l=0;l<route.legs.length;++l) {
            if(!this.origin)this.origin=route.legs[l].start_location;
            this.destination = route.legs[l].end_location;

            for(var w=0;w<route.legs[l].via_waypoints.length;++w) { this.waypoints.push({location:route.legs[l].via_waypoints[w], stopover:false});}
          }
          //the route has been modified by the user when you are here you may call now this.getPoints() and work with the result
        }
        return this;
    };

    /**
    * retrieves points for a route 
    *         
    * @return array         
    **/
    Route.prototype.getPoints = function() {
      var points=[[this.origin.lat(),this.origin.lng()]];

      for(var w=0;w<this.waypoints.length;++w) { points.push([this.waypoints[w].location.lat(), this.waypoints[w].location.lng()]);}
      points.push([this.destination.lat(), this.destination.lng()]);
      return points;
    };
</script>
<style>
.lables {color:#000; font-family:Verdana, Geneva, sans-serif;  font-size:12px; font-weight:bold;} </style>
</head>
<body onLoad="initialize()">  
<div style=" width:240px; height:70px; float:left;"><a href="http://hybridtracktrans.com" target="_blank"><img src="../images/logo.png" style="max-height:70px;max-width:220px;"></a>

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
<div style="float:right;width:29%;height:100%;overflow:auto; margin-left:5px;">
  <table width="100%" border="0">
  <?php for($i=0;$i<sizeof($address);$i++){?>
  
  <tr><td style="width:auto; <?php if($i%2==0){?> background:#dfdfdf repeat; <?php }else{?>background:#fff repeat;<?php }?> padding-top:10px;">
    <span style="width:auto; font-family:Verdana, Geneva, sans-serif; font-size:14px;"><strong>Pick Address:</strong>&raquo; <?php echo $address[$i]['pck_add'] ?></span> <br/>
    <span  style="width:auto; font-family:Verdana, Geneva, sans-serif; font-size:14px;"><strong>Drop Address:</strong>&raquo; <?php echo $address[$i]['drp_add'] ?> </span>
  </td></tr>
  <?php } ?>
</table>

  
    </div>
    <input type="hidden" id="dri_code" value="<?php echo $dri_code?>" />
  <!-- <div id="directions_panel" style="width:100%"></div>-->
 <br style="clear: both;"/>
 </body>
</html>
<script type="text/javascript">
setInterval("loopmaker();", 20000);
   loopmaker();
	</script>