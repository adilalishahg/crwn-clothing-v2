{ include file = headerinner.tpl}
{literal} 
   <script language="JavaScript" type="text/javascript" src="suggest.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#search").validate();
	$("#returnpickupUSS").mask("29:59");
	$("#apptimeUSS").mask("29:59:59");
	$("#dobUSS").mask("99/99/9999");
	$("#phnumUSS").mask("(454) 654-6546");

    $("#startdate").datepicker( {dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( { dateFormat: 'mm/dd/yy'} );
	});	
function deleteRec(id)
		{ var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{ $.post("delete.php", {id: id}, function(data)
			{ });
			$('#tr'+id).hide();
			//location.reload();
			 //location.href="reqdetails.php?delId="+id;
		return true;}else{			
			return false;}
}
function stchange(val,req)
{
  if (val != ''){		
 	location.href="reqdetails.php?st="+val+"&req="+req;
	return true;}else{
			return false;
		}			
	}	
function ChangeStatus(val,st){
var ans= 1;
if(st == '3'){
     jPrompt('Specify the reason for disapproving:', '', ' Medical Transportation', function(r) {
	  if(typeof(r) == "undefined"){
	    Ask();
	  }else{
	  if(r == '' || r == null){ jAlert('You must Specify a reason for disapproving'); return false; }	  	  else{
	    ans = r;  	
        AjaxSend(val,st,ans); }
	  }
	});
}
if(st == '2'){
   AjaxSend(val,st,ans);
  }
}	
function removeTr(val){
  $('#tr'+val).remove();
}
function Ask(){
    jPrompt('Specify the reason for disapproving:', '', ' Medical Transportation', function(r) {
	  if(typeof(r) == "undefined"){
	  jAlert('You must Specify a reason for disapproving'); 	  
	    Ask();
	  }else{
	  return r; }
	});
}	
function AjaxSend(val,st,ans){
   $.post("hosprequests.php", {queryString: ""+val, sta:""+st, rea: ""+ans}, function(data){
  if(data.length > 0) {   
        if(st == '3'){	
          if(data == 'Success'){
            //var url = window.location;
            //location.href= url;
           removeTr(val); return false;
          }else{
            //var url = window.location;
            //location.href= url;
            removeTr(val); return false;
          }	
		}
		else if(st == '2'){ 
          if(data == 'Success'){
           //var url = window.location;
           //location.href= url;
            removeTr(val); return false;
          }else{
           //var url = window.location;
           //location.href= url;
            removeTr(val); return false;
          }		
		} 
        else{
		return false;	
		} 		
      }
	 });
}
function checkdrv(val,drv){
	//alert(val);
	if(val==1){//alert(drv);
	$('.drv_id').val(drv);
	}
	}
</script> 
{/literal}

  <table width="75%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
              
              { if $errors != ''} {$errors} {/if}</span></td>
          </tr>
          <tr>
            <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>
          </tr>
          <tr><td colspan="2"><form name="search" id="search" method="post" action="" >
          <table width="100%" border="0">
  	
 
  <tr>
    <td><strong>Start Date:</strong></td>
    <td><input type="text" name="startdate" id="startdate" class="required"  size="32" value="{$post.startdate}"  autocomplete="off"/></td>
   <td><strong>End Date:</strong></td>
    <td><input type="text" name="enddate" id="enddate" class="required" size="32"  value="{$post.enddate}"  autocomplete="off"/></td>
  </tr>
   <tr>
    <td><strong>Member/Patient:</strong></td>
    <td><input type="text" name="clientname" id="pname" value="{$post.clientname}"  class="required" size="32" onKeyUp="searchSuggest();"  autocomplete="off"/><div id="layer1"></div></td>
    <td><strong>Leg:</strong></td>
    <td>
    <select name="leg"><option value=""> All </option>
    <option value="AB" {if $post.leg eq 'AB'} selected="selected"{/if}> Leg A </option>
    <option value="BF"  {if $post.leg eq 'BF'} selected="selected"{/if}> Leg B </option>
    </select>
    
    </td>
    
    
  </tr>
  <tr>
    <td colspan="2"><span  style="font-size:9px; color:#F00;">Date format mm/dd/yyyy | Time format hh:mm:ss</span></td>
    <td><input type="submit" value="Search" name="search" class="btn"/><input type="hidden" name="st" value="approved"  /></td>
   
  </tr>
</table></form>

          </td></tr>
          
         
          <tr>
            <td height="19" align="left" class="admintopheading">
              </td>
            <td class="admintopheading" style="text-align:center;">REQUESTS DETAIL {if $clinic neq ''}[{$clinic}]{/if}</td>
          </tr>
          <tr>
            <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><div style="width:700px; border: #F00 0px solid; float:left;">
            {if $post.st eq 'active'}
                <table width="100%" border="0" class="main_table">
                  <tr class="admintopheading" height="55">
                    <td align="center"><strong>S.No</strong></td>
                    <td align="center"><strong>Patient Name</strong></td>
                    <td align="center"><strong>Appointment date</strong></td>
                    <td align="center"><strong>Pick Time</strong></td>
                    <td align="center"><strong>Re-turn Pick Time</strong></td>
                    
                  </tr>
                  <form name="updatenow" id="updatenow" action="updatenow.php" method="post" >
                  {section name=q loop=$data}
            <tr valign="top" id="tr{$data[q].id}">
              <td align="left"><b>{$smarty.section.q.iteration}</b></td>
              <td align="left"><b>{$data[q].clientname}<input type="hidden" name="id[]" value="{$data[q].id}"  /></b></td>
              <td align="center"><input type="text" name="appdate[]" value="{$data[q].appdate|date_format:"%m/%d/%Y"}"  /></td>
              <td align="center"><input type="text" name="apptime[]" value="{$data[q].apptime}"  /></td>
              <td align="center"><input type="text" name="returnpickup[]" value="{$data[q].returnpickup}"/></td>
            </tr>
                  {sectionelse}
            <tr>
                   <td colspan="5" align="center" class="labeltxt"><b>No Record Found</b></td>
            </tr>
                  {/section}
                  {if $data neq ''}
                  <tr>
             		<td ></td>
                    <td ></td>
                    <td ></td>
                    <td ><input type="submit" name="updatenow" value=" Update ..." class="btn" /></td>
                    <td ></td>
             </tr>    {/if}
             </form>
             {if $data neq ''}
             <tr><td colspan="5" ><form name="coupleUP" id="" action="updatenow3.php" method="post">
             <table style="width:100%; border:#F00; border-style:double;" >
             <tr><td colspan="4" style="text-align:center" class="admintopheading">Update Following Attributes For All Search Records</td></tr>
             <tr>
             <td width="15%">Patient Name:</td><td width="35%"><input type="text" name="clientname" value="{$data[1].clientname}" /></td>
             <td width="15%">DOB:</td><td width="35%"><input type="text" name="dob" id="dobUSS" value="{$data[1].dob|date_format:"%m/%d/%Y"}" /></td>
             </tr>
             <tr>
             <td >Insurance ID:</td><td ><input type="text" name="cisid" value="{$data[1].cisid}" /></td>
             <td >Patient Phone No:</td><td ><input type="text" name="phnum" id="phnumUSS" value="{$data[1].phnum}" /></td>
             </tr>
             <tr>
             <td >Vehicle Pref.:</td><td ><select name="vehtype" id="vehtype">
                      <option value="">Select</option>
                      {section name=q loop=$vehiclepref}	
                      <option value="{$vehiclepref[q].id}" {if $data[1].vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>
                      {/section}
                    </select>
             </td>
             <td ></td><td ></td>
             </tr>
              <tr>
             <td >Pick Time:</td><td ><input type="text" name="apptime" id="apptimeUSS" value="{$data[1].apptime}" /></td>
             <td >Return PickTime:</td><td ><input type="text" name="returnpickup" id="returnpickupUSS" value="{$data[1].returnpickup}" /></td>
             </tr>
             <tr>
             <td >Pick Address:</td><td ><textarea name="pickaddr" cols="33" rows="2">{$data[1].pickaddr}</textarea></td>
             <td >Drop Address:</td><td ><textarea name="destination" cols="33" rows="2">{$data[1].destination}</textarea></td>
             </tr>
             <tr>
             <td >Return Address:</td><td ><textarea name="backto" cols="33" rows="2">{$data[1].backto}</textarea></td>
             <td ></td><td ><input type="text" name="pendingids" value="{$pendingids}"  /></td>
             </tr>
              <tr>
             <td ></td><td ></td><td ><input type="submit" name="updatenow3" value="UPDATE" class="btn" /></td>
             <td ></td>
             </tr>
             </table></form>
             </td>
             </tr>  
             {/if}
                </table>
                {/if}
            {if $post.st eq 'approved'}
                <table width="100%" border="0" >
                  <tr class="admintopheading" height="55">
                    <td align="center">S#</td>
                    <td align="center">Patient Name</td>
                    <td align="center">Apt. date</td>
                    <td align="center">Leg</td>
                    <td align="center">Pick Time</td>
                    <td align="center">Est. Drop Time</td>
                    <td align="center">Assign Driver</td>
                    
                  </tr>
                  <form name="updatenow" id="updatenow" action="updatenow2.php" method="post" >
                  {section name=q loop=$data}
           <tr valign="top" id="tr{$data[q].id}">
           <td align="left"><b>{$smarty.section.q.iteration}</b></td>
           <td align="left"><b>{$data[q].trip_user}<input type="hidden" name="tdid[]" value="{$data[q].tdid}"  /></b></td>
           <td align="center"><input type="text" name="date[]" value="{$data[q].date|date_format:"%m/%d/%Y"}" size="12" /></td>
           <td align="left">{if $data[q].type eq 'AB'}First{elseif $data[q].type eq 'BC' || $data[q].type eq 'BF'}Second{elseif $data[q].type eq 'CD' || $data[q].type eq 'CF'}Third{elseif $data[q].type eq 'DE' || $data[q].type eq 'DF'}Forth{elseif $data[q].type eq 'EF'}Fifth{/if} Leg</td>
              <td align="center"><input type="text" name="pck_time[]" value="{$data[q].pck_time}"  size="10" /></td>
              <td align="center"><input type="text" name="drp_time[]" value="{$data[q].drp_time}" size="10"/></td>
              <td align="center"><select name="drv_id[]" class="drv_id" style="width:auto;" onchange="checkdrv('{$smarty.section.q.iteration}',this.value)" > 
              <option value="">--Select--</option>
{section name=r loop=$drivers}
<option value="{$drivers[r].drv_code}" {if $drivers[r].drv_code eq $data[q].drv_id}selected{/if}>{$drivers[r].fname}-{$drivers[r].lname}</option>
{/section}
               </select></td>
            </tr>
                  {sectionelse}
            <tr> <td colspan="7" align="center" class="labeltxt"><b>No Record Found</b></td> </tr>
                  {/section}
                  {if $data neq ''}
                  <tr>
                    <td colspan="7" ><input type="submit" name="updatenow" value=" Update ..." class="btn" /></td>
             </tr>    {/if}
             </form>
               </table>
                {/if}    
              </div></td>
          </tr>
          
        </table></td>
    </tr>
  </table>

{ include file = innerfooter.tpl}

