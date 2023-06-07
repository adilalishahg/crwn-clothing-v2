{ include file = header_buzzer3.tpl}

{literal} 
<script type="text/javascript">
 $(document).ready(function() { 
});
refreshed();
function st_status_change(id,st,request_id){ 
	ok=confirm("Are you sure you want to change status of this Trip?");
		if (ok)
		{ //alert(st);		
	 $.post("editgrid_ajax.php", {id: ""+id,st: ""+st,request_id: ""+request_id}, function(data){
	 if(data.length > 0 ){  location.reload();
		 }
	});
		}else return false;
	}		
//setInterval(getalerts(),10000);
	function deleteRec(id,id2)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			location.href="grid2.php?delId="+id+"&id="+id2;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
	//function dvmap(val1,val2)
	function dvmap(did,tid,tdate,ttime,acknowledge_status)
	{
		//alert(did+" -- "+tid+" -- "+tdate+" -- "+ttime);
		var brk =  Array();
		var msg =  Array();
		if (did != '' && tid != '' && tdate != '' && ttime != '')
		{
			//brk = val1.split('^');
			//alert("cnfrm.php"+did+" - "+tid+" - "+tdate+" - "+ttime);
		   	$.post("cnfrm.php", {drv_id: did, trp_id: tid, trp_date: tdate, trp_time:ttime}, function(cnfrm)
			{ //alert(acknowledge_status);
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
$.post("dvmap.php", {did: did, tid: tid, tdate: tdate, ttime: ttime, acknowledge_status: acknowledge_status}, function(data)
					{
						if(data.length > 0)
						{
							msg = data.split('^');
							if(msg[1] == '0')
								alert("Not Assigned Yet");
							else
								alert("Assigned");
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
				//}	
			});
		}
		else
		{
			return false;
		}	
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
location.href=url+"&account="+id;   		}
//Alerts code for 		
/*function alerts(drv_id){ 
 if(drv_id != ''){
	var message = prompt("Send Message to : "+drv_id);
		if(message !== '' && message.length > 0){	 
		$.post("sendalert.php", {messag: ""+message, driver_code:""+drv_id}, function(data){ //alert(data);
  				if(data.length > 0) { 
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
	setInterval ( "getalerts()", 10000);
 //End of alert
 //Page refresh code
 function refreshpagejana(){
	 var value = 'refresh';
 $.post("refreshpage.php", {action: ""+value}, function(data){
	 if(data.length > 0) { //alert(data);
		 var laylay = data;
		 if(laylay == 0 || laylay == 'P0'){
		 return false;
		  }
		 else if(laylay == 1 || laylay == 'T0'){  location.reload();   }
		  }
	});
 }
 function refreshed(){ 
	 var valu = 'refreshed'; //alert(valu);
 $.post("refreshpage.php", {action: ""+valu}, function(data){
			});
 }
 setInterval ( "refreshpagejana()", 10000);*/
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
 //start of finding coordinates from google
 function findcoord(addtype,add,id){
	 //alert(id);
	 $.post("add_cordinates.php", {id: ""+id, addtype: ""+addtype}, function(data){
		 if(data.length > 0 ){
			 if(data == 1){ location.reload();   }
			 else if(data !== 1){ return false; }
			 }
			});
	 }
 //End of finding google coordinates

</script> 
{/literal}

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">
<tr><td style="background-color:#09F;">{include file = menu.tpl}</td></tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
                  
                  
                  
                  { if $errors != ''} {$errors} {/if}</span></td>
              </tr>
              <tr>
                <td height="19" align="center"><div id="search_form">
                    <form name="searchReport" action="grid2.php?id={$id}&st={$st}&ad={$ad}" method="post">
                      <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >
                        <tr>
                          <td colspan="8" align="left" valign="middle" class="labeltxt"><table border="0" width="100%">
                              <tr>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><strong>Driver ID:</strong></td>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><select name="driver" id="driver" onchange="fsubmit('grid2.php?id={$id}&st={$st}&ad={$ad}',this.value);">
                                    <option value="">Select Driver</option>
                    {section name=d loop=$drivers}	
                                <option value="{$drivers[d].drv_code}" {if $drivers[d].drv_code eq $drv } selected="selected" {/if}>{$drivers[d].fname} {$drivers[d].lname} - [ {$drivers[d].drv_code} ]</option>
                    {/section}  
                                  </select></td>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><strong>Patient:</strong></td>
                                <td align="left" valign="top" class="labeltxt"><select  onchange="fsubmit2('grid2.php?id={$id}&st={$st}&ad={$ad}',this.value);" name="user" id="user">
                                    <option value="">Select Patient</option>
                    {section name=d loop=$userdata}	
                   <option value="{$userdata[d].trip_user}" >{$userdata[d].trip_user}</option>
                    {/section}  
                                  </select>
                                  <!--<input type="text" name="user" id="user" value="{$user}" class="inputTxtField "/>--> 
                                  &nbsp;
                                  <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
                                    <div class="suggestionList" id="autoSuggestionsList1"> &nbsp;</div>
                                  </div></td>
                                <td colspan="2" align="left" valign="top" class="labeltxt"><strong>Accounts:</strong>&nbsp;</td>
                                <td rowspan="2" align="left" valign="top" class="labeltxt"><select name="account" id="account"  onchange="fsubmit3('grid2.php?id={$id}&st={$st}&ad={$ad}',this.value);">
                                    <option value="">Select Account</option>
                    {section name=d loop=$accounts}	
                   <option value="{$accounts[d].id}" >{$accounts[d].account_name}</option>
                    {/section}  
                                  </select>
               <!--<input type="text" name="clinic" id="clinic" value="{$clinic}" class="inputTxtField date" />-->
                                  <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">
                                    <div class="suggestionList" id="div">&nbsp;</div>
                                  </div></td>
                    <td valign="top"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  />
                                  &nbsp; </td>
                                <td rowspan="2"  align="left" valign="top" class="labeltxt"><a href="index.php"><img src="../images/person_icon.png" border="0"  /></a> <!--<a href="hits-map-all-drivers-location.html" target="_blank"><img src="../graphics/gps.png"></a>--></td>
                              </tr>
                            </table></td>
                        </tr>
                      </table>
                    </form>
                  </div></td>
              </tr>
              <tr>
                <td class="tabs"><ul>
                    <!--<li {if $st== '9'} class="active"{/if}><a href="grid2.php?id={$id}&st=9&acknowledge_status=0">Pending ({$st9})</a></li>
                    <li {if $st== '5'} class="active"{/if}><a href="grid2.php?id={$id}&st=5">In Progress ({$st5})</a></li>
                    <li {if $st== '10'} class="active"{/if}><a href="grid2.php?id={$id}&st=10">Arrived ({$st10})</a></li>
                    <li {if $st== '6'} class="active"{/if}><a  href="grid2.php?id={$id}&st=6">Picked Up ({$st6})</a></li>
                 -->   
                 	<li style="background-color:#093;"><a href="grid2.php?id={$id}&st=11" >Open Runs ({$st11})</a></li>
                    <li {if $st== '4'} class="active"{/if}><a href="grid2.php?id={$id}&st=4&ad=0">Delivered Runs ({$st4})</a></li>
                    <li {if $st== '3'} class="last" {/if}><a href="grid2.php?id={$id}&st=3&ad=0">Cancelled Runs ({$st3})</a></li>
                    
                    <!--<li {if $st eq '0' || $acknowledge_status eq '0'} class="last" {else} class="last"{/if}>
                    <a href="grid2.php?id={$id}&st=9&acknowledge_status=0">Pending Trips ({$st9})</a>
                    </li> 
                   <li><input type="button" value="GET" onclick="getalerts()" /></li>-->
                  </ul></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">ROUTING SHEET DETAILS </td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0" >
                    <tr>
                      <!--<td align="left" class="label_txt_heading"><strong>Code</strong></td>-->
                      <td align="left" class="label_txt_heading"><strong>Account<br/>Trip ID</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Patient Name </strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Appt. Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Miles</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                      <td align="center" class="label_txt_heading"><strong>Options</strong></td>
                      <td align="left" class="label_txt_heading"><strong>{if $st== '9'}Status{else}Location{/if}</strong></td>
                    </tr>
                    <div id="sc"></div>
                    {section name=q loop=$membdetail}
                    <tr  valign="top" id="{$membdetail[q].tdid}"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}"><!---->
                     <!-- <td >{$membdetail[q].ccode}</td>
                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_clinic}</b></td>-->
                      <td align="left" valign="top" class="grid_content"><b>
                      {section name=p loop=$accounts}
                      { if $accounts[p].id eq $membdetail[q].account } {$accounts[p].account_name} {/if} 
                      {/section}
                      </b><br/>{$membdetail[q].ccode} {$membdetail[q].modiv_id}</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_user}<br/>
                      {if $membdetail[q].pcomments neq ''}<img src="../images/icons/information2.png" title="{$membdetail[q].pcomments}" >{else}
                      <img src="../images/icons/information.png" title="{$membdetail[q].pcomments}" >{/if}
                      {if $membdetail[q].modiv_flage eq '1'}<img style="margin-top: -11px;" border="0" width="60" height="30" title="ModivCare" alt="ModivCare" src="../graphics/modiv30.svg" />{/if}
                      </td>
                      <!--<td align="left" valign="top" class="grid_content"> 
                      {if $st neq '9'}
{$membdetail[q].driver}-[{$membdetail[q].drv_id}]
{else}
<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}','{$membdetail[q].acknowledge_status}')">
<option value="">--Select--</option>
{section name=r loop=$driverdata}
<option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}
</select>
{/if} </td>-->
        <td align="left" valign="top" class="grid_content"><select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}','{$membdetail[q].acknowledge_status}')">
                         <option value="">--Select--</option>
{if $membdetail[q].modiv_flage eq '1'}
{section name=r loop=$driverdata_modiv}
            <option value="{$driverdata_modiv[r].drv_code}" {if $driverdata_modiv[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata_modiv[r].fname} {$driverdata_modiv[r].lname}</option>
{/section}  
{else}                         
                         
                         
{section name=r loop=$driverdata}
            <option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $membdetail[q].drv_id}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}
{/if}
                      </select></td>
             <!--<td align="left" valign="top" class="grid_content"> {if $membdetail[q].drv_id neq ''}
{$membdetail[q].driver}-[{$membdetail[q].drv_id}]
{else}
{if $st== '5' || $st== '9'}
<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}')">
<option value="">--Select--</option>
{section name=r loop=$driverdata}
<option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $staff1}selected{/if}>{$driverdata[r].fname} {$driverdata[r].lname}</option>
{/section}
</select>
{/if}
{/if} </td>
-->
                   <td align="left" valign="top" class="grid_content">{if $membdetail[q].picklocation neq ''}[<strong>Pick Location:</strong> {$membdetail[q].picklocation}]<br/>{/if}
                   {$membdetail[q].pck_add}{if $membdetail[q].pickup_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].pickup_instruction}]{/if}{if $membdetail[q].p_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].p_phnum}]{/if}
                        <!--<a href="#" onclick="findcoord('pick','{$membdetail[q].pck_add}','{$membdetail[q].tdid}');" > {if $membdetail[q].pick_latlong eq '' || $membdetail[q].pick_latlong eq 'NULL'}<img src="../images/icons/null_cord.png" title="Find Coordinate" >{else}<img src="../images/icons/yes_cord.png" title="Find Updated Coordinate" >{/if}</a>--></td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].droplocation neq ''}[<strong>Drop Location:</strong> {$membdetail[q].droplocation}]<br/>{/if}
                      {$membdetail[q].drp_add}{if $membdetail[q].destination_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].destination_instruction}]{/if}{if $membdetail[q].d_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].d_phnum}]{/if}<!--<br/>
<a href="#" onclick="findcoord('drop','{$membdetail[q].drp_add}','{$membdetail[q].tdid}');" >{if $membdetail[q].drop_latlong eq '' || $membdetail[q].drop_latlong eq 'NULL'}<img src="../images/icons/null_cord.png" title="Find Coordinate" >{else}<img src="../images/icons/yes_cord.png" title="Find Updated Coordinate" >{/if}</a>--></td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} W/C{else} {$membdetail[q].pck_time}{/if}</td>
                      <td align="left" valign="top" class="grid_content" >{if $membdetail[q].org_apptime neq ''}  {$membdetail[q].org_apptime}{else}--:--{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} --:--{else}{$membdetail[q].drp_time}{/if}</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_miles}
                      {if $membdetail[q].modiv_flage eq '1'}
                      <br/>$ {$membdetail[q].legcharges}
                      {/if}
                      <!--<span style="font-size:9px; color:#F00;"><br />$ {$membdetail[q].legcharges}</span>--></td>
                      <td align="left" valign="top" class="grid_content">
                      
                      {$membdetail[q].vehtype}
                      
                      </td>
                      <td align="left" valign="top" class="grid_icon"><!--<a  href="#" onclick="popWind('editgrid-new.php?id={$membdetail[q].tdid}&type={if $st eq 6}1{else}2{/if}');" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>--><a  href="#" onclick="window.open('edit2.php?id={$membdetail[q].reqid}')" title="Edit" > <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;		  
    {if $st eq 4}  <a href="javascript:popWind('../reports/details.php?id={$membdetail[q].tdid}');" title="View"> {if $membdetail[q].status eq '4'}
                        Completed
                        {/if}	 
                        {if $membdetail[q].status eq '1'}
                        Completed
                        {/if} </a>&nbsp;&nbsp;
                        {else}  <a href="javascript:popWind('../reports/details.php?id={$membdetail[q].tdid}');" title="View"> View</a>&nbsp;&nbsp;
                        {/if}
                     {if $smarty.session.admuser.admin_level eq '0'} <a href="#"  onclick="return deleteRec('{$membdetail[q].tdid}','{$id}');"  title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a> {/if}&nbsp; 
                        <!----><a href="#" onclick="alerts('{$membdetail[q].drv_id}')" ><img src="../graphics/alert.png" height="20px" width="20px" /></a><br/>
                        <!--&nbsp;<a href="#" onclick="popWind3('temp_comments.php?tdid={$membdetail[q].tdid}');" ><img src="../graphics/temp_comments.png" height="20px" width="20px" /></a>-->
                       {if $st neq '14'}
                {if $membdetail[q].modiv_flage eq '1' && $membdetail[q].drv_id eq ''} Assign Driver {else}
                        <select name="st_status" id="st_status" onchange="st_status_change('{$membdetail[q].tdid}',this.value,'{$membdetail[q].reqid}');" style="width:110px;" >
                       {if $membdetail[q].status eq '5' || $membdetail[q].status eq '0'}                       
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="13" {if $membdetail[q].status eq '13'} selected="selected"{/if}>Enroute</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                         <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
                          <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          
						 {elseif $membdetail[q].status eq '13'}	
						  <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="13" {if $membdetail[q].status eq '13'} selected="selected"{/if}>Enroute</option>
                          <option value="10" {if $membdetail[q].status eq '10'} selected="selected"{/if}>Arrived at Pickup</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                          <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
                          <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          {elseif $membdetail[q].status eq '10'}	
						  <option value="13" {if $membdetail[q].status eq '13'} selected="selected"{/if}>Enroute</option>
                          <option value="10" {if $membdetail[q].status eq '10'} selected="selected"{/if}>Arrived at Pickup</option>
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                          <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
                          <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
                          {elseif $membdetail[q].status eq '6'}
                          <option value="10" {if $membdetail[q].status eq '10'} selected="selected"{/if}>Arrived at Pickup</option>
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="12" {if $membdetail[q].status eq '12'} selected="selected"{/if}>Arrived at Drop Off</option>
                          {elseif $membdetail[q].status eq '12'}
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked Up</option>
                          <option value="12" {if $membdetail[q].status eq '12'} selected="selected"{/if}>Arrived at Drop Off</option>
                          <option value="4" {if $membdetail[q].status eq '4'} selected="selected"{/if}>Dropped</option>
						  {elseif $membdetail[q].status eq '3'}	
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
							{elseif $membdetail[q].status eq '7'}	
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                         <option value="7" {if $membdetail[q].status eq '7'} selected="selected"{/if}>Billable No-Show</option>
							{elseif $membdetail[q].status eq '8'}	
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
                          <option value="8" {if $membdetail[q].status eq '8'} selected="selected"{/if}>non-Billable No-Show</option>
							{elseif $membdetail[q].status eq '9'}	
                          <option value="9" {if $membdetail[q].status eq '9'} selected="selected"{/if}>Pending</option>
                          <option value="3" {if $membdetail[q].status eq '3'} selected="selected"{/if}>Cancelled</option>
                          {elseif $membdetail[q].status eq '4' || $membdetail[q].status eq '1'}	
                          <option value="4" {if $membdetail[q].status eq '4'} selected="selected"{/if}>Dropped</option>
                          <option value="6" {if $membdetail[q].status eq '6'} selected="selected"{/if}>Picked</option>
                          <option value="5" {if $membdetail[q].status eq '5'} selected="selected"{/if}>Scheduled</option>
							{/if}
                        </select>
                        {/if}
                        {/if}
                        </td>
                      <td > {if $st eq '9' }
                        {if $membdetail[q].acknowledge_status eq '0'}Pending{/if}<br/>
                        {if $membdetail[q].acknowledge_status eq '0'}<span style="color:#66F; font-weight:bold;"><a href="#" onclick="ack('{$membdetail[q].tdid}')">Ack. by Admin</a></span>{/if}
                {if $membdetail[q].acknowledge_status eq '2'}<span style="color:#F00; font-weight:bold;">Denied</span>{/if}
                        {else} <!--<a title="[{$membdetail[q].drv_id}]" href="driver.php?dri_code={$membdetail[q].drv_id}&a={$membdetail[q].pck_add}&b={$membdetail[q].drp_add}" target="_blank"><img alt="Track" border="0" src="../graphics/gps.png"></a><br/>
                        <a title="[{$membdetail[q].drv_id}] Multi Routes" href="driver_trips.php?dri_code={$membdetail[q].drv_id}" target="_blank"><img alt="Track" border="0" src="../graphics/multiroutes.png"></a>-->
                        {/if} 
                        <!--{if $membdetail[q].gps neq ''} <a title="GPS" href="{$membdetail[q].gps}"><img alt="GPS" border="0"  src="../graphics/gps.png"></a>{else}<img alt="GPS Not Installed" border="0"  src="../graphics/dgps.png">{/if}&nbsp;&nbsp;
--></td>
                      <!--<td class="grid_content">{if $membdetail[q].sip neq ''}<a href="sip:{$membdetail[q].sip}" title="Call"><img alt="Call" border="0"  src="../graphics/call_driver.png"></a>{else}<img alt="Call Not Configured" border="0"  src="../graphics/dcall.png">{/if}</td>-->
                    </tr>
                    {sectionelse}
                    <tr>
                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                    </tr>
                    {/section}
                  </table></td>
              </tr>
              <tr>
                <td>{$paging}</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 