{ include file = headerinner.tpl}



{literal} 
<script>



function chk_date()



{



	date = $('#vpurchasedon').val();



	cdate =new Date();



	day = cdate.getDate();



	month = cdate.getMonth();



	year = cdate.getFullYear();



	//curdate = month + '/'+day + '/' + year;



	curdate = new Date(year, month, day);



	Ardate = date.split('/');



	entdate = new Date (Ardate[2], Ardate[0],Ardate[1]);



	//alert(entdate + ' and ' + curdate  + ' diference :' + dif);



	if(entdate > curdate)



	{



		//alert(date + ' and ' + curdate);



		alert('Future date is not allowed!');



	}



}



$(document).ready(function() {

	$("#editvehicle").validationEngine();
	$("#expireon").mask("19/39/9999");

});



function check(){





	a = $('#a').show();

$('#b').show();



}

function check2(){





	a = $('#a').hide();

    $('#b').hide();

}



</script> 
{/literal}
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center" class="outer_table" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">Edit Vehicle </td>
        </tr>
         <tr>
          <td height="19" align="center" class=""><b>{$modiv_msg}</b></td>
        </tr>
        <tr>
          <td height="19" align="center"> { if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}
            
            
            
            { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top"><form name="editvehicle" id="editvehicle" method="post" action="editvehicle.php?id={$id}">
              <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" style="border:#999999 1px solid;">
                <tr>
                  <td colspan="3" valign="top" class="admintopheading"><strong>Vehicle Information</strong></td>
                </tr>
                <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>Vehicle ID :</strong></td>
                  <td colspan="2" align="left"><input name="vehicle_id" type="text"  class="validate[required] inputTxtField" id="vehicle_id" value="{$data.vehicle_id}" maxlength="20"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>Plat Number :</strong></td>
                  <td colspan="2" align="left"><input name="vnum" type="text"  class="validate[required] inputTxtField" id="vnum" value="{$vnum}" maxlength="15"/>
                    &nbsp;<span class="SmallnoteTxt">*</span>
                    <input type="hidden" name="hidvnum" id="hidvnum" value="{$hidvnum}"/></td>
                </tr>
                <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>VIN Number :</strong></td>
                  <td colspan="2" align="left"><input name="vin" type="text"  class="validate[required] inputTxtField" id="vin" value="{$data.vin}" maxlength="30"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Name :</strong></td>
                  <td colspan="2" align="left"><input name="vname" type="text"  class="validate[required] inputTxtField" id="vname" value="{$vname}" maxlength="50"/>
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
                  <td align="left" valign="top" class="labels"><strong>Model:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="vmodel" id="vmodel" value="{$vmodel}" maxlength="15" class="validate[required] inputTxtField" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
               <!-- <tr>
                  <td align="left" valign="top" class="labels"><strong>Purchased on:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="vpurchasedon" id="vpurchasedon" value="{$vpurchasedon}" class="validate[required] inputTxtField date"  onblur="chk_date();"/>
                    &nbsp;<span class="SmallnoteTxt">* (mm/dd/yyyy)</span></td>
                </tr>-->
                 <tr>
                  <td width="38%" align="left" valign="top" class="labels"><strong>Registration Number :</strong></td>
                  <td colspan="2" align="left"><input name="regno" type="text"  class="validate[required] inputTxtField" id="regno" value="{$data.regno}" maxlength="30"/>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Registration Expiration Date:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="expireon" id="expireon" value="{$data.expireon|date_format:"%m/%d/%Y"}" class="validate[required] inputTxtField date"  />
                    &nbsp;<span class="SmallnoteTxt">* (mm/dd/yyyy)</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Lincence State:</strong></td>
                  <td align="left"><select name="licensePlateState" id="licensePlateState" class="validate[] SelectBox"  >
                      <option value="" >Select</option>
                      {section name=n loop=$slist}
                      <option value="{$slist[n].abbr}" {if $data.licensePlateState neq ''}{if $slist[n].abbr eq $data.licensePlateState}selected{/if}{elseif $slist[n].abbr eq 'VA'}selected{/if}>
					   {$slist[n].statename}
		              </option>
		        	   {/section}
        			  </select>
                    &nbsp;<span class="SmallnoteTxt"></span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Capacity:</strong></td>
                  <td colspan="2" align="left"><input type="text" name="vcapacity" id="vcapacity" value="{$vcapacity}" class="validate[required,custom[onlyNumber]] inputTxtField digits" maxlength="2" />
                    &nbsp;<span class="SmallnoteTxt">* Seater</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Make:</strong></td>
                  <td colspan="2" align="left"><input name="vmake" type="text" class="validate[required] inputTxtField" id="vmake" value="{$vmake}" maxlength="50" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Milage: </strong></td>
                  <td colspan="2" align="left"><input name="vmileage" type="text" class="validate[required,custom[onlyNumber]] inputTxtField digits" id="vmileage" value="{$vmileage}" maxlength="15" />
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>GPS Enabled?: </strong></td>
                  <td colspan="2" align="left"><input onclick="check();" type="radio" name="gps" id="gps1" value="1" {if $gps eq '1'} checked="checked"{/if} />
                    Yes &nbsp;&nbsp;
                    <input onclick="check2();" type="radio" name="gps" id="gps2" value="0" {if $gps eq '0'} checked="checked"{/if} />
                    No
                    
                    
                    
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                </tr>
                <tr id="a" {if $gpsurl eq ''} style="display:none"{/if}>
                  <td align="left" valign="top" class="labels"><strong>GPS: </strong></td>
                  <td colspan="2" align="left"><input type="text" name="gpsurl" id="gpsurl" value="{$gpsurl}" class="inputTxtField digits" />
                    </td>
                </tr>
                <!--  <tr>
                  <td align="left" valign="top" class="labels"><strong>Vehicle Color :</strong></td>
                  <td align="left" valign="top"><input name="vcolor" type="text" class="validate[required,custom[onlyLetter]] inputTxtField" id="vcolor" value="{$vcolor}" maxlength="20" />
                    &nbsp;<span class="SmallnoteTxt">* </span></td>
                  <td valign="top">&nbsp;</td>
                </tr>
                         <tr>
              <td align="left" valign="top" class="labeltxt"><strong>Transmission:</strong></td>
              <td colspan="2" align="left" valign="top">
			  <select name="vtransmission" id="vtransmission" class="SelectBox required" >
               <option value="">Select</option>
			   <option value="Auto" {if $vtransmission eq 'Auto'}selected{/if}>Auto</option>           
			   <option value="Manual" {if $vtransmission eq 'Manual'}selected{/if}>Manual</option>  
		      </select>
			  &nbsp;<span class="SmallnoteTxt">*</span></td>
            </tr>-->
                <tr align="left">
                  <td colspan="3" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td align="left" valign="top" class="labels"><strong>Status :</strong></td>
                  <td align="left" valign="top"><select name="vstatus" id="vstatus" class="validate[required] SelectBox">
                      <option value="">Select</option>
                      <option value="Open" {if $vstatus eq 'Open'}selected{/if}>Open</option>
                      <option value="Suspended" {if $vstatus eq 'Suspended'}selected{/if}>Suspended</option>
                      <option value="Expired" {if $vstatus eq 'Expired'}selected{/if}>Expired</option>
                      <option value="Sold" {if $vstatus eq 'Sold'}selected{/if}>Sold</option>
                    </select>
                    &nbsp;<span class="SmallnoteTxt">*</span></td>
                  <td valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="3" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td valign="top">&nbsp;</td>
                  <td colspan="2"><input type="submit" name="submit" value="Save Changes" class="inputButton btn"></td>
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