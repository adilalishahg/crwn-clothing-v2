{literal} 
		<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
		<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
			  <script type="text/javascript"> 
				   function totalmiles(){
				    var m1 = parseFloat($('#miles1').val());
				    var m2 = parseFloat($('#miles2').val());
				    var m3 = parseFloat($('#miles3').val());
				    var m4 = parseFloat($('#miles4').val());
				    var m5 = parseFloat($('#miles5').val());
				    //var tot = (m1+m2+m3+m4+m5);
				   //$('#calcmiles').val(tot)
				   
				   //alert(m1);
				   
				   }
              </script>{/literal}

<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="19" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="ar" id="ar" method="post" action="approve_request.php">
        <table width="100%" border="0" cellspacing="4" cellpadding="2" align="center">
          <tr>
            <td colspan="3" valign="top" class="admintopheading"><strong>Approve Trip Request</strong></td>
          </tr>
          <tr>
            <td valign="top" class="labeltxt">&nbsp;</td>
            <td colspan="2"><input type="hidden" name="id" value="{$id}">
              <input type="hidden" name="rqid" value="{$rqid}"></td>
          </tr>
          {if $appdate eq $currdate}
   <!--       <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Assign Driver:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="driver" id="driver" class="SelectBox" >
                <option value="">Select</option>
			   {section name=n loop=$drivers}
                <option value="{$drivers[n].drv_code}" > {$drivers[n].fname}&nbsp;{$drivers[n].lname} </option>
			   {/section}
              </select>
              &nbsp;<span class="SmallnoteTxt">*</span></td>
          </tr>-->{else}{/if}
          <tr>
            <td align="right" valign="top" class="labeltxt">&nbsp;</td>
            <td colspan="2" align="left">{if $msg neq ''}{$msg}{/if}</td>
          </tr>
          
          
          
          <tr>
	   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Trip Type:</strong>&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left">{$ttype}</td>
		</tr>
        <tr>
	   <td width="38%" align="right" valign="top" class="labeltxt">&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left"></td>
		</tr>
			<tr> 
			  <td width="38%" align="right" valign="top" class="labeltxt"><strong>Pick Up Address:</strong>&nbsp;&nbsp;</td>              <td width="62%" colspan="2" align="left">{$pickaddrmiles}</td>
            </tr>
			<tr>
	   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Destination Address:</strong>&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left">{$destinationmiles}</td>
            </tr>
{if $ttype eq 'Three Way'|| $ttype eq 'Four Way'|| $ttype eq 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Second Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$three_address}</td>
</tr>
{/if}
{if $ttype eq 'Four Way'|| $ttype eq 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Third Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$four_address}</td>
</tr>
{/if}
{if $ttype == 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Forth Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$five_address}</td>
</tr>
{/if}

{if $ttype eq 'Round Trip' || $ttype eq 'Three Way'|| $ttype eq 'Four Way'|| $ttype eq 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Last Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$backto}</td>
</tr>
{/if}
<tr>
            <td colspan="3" valign="top">You can change below miles before actually going to approve this trip request
              </td>
          </tr>            
 <tr>
	   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Miles String:</strong>&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left">
       <input name="miles1" id="miles1" value="{$miles1}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {if $ttype eq 'Round Trip' || $ttype eq 'Three Way'|| $ttype eq 'Four Way'|| $ttype eq 'Five Way'}
       <input name="miles2" id="miles2" value="{$miles2}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if}
       {if $ttype eq 'Three Way'|| $ttype eq 'Four Way'|| $ttype eq 'Five Way'}
       <input name="miles3" id="miles3" value="{$miles3}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if}
       {if $ttype eq 'Four Way'|| $ttype eq 'Five Way'}
       <input name="miles4" id="miles4" value="{$miles4}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if}
       {if $ttype eq 'Five Way'}
       <input name="miles5" id="miles5" value="{$miles5}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if} (You can change these miles.)
 </td>
		</tr>
<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Loaded Miles:</strong></td>
<td width="62%" colspan="2" align="left"><input type="text" name="loadedmilage" id="loadedmilage" size="10" value="{$loadedmilage}" class="inputTxtField" readonly="readonly" /></td>
          </tr>
<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>UnLoaded Miles:</strong></td>
<td width="62%" colspan="2" align="left"><input type="text" name="unloadedmilage" id="unloadedmilage" size="10" value="{$unloadedmilage}" class="inputTxtField" />(You can change these miles.)</td>
          </tr>
<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Total Miles:</strong></td>
<td width="62%" colspan="2" align="left"><input type="text" name="totmilages" id="totmilages" size="10" value="{$totmilages}" class="inputTxtField" readonly="readonly" /></td>
          </tr>
 {if $detail.capped_miles eq '1'}
 <tr><td></td><td colspan="2"><span style="color:#F00; font-size:14px; padding:5 5 5 5px; text-align:center;">&raquo; CAPPED MILES OSERVED</span></td></tr>
 {/if}
 {if $detail.after_hours eq '1'}
 <tr><td></td><td colspan="2"><span style="color:#F00; font-size:14px; padding:5 5 5 5px; text-align:center;">&raquo; AFTER HOURS OSERVED</span></td></tr>
 {/if}           
          

          <tr>
            <td valign="top">&nbsp;</td>
            <td colspan="2"><input type="submit" name="submit" value="Submit" class="btn"  />
              <input type="reset" name="reset" value="Reset" class="btn"  /></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>