{ include file = headerinner.tpl}
{literal} 
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{		
			location.href="index.php?delId="+id;
			return true;
		}
		else
		{
		return false;
		}
	}
function check(){
	a = $('#a').show();
$('#b').show();
}
function check2(){
	a = $('#a').hide();
    $('#b').hide();
}
function chk_date()
{
	date = $('#vpurchasedon').val();
if ( new Date(date) > new Date() )
{
alert('Future date is not allowed!');
 $('#vpurchasedon').val("");
 return false;
}
}
$(document).ready(function() {
	$("#addvehicle").validationEngine();
	$("#expireon").mask("19/39/9999");
});
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">Add Vehicle</td>
        </tr>
        <tr>
          <td height="19" align="center">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
            
            
            
            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="addvehicle" id="addvehicle" method="post" action="addvehicle.php">
              <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:#999999 1px solid;">
                <tr>
                  <td colspan="3" valign="top" class="admintopheading"><strong>Vehicle Information</strong></td>
                </tr>
                <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>Plat Number :</strong></td>
                  <td colspan="2" align="left"><input name="vnum" type="text"  class="validate[required] inputTxtField" id="vnum" value="{$vnum}" maxlength="15"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                 <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>VIN Number :</strong></td>
                  <td colspan="2" align="left"><input name="vin" type="text"  class="validate[required] inputTxtField" id="vin" value="{$post.vin}" maxlength="30"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Name :</strong></td>
                  <td colspan="2" align="left"><input name="vname" type="text" class="validate[required] inputTxtField" id="vname" value="{$vname}" maxlength="50"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Type:</strong></td>
                  <td colspan="2" align="left"><select name="vtype" id="vtype" class="validate[required] SelectBox" >
                      <option value="">Select</option>
               {section name=n loop=$tlist}
                      <option value="{$tlist[n].id}" {if $tlist[n].id eq $vtype}selected{/if}>{$tlist[n].vehtype}</option>
			   {/section}
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td colspan="3" height="5"></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Model:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="vmodel" id="vmodel" value="{$vmodel}" maxlength="15" class="validate[required] inputTxtField" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <!--<tr>
                  <td align="left" valign="top" class="labels"><strong>Purchased on:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="vpurchasedon" id="vpurchasedon" value="{$vpurchasedon}" class="validate[required] inputTxtField date" onblur="chk_date();" />
                    &nbsp;<span class="SmallnoteTxt">* (mm/dd/yyyy)</span></td>
                </tr>-->
                <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>Registration Number :</strong></td>
                  <td colspan="2" align="left"><input name="regno" type="text"  class="validate[required] inputTxtField" id="regno" value="{$post.regno}" maxlength="30"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Registration Expiration Date:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="expireon" id="expireon" value="{$post.expireon}" class="validate[required] inputTxtField date" onblur="chk_date();" />
                    &nbsp;<span class="SmallnoteTxt">* (mm/dd/yyyy)</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Capacity:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="vcapacity" id="vcapacity" value="{$vcapacity}" class="validate[required,custom[onlyNumber]] inputTxtField digits" maxlength="2" />
                    &nbsp;<span class="SmallnoteTxt">* <strong>Seater</strong></span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Make : </strong></td>
                  <td colspan="2" align="left"><input name="vmake" type="text" class="validate[required] inputTxtField" id="vmake" value="{$vmake}" maxlength="50" />
                    &nbsp;<span class="SmallnoteTxt">* </span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Milage: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="vmileage" id="vmileage" value="{$vmileage}" class="validate[required,custom[onlyNumber]] inputTxtField digits" maxlength="15" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>GPS Enabled? </strong></td>
                  <td colspan="2" align="left"><input type="radio" name="gps" id="gps1" value="1" onclick="check()" />
                    Yes &nbsp;&nbsp;
                    <input type="radio" name="gps" id="gps2" value="0" {if $gps eq '0'}checked{/if} onclick="check2();" />
                    No
                    
                    
                    
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr id="a" style="display:none">
                  <td align="left" valign="top" class="labels"><strong>GPS : </strong></td>
                  <td colspan="2" align="left"><input type="text" name="gpsurl" id="gpsurl" value="{$gpsurl}" class=" inputTxtField"  />
                    </td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" class="inputButton btn">
                    <input type="reset" name="reset" value="Reset" class="inputButton btn"></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 