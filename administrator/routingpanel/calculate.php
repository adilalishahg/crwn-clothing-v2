<html xmlns="http://www.hybriditservices.com/demos/httglobal-2/w3.org/1999/xhtml">
<body>
<?php 
	//$from = $_REQUEST['from']; 	$to = $_REQUEST['to'];
	$from = $_REQUEST['from_val']; 	$to = $_REQUEST['to_val'];
?>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAA-y1i2USi6PLLmT4RvXc-gBQlCw3P91oSVaavChCcALS3NokerBSRHqtJLUD7R2vnmX5f33w4TW1Fzw"></script>
<script type="text/javascript">
//<![CDATA[
var from = '<?php echo $from; ?>';
var to = '<?php echo $to; ?>';
google.load("maps", "2");


var gdir;
var ih = '';
function load() {
	if (GBrowserIsCompatible()){
    	gdir = new google.maps.Directions();
        google.maps.Event.addListener(gdir, "load", handleLoad);
        gdir.load("from: "+from+" to: "+to+"", {getSteps: true});
}}
function handleLoad(){
	var calculated_miles = gdir.getDistance().html;
	calculated_miles = calculated_miles.replace("&nbsp;mi","");
	document.getElementById("totalMiles").innerHTML= '<input value="'+calculated_miles+'" type="text" name="miles1" id="miles1" class="required"/><input type="button" value="Calculate"  onclick="calculate_distance(\'cal_miles\',\'addr1\',\'addr2\');" ><span style="color:#FF0000"> * </span>';
}
function get_miles(){
	return document.getElementById("totalMiles").innerHTML;
}


window.onload = load;
window.onunload = google.maps.Unload;
//]]>
</script>
<div id="totalMiles"></div>
<input type="hidden" name="cm" id="cm" value="">
</body></html>