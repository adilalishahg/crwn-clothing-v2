<?php include_once('../DBAccess/Database.inc.php'); ?>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <script type="text/javascript"
        src="//maps.google.com/maps/api/js?sensor=false&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw"></script>
    <script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
    <!--<script type="text/javascript" src="../scripts/jquery-ui-1.8.2.custom.min.js"></script>-->

    <script type="text/javascript">
    var overlay;
    var map;
    var markersArray = [];
    var row = new Array();
    var b = new Array();
    var a = new Array();
    var alldata = new Array();
    var setdata = [];
    //new variable
    var geocoder;
    var centerChangedLast;
    var reverseGeocodedLast;
    var currentReverseGeocodeResponse;
    //end of new code
    function fetchdata() {
        var uss = 'allsch';
        $.post("fetchdriverslocations.php", {
            sheetid: "" + uss
        }, function(data) {

            if (data.length > 0) {
                var testdata = data;
                alldata = testdata;
            }
        });
    }

    function initialize() {
        var haightAshbury = new google.maps.LatLng(<?php echo GEOCODE ?>);
        var mapOptions = {
            zoom: 13,
            center: haightAshbury,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
        geocoder = new google.maps.Geocoder();
    }
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

    function loopmaker() {
        fetchdata();
        console.log(alldata);
        clearOverlays();
        //nae code
        row = alldata.split('@');
        //var tttt = row.length+Number(1);
        if (row.length > 0) {
            $('#wait').hide();
        }
        for (var i = 0; i < row.length; i++) {
            var t = new Object();
            var onerec = row[i];
            driverrec = onerec.split('^');
            t.lat = driverrec[1];
            t.lng = driverrec[2];
            t.name = driverrec[3];
            t.assignment = driverrec[4];
            t.status = driverrec[5];
            t.firstname = driverrec[6];
            t.lastname = driverrec[7];
            setdata[i] = t; //alert(setdata[i]);
        }
        //end of new code
        var yarana = setdata; //alert(yarana);
        for (var j = 0; j < yarana.length; j++) {
            var latlng = new google.maps.LatLng(yarana[j].lat, yarana[j].lng);
            //addMarker(yarana[j].name,latlng);  
            map.addMarker(createMarker(yarana[j].name, latlng, yarana[j].assignment, yarana[j].status, yarana[j]
                .firstname, yarana[j].lastname));
        }
        //  console.log(map.getMarkers());    
        console.log(alldata);
        //  console.log(map.getMarkers());
    }
    var infowindow;
    (function() {
        google.maps.Map.prototype.markers = new Array();
        /**/
        google.maps.Map.prototype.addMarker = function(marker) {
            this.markers[this.markers.length] = marker;
            markersArray.push(marker);
        };
        google.maps.Map.prototype.getMarkers = function() {
            return this.markers
        };
        google.maps.Map.prototype.clearMarkers = function() {
            if (infowindow) {
                infowindow.close();
            }
            for (var i = 0; i < this.markers.length; i++) {
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

    function createMarker(name, latlng, assignment, status, firstname, lastname) {
        //alert(status);
        if (assignment == '1') {
            if (status == 9) var image = 'pointer/orange.png'; //Trip assign but not picked
            else if (status == 5) var image = 'pointer/orange.png'; //Trip is Inprogress 
            else if (status == 6) var image = 'pointer/green.png'; //Trip is Picked
            else if (status == 4) var image = 'pointer/blue.png'; //Trip is Droped
            else if (status == 3) var image = 'pointer/purple.png'; //Trip is Cancelled
            else if (status == 7) var image = 'pointer/purple.png'; //Trip is Not at home
            else if (status == 8) var image = 'pointer/purple.png'; //Trip is Not going
            else var image = 'pointer/gray.png'; //Undefine status //getTitle()
        } else var image = 'pointer/red.png'; //vacant drivers
        // cus = 'Salam dkhfsg sjfdlkg lksdfj glkjsdf lgjlksdfj glkjsdf lk';
        //var marker = new google.maps.Marker({position: latlng, map: map,icon: image,title:"Driver",labelContent:cus});
        var driver = 'https://chart.googleapis.com/chart?chst=d_map_spin&chld=2.1|0|FFFF42|13|b|' + firstname + '|' +
            lastname;
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            icon: driver
        });
        /*var marker = new MarkerWithLabel({
       position: latlng,
       map: map,
       draggable: true,
       raiseOnDrag: true,
       labelContent: 'This is the point',
       labelAnchor: new google.maps.Point(50, 0),
       labelClass: "labels", // the CSS class for the label
       labelStyle: {opacity: 0.50}
     });*/
        google.maps.event.addListener(marker, "click", function() {
            if (infowindow) infowindow.close();
            infowindow = new google.maps.InfoWindow({
                content: name
            });
            infowindow.open(map, marker);
        });
        return marker;
    }
    //New code
    function geocode() {
        var address = document.getElementById("address").value;
        geocoder.geocode({
            'address': address,
            'partialmatch': true
        }, geocodeResult);
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

        var text = 'Lat/Lng: ' + getCenterLatLngText();
        if (currentReverseGeocodeResponse) {
            var addr = '';
            if (currentReverseGeocodeResponse.size == 0) {
                addr = 'None';
            } else {
                addr = currentReverseGeocodeResponse[0].formatted_address;
            }
            text = text + '<br>' + 'address: <br>' + addr;
        }

        var infowindow = new google.maps.InfoWindow({
            content: text
        });

        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map, marker);
        });
    }
    loopmaker();
    setTimeout(function() {
        loopmaker();
    }, 5000);
    //setTimeout(function() {  }, 16000);
    </script>
    <style>
    .lables {
        color: #000;
        font-family: Verdana, Geneva, sans-serif;
        font-size: 10px;
    }
    </style>
</head>

<body onLoad="initialize()">
    <div style=" width:220px; height:80px; float:left;"><a href="http://hybridtracktrans.com" target="_blank"><img
                src="../images/logo.png" style="max-height:70px; max-width:200px;"></a>

    </div>
    <div style="float:left; width:76%; margin-top:0px; border: solid 0px #F00;">
        <table width="100%" border="0">
            <!--<tr>
<td><img src="pointer/red.png" height="20px" width="16" />&nbsp;</td><td class="lables">&nbsp;Vacant Drivers</td>
<td><img src="pointer/orange.png" height="20px" width="16"/>&nbsp;</td><td class="lables">&nbsp;Trip assign but not picked yet</td>
<td><img src="pointer/green.png" height="20px" width="16" />&nbsp;</td><td class="lables">&nbsp;Picked</td>
<td><img src="pointer/blue.png" height="20px" width="16" />&nbsp;</td><td class="lables">&nbsp;Droped</td>
<td><img src="pointer/purple.png" height="20px" width="16" />&nbsp;</td><td class="lables">&nbsp;Cancelled/Not going/Not at home</td>
<td><img src="pointer/gray.png" height="20px" width="16" />&nbsp;</td><td class="lables">&nbsp;Undefine</td>
</tr>-->
            <tr>
                <td></td>
                <td colspan="11">Find Address Location: <input type="text" id="address" /><input type="button"
                        value="Find Location" onClick="geocode()"><input type="button" value="Add Marker at Address"
                        onClick="addMarkerAtCenter()" /></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="11">
                    <p id="wait" style="color:#F00;">Please Wait... <span id="countdown">15</span> seconds.</p>
                </td>
            </tr>

        </table>
    </div>
    <div id="map_canvas" style="width:100%; height:90%;float:left;"></div>
    <br style="clear: both;" />
</body>

</html>
<script type="text/javascript">
setInterval("loopmaker();", 16000);
loopmaker();
</script>
<script language="javascript">
var max_time = 15;
var cinterval;

function countdown_timer() {
    // decrease timer
    max_time--;
    document.getElementById('countdown').innerHTML = max_time;
    if (max_time == 0) {
        clearInterval(cinterval);
    }
}
// 1,000 means 1 second.
cinterval = setInterval('countdown_timer()', 1000);
</script>