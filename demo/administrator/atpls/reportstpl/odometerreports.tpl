{ include file = headerinner.tpl}
{literal} 
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
function aga(val)
{ 	if(val =='drivers')
	{$('#drivers').show(); $('#vehicles').hide();} //'slow'
	else
	{$('#drivers').hide(); $('#vehicles').show();}
}
function updatereading(id){
	if(id!=''){
	var reading=$('#'+id).val();
	//alert(reading);
	$.post("changeodreading.php", {reading: ""+reading, id: ""+id}, function(data){
				if(data.length > 0) {alert('Updated!');}});
	
	}
	}

$(document).ready(function(){	
$("#startdate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
$('#adduser').validate();
});
</script> 
{/literal}
<table width="80%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
              [<a href="javascript:history.back();">Back</a>]</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">Odometer Reading Report</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="" method="post" id="adduser">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
                  <tr>
                  <td width="5%" class="labeltxt"><strong>Date:</strong></td>
                  <td width="20%" ><input type="text" name="startdate" id="startdate" value="{$post.startdate}" class="required" size="10"/>(mm/dd/yyyy)</td>
                  <!--<td width="5%"  class="labeltxt"><strong>To:</strong>&nbsp;</td>
                  <td width="20%" ><input type="text" name="enddate" id="enddate" value="{$post.enddate}" class="required" size="10" />(mm/dd/yyyy)</td>
                 -->  <td width="9%" class="labeltxt"><strong>Report By</strong></td>
                  <td width="15%"><input type="radio" name="reportby" value="drivers" {if $post.reportby eq 'drivers'} checked="checked"{/if} onchange="aga(this.value)"/> Drivers
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="reportby" value="vehicles"  {if $post.reportby eq 'vehicles'} checked="checked"{/if}  onchange="aga(this.value)"/> Vehicles</td>
                  <td width="30%"  colspan="2">
                  <span id="drivers" style="display:none">
                  <strong>Drivers:</strong>&nbsp; 
                  <select name="driver_id" >
                      <option value="">Select Driver</option>
            {section name=q loop = $drivers}
                      <option value="{$drivers[q].Drvid}" {if $drivers[q].Drvid eq $post.driver_id} selected{/if}>{$drivers[q].lname} {$drivers[q].fname}  - [ {$drivers[q].drv_code} ]</option>
            {/section}
                    </select></span>
                    <span id="vehicles" style="display:none">
                  <strong>Vehicles:</strong>&nbsp; 
                  <select name="veh_id" >
                      <option value="">Select Vehicle</option>
            {section name=q loop = $vehicles}
                  <option value="{$vehicles[q].id}" {if $vehicles[q].id eq $post.veh_id} selected{/if}>{$vehicles[q].vname} - [ {$vehicles[q].vnumber} ]</option>
            {/section}
                    </select></span>
                    </td>
                </tr>
                <tr>
                  <td align="left" colspan="2" valign="top">&nbsp;</td>
                  <td colspan="2" align="left" valign="top"><input type="submit" name="submit" id="submit" value='&nbsp;&nbsp;&nbsp;Show Report&nbsp;&nbsp;&nbsp;' class="inputButton btn"  />
                    &nbsp;
                    <input type="reset" name="reset" value='&nbsp;Reset&nbsp;' class="inputButton btn"  /></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table11">
              <tr class="admintopheading">
                <td width="2%" align="center"><strong>#</strong></td>
                <td width="6%" align="center"><strong> Date </strong></td>
                <td width="10%" align="center"><strong> Driver </strong></td>
                <td width="10%" align="center"><strong> Vehicle </strong></td>
                <td width="7%" align="center"><strong> Odometer Reading </strong></td>
                <td width="7%" align="center"><strong> Clock In </strong></td>
                <td width="10%" align="center"><strong> Clock Out </strong></td>
                <!--<td width="13%" align="center"><strong> Options </strong></td>-->
              </tr>
              {section name=q loop=$data}
              {if $reqdetails[q].rows neq '0'}
              <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
                
                <td align="center" valign="top"><p>{$smarty.section.q.iteration}</p></td>
                <td align="center" valign="top">{$data[q].dated|date_format:"%D"} </td>
                <td align="center" valign="top">{$data[q].driver}</td>
                <td align="center" valign="top">{$data[q].vehicle}</td>
                
                <td align="center" valign="top"><input type="text" value="{$data[q].odometer_reading}" id="{$data[q].id}" /><a href="#" onclick="updatereading('{$data[q].id}')" >Update</a></td>
                <td align="center" valign="top">{if $data[q].enter_type eq 'ClockIn'}{$data[q].enter_type}{/if}</td>
                <td align="center" valign="top">{if $data[q].enter_type eq 'ClockOut'}{$data[q].enter_type}{/if}</td>
                
                
               <!-- <td align="center" valign="top"><a href="receiptdetail.php?id={$data[q].id}" rel="facebox" >View Receipt</a> | <a href="edit_receipt.php?id={$data[q].id}&startdate={$post.startdate}&enddate={$post.enddate}&reportby={$post.reportby}&reportby={$post.reportby}&driver_id={$post.driver_id}&veh_id={$post.veh_id}" rel="facebox" >Edit Info</a></td>
               -->  </tr>
              {/if}
              {sectionelse}
              <tr>
                <td colspan="7" align="center" ><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        
      </table>
 {literal}<script>aga('{/literal}{$post.reportby}{literal}');</script>{/literal}     
{ include file = innerfooter.tpl} 