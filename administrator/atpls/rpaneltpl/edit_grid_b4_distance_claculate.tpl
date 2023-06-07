{literal}

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

  }else{

     $('#pu1').attr('disabled', false);

  }  



if(document.getElementById('drp_wc').checked == true){

   $('#dt1').attr('disabled', true);

  }else{

     $('#dt1').attr('disabled', false);

  }  

 }

</script>

{/literal}



<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">

        <tr>

          <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}

		  { if $errors != ''} {$errors} {/if} </td>

        </tr>

        <tr>

          <td class="admintopheading">Edit Routing Sheet </td>

        </tr>

        <tr>

          <td align="left" valign="top">

		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">

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

								    <td width="150" height="25" align="right" class="labeltxt">Consumer Name: </td>

								    <td width="486" height="25"><input name="consumer" type="text"  class="required" id="consumer"/ value="{$cname}" maxlength="45">

								    <span style="color:#FF0000"> * </span></td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Facility / Corporate: </td>

								    <td height="25"><input name="clinic" type="text" class="required" id="clinic" value="{$clinic}" size="75" />

								    <span style="color:#FF0000"> * </span></td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Telephone:</td>

								    <td height="25"><input value="{$phone}" type="text" name="phone" id="phone" class=""/>								      <span class="SmallnoteTxt">e.g (001-02-1234)</span></td>
							      </tr>

								 

								  <tr>

								    <td height="25" align="right" class="labeltxt">Pickup Address: </td>

								    <td height="25"><textarea name="addr1" id="addr1" cols="35" class="required">{$addr1}</textarea><span style="color:#FF0000"> * </span></td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Drop Address: </td>

								    <td height="25"><textarea name="addr2" cols="35" class="required">{$addr2}</textarea><span style="color:#FF0000"> * </span></td>
							      </tr>

								  <br>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Pickup Time: </td>

								    <td height="25">
								{if $smarty.session.admuser.admin_level eq '0'}	
		<input value="{$ptime}" type="text" name="pu1" id="pu1" {if $ptime eq "00:00:00"}disabled="disabled"{else}class="required"{/if}/> or 

		<input type="checkbox" name="pck_wc"  id="pck_wc" onclick="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if} />			
								{else}
								   {if $sts eq '5' || $sts eq '2'}
		<input value="{$ptime}" type="text" name="pu1" id="pu1" {if $ptime eq "00:00:00"}disabled="disabled"{else}class="required"{/if}/> or 
		<input type="checkbox" name="pck_wc"  id="pck_wc" onclick="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if} />
									{else}
	    <input value="{$ptime}" type="text" name="pu1" id="pu1" disabled="disabled"/> or 
		<input type="checkbox" name="pck_wc"  id="pck_wc" onclick="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if} disabled="disabled" />
								   {/if}
								{/if}
<!--								
								
									<input value="{$ptime}" type="text" name="pu1" id="pu1" {if $smarty.session.admuser.admin_level neq '0' & ($st neq '5' || $st neq '2')}disabled="disabled"{else}{if $ptime eq "00:00:00"} disabled="disabled" {/if}{/if} class="required"/> or <input type="checkbox" name="pck_wc"  id="pck_wc" onclick="chkwc();" {if $smarty.session.admuser.admin_level neq '0'}disabled="disabled"{/if} {if $ptime eq "00:00:00"}  checked="checked" {/if}/>

<input value="{$ptime}" type="text" name="pu1" id="pu1" class="required" {if $ptime eq "00:00:00"} disabled="disabled" {/if}/> or <input type="checkbox" name="pck_wc"  id="pck_wc" onclick="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if} />-->

								    W/C<span style="color:#FF0000"> * </span>									</td>
							      </tr>		  
						       {if $smarty.session.admuser.admin_level eq '0'}
								  {if $sts neq '5' && $sts neq '2'}
								  <tr>
								    <td height="25" align="right" class="labeltxt">Actual Pickup Time:</td>
								    <td height="25"><input value="{$aptime}" type="text" name="apu1" id="apu1"/></td>
							      </tr>
								  {/if}
                                {else}
								  {if $sts neq '5' && $sts neq '2'}
								  <tr>
								    <td height="25" align="right" class="labeltxt">Actual Pickup Time:</td>
								    <td height="25">{$aptime}<input value="{$aptime}" type="hidden" name="apu1" id="apu1"/></td>
							      </tr>	
								  {/if}						 
							    {/if}  	
								  <tr>

								    <td height="25" align="right" class="labeltxt">Drop Time: </td>

								    <td height="25">
									
								{if $smarty.session.admuser.admin_level eq '0'}	
		<input value="{$dtime}" type="text" name="dt1" id="dt1" {if $ptime eq "00:00:00"}disabled="disabled"{else}class="required"{/if}/> <!--or 
	<input type="checkbox" name="drp_wc" id="drp_wc" onchange="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if} />		-->						                                {else}
								   {if $sts eq '5' || $sts eq '2'}
	    <input value="{$dtime}" type="text" name="dt1" id="dt1" {if $ptime eq "00:00:00"}disabled="disabled"{else}class="required"{/if}/> <!--or 
		<input type="checkbox" name="drp_wc" id="drp_wc" onchange="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if} />	
-->									{else}
		<input value="{$dtime}" type="text" name="dt1" id="dt1" disabled="disabled"/><!--or 
		<input type="checkbox" name="drp_wc" id="drp_wc" onchange="chkwc();" {if $ptime eq "00:00:00"} checked="checked" {/if}disabled="disabled"/>-->	
								   {/if}
								{/if}
									
							{if $ptime eq "00:00:00"}
							{/if}		
									
<!--									<input value="{$dtime}" type="text" name="dt1" id="dt1" {if $smarty.session.admuser.admin_level neq '0'}disabled="disabled"{/if} {if $ptime eq "00:00:00"} disabled="disabled" {/if} class="required"/> or <input type="checkbox" name="drp_wc" id="drp_wc" onchange="chkwc();" {if $smarty.session.admuser.admin_level neq '0'}disabled="disabled"{/if} {if $ptime eq "00:00:00"} checked="checked" {/if} />-->

								    <!--W/C--><span style="color:#FF0000"> * </span><input value="{$adtime}" type="hidden" name="adt1" id="adt1"/></td>
							      </tr>
							{if $smarty.session.admuser.admin_level eq '0'}	  
                               {if $sts neq '5' && $sts neq '2'}  
								  <tr>
								    <td height="25" align="right" class="labeltxt">Actual Drop Time:</td>
								    <td height="25"><input value="{$adtime}" type="text" name="adt1" id="adt1"/></td>
							      </tr>
								{/if}  
                             {else}
							    {if $sts neq '5' && $sts neq '2'}  
								  <tr>
								    <td height="25" align="right" class="labeltxt">Actual Drop Time:</td>
								    <td height="25">{$adtime}<input value="{$adtime}" type="hidden" name="adt1" id="adt1"/></td>
							      </tr>	
								 {/if}						 
							 {/if}
								  <tr>

								    <td height="25" align="right" class="labeltxt">Miles:</td>

								    <td height="25"><input value="{$m1}" type="text" name="miles1" id="miles1" class="required"/><span style="color:#FF0000"> * </span></td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Staff ID:</td>

								    <td height="25"><select name="staff1" id="staff1" class="required">

									  <option value="">--Select--</option>

									  {section name=r loop=$driverdata}

									  <option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code == $staff1}selected="selected"{/if}>{$driverdata[r].drv_code}--{$driverdata[r].fname} {$driverdata[r].lname}</option>

									  {/section}

									</select><span style="color:#FF0000"> * </span></td>
							      </tr>
								 <tr>
                                   <td height="25" align="right" class="labels"></td>
                                   <td height="25"><input type="checkbox" name="chk" value="1" id="chk" onclick="show();" />
                                     (Click Here to enter mobile number)<br>
                               
                                       <input type="text" name="mnum" id="mnum"  style="display:none"  /></td>
                                 </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Remarks:</td>

								    <td height="25"><textarea name="remarks" id="remarks" cols="35" >{$remarks}</textarea></td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Status:</td>

								    <td height="25">						
								{if $sts eq '5' || $sts eq '2'}	
								   <select name="status" class="name_text required" onchange="return chks(this.value,{$type});">								
										<option value="5" {if $sts eq '5'} selected="selected"{/if}>In Progress</option>
										<option value="2" {if $sts eq '2'} selected="selected"{/if}>Rescheduled</option>
										<option value="3" {if $sts eq '3'} selected="selected"{/if}>Cancelled</option>
										<option value="6" {if $sts eq '6'} selected="selected"{/if}>Picked</option>
										<option value="8" {if $sts eq '8'} selected="selected"{/if}>Not Going</option>
										<option value="7" {if $sts eq '7'} selected="selected"{/if}>Not at home</option>
									</select>									
								{elseif $sts eq '3'}	
								   <select name="status" class="name_text required" onchange="return chks(this.value,{$type});">							
										<option value="2" {if $sts eq '2'} selected="selected"{/if}>Rescheduled</option>
										<option value="3" {if $sts eq '3'} selected="selected"{/if}>Cancelled</option>
								   </select>	
								{elseif $sts eq '6'}	
								   <select name="status" class="name_text required" onchange="return chks(this.value,{$type});">							
										<option value="5" {if $sts eq '5'} selected="selected"{/if}>In Progress</option>
										<option value="4" {if $sts eq '4'} selected="selected"{/if}>Dropped</option>
								   </select>	
								{elseif $sts eq '7'}	
								   <select name="status" class="name_text required" onchange="return chks(this.value,{$type});">							
										<option value="2" {if $sts eq '2'} selected="selected"{/if}>Rescheduled</option>
										<option value="7" {if $sts eq '7'} selected="selected"{/if}>Not at home</option>
								   </select>	
								{elseif $sts eq '8'}	
								   <select name="status" class="name_text required" onchange="return chks(this.value,{$type});">							
										<option value="2" {if $sts eq '2'} selected="selected"{/if}>Rescheduled</option>
										<option value="8" {if $sts eq '8'} selected="selected"{/if}>Not Going</option>	
								   </select>									   								   								
								{else}
								      {if $smarty.session.admuser.admin_level eq '0'}								
                                      <select name="status" class="name_text required" onchange="return chks(this.value,{$type});">																	
										{if $sts eq '1'}
										<option value="1" {if $sts eq '1'} selected="selected"{/if}>Completed</option>
										{elseif $sts eq '4'}
										<option value="4" {if $sts eq '4'} selected="selected"{/if}>Completed</option>
										{/if}																				
										<option value="2" {if $sts eq '2'} selected="selected"{/if}>Rescheduled</option>
										<option value="3" {if $sts eq '3'} selected="selected"{/if}>Cancelled</option>
										<option value="6" {if $sts eq '6'} selected="selected"{/if}>Picked</option>										
										<option value="3" {if $sts eq '3'} selected="selected"{/if}>Cancelled</option>
										<option value="8" {if $sts eq '8'} selected="selected"{/if}>Not Going</option>
										<option value="7" {if $sts eq '7'} selected="selected"{/if}>Not at home</option>											
								     </select>	
									 {else}
											{if $sts eq '1'}
													Delayed
											{if $sts eq '3'}
													Cancelled
											{elseif $sts eq '4'}
													Successful
											{elseif $sts eq '5'}
													In Progress
											{elseif $sts eq '2'}
													Rescheduled
											{elseif $sts eq '7'}
													Not at Home
											{elseif $sts eq '8'}
													Not Going											
											{/if}
									 {/if}															
								{/if}
                              {/if}								  </td>
							      </tr>
								  <tr>

									<td height="25">&nbsp;</td>

									<td height="25">

									<input type="submit" value="Update" name="updgrid" id="updgrid" class="btn"/>

									<input type="reset" value="Reset" name="reset" class="btn" />									</td>
								  </tr>
			  </table>         

			                     <input type="hidden" value="{$sheetid}" name="sheetid" id="sheetid">   

			                    <input type="hidden" value="{$tripid}" name="tripid" id="tripid">  

								<input type="hidden" value="{$id}" name="id" id="id">

								</form></td>

    <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>

  </tr>

  <tr>

    <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>

    <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>

    <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>

  </tr>

</table>		  </td>

        </tr>

      </table>

