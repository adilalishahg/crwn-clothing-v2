{ include file = headernew.tpl}
<link href="administrator/theme/styles.css" rel="stylesheet">	
<meta http-equiv="refresh" content="60">
{literal} 
<script type="text/javascript">
 $(document).ready(function() { 
});

function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 1000, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 650, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function popWind3(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 500, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function fsubmit(url,id){
location.href=url+"&driver="+id; }
function fsubmit2(url,id){
location.href=url+"&user="+id;   }
function fsubmit3(url,id){location.href=url+"&account="+id; }
function rload(url){location.href=url; }
function deleteRec(id,st)
		{ //alert(st);
		var ok;
		ok=confirm("Are you sure you want to cancel this trip?");
		if (ok)
		{		
			location.href="grid.php?delId="+id+"&st="+st;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
function refreshpagejana(){ location.reload();  }
setInterval ( "refreshpagejana()", 10000);	
</script> 
{/literal}
<div style="min-height:400px;" class="submain">

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF" >


  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
                  
                  
                  
                  { if $errors != ''} {$errors} {/if}</span></td>
              </tr>
             <!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="rload('grid.php');"><i class="fa fa-refresh" style="color:#0059b7; font-size:24px;"></i></a>-->
             <tr>
                <td height="19" align="center" class="admintopheading"><strong>TODAY TRIPS</strong></td>
              </tr>
              <tr>
                <td class="tabs" style="color:#FFF"><ul>
                    <!--<li {if $st== '5'} class="active"{/if}><a href="grid.php?id={$id}&st=5">In Progress ({$st5})</a></li>
                    <li {if $st== '4'} class="active"{/if}><a href="grid.php?id={$id}&st=4">Completed ({$st4})</a></li>
                    <li {if $st== '3'} class="active"{/if}><a href="grid.php?id={$id}&st=3">Cancelled ({$st3})</a></li>
                    <li {if $st== '2'} class="active"{/if}><a  href="grid.php?id={$id}&st=2">Rescheduled ({$st2})</a></li>
                    <li {if $st== '8'} class="active"{/if}><a href="grid.php?id={$id}&st=8&ad=0">Not Going ({$st8})</a></li>
                    <li {if $st== '7'} class="active"{/if}><a href="grid.php?id={$id}&st=7&ad=0">Not at Home ({$st7})</a></li>
                    <li {if $st eq '0' || $acknowledge_status eq '0'} class="last" {else} class="last"{/if}>
                    <a href="grid.php?id={$id}&st=9&acknowledge_status=0">Pending Trips ({$st9})</a>
                    </li>-->
                    
                    <li {if $st== '9'} class="active"{/if}><a href="grid.php?id={$id}&st=9&acknowledge_status=0">Pending ({$st9})</a></li>
                    <li {if $st== '5'} class="active"{/if}><a href="grid.php?id={$id}&st=5"> Scheduled ({$st5})</a></li>
                    <li {if $st== '10'} class="active"{/if}><a href="grid.php?id={$id}&st=10">Arrived ({$st10})</a></li>
                    <li {if $st== '6'} class="active"{/if}><a  href="grid.php?id={$id}&st=6">Picked Up ({$st6})</a></li>
                    <li {if $st== '4'} class="active"{/if}><a href="grid.php?id={$id}&st=4&ad=0">Delivered ({$st4})</a></li>
                    <li class="last"><a href="grid.php?id={$id}&st=3&ad=0">Cancelled ({$st3})</a></li>
                    
                    
                    
                    <!--<li {if $st== '9'}style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a rel="facebox" href="add-sheet.php">Upload Sheet</a></li>
 <li class="small"><a  title="Add" href="#" onclick="popWind2('addgrid.php?id={$id}');" > <img alt="Add" border="0" src="../graphics/add_12.gif"></a></li>--> 
                    <!--<li><input type="button" value="GET" onclick="getalerts()" /></li>-->
                  </ul></td>
              </tr>
              
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
                <table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0">
                    <tr style="background-color:#a40026; color:#FFF;">
                     <!--  <td align="left" class="label_txt_heading"><strong>Code</strong></td>
                     <td align="left" class="label_txt_heading"><strong>Facility</strong></td>-->
                      <td align="left" class="label_txt_heading"><strong>Account</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Patient Name </strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Miles</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                      <td align="center" class="label_txt_heading"><strong>Status</strong></td>
                     <!-- <td align="left" class="label_txt_heading"><strong>{if $st== '9'}{else}Location{/if}</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Call</strong></td>-->
                    </tr>
                    <div id="sc"></div>
                    {section name=q loop=$membdetail}
                    <tr  valign="top" id="{$membdetail[q].tdid}"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}"><!---->
                     <!-- <td >{$membdetail[q].trip_id}</td>
                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_clinic}</b></td>-->
                      <td align="left" valign="top" class="grid_content">
                      {$membdetail[q].account}
                      </td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_user}</td>
                      
        <td align="left" valign="top" class="grid_content">{section name=r loop=$driverdata}
            {if $driverdata[r].drv_code eq $membdetail[q].drv_id}{$driverdata[r].fname} {$driverdata[r].lname}{/if}
{/section} </td>
            
                   <td align="left" valign="top" class="grid_content">{if $membdetail[q].picklocation neq ''}[<strong>Pick Location:</strong> {$membdetail[q].picklocation}]<br/>{/if}
                   {$membdetail[q].pck_add}{if $membdetail[q].pickup_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].pickup_instruction}]{/if}{if $membdetail[q].p_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].p_phnum}]{/if}
                        </td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].droplocation neq ''}[<strong>Drop Location:</strong> {$membdetail[q].droplocation}]<br/>{/if}
                      {$membdetail[q].drp_add}{if $membdetail[q].destination_instruction neq ''}<br/>[<strong>Instruction:</strong> {$membdetail[q].destination_instruction}]{/if}{if $membdetail[q].d_phnum neq ''}<br/>[<strong>Phone #:</strong> {$membdetail[q].d_phnum}]{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} W/C{else} {$membdetail[q].pck_time|date_format:"%H:%M"}{/if}</td>
                      <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} --:--{else}{$membdetail[q].drp_time|date_format:"%H:%M"}{/if}</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_miles}</td>
                      <td align="left" valign="top" class="grid_content">
                      
                      {$membdetail[q].vehtype}<span style="font-size:9px; color:#F00;">
                      {if $membdetail[q].dstretcher eq 'Yes'}<br/>&raquo; 2Man-Team {/if}
                      {if $membdetail[q].bar_stretcher eq 'Yes'}<br/>&raquo; Bariatric-Str. {/if}
                     </span>
                      
                      </td>
                      <td align="left" valign="top" class="grid_icon">
                        
                      
                          {if $membdetail[q].status eq '5'}In Progress{/if}
                          {if $membdetail[q].status eq '2'}Rescheduled{/if}
                          {if $membdetail[q].status eq '3'}Cancelled{/if}
                          {if $membdetail[q].status eq '6'}Picked Up{/if}
                          {if $membdetail[q].status eq '8'}Not Going{/if}
                          {if $membdetail[q].status eq '7'}Not at home{/if}
						  {if $membdetail[q].status eq '9'}Pending{/if}
                          {if $membdetail[q].status eq '10'}Driver Arrived{/if}
                           <br/>
                          {if $membdetail[q].status eq '5' || $membdetail[q].status eq '9' || $membdetail[q].status eq '10'}
<a href="#"  onclick="return deleteRec('{$membdetail[q].tdid}','{$st}');"  title="Cancel" style="color:red;font-weight:bold;font-size:16px;"> X</a>
{/if}<a  href="javascript:popWind2('details.php?id={$membdetail[q].tdid}');" title="View">&nbsp;&nbsp;<i class="fa fa-file-alt" style="color:#0059b7;  font-size:24px;"></i></a> {if $membdetail[q].status eq '10' || $membdetail[q].status eq '6' || $membdetail[q].status eq '5' }
                      <a title="[{$membdetail[q].drv_id}]" href="driver.php?dri_code={$membdetail[q].drv_id}&a={$membdetail[q].pck_add}&b={$membdetail[q].drp_add}" target="_blank"><img alt="Track" border="0" src="administrator/graphics/gps.png"></a> {/if}

                        </td>
                      <!--<td >
                      {if $membdetail[q].status eq '10' || $membdetail[q].status eq '6' || $membdetail[q].status eq '5' }
                      <a title="[{$membdetail[q].drv_id}]" href="driver.php?dri_code={$membdetail[q].drv_id}&a={$membdetail[q].pck_add}&b={$membdetail[q].drp_add}" target="_blank"><img alt="Track" border="0" src="administrator/graphics/gps.png"></a> {/if}
                      </td>-->
                        
                    </tr>
                    {sectionelse}
                    <tr>
                      <td colspan="12" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
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
</div>
{ include file = footerlast.tpl} 