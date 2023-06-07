{ include file = headerinner.tpl}
{literal}
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
function selbox(val){
if(val == '0'){
if(document.getElementById('box').checked == true)
   {
  $('#hospname').attr("disabled", true);
  $('#address').attr("disabled", true);
  $('#cisid').attr("disabled", false);
  //$('#box2').attr("disabled", true);   
  $('#box2').attr("checked", false);  
  $('#ssn').val("");   
  $('#ssn').attr("disabled", true); 
  return true;  
  }
else if(document.getElementById('box').checked == false){
  $('#hospname').attr("disabled", false);
  $('#address').attr("disabled", false);
  $('#ssn').attr("disabled", true); 
  $('#box').attr("disabled", false);
  $('#box2').attr("disabled", false); 
  $('#box2').attr("checked", false);     
  $('#cisid').attr("disabled", true); 
  $('#cisid').val(""); 
  return true;
  }else{
  return false;
    }
  }
if(val == '1'){
if(document.getElementById('box2').checked == true)
   {
  $('#hospname').attr("disabled", true);
  $('#address').attr("disabled", true);
  $('#cisid').val("");
  //$('#box').attr("disabled", true); 
  $('#cisid').attr("disabled", true);     
  $('#box').attr("checked", false);   
  $('#ssn').attr("disabled", false);  
  return true;  
  }
else if(document.getElementById('box2').checked == false){
  $('#hospname').attr("disabled", false);
  $('#address').attr("disabled", false);
  $('#cisid').attr("disabled", true); 
  $('#box').attr("disabled", false);
  $('#box').attr("checked", false); 
  $('#box2').attr("disabled", false);     
  $('#ssn').attr("disabled", true); 
  $('#ssn').val("");    
  return true;
  }else{
  return false;
    }
  }  
}
$(document).ready(function(){	

$("#startdate").datepicker( {maxDate: '-0', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {maxDate: '-0', dateFormat: 'mm/dd/yy'} );
});
</script>
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            
                            <tr>
            <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td></tr>
							<tr>
                             <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							{if $noReq neq '0'}
							[<a href="javascript:history.back();">Back</a>]{/if}</div>							  </td></tr>	
                            <tr>
<td height="19" colspan="2" align="center" class="admintopheading">PAYMENT REPORT</td>
                            </tr>
                                                       <tr>
                              <td height="auto" colspan="2" align="center"  valign="top">
							 <form name="searchReport" id="searchReport" action="payment.php" method="post"> 
							  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >
           
            <tr>
              <td width="20%" align="left" valign="top" class="labeltxt"><strong>From:<font color="#FF0000">*</font></strong></td>
              <td width="30%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$startdate}" class="inputTxtField"/>                &nbsp;
                
                (mm/dd/yyyy)</td>
              <td align="left" width="20%" valign="top" class="labeltxt"><strong>To:<font color="#FF0000">*</font></strong>&nbsp;</td>
              
              <td width="30%" align="left" valign="top"><input type="text" name="enddate" id="enddate" value="{$enddate}" class="inputTxtField" />
                
                (mm/dd/yyyy)</td>
             </tr>
            <tr>
              <td align="left" valign="top" class="labeltxt"><strong>Account Name:</strong></td>
              <td align="left" valign="top">
			  <select name="hospname" id="hospname">
			    <option value="">All</option>
			   {section name=q loop=$hosp} 
			    <option value="{$hosp[q].id}" {if $hospname eq $hosp[q].id}selected="selected"{/if}>{$hosp[q].account_name}</option
				>{/section}
			   </select>		  </td>
               <td align="left" valign="top" class="labeltxt"><strong>Patient Name  :</strong></td>
     	 <td align="left" valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div> </td>
           </tr>
          		<tr>
              
              <td align="left" valign="top" class="labeltxt"><strong>Payment Status:</strong>&nbsp;</td>
                            <td align="left" valign="top"><select name="payment_status" ><option value="" {if $payment_status eq ''} selected="selected" {/if} >All</option><option value="0" {if $payment_status eq '0'} selected="selected" {/if} >Pending</option><option value="1" {if $payment_status eq '1'} selected="selected" {/if} >Collected</option></select></td>
			</tr>
            <!--<tr>
              <td align="left" valign="top" class="labeltxt"></td>
              <td align="left" valign="top"><input type="checkbox" {if $reclaim neq ''} checked="checked" {/if} name="reclaim" value="reclaim" />&nbsp;<strong>Reclaim Only</strong></td>
              <td align="left" valign="top"><strong>HIC Form: </strong></td><td align="left" valign="top" colspan="2"><input type="radio" name="hic" value="1" {if $hic eq '1'} checked="checked" {/if} /> Yes  <input type="radio" name="hic" value="0" {if $hic eq '0'} checked="checked" {/if} /> No&nbsp;</td>
			</tr>-->
            <tr>
              <td></td>
              <td colspan="3" align="left" valign="top">
			  <input type="submit" name="showpay" value='Report' class="inputButton btn"  />&nbsp;
			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />		 	  </td>
              </tr>
          </table>	</form>
                  		  	                  </td>
                            </tr>
                            <tr>
                              <td height="auto" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="100%" border="0" cellspacing="0" cellpadding="0">                    
                            <tr>
                            <td align="center" class="admintopheading">ACCOUNT RECEIVABLES </td>
                            </tr>
                            <tr>
                            <td align="center" class="admintopheading" >Total Amount in this Search: $ {$tot_amount|string_format:"%.2f"} [ Collected: $ {$collectedammount|string_format:"%.2f"}]  <span style="color:#F00;" >[ Pending: $ {$pendingammount|string_format:"%.2f"}]</span>  </td>
                            </tr>
                          {if $noReq neq '0'}
                            <tr>
                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								<div style="100%; border: #F00 0px solid; float:left;"></div>
						   <br />
							  <table width="100%" border="0" class="">
							  <tr class="admintopheading">
<td width="15%" align="center"><strong>{if $showPatient eq 'no'}Patient{else}Patient Name{/if}</strong></td>
<td width="15%" align="center"><strong>{if $showPatient eq 'no'}Contact Person{else}Appt Date /Time{/if}<br/>Account Name</strong></td>
<td  width="20%"  align="center" ><strong>Pick Address</strong></td>
<td width="20%" align="center"><strong>Destination Address </strong></td>
<td width="10%" align="center"><strong>Amount</strong></td>
<td width="10%" align="center"><strong>Update Collected<br/>Amount</strong></td>
<td align="10%"><strong>&nbsp;Invoice&nbsp;</strong></td>
<td align="10%"><strong>Payment <br />Status </strong></td>
								</tr>	   
							{section name=q loop=$reqdetails}
							  {if $reqdetails[q].rows neq '0'}
							  <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
								<td align="left" valign="middle">
								<b>{if $showPatient eq 'no'}{$reqdetails[q].hospname}{else}{$reqdetails[q].clientname}{/if}</b>
								</td>
								<td align="center" valign="middle">
								{if $showPatient eq 'no'}
								{$reqdetails[q].firstname} {$reqdetails[q].lastname}{else}
								{$reqdetails[q].appdate|date_format} {$reqdetails[q].apptime|truncate:5:""}
								{/if}<br/>{$reqdetails[q].account_name}
								</td>
							<td align="center" valign="middle"> {$reqdetails[q].pickaddr }</td>
									<td align="center" valign="middle"> {$reqdetails[q].destination }</td>
								<td align="center" valign="middle">   
								 $&nbsp;{$reqdetails[q].charges|string_format:"%.2f"}
								</td>
                                <td align="center" valign="middle">   
                                $&nbsp;<input type="text" name="amountrec" id="amountrec{$reqdetails[q].id}" size="6" value="{$reqdetails[q].partial_collected|string_format:"%.2f"}"  />
&nbsp;<input type="button" value="Update" class="inputButton btn" onclick="amountrec('{$reqdetails[q].id}');" />


								</td>                               
								<td align="center" valign="middle">
								<a href="javascript:popWind2('medical_invoice.php?id={$reqdetails[q].tid}');">Invoice</a></td>
								<td width="10" align="center" valign="middle">
								<select name="paystatus"  id="paystatus{$smarty.section.q.iteration}" onChange="javascript:chgpaystatus(this.value,{$reqdetails[q].id},{$smarty.section.q.iteration});" ><!--{if $reqdetails[q].paystatus eq '1'} disabled="disabled" {/if}-->
			    <option value="0"{if $reqdetails[q].paystatus eq '0'} selected="selected" {/if}>Pending</option>
				<option value="2"{if $reqdetails[q].paystatus eq '2'} selected="selected" {/if}>Partial Collected</option>
                <option value="1"{if $reqdetails[q].paystatus eq '1'} selected="selected" {/if}>Collected</option>
			   </select>
								</td>
								</tr>
							 {else}
							 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 				 
							 {/if}
							{sectionelse}
							 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 
							 {/section} 
							</table> 					
                			
                </td>
            </tr>
			 {else}
						 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr> 				 
							 {/if}
        {if $payment_status eq '0' AND $hospname neq '0' AND $totalRows gt 0}                   
		<tr><td colspan="5" align="center" class="labeltxt">
        <form name="payonce" action="payment.php" method="post" >
        <input type="hidden" name="startdate" value="{$startdate}" />
        <input type="hidden" name="enddate" value="{$enddate}" />
        <input type="hidden" name="hospname" value="{$hospname}" />
        <input type="hidden" name="payment_status" value="{$payment_status}" />
        <input type="hidden" name="request_status" value="{$request_status}" />
        <input type="hidden" name="pname" value="{$pname}" />
        <input type="hidden" name="reclaim" value="{$reclaim}" />
        <input type="submit" class="inputButton btn" name="payonce" value="Collected For All Search" /></form>
        </td></tr>
        {/if}
      </table>
					     			       </td>
                   </tr>
			    <tr><td></td>
			</tr>		 
      </table>  
    </td>
  </tr>
</table>
<table><tr><td align="left">{$pages}</td></tr></table>
{literal}
<script>selbox();</script>	
<script>
function chgpaystatus(pay,fid,id){
$.post("changestatus.php",{pay:pay,fid:fid},function(result){
	if(result != '') { location.reload(); }
		//$("#paystatus"+id).attr('disabled',true);
		 }); }
function amountrec(id){ //alert(id);
var amount = $('#amountrec'+id).val();
//var balance = $('#balance'+id).val(); //alert(balance);
$.post("amountrec.php",{amount:amount,id:id},function(result){ 
	//if(result != '') 
	window.location.reload();
		}); 
 }		 
</script>	 
{/literal}
{ include file = innerfooter.tpl}