
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Driver Tracking History</title>
    <script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
    <script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
    <script language="javascript" type="text/javascript" src="../scripts/ui.datepicker.js"></script>
    <link href="../theme/flora.datepicker.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="../theme/style.css" type="text/css">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script type="text/javascript" >
    $(document).ready(function() {
	$("#date").datepicker({ minDate: '-10' , maxDate: '0'});
	$("#history").validate();
		});
    </script>
    <style>
    html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#map_canvas {
  height: 100%;
}

@media print {
  html, body {
    height: auto;
  }

  #map_canvas {
    height: 650px;
  }
}
    </style>


<?php 
include_once('../DBAccess/Database.inc.php');
	$db 	= new Database;
	$date 	= $_POST['date'];
	$dataarray=''; 
	$db->connect();
	$drv = "SELECT drv_code, CONCAT(fname,' ',lname) as driver_name FROM drivers "; 
if($db->query($drv) && $db->get_num_rows() > 0) {$drvdata = $db->fetch_all_assoc(); }
	 $driver_code = $_POST['driver_id'];
$sql = "SELECT lat,lang FROM trackinghistory WHERE driver_code	= '$driver_code' AND datetime BETWEEN '".$date." 00:00:00' AND '".$date." 23:59:59' ORDER BY id ASC "; 
				  if($db->query($sql) && $db->get_num_rows() > 0)	 {$data = $db->fetch_all_assoc();
				$str = '';  
	for($i = 0;$i<sizeof($data);$i++)
	{ 
	 $row = $data[$i];
	/*for($j=0; $j<sizeof($row);$j++){} */
	$str  .= $row['lat'];
	$str  .= '^'.$row['lang'];
 	$str  .= '@';
	} 
	$str = substr($str, 0, -1);
				  
				  }
 ?>	
 
 
	<script>
	var latlangdata = new Array();
	var row = new Array();
	var setdata = [];
latlangdata = '<?php echo $str;?>';	
	 
	
	
      function initialize() {
        var myLatLng = new google.maps.LatLng(32.715071000000002,-117.12111299999999);
        var mapOptions = {
          zoom: 13,
          center: myLatLng,
          mapTypeId: google.maps.MapTypeId.ROADMAP,
        };

        var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
		row = latlangdata.split('@');
				for (var i = 0; i < row.length; i++) { 
				var t =  new Object();
				var onerec = row[i];
				driverrec = onerec.split('^');
				t.lat 		=  driverrec[0]; 
				t.lng 		=  driverrec[1];
				setdata[i] 	=  t; 
				}
		var gukhbarikahani = setdata; 
		var flightPlanCoordinates = new Array();
		for (var j = 0; j < gukhbarikahani.length; j++) {
		//flightPlanCoordinates += new google.maps.LatLng(gukhbarikahani[j].lat,gukhbarikahani[j].lng)+", ";
		 flightPlanCoordinates.push(new google.maps.LatLng(parseFloat(gukhbarikahani[j].lat), parseFloat(gukhbarikahani[j].lng)))+',';
			 }	
			//alert([flightPlanCoordinates]); 
        var flightPath = new google.maps.Polyline({
          path: [flightPlanCoordinates], 
		  strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 3
        });

        flightPath.setMap(map);
      }
    </script>
  </head>
  <body onload="initialize()">
  <div style="float:left; width:76%; margin-top:0px; border: solid 0px #F00;">
<table width="100%" border="0"><form name="" action="" id="history" method="post" enctype="multipart/form-data" >
<tr><td></td><td colspan="11">Select Driver: <select name="driver_id" class="required" ><option value="">--Select Driver--</option>
<?php foreach($drvdata as $rows) {?>
<option value="<?php echo $rows['drv_code']; ?>" <?php if($driver_code == $rows['drv_code']) echo 'selected="selected"; '?> ><?php echo $rows['driver_name'] ;?></option>
<?php } ?>
</select>&nbsp;Select Date: <input type="text" name="date" id="date" value="<?php echo $date; ?>" readonly="true"   maxlength="15" size="26" class="required" />&nbsp;<input type="submit" name="submit"  value="Track History" class="inputButton btn" /></td>
<tr><td></td></tr>
</tr>
  </form>
</table></div>
     <div id="map_canvas" style="width:100%; height:90%;float:left;"></div>
    
  </body>
</html>
