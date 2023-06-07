<?php
$cSession = curl_init(); 
//step2
curl_setopt($cSession,CURLOPT_URL,"https://maps.googleapis.com/maps/api/place/queryautocomplete/json?key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw&input=".urlencode($_REQUEST['input']));
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
curl_setopt($cSession,CURLOPT_HEADER, false); 
//step3
$result=curl_exec($cSession);
//step4
curl_close($cSession);
//step5
//echo $result;

$arrResults = array();
$result = json_decode($result);
foreach($result->predictions as $pred)
{
	$arrResults[] = $pred->description;
}
echo json_encode($arrResults);

?>