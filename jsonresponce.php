<?php
$dbconnect = mysqli_connect("localhost","nhmtrans_nhmtran","GBsy4tPX","nhmtrans_nhmtran");
$resultset = mysqli_query($dbconnect ,"SELECT id,gpsurl FROM vehicles");
$arrVDrivers = array();
while($row = mysqli_fetch_object($resultset))
{
	
	$resultset2 = mysqli_query($dbconnect ,"SELECT drv_name FROM dv_mapping WHERE veh_id=".$row->id);
	if(count($resultset2)>0)
	{
		$row2 = mysqli_fetch_object($resultset2);
		$arrVDrivers[$row->gpsurl] = $row2->drv_name;
	}
	else
	{
		$arrVDrivers[$row->gpsurl] = "N/A";
	}
}

//print_r($arrVDrivers);exit;
// Get cURL resource
$curl = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'http://207.38.71.123/api/login',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => array(
        email => 'achishti@hybriditservices.com',
        password => 'Hybrid+112?112'
    )
));
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);
$data = json_decode($resp);
$arrMarkers = array();
if($data->status==1)
{
	$apikey = $data->user_api_hash;
	//echo 'http://207.38.71.123/api/get_devices?lang=en&user_api_hash='.$apikey;exit;
		// Get cURL resource
	$curl = curl_init();
	// Set some options - we are passing in a useragent too here
	curl_setopt_array($curl, array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => 'http://207.38.71.123/api/get_devices?lang=en&user_api_hash='.$apikey,
		CURLOPT_USERAGENT => 'Codular Sample cURL Request',
	  
	));
	// Send the request & save response to $resp
	$resp = curl_exec($curl);
	// Close request to clear up some resources
	curl_close($curl);

	$datadevices = json_decode($resp);
	//echo "<pre>";
	$mycount = 0;
	foreach($datadevices as $deviceGroup)
	{
		//if($deviceGroup->title=="Crown Med")
		if($deviceGroup->title=="H & M")
		{
			
			foreach($deviceGroup->items as $id=>$item)
			{
				$arrMarkers[$mycount]['name'] = $item->name." (".$item->online.")";
				$arrMarkers[$mycount]['online'] = $item->online;
				$arrMarkers[$mycount]['drivername'] = $arrVDrivers[$item->device_data->imei];
				$arrMarkers[$mycount]['lat'] = $item->lat;
				$arrMarkers[$mycount]['lng'] = $item->lng;
				$arrMarkers[$mycount]['imei'] = $item->device_data->imei;
				$arrMarkers[$mycount]['speed'] = $item->device_data->traccar->speed;
				$arrMarkers[$mycount]['latest_positions'] = $item->device_data->traccar->latest_positions;
				$arrMarkers[$mycount]['tail_color'] = $item->device_data->tail_color;
				
				
				$mycount++;
			}
			
		}
	}
	//print_r($arrMarkers);
	//echo "</pre>";
	//exit;
	$output = '<markers>';
	foreach($arrMarkers as $id=>$arrDetail)
	{
		$output .= '<marker id="'.$id.'" name="'.$arrDetail['name'].'" address="'.$arrDetail['imei'].'" lat="'.$arrDetail['lat'].'" lng="'.$arrDetail['lng'].'" speed="'.$arrDetail['speed'].'" drivername="'.$arrDetail['drivername'].'" online="'.$arrDetail['online'].'" latestpositions="'.$arrDetail['latest_positions'].'" tailcolor="'.$arrDetail['tail_color'].'" type="restaurant"/>';
	}
	$output .= '</markers>';
	header("Content-type: text/xml");
	echo $output;
}
else
{


header("Content-type: text/xml");

$output = '';
echo $output;
}
?>