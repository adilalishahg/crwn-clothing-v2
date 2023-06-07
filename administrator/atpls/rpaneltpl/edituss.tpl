<html>
{literal}
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />
<link href="../theme/styles.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.autocomplete.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2"></script>
<script>
   $(document).ready(function(){
    $('#addgrid').validate();
		$("#phone").mask("999-999-9999");
		$("#dt1").mask("99:99");
		$("#pu1").mask("99:99");
		$("#pu2").mask("99:99");
		$("#dt2").mask("99:99");
		$("#adt1").mask("99:99");
		$("#apu1").mask("99:99");
  });
function show()
 {
    if( $('#chk').attr('checked')){
	$('#mnum').show();
     }else{
	 	$('#mnum').hide();
	 }
 }  
function chks(val,typ){
   if(val == ''){
   }else{
   }
}
function chkwc(){
if(document.getElementById('pck_wc').checked == true){



   $('#pu1').attr('disabled', true);

     $('#dt1').attr('disabled', true);

	



  }else{



     $('#pu1').attr('disabled', false);

      $('#dt1').attr('disabled', false);

  }  





if(document.getElementById('drp_wc').checked == true){



   $('#dt1').attr('disabled', true);



  }else{



     $('#dt1').attr('disabled', false);



  }  



 }

</script>
{/literal}
<body>

<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
  <tr>
    <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}
      { if $errors != ''} {$errors} {/if} </td>
  </tr>
  <tr>
    <td class="admintopheading">Edit Routing Sheet </td>
  </tr>
  <tr>
    <td align="left" valign="top"><table width="650" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>
          <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>
          <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>
        </tr>
        <tr>
          <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>
          <td align="left" valign="top" width="100%"><form name="addgrid" id="addgrid" method="post" action="editgrid-new.php?type={$type}" enctype="multipart/form-data" >
              <table width="650" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td height="25" align="right" class="labels">Trip Code : </td>
                  <td height="25"><input type="text" name="trip_code" id="trip_code"  class="required" maxlength="45" value="{$trip_code}"/>
                    <span style="color:#FF0000"> * </span></td>
                </tr>
                <tr>
                  <td width="150" height="25" align="right" class="labeltxt">Patient: </td>
                  <td width="486" height="25"><input name="consumer" type="text"  class="required" id="consumer"/ value="{$cname}" maxlength="45">
                    <span style="color:#FF0000"> * </span></td>
                </tr>
               <!-- <tr>
                  <td height="25" align="right" class="labeltxt">Account: </td>
                  <td height="25"><select name=""><option value="">Select Account</option>{section name=q loop=$accounts}
                  <option value="{$accounts[q].id}" {if $tripDetail.0.account eq accounts[q].id} selected {/if}>{$accounts[q].account_name}</option>{/section}</select>         <span style="color:#FF0000"> * </span></td>
                </tr>-->
                <tr>
                  <td height="25" align="right" class="labeltxt">Telephone:</td>
                  <td height="25"><input value="{$phone}" type="text" name="phone" id="phone" class=""/>
                    <span class="SmallnoteTxt">e.g (001-02-1234)</span></td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Pickup Address: </td>
                  <td height="25"><textarea name="addr1" id="addr1" cols="35" class="required">{$addr1}</textarea>
                    <span style="color:#FF0000"> * </span></td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Drop Address: </td>
                  <td height="25"><textarea name="addr2" id="addr2" cols="35" class="required">{$addr2}</textarea>
                    <span style="color:#FF0000"> * </span></td>
                </tr>
                <br>
                <tr>
                  <td height="25" align="right" class="labeltxt">Miles:</td>
                  <td height="25"><p id="results"></p>
                    <input value="{$m1}" type="text" name="miles1" id="miles1" class="required"/>
                    
                    <!--<input type="button" id="cmb" value="Calculate" onclick="calculate_distance('cal_miles','addr1','addr2');" >
                    
                    <input type="button" id="cmb" value="Calculate" onClick="showLocation(); return false;" >-->
                    <span style="color:#FF0000"> * </span></td>
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Pickup Time: </td>
                  <td height="25"> {if $smarty.session.admuser.admin_level eq '0'}{else} {/if}
                    <input onChange="dp(this.value);" value="{$ptime}" type="text" name="pu1" id="pu1" {if $wc eq "1"}disabled="disabled"{else}class="required"{/if}/>
                    or
                    <input  type="checkbox" name="pck_wc"  id="pck_wc" onClick="chkwc();" {if $wc eq "1"} checked="checked" {/if} />
                    
                <tr>
                  <td height="25" align="right" class="labeltxt">User Comments:</td>
                  <td height="25"><textarea name="remarks" id="remarks" cols="35" >{$remarks}</textarea></td
							      >
                </tr>
                <tr>
                  <td height="25" align="right" class="labeltxt">Trip Comments:</td>
                  <td height="25"><textarea name="t_comments" id="t_comments" cols="35" >{$comments}</textarea></td>
                </tr>
                <tr>
                  <td height="25">&nbsp;</td>
                  <td height="25"><input type="submit" value="Update" name="updgrid" id="updgrid" class="btn"/>
                    <input type="reset" value="Reset" name="reset" class="btn" /></td>
                </tr>
              </table>
              <input type="hidden" value="{$sheetid}" name="sheetid" id="sheetid">
              <input type="hidden" value="{$tripid}" name="tripid" id="tripid">
              <input type="hidden" value="{$id}" name="id" id="id">
              <input type="hidden" value="{$tdate}" name="tdate" id="tdate">
            </form></td>
          <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>
          <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>
          <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>