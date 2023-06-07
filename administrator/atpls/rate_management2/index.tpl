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
	var rate3	 		= $('#rate3').val();
	var permile_ch 		= $('#permile_ch').val();
	var rate6 			= $('#rate6').val();
	var rate10 			= $('#rate10').val();
	var afterhour_ch 	= $('#afterhour_ch').val();
	var v_type 		= $('#v_type').val();
	var id 			= $('#id').val();
	//alert(id+'b'+v_type+'b'+acharges+'b'+wtcharges+'b'+mcharges+'b'+bcharges); return false;
  $.post("addrate.php", { permile_ch: ""+permile_ch, afterhour_ch: ""+afterhour_ch, rate3: ""+rate3, rate6: ""+rate6, rate10: ""+rate10, v_type: ""+v_type, id: ""+id}, function(data){	if(data.length > 0) { 
				//alert(data);
				//alert('Updated!');
				location.reload(); } }); 
	}	
function update_rate(val){
	var rate3 		= $('#rate3'+val).val();
	var permile_ch 		= $('#permile_ch'+val).val();
	var rate6 	= $('#rate6'+val).val();
	var rate10 		= $('#rate10'+val).val();
	var afterhour_ch 	= $('#afterhour_ch'+val).val();
	$.post("updaterate.php", {permile_ch: ""+permile_ch, afterhour_ch: ""+afterhour_ch, rate3: ""+rate3, rate6: ""+rate6, rate10: ""+rate10,id: ""+val}, function(data){
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
          <td height="19" align="center" class="admintopheading">RATES MANAGEMENT FOR [ {$hosp.account_name} ] </td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>#.</strong></td>
                <td width="20%" align="center" class="label_txt_heading"><strong>Vehicle Type</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>0-3 Miles<br/>Charges</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>4-6 Miles<br/>Charges</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>7-10 Miles<br/>Charges</strong></td>
                <td width="11%" align="center" class="label_txt_heading"><strong>After 10 Miles<br/>Charges per mile</strong></td>
               <td width="11%" align="center" class="label_txt_heading"><strong>After Hours Fee<br/>(per trip)</strong></td>
               <td width="20%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop = $v_rates}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="left" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>
                <td align="left" valign="middle">{$v_rates[q].vehtype}</td>
                <td align="left" valign="middle"><input type="text" id="rate3{$v_rates[q].id}" value="{$v_rates[q].rate3}"  size="5" /></td>
                <td align="left" valign="middle"><input type="text" id="rate6{$v_rates[q].id}" value="{$v_rates[q].rate6}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="rate10{$v_rates[q].id}" value="{$v_rates[q].rate10}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="permile_ch{$v_rates[q].id}" value="{$v_rates[q].permile_ch}"  size="5"  /></td>
                <td align="left" valign="middle"><input type="text" id="afterhour_ch{$v_rates[q].id}" value="{$v_rates[q].afterhour_ch}"  size="5"  /></td>
                 
                
                
                
                
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
                <td width="40%" height="25" align="left" class="labeltxt"><strong>0-3 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate3" type="text" class="" id="rate3" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>4-6 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate6" type="text" class="" id="rate6" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>7-10 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="rate10" type="text" class="" id="rate10" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;</td>
              </tr>
              <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>After 10 Miles Charges:</strong></td>
                <td width="60%" height="25"><input name="permile_ch" type="text" class="" id="permile_ch" value="0.0" maxlength="10" size="8" />
                  &nbsp;<span class="SmallnoteTxt">* </span>&nbsp;(<b>per mile</b>)</td>
              </tr>
               <tr>
                <td width="40%" height="25" align="left" class="labeltxt"><strong>After Hours Fee:</strong></td>
                <td width="60%" height="25"><input name="afterhour_ch" type="text" class="" id="afterhour_ch" value="0.0" maxlength="10" size="8" />
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