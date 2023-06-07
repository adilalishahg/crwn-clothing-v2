<table width="700px" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="25" align="left" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="19" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="ar" id="ar" method="post" action="approve_request.php">
        <table width="100%" border="0" cellspacing="4" cellpadding="2" align="center" class="outer_table">
          <tr>
            <td colspan="3" valign="top" class="admintopheading"><strong>Update Trip Milage </strong></td>
          </tr>
          <tr>
            <td valign="top" class="labeltxt">&nbsp;</td>
            <td colspan="2"><input type="hidden" name="tid" value="{$tid}"></td>
          </tr>
          <tr>
	   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Trip Type:</strong>&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left">{$dt.0.triptype}</td>
		</tr>
        <tr>
	   <td width="38%" align="right" valign="top" class="labeltxt">&nbsp;&nbsp;</td>
       <td width="62%" colspan="2" align="left"></td>
		</tr>
			<tr> 
			  <td width="38%" align="right" valign="top" class="labeltxt"><strong>Pick Up Address:</strong>&nbsp;&nbsp;</td>              <td width="62%" colspan="2" align="left">{$dt.0.pickaddr}</td>
            </tr>
			<tr>
	   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Destination Address:</strong>&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left">{$dt.0.destination}</td>
            </tr>
{if $dt.0.triptype eq 'Three Way'|| $dt.0.triptype eq 'Four Way'|| $dt.0.triptype eq 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Second Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$dt.0.three_address}</td>
</tr>
{/if}
{if $dt.0.triptype eq 'Four Way'|| $dt.0.triptype eq 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Third Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$dt.0.four_address}</td>
</tr>
{/if}
{if $dt.0.triptype == 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Forth Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$dt.0.five_address}</td>
</tr>
{/if}

{if $dt.0.triptype eq 'Round Trip' || $dt.0.triptype eq 'Three Way'|| $dt.0.triptype eq 'Four Way'|| $dt.0.triptype eq 'Five Way'}<tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Last Destination Address:</strong>&nbsp;&nbsp;</td>	           <td width="62%" colspan="2" align="left">{$dt.0.backto}</td>
</tr>
{/if}
          <tr>
	   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Miles String:</strong>&nbsp;&nbsp;</td>	               <td width="62%" colspan="2" align="left">
       <input name="miles1" id="miles1" value="{$miles1}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {if $dt.0.triptype eq 'Round Trip' || $dt.0.triptype eq 'Three Way'|| $dt.0.triptype eq 'Four Way'|| $dt.0.triptype eq 'Five Way'}
       <input name="miles2" id="miles2" value="{$miles2}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if}
       {if $dt.0.triptype eq 'Three Way'|| $dt.0.triptype eq 'Four Way'|| $dt.0.triptype eq 'Five Way'}
       <input name="miles3" id="miles3" value="{$miles3}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if}
       {if $dt.0.triptype eq 'Four Way'|| $dt.0.triptype eq 'Five Way'}
       <input name="miles4" id="miles4" value="{$miles4}" size="6" maxlength="7" onkeyup="totalmiles();" />
       {/if}
       {if $dt.0.triptype eq 'Five Way'}
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
<td width="62%" colspan="2" align="left"><input type="text" name="unloadmilage" id="unloadmilage" size="10" value="{$unloadmilage}" class="inputTxtField" /></td>
          </tr>
           <tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Total Miles:</strong></td>
<td width="62%" colspan="2" align="left"><input type="text" name="totmilages" id="totmilages" size="10" readonly="readonly" value="{$totmilages}" class="inputTxtField" /></td>
          </tr>
          <tr>
<td width="38%" align="right" valign="top" class="labeltxt"><strong>Free Miles:</strong></td>
<td width="62%" colspan="2" align="left"><input type="text" name="freemiles" id="freemiles" size="10" readonly="readonly" value="{$freemiles}" class="inputTxtField" /></td>
          </tr>
         
          <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Wait Time?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><input type="text" name="wait_time" id="wait_time" value="{$dt.0.wait_time}" size="10" maxlength="8" class="inputTxtField" />HH:MM:SS 
            </td>
          </tr>
          <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>No Show Apply?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="noshow">
            										<option value="0" {if $dt.0.noshow eq '0'}selected{/if}>No</option>
                                                    <option value="1" {if $dt.0.noshow eq '1'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>
         <!-- <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Stretcher Used?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="stretcher">
            										<option value="No" {if $dt.0.stretcher eq 'No'}selected{/if}>No</option>
                                                    <option value="Yes" {if $dt.0.stretcher eq 'Yes'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>-->
           <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Bariatric Stretcher Used?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="bar_stretcher">
            										<option value="No" {if $dt.0.bar_stretcher eq 'No'}selected{/if}>No</option>
                                                    <option value="Yes" {if $dt.0.bar_stretcher eq 'Yes'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>
           <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>2 Man Team Used?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="dstretcher">
            										<option value="No" {if $dt.0.dstretcher eq 'No'}selected{/if}>No</option>
                                                    <option value="Yes" {if $dt.0.dstretcher eq 'Yes'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>
           <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>0xygen Charges Apply?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="oxygen">
            										<option value="No" {if $dt.0.oxygen eq 'No'}selected{/if}>No</option>
                                                    <option value="Yes" {if $dt.0.oxygen eq 'Yes'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>
          <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Wheel Chair Rental Fee Apply?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="dwchair">
            										<option value="No" {if $dt.0.dwchair eq 'No'}selected{/if}>No</option>
                                                    <option value="Yes" {if $dt.0.dwchair eq 'Yes'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>
          <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>After Hours Fee Apply?:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><select name="after_hours">
            										<option value="0" {if $dt.0.after_hours eq '0'}selected{/if}>No</option>
                                                    <option value="1" {if $dt.0.after_hours eq '1'}selected{/if}>Yes</option>
                                                    </select> Auto apply
            </td>
          </tr>
         
         
          
          
           {if $dt.0.capped_miles eq '1'}
 <tr><td></td><td colspan="2"><span style="color:#F00; font-size:14px; padding:5 5 5 5px; text-align:center;">&raquo; CAPPED MILES OSERVED</span></td></tr>
 <input type="hidden" name="capped_miles" value="{$dt.0.capped_miles}"  />
 {/if}
           <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Miscellaneous Charges:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><input type="text" name="miscellaneous_charges" id="miscellaneous_charges" value="{$dt.0.miscellaneous_charges}" size="10" maxlength="8" class="inputTxtField" /> $ 
            </td>
          </tr>
           <tr>
            <td width="38%" align="right" valign="top" class="labeltxt"><strong>Total Charges:</strong>&nbsp;&nbsp;</td>
            <td width="62%" colspan="2" align="left"><input type="text" name="totcharges" id="totcharges" size="10" value="{ $dt.0.charges}" class="inputTxtField" readonly="true" /> 
              $</td>
          </tr>
          <tr>
            <td valign="top">&nbsp;</td>
            <td colspan="2"><input type="submit" name="submit" value="Submit" class="btn"  />
              <input type="hidden" name="date" id="date" value="{$tdate}" />
            
              
             <!-- <input type="hidden" name="afterhfee" value="{$dt.0.afterhfee}" />-->
              <input type="reset" name="reset" value="Reset" class="btn"  /></td>
          </tr>
        </table>
      </form></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
<script>
$('#wait_time').mask('29:59:59');
</script>
