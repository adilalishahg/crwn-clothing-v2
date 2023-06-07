{ include file = header_buzzer2.tpl}
{literal} 
<style>
.assign { 	background-color:#99FF66;	}
.duplicateassign {	 background-color: #FFFF33;	}
</style>
<script type="text/javascript">
$(document).ready(function() { 
refreshed();
});
//setInterval(getalerts(),10000);
	function deleteRec(id,id2,dt)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			location.href="nextdaygrid.php?delId="+id+"&id="+id2+"&dt="+dt;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
function dvmap(did,tid,tdate,ttime,acknowledge_status)
	{
		//alert(did+" -- "+tid+" -- "+tdate+" -- "+ttime);
		var brk =  Array();
		var msg =  Array();
		//if (did != '' && tid != '' && tdate != '' && ttime != '')
		//{
			//brk = val1.split('^');
			//alert("cnfrm.php"+did+" - "+tid+" - "+tdate+" - "+ttime);
		   //	$.post("cnfrm.php", {drv_id: did, trp_id: tid, trp_date: tdate, trp_time:ttime}, function(cnfrm)
			//{ //alert(acknowledge_status);
				//alert('Confirm Return : '+ cnfrm);
				/*if(cnfrm == 0)
				{
				//alert('i got 0 now');
				alert('This Driver is already assign to another trip. \nPlease select different driver?');
					if(cfm)
					{
						$.post("dvmap.php", {did: did, tid: tid, tdate: tdate, ttime: ttime}, function(data)
						{
							if(data.length > 0)
							{
								msg = data.split('^');
								if(msg[1] == '0')
									alert("Not Assigned Yet");
							else
									alert("Assigned");
								$(	"#msg").html(msg[0]);
								if(msg[1] == '0')
								{
									$("#dv"+msg[1]).html('Not assigned Yet');
									$("#dv"+val2).html(brk[1]);
								}
								if(msg[1] != '0' || msg[1] != 'fail'  )
								{
									$("#dv"+msg[1]).html('Not assigned Yet');
									$("#dv"+val2).html(brk[1]);			 
								}
								return true;
							}
						});
					}
					else
					{
						return false;
					}
				}
				else
				{*/
					//alert('i got 1 now');
				//$.post("dvmap.php", {drv: ""+val2, veh:""+brk[0], vehnp:""+brk[1]}, function(data)
$.post("dvmap2.php", {did: did, tid: tid, tdate: tdate, ttime: ttime, acknowledge_status: acknowledge_status}, function(data)
					{
						if(data.length > 0)
						{ //alert(data);
							msg = data.split('^'); //alert(msg[2]);
							if(data == '0')
								alert("Not Assigned Yet");
							else {
								alert("Assigned");//alert(msg[2]); // location.reload(); 
								}
							/*$(	"#msg").html(msg[0]);
							if(msg[1] == '0')
							{
								$("#dv"+msg[1]).html('Not assigned Yet');
								$("#dv"+val2).html(brk[1]);
							}
							if(msg[1] != '0' || msg[1] != 'fail'  )
							{
								$("#dv"+msg[1]).html('Not assigned Yet');
								$("#dv"+val2).html(brk[1]);			 
						}*/
						return true;
					}
					});
	//	}	
	///		});
		/*}
		else
		{
			return false;
		}*/	
	}
	 function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 715, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
    function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 800, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
   function popWind3(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 500, width = 500, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function fsubmit(url,id){
location.href=url+"&driver="+id; }
function fsubmit2(url,id){
location.href=url+"&user="+id;   }
function fsubmit3(url,id){
location.href=url+"&account="+id;}
//Alerts code for 		
function alerts(drv_id){ 
	 if(drv_id != ''){
	var message = prompt("Send Message to : "+drv_id);
		if(message !== ''){	 
		$.post("sendalert.php", {messag: ""+message, driver_code:""+drv_id}, function(data){
  				if(data.length > 0) { //alert(data);
				}
	 }); return true; }
	 	 else {return false; }
	   	}
 	 else { return false; }
	 }
var Usmania; 
var UsmaniaA = new Array();	   
function getalerts(){
		$.post("getalerts.php", {}, function(data){
  				if(data.length > 0) {
				var alerts = data;
				Usmania = alerts;
				sadigalliaga();
			 } });
	}	 
function sadigalliaga(){ //alert(Usmania);
			 UsmaniaA = Usmania.split('@');
			 if(UsmaniaA.length > 1){
				id 		= UsmaniaA[0];
				from 	= UsmaniaA[1];
				message	= UsmaniaA[2];
				senttime= UsmaniaA[3];
						var ok;
		ok=confirm('From: '+from+'      Sent: '+senttime+'\n\nMessage: '+message);
		if (ok)
		{		
			$.post("getalerts.php", {recid: ""+id}, function(data){
			});
			return true;
		}
		else
		{
			return false;
		}
	}   }
	//setInterval ( "getalerts()", 20000);
 //End of alert
 //Page refresh code
 function refreshpagejana(){
	 var value = 'refresh';
 $.post("refreshpage.php", {action: ""+value}, function(data){
	 if(data.length > 0) { 
		 var laylay = data;
		 if(laylay == 0){
		 return false;
		  }
		 else if(laylay == 1){  location.reload();   }
		  }
	});
 }
 function refreshed(){
	 var value = 'refreshed';
 $.post("refreshpage.php", {action: ""+value}, function(data){
			});
 }
 setInterval ( "refreshpagejana()", 1000000);
 //Page refresh code
 //Acknowledge by admin
  function ack(id){
 $.post("acknowledged.php", {id: ""+id}, function(data){
	 if(data.length > 0 ){
		 $('#'+id).hide();
		 }
	});/**/
 }
 //end of acknowledge
</script> 		<script type="text/javascript" src="//maps.google.com/maps/api/js?sensor=false"></script>

<script type="text/javascript">
  var directionsDisplay;
  var directionsService = new google.maps.DirectionsService();
  var map;
  var oldDirections = [];
  var allDirections = [];
  var currentDirections = null;
  var route = [];
  var inc = 1;

  function initialize() {
    var myOptions = {
      zoom: 9,
      center: new google.maps.LatLng(42.0058862,-88.1714097),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

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
          //setUndoDisabled(false);
        }
        currentDirections = directionsDisplay.getDirections();
      });
    //setUndoDisabled(true);
    //calcRoute();
  }
  function calcRoute(add1,add2) {
    start = add1;
      end = add2;
	  inc = inc+1;
	//var start = '48 Pirrama Road, Pyrmont NSW';
    //var end = 'Bondi Beach, NSW';
    var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
      if (status == google.maps.DirectionsStatus.OK) {
	  //allDirections = [];
	  //response= push(response);
	  //route = response.routes[inc];
        directionsDisplay.setDirections(response);
		 
      }
    });
  }
 
 
 function showpanel() {

   var docHeight = $(document).height();

   $("body").append("<div id='overlay'>this is the point</div>");

   $("#overlay")
      .height(docHeight)
      .css({
         'opacity' : 0.4,
         'position': 'absolute',
         'top': 0,
         'left': 0,
         'background-color': 'black',
         'width': '100%',
         'z-index': 5000
      });

} 
  
  
</script>
{/literal}
</head>

<body onLoad="initialize()">
<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">
<tr><td style="background-color:#09F;">{include file = menu.tpl}</td></tr>
<tr><td style="height:10px;"></td></tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="tabs"><ul>
                    <li {if $st== '5'} class="active"{/if}><a href="nextdaygrid.php?date={$date}&st=5">In Progress</a></li>
                     <li class="last" ><a href="nextdaygrid.php?date={$date}&st=9&acknowledge_status=0">Pending Trips</a></li>
<!--  -->                     
 <a href="autoscheduale.php?date={$date}" title="Click for Auto Schedule"><img src="../images/autoprocess.png" border="0"/></a>
 &nbsp;&nbsp;&nbsp;<a href="rescheduale.php?date={$date}" title="Reschedule"><img src="../images/Routing.gif" border="0" height="32" width="32" alt="Reschedule"/></a>{if $yes eq '1'}{if $date neq $date0}{/if}{/if}
                </ul>
                
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <form name="searchReport" action="nextdaygrid.php?st={$st}&date={$date}" method="post">
          <strong>Driver:</strong> <select name="driver" id="driver" onChange="fsubmit('nextdaygrid.php?st={$st}&date={$date}',this.value);">
                                    <option value="">Select Driver</option>
                    {section name=d loop=$drivers}	
                                <option value="{$drivers[d].drv_code}" {if $drivers[d].drv_code eq $drv } selected="selected" {/if}>{$drivers[d].fname} {$drivers[d].lname} - [ {$drivers[d].drv_code} ]</option>
                    {/section}  
                                  </select>
                                  <strong>Client:</strong> <select  onchange="fsubmit2('nextdaygrid.php?st={$st}&date={$date}',this.value);" name="user" id="user">
                                    <option value="">Select Client</option>
                    {section name=d loop=$userdata}	
                   <option value="{$userdata[d].trip_user}" >{$userdata[d].trip_user}</option>
                    {/section}  
                                  </select>
                                  <strong>Accounts:</strong> <select name="account" id="account"  onchange="fsubmit3('nextdaygrid.php?st={$st}&date={$date}',this.value);">
                                    <option value="">Select Account</option>
                    {section name=d loop=$accounts}	
                   <option value="{$accounts[d].id}" >{$accounts[d].account_name}</option>
                    {/section}  
                                  </select>
                                  
                                  </td>
              </tr>
              <tr>
                <td height="19" align="left">
                 <span style="color:#F00; font-weight:bold;" class="admintopheading">SCHEDULE DETAILS [ {$date|date_format} ]  </span>
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--<span style="background-color:#cfc2dd; font-size:14px;">&nbsp;&nbsp;&nbsp;Pre Match Assignment&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--> <span style="background-color:#eecec3; font-size:14px;">&nbsp;&nbsp;&nbsp;Manual Assignment&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#d7ece1; font-size:14px;">&nbsp;&nbsp;&nbsp;Auto Schedule Assignment&nbsp;&nbsp;&nbsp;</span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="background-color:#FF6; font-size:14px;">&nbsp;&nbsp;&nbsp;Let's Fill the Gap&nbsp;&nbsp;&nbsp;</span>
               </td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style=""><table width="100%" border="0" class="main_table1" cellpadding="0" cellspacing="0" >                  
                    <div id="sc"></div>
					<tr><td colspan="12"><div style="height:100%; border: solid #FF0000 0px; padding-top:10px;">
                    <table width="100%" border="0" >
					 <tr>
                      <!--<td align="left" class="label_txt_heading"><strong>Code</strong></td>-->
                      <td align="left" class="label_txt_heading"><strong>Account</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Patient Name</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Miles</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                      <td align="center" class="label_txt_heading"><strong>Options</strong></td>
                      <td align="left" class="label_txt_heading"><strong>{if $st== '9'}Status{else}Location{/if}</strong></td>
                    </tr>
					{section name=q loop=$membdetail}
					<tr valign="top" id="{$membdetail[q].tdid}" {if $membdetail[q].drv_id neq ''}
                   <!--{if $membdetail[q].assign_type eq 'Prematch'} bgcolor="#cfc2dd" {/if}-->
                   {if $membdetail[q].assign_type eq 'Auto'} bgcolor="#d7ece1" {/if}
                   {if $membdetail[q].assign_type eq 'Manual'} bgcolor="#eecec3" {/if}
                    {if $membdetail[q].assign_type eq 'FilltheGap'} bgcolor="#FF6" {/if}
                   
                     {/if} >
                      <!--<td >{$membdetail[q].ccode}</td>-->
                      <td align="left" valign="top" class="grid_content"><b> {section name=p loop=$accounts}
                      { if $accounts[p].id eq $membdetail[q].account } {$accounts[p].account_name} {/if} 
                      {/section}</b></td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_user}<br/>
                      {if $membdetail[q].pcomments neq ''}<img src="../images/icons/information2.png" title="{$membdetail[q].pcomments}" >{else}
                      <img src="../images/icons/information.png" title="{$membdetail[q].pcomments}" >{/if}</td>
<td align="left" valign="top" id="{$membdetail[q].tdid}"> 
<select name="staff1" id="staff1" class="required" onChange="dvmap(this.value,'{$membdetail[q].tdid}', '{$membdetail[q].trip_date}', '{$membdetail[q].pck_time}', '{$membdetail[q].acknowledge_status}', '{$membdetail[q].pck_add}', '{$membdetail[q].drp_add}');">
<option value="">--Select--</option>
{section name=r loop=$driverdata}
<option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}
</select><br/> <a href="#" onClick="calcRoute('{$membdetail[q].pck_add}', '{$membdetail[q].drp_add}');" >Show Route on Map</a>
</td>
                   	 <td align="left" valign="top" class="grid_content">{if $membdetail[q].picklocation neq ''}[<strong>Pick Location:</strong> {$membdetail[q].picklocation}]<br/>{/if}
                   {$membdetail[q].pck_add}{if $membdetail[q].pickup_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].pickup_instruction}]{/if}{if $membdetail[q].p_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].p_phnum}]{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].droplocation neq ''}[<strong>Drop Location:</strong> {$membdetail[q].droplocation}]<br/>{/if}
                      {$membdetail[q].drp_add}{if $membdetail[q].destination_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].destination_instruction}]{/if}{if $membdetail[q].d_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].d_phnum}]{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} W/C{else} {$membdetail[q].pck_time|date_format:"%H:%M"}{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} --:--{else}{$membdetail[q].drp_time|date_format:"%H:%M"}{/if}</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_miles}
                      <!--<span style="font-size:9px; color:#F00;"><br />$ {$membdetail[q].legcharges}</span>--></td>
                      <td align="left" valign="top" class="grid_content"><strong>{$membdetail[q].vehtype}</strong></td>
                      <td align="left" valign="top" class="grid_icon">&nbsp;&nbsp;<a  href="edit2.php?id={$membdetail[q].reqid}&date={$date}" title="Edit" target="_blank"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;			  
   {if $st eq 4}  <a href="javascript:popWind('../reports/details.php?id={$membdetail[q].tdid}');" title="View"> {if $membdetail[q].status eq '4'}
                        Successful
                        {/if}	 
                        {if $membdetail[q].status eq '1'}
                        Delayed
                        {/if} </a>&nbsp;&nbsp;
                        {else}  <a href="javascript:popWind('../reports/details.php?id={$membdetail[q].tdid}');" title="View"> View</a>&nbsp;&nbsp;
                        {/if}
                        {if $smarty.session.admuser.admin_level eq '0'} <a href="#"  onclick="return deleteRec('{$membdetail[q].tdid}','{$id}','{$date}');"  title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a> {/if}
                        <!--&nbsp;<a href="#" onClick="popWind3('temp_comments.php?tdid={$membdetail[q].tdid}');" ><img src="../graphics/temp_comments.png" height="20px" width="20px" /></a>&nbsp;-->
                   </td>
<td >
{if $st eq '9' }
{if $membdetail[q].acknowledge_status eq '0'}Pending{/if}<br/>
{if $membdetail[q].acknowledge_status eq '0'}<span style="color:#66F; font-weight:bold;"><a href="#" onClick="ack('{$membdetail[q].tdid}')">Ack. by Admin</a></span>{/if}
{if $membdetail[q].acknowledge_status eq '2'}<span style="color:#F00; font-weight:bold;">Denied</span>{/if}
{else}

<a title="[{$membdetail[q].drv_id}]" href="driver.php?dri_code={$membdetail[q].drv_id______}&a={$membdetail[q].pck_add}&b={$membdetail[q].drp_add}" target="_blank"><img alt="Track" border="0" src="../graphics/gps.png"></a>
{/if}
</td>
                      
                    </tr>
					
                    {sectionelse}<tr>
                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                    </tr>
					</table></div></td></tr>
					
                    {/section}
                  </table></td>
              </tr>
              <tr>
                <td colspan="12">
                </td>
              </tr>
            </table></td>
        </tr>
      </table></td>

</tr>
<!--<tr><td>
<div style="border: 0px solid #F00; text-align:right;"><a href="#" onClick="$('#mapdiv').toggle();">Map&nabla;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></div>
<div id="mapdiv" style="height:800px; width:100%; overflow:scroll; border: solid #FF0000 0px;" >
<div id="map_canvas" style="float:left;width:100%;height:100%"></div></div>
		</td>		
  </tr>-->
</table>
