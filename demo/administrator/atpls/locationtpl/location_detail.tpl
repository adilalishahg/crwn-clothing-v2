<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">
<head>
<meta MMTp-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$pgTitle}</title>
	{literal}
	 <style type="text/css">
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
    </style>
	<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script src="MMTp://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAdUEjy77Apg8cV-krWrQ7exQlCw3P91oSVaavChCcALS3NokerBSv_WLWYQG2sOoC22S2Brq8ZxeQIw"  type="text/javascript"></script>
<script src="../scripts/jquery.jmap.min.js" type="text/javascript"></script>
	<script language="javascript">
	$(document).ready(function($) {		
		$('#map').jmap('init', {mapCenter:[55.958858,-3.162302]}, function(el, options){
      	$(el).jmap("searchDirections", {fromAddress: $('#from').val(), toAddress: $('#to').val(), directionsPanel:"directions"});	
	  	});
	});
	</script>
	{/literal}
</head>
<body>
	<div id="non-printable" style="background-color:#579722; color:#FFFFFF; font-weight:bold; padding:3px; margin-bottom:5px; font-size:16px; font-style:italic;">AZ Pakistan Location Search<span style="padding-left:350px;"><a href="javascript:window.print();"><img src="../../images/printer_icon.png" border="0"></a>&nbsp;|&nbsp;<a href="javascript:window.close();" style="color:#FFFFFF; text-decoration:none; font-size:12px; font-weight:bold;">Close this window</a></span></div>
	<div class="event_detail" id="printable" style="padding:2px; padding-left:0px; padding-right:0px;">
    <div align="right" id="map" style="width:300px; height:350px; float:right; border:#009966 2px solid;"></div>
	<div id="directions" style="width:380px; float:left; margin-bottom:10px; border:#009966 2px solid;" class="direct"></div>
	<input type="hidden" id="from" name="from" value="{$from}" />
	<input type="hidden" id="to" name="to" value="{$to}" />
	<br />
    </div>
</body>
</html>  
  