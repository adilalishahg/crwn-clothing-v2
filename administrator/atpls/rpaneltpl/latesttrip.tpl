{literal}
<style>
.background-color-red { background-color: orange; }
</style>
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script type="text/javascript">
$(document).ready(function(){ 
/*var ty = '{/lietral}{$waqfa}{lietral}';
 setInterval(ref,ty);
function ref(){
	var duration = '{/literal}{$duration}{literal}';
	location.href="latesttrips.php?duration="+duration;
	}*/
 setInterval(findRed,1000);     
 function findRed(){ 
  $("tr.blinkRed").each(function(){ 
       $(this).toggleClass("background-color-red");
     })
    }
}); 
function deleteRec(id,id2)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			location.href="grid.php?delId="+id+"&id="+id2;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
	//window.onload = self.focus();
</script>
{/literal}
<link href="../theme/style.css" rel="stylesheet" type="text/css">
<!----> <meta http-equiv="refresh" content="{$duration}; URL=latesttrips.php?duration={$duration}">
<body onBlur="self.focus();">

<table width="100%" align="center">
<tr align="center"><td>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="main_table" >
					<tr>
                      <td colspan="11" align="left" >
                      	<table cellpadding="2" cellspacing="2" width="80%">
                        	<tr>
                            	<td><img src="../images/logo.png"></td>
                                <td><b>Date:</b>{$today}</td>
                                <td>
                                	<form method="post" action="latesttrips.php">
                     <b>Update Every :</b>
                     <select id="duration" name="duration" onChange="this.form.submit();" class=""> 
                     <option selected="selected">--Select--</option>
					  <option value="5"  {if $duration eq '5'} selected="selected"  {/if}>5 sec</option>
					  <option value="15" {if $duration eq '15'} selected="selected" {/if}>15 sec</option>
					  <option value="30" {if $duration eq '30'} selected="selected" {/if}>30 sec</option>
					  <option value="60" {if $duration eq '60'} selected="selected" {/if}>1 min</option>
                      <option value="300" {if $duration eq '300'} selected="selected" {/if}>5 min</option>
					  </select>
                    
					</form>
                                </td>
                                <td align="right"><a href="index.php"><img src="../images/home.png" alt="" border="0"></a></td>
                            </tr>
                        </table>
                      </td>
                    </tr>                   
                    <tr>
                      <td colspan="11" align="center" >&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="11" align="left" style="font-size:14px; color:#000; font-weight:bold;" ><table width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td width="334" style="font-size:15px; color:#000; font-weight:bold; background:url(../images/adm_tab.png) no-repeat; text-align:center; width:200px; height:30px;">Online Trips </td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Trip ID </strong></td>
                      <!--<td width="13%" align="left" class="label_txt_heading"><strong>Facility Name </strong></td>-->
                      <td width="13%" align="left" class="label_txt_heading"><strong>Patient Name </strong></td>
                  <!-- <td width="15%" align="left" class="label_txt_heading"><strong>Driver</strong></td>-->
                      <td width="13%" align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td width="13%" align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td width="11%" align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
			<!--		    <td width="5%" align="left" class="label_txt_heading"><strong>Drop Time</strong></td>-->
					  <td width="8%" align="left" class="label_txt_heading"><strong>Miles</strong></td>
					   <td width="9%" align="left" class="label_txt_heading"><strong>Trip Type</strong></td>
                      <td width="10%" align="center" class="label_txt_heading"><strong>Status</strong></td>
                    </tr>
                    {section name=q loop=$req}
<tr valign="top"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}" class="blinkRed"  >
                      <td align="left" valign="top" class="grid_content">{$req[q].reqid}</td>
                      <!--<td align="left" valign="top" class="grid_content"><b>{$req[q].hospname}</b></td>-->
                      <td align="left" valign="top" class="grid_content">{$req[q].clientname}</td>
            <!--   <td align="left" valign="top" class="grid_content">{$req[q].driver} - [ {$membdetail[q].drv_code} ]</td>-->
                      <td align="left" valign="top" class="grid_content">{$req[q].pickaddr}</td>
                      <td align="left" valign="top" class="grid_content">{$req[q].destination}</td>
			    <td align="left" valign="top" class="grid_content">{if $req[q].wc eq '1'} W/C{else} {$req[q].apptime}{/if}</td>
			<!--			  <td align="left" valign="top" class="grid_content">{if $req[q].wc eq '1'} --:--{else}{$req[q].drp_time}{/if}</td>-->
                      <td align="left" valign="top" class="grid_content">{$req[q].milage}</td>
             <td align="left" valign="top" class="grid_content">{if $req[q].triptype == 'RW'}Round Trip{else}One Way{/if}</td>
					  <td align="left" valign="top" class="grid_icon">
				Req Recvd
  {sectionelse}
        <tr>
                     <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
      </tr>
                    {/section}
     </table>
<table>
            <tr><td>&nbsp;</td></tr>
</table>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1" class="main_table" >
                    <tr>
                      <td colspan="11" align="left"style="font-size:14px; color:#000; font-weight:bold;"  ><table width="100%" border="0" cellspacing="1" cellpadding="3">
                        <tr>
						<td width="334" style="font-size:15px; color:#000; font-weight:bold; background:url(../images/adm_tab.png) no-repeat; text-align:center; width:200px; height:30px;">In Process Trips </td>
                          <td>&nbsp;</td>
                        </tr>
                      </table></td>
                    </tr>
                   <tr>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Code</strong></td>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Patient Name </strong></td>
                     <!-- <td width="10%" align="left" class="label_txt_heading"><strong>Facility Name </strong></td>-->
                       <td width="15%" align="left" class="label_txt_heading"><strong>Driver</strong></td>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Pick Address</strong></td>
                      <td width="10%" align="left" class="label_txt_heading"><strong>Drop Address</strong></td>
                      <td width="5%" align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>
					    <td width="5%" align="left" class="label_txt_heading"><strong>Drop Time</strong></td>
					  <td width="5%" align="left" class="label_txt_heading"><strong>Miles</strong></td>
					   <td width="5%" align="left" class="label_txt_heading"><strong>Trip Type</strong></td>
                      <td width="7%" align="center" class="label_txt_heading"><strong>Status</strong></td>
                    </tr>
                    {section name=q loop=$membdetail}
<tr valign="top"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_code}</b></td>
                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_user}</b></td>
                      <!--<td align="left" valign="top" class="grid_content">{$membdetail[q].trip_clinic}</td>-->
                  <td align="left" valign="top" class="grid_content">{$membdetail[q].driver} - [ {$membdetail[q].drv_id} ]</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].pck_add}</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].drp_add}</td>
		    <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} W/C{else} {$membdetail[q].pck_time}{/if}</td>
				  <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} --:--{else}{$membdetail[q].drp_time}{/if}</td>
                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_miles}</td>
                       <td align="left" valign="top" class="grid_content">{if $membdetail[q].type == '1'}<img src="../images/one-way.png" title="One-Way Trip">{else}<img  title="Two-Way Trip" src="../images/two-way.png">{/if}</td>
					  <td align="left" valign="top" class="grid_icon">
				{if $membdetail[q].status == '0'}
				Add-On	
				{/if}	 
				{if $membdetail[q].status == '1'}
				Completed with Delay 	
				{/if}	 
				{if $membdetail[q].status == '5'}
				In Progress	
				{/if}	 
				{if $membdetail[q].status == '6'}
			    Picked
				{/if}	 
				{if $membdetail[q].status == '2'}
			   Rescheduled
				{/if}	 
				{if $membdetail[q].status == '4'}
			   Dropped
				{/if}				</td>
        </tr>
                    {sectionelse}
                    <tr>
                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                   </tr>
                    {/section}
      </table>
</td></tr></table>
</body>
{ include file = footer.tpl}