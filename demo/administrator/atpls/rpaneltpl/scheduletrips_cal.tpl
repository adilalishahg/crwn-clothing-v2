<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.hybriditservices.com/demos/httglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<link href="../theme/calendar.css" rel="stylesheet" type="text/css" />
<link href="../theme/fullcalendar.css" rel="stylesheet" type="text/css" />
<link href="../theme/fullcalendar.print.css" rel="stylesheet" type="text/css" />
{literal}
<script type='text/javascript' src='../scripts/jquery-1.5.min.js'></script>
<script type='text/javascript' src='../scripts/jquery-ui-1.8.9.custom.min.js'></script>
<script type='text/javascript' src='../scripts/fullcalendar.js'></script>

<script type='text/javascript'>

		$(document).ready(function() {
	
		$('#calendar').fullCalendar({
		
		    theme: true,
			editable: false,
			
			events: "../routingpanel/scheduletrips3.php"
			
			
		});
	});
</script>
<style type='text/css'>
	body {
		text-align: center;
		font-size: 13px;
		font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
		}
	#calendar {
		margin: 0 auto;
		}
</style>
{/literal}
</head>
<body>
<div style="float:left;"></div>
<div style=" float:right; height:50px;"></div>
<div style=" width:700px;" id='calendar'></div>
</body>
</html>