{ include file = headerinner.tpl}
{literal} 
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{ location.href="index.php?del_id="+id;
		return true;}else{			
			return false;}
	}
function add_form(val){
	if (val != ''){		
	$('#add_rates').show();
 	//location.href="index.php?st="+val;
	}else{
		$('#add_rates').hide();
			}			
	}
function add_rates2(){
	var pickup_ch 		= $('#pickup_ch').val();
	var permile_ch 		= $('#permile_ch').val();
	var un_loaded_ch 	= $('#un_loaded_ch').val();
	var waittime_ch 	= $('#waittime_ch').val();
	var freeWaitTime 	= $('#freeWaitTime').val();
	var noshow_ch 		= $('#noshow_ch').val();
	var afterhour_ch 	= $('#afterhour_ch').val();
	//var stretcher_ch 	= $('#stretcher_ch').val();
	var dstretcher_ch 	= $('#dstretcher_ch').val();
	var bstretcher_ch 	= $('#bstretcher_ch').val();
	var oxygen_ch 		= $('#oxygen_ch').val();
	var doublewheel_ch 	= $('#doublewheel_ch').val();
	
	
	/*var un25 	= $('#un25').val();
	var un30 	= $('#un30').val();
	var un35 	= $('#un35').val();
	var un40 	= $('#un40').val();
	var un45 	= $('#un45').val();
	var un50 	= $('#un50').val();
	var un55 	= $('#un55').val();
	var un60 	= $('#un60').val();*/
	var v_type 		= $('#v_type').val();
	var id 			= $('#id').val();
	//alert(id+'b'+v_type+'b'+acharges+'b'+wtcharges+'b'+mcharges+'b'+bcharges); return false;
  $.post("addrate.php", {
  pickup_ch: ""+pickup_ch, 
  permile_ch: ""+permile_ch,
  un_loaded_ch: ""+un_loaded_ch, 
  waittime_ch: ""+waittime_ch, 
  freeWaitTime: ""+freeWaitTime, 
  noshow_ch: ""+noshow_ch, 
  afterhour_ch: ""+afterhour_ch,  
  dstretcher_ch: ""+dstretcher_ch, 
  bstretcher_ch: ""+bstretcher_ch, 
  oxygen_ch: ""+oxygen_ch, 
  doublewheel_ch: ""+doublewheel_ch,   
  v_type: ""+v_type, 
  id: ""+id
  }, function(data){
				if(data.length > 0) { 
				//alert(data);
				//alert('Updated!');
				location.reload(); } }); 
	}	
function update_rate(val){
	var pickup_ch 		= $('#pickup_ch'+val).val();
	var permile_ch 		= $('#permile_ch'+val).val();
	var un_loaded_ch 	= $('#un_loaded_ch'+val).val();
	var waittime_ch 	= $('#waittime_ch'+val).val();
	var freeWaitTime 	= $('#freeWaitTime'+val).val();
	var noshow_ch 		= $('#noshow_ch'+val).val();
	var afterhour_ch 	= $('#afterhour_ch'+val).val();
	var dstretcher_ch 	= $('#dstretcher_ch'+val).val();
	var bstretcher_ch 	= $('#bstretcher_ch'+val).val();
	var oxygen_ch 		= $('#oxygen_ch'+val).val();
	var doublewheel_ch 	= $('#doublewheel_ch'+val).val();
	
	
	
	$.post("updaterate.php", {
        pickup_ch: ""+pickup_ch, 
        permile_ch: ""+permile_ch, 
        un_loaded_ch: ""+un_loaded_ch, 
        waittime_ch: ""+waittime_ch, 
        freeWaitTime: ""+freeWaitTime, 
        noshow_ch: ""+noshow_ch, 
        afterhour_ch: ""+afterhour_ch, 
        dstretcher_ch: ""+dstretcher_ch, 
        bstretcher_ch: ""+bstretcher_ch, 
        oxygen_ch: ""+oxygen_ch, 
        doublewheel_ch: ""+doublewheel_ch, 
        id: ""+val
        }, 
        function(data){
				if(data.length > 0) { alert('Updated!');
				//location.reload(); 
				} }); 
	
	}
function deleteit(val){
	$.post("delete.php", {id: ""+val}, function(data){
				if(data.length > 0) { location.reload(); } }); 
	}		
</script> 

{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" width="100%" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="98%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            
            { if $errors != ''} {$errors} {/if}</td>
        </tr>
        <tr>
          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>] </div></td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">RATES MANAGEMENT FOR [ {$host_info.account_name} ] </td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>#.</strong></td>
                <td width="20%" align="center" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>Pickup<br/>Charges (per trip)</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>Mile Charges<br/>(per mile)</strong></td>
                <!--<td width="11%" align="center" class="label_txt_heading"><strong>Un Loaded Mile Charges<br/>(per mile)</strong></td>-->
                <td width="11%" align="center" class="label_txt_heading"><strong>Wait Time Charges<br/>(per minute)</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>Free Wait <br>Time<br/>(minutes)</strong></td>
               <td width="11%" align="center" class="label_txt_heading"><strong>No Show Fee<br/>(per trip)</strong></td>
               <td width="11%" align="center" class="label_txt_heading"><strong>After Hours Fee<br/>(per trip)</strong></td>
               <td width="10%" align="center" class="label_txt_heading"><strong>2 Man Team Charges<br/>(per trip)</strong></td>
               <td width="10%" align="center" class="label_txt_heading"><strong>Bariatric Stretcher Charges<br/>(per trip)</strong></td>
               <td width="10%" align="center" class="label_txt_heading"><strong>0xygen charges<br/>(per trip)</strong></td>
				<td width="10%" align="center" class="label_txt_heading"><strong>Wheel Chair Rental<br/>(per trip)</strong></td>
                
               
               
                
               <td width="20%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop = $v_rates}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="left" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>
                <td align="left" valign="middle">{$v_rates[q].vehtype}</td>
                <td align="left" valign="middle"><input type="text" id="pickup_ch{$v_rates[q].id}" value="{$v_rates[q].pickup_ch}"  size="5" /></td>
                <td align="left" valign="middle"><input type="text" id="permile_ch{$v_rates[q].id}" value="{$v_rates[q].permile_ch}"  size="5"  /></td>
                <td style="display:none;"><input type="text" id="un_loaded_ch{$v_rates[q].id}" value="{$v_rates[q].un_loaded_ch}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="waittime_ch{$v_rates[q].id}" value="{$v_rates[q].waittime_ch}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="freeWaitTime{$v_rates[q].id}" value="{$v_rates[q].free_wait_time}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="noshow_ch{$v_rates[q].id}" value="{$v_rates[q].noshow_ch}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="afterhour_ch{$v_rates[q].id}" value="{$v_rates[q].afterhour_ch}"  size="5"  /></td>
    <!--            <td align="left" valign="middle"><input type="text" id="stretcher_ch{$v_rates[q].id}" value="{$v_rates[q].stretcher_ch}"  size="5"  /></td>-->
                <td align="left" valign="middle"><input type="text" id="dstretcher_ch{$v_rates[q].id}" value="{$v_rates[q].dstretcher_ch}"  size="5"  /></td>
				<td align="left" valign="middle"><input type="text" id="bstretcher_ch{$v_rates[q].id}" value="{$v_rates[q].bstretcher_ch}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="oxygen_ch{$v_rates[q].id}" value="{$v_rates[q].oxygen_ch}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="doublewheel_ch{$v_rates[q].id}" value="{$v_rates[q].doublewheel_ch}"  size="5"  /></td>
                
                
                
                
                
                <td align="center" valign="minddle">&nbsp;<a href="#" onclick="deleteit('{$v_rates[q].id}');">Delete</a>&nbsp;<input type="button" value="Update" id="X" onclick="update_rate('{$v_rates[q].id}');" class="btn"/></td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="7" align="center"><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td style="border: solid 0px #F00; padding-left:80px; padding-top:40px;">Add Rates for New Vehicle Type (Service): <select name="v_type" id="v_type" onchange="add_form(this.value);" >
              <option value="">Select Vehicle Type</option>
         {section name=q loop = $v_types}
              <option value="{$v_types[q].id}">{$v_types[q].vehtype}</option>
        {/section}
            </select></td>
        </tr>
        <tr>
          <td><table width="650" border="0" cellspacing="2" cellpadding="2" id="add_rates" style="display:none; padding-left:100px;">
              <tr>
                <td colspan="2"></td>
              </tr>
              <tr>
            <td width="40%" height="25" align="left" class="labeltxt"><strong>Pickup Charges:</strong></td>
                <td width="60%" height="25"><input name="pickup_ch" type="text" class="" id="pickup_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Mile Charges:</strong></td>
                <td width="60%" height="25"><input name="permile_ch" type="text" class="" id="permile_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per mile</b>)</td>
              </tr>
              <tr style="display:none">
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Un Loaded Mile Charges:</strong></td>
                <td width="60%" height="25"><input name="un_loaded_ch" type="text" class="" id="un_loaded_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per mile</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Wait Time Charges:</strong></td>
                <td width="60%" height="25"><input name="waittime_ch" type="text" class="" id="waittime_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per minute</b>) </td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Free Wait Time:</strong></td>
                <td width="60%" height="25"><input name="freeWaitTime" type="text" class="" id="freeWaitTime" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>minutes</b>) </td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>No Show Fee:</strong></td>
                <td width="60%" height="25"><input name="noshow_ch" type="text" class="" id="noshow_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>After Hours Fee:</strong></td>
                <td width="60%" height="25"><input name="afterhour_ch" type="text" class="" id="afterhour_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>2 Man Team Charges:</strong></td>
                <td width="60%" height="25"><input name="dstretcher_ch" type="text" class="" id="dstretcher_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Bariatric Stretcher Charges:</strong></td>
                <td width="60%" height="25"><input name="bstretcher_ch" type="text" class="" id="bstretcher_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Oxygen Charges:</strong></td>
                <td width="60%" height="25"><input name="oxygen_ch" type="text" class="" id="oxygen_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>Wheel Chair Rental:</strong></td>
                <td width="60%" height="25"><input name="doublewheel_ch" type="text" class="" id="doublewheel_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per trip</b>)</td>
              </tr>
              
              
             
              
              <tr>
                <td height="25">&nbsp;</td>
                <td height="25"><input type="button" value="Add Rates" id="ddd" onclick="add_rates2();"  class="btn"/></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center">{$paging}<input type="hidden" value="{$id}" id="id" name="id"  /></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 