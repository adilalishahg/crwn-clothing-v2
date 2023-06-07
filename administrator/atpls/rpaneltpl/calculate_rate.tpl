{literal}
<!--<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAARJFby_EDvbtbDXpL59YohhSBgRtPd8RUyPWzmQyqBueRduX8aBQuf96xzgyt0V5sOUobIY63UfMBbw"></script>-->
<!--<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyB5z96NP6Nsn5w0Fs97o2KsVr9BMy49fjo&sensor=true"></script>-->
<script type="text/javascript">
//<![CDATA[
var from = '{/literal}{$from}{literal}';
var to = '{/literal}{$to}{literal}';
var ppm = '{/literal}{$rates[0].price_per_mile}{literal}';
var pc = '{/literal}{$rates[0].pickup_charges}{literal}';
google.load("maps", "2");
var gdir;
function load()
{
	if (GBrowserIsCompatible()) 
	{
		gdir = new google.maps.Directions();
		google.maps.Event.addListener(gdir, "load", handleLoad);
		gdir.load("from: "+from+" to: "+to+"", {getSteps: true});
	}
}
function handleLoad()
{
	var miles = gdir.getDistance().html;
	miles = miles.replace("mi","");
	miles = miles.replace(",","");
	document.getElementById("totalMiles").innerHTML = "Distance: "+miles+" Miles";
	var cost = (parseInt(miles) * parseInt(ppm))+parseInt(pc);
	document.getElementById("totalCost").innerHTML = "Cost: $ "+cost;
	//document.getElementById("totalMiles").innerHTML = gdir.getDistance().html;
}
window.onload = load;
window.onunload = google.maps.Unload;
//]]>
</script>
{/literal}
<link href="../theme/style.css" rel="stylesheet" type="text/css">
<div class="instantrate"> 
  				<table width="100%" border="0" cellspacing="5" cellpadding="3">
                <form action="calculate_rate.php" method="post">
   				  <tr>
				    <td>&nbsp;</td>
				    <td>&nbsp;</td>
				    </tr>
				  <tr>
					<td ><strong>From</strong></td>
					<td >
                    <label>
					  <input type="text" name="center" value="{$from}">
					</label>
                    </td>
				  </tr>
				  <tr>
					<td><strong>To</strong></td>
					<td><input type="text" name="c1" value="{$to}"></td>
				  </tr>
				 <strong>
                    <tr>
                  	<td >Pickup Charges</td><td>{$pickup_charges}</td>
                  </tr>
                   <tr>
                  	<td >Carges Per Mile:</td><td>{$price_per_mile}</td>
                  </tr>
                   <tr>
                  	<td >Distance:</td><td>{$miles}</td>
                  </tr>
                   <tr>
                  	<td >Cost in USD:</td><td>{$cost}</td>
                  </tr></strong>
                           
				  <tr>
					<td>&nbsp;</td>
					<td><input class="btn" type="submit" name="Submit" value="Submit" />
                      <input class="btn" type="submit" name="Submit2" value="Reset" /></td>
				  </tr>
                  </form>
			</table>
  </div>