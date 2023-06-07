{ include file = headerinner.tpl}
{literal} 
<script type="text/javascript">

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
function typechange(val)
{ var page = $('#page').val();
  var st   = $('#st').val();
  var req  = $('#req').val();
  if (val != ''){		
 	location.href="reqdetails.php?st="+st+"&req="+req+"&Page="+page+'&type='+val;
	return true;}else{
			return false;
		}			
	}		
function ChangeStatus(val,st){
	 var ok;
		ok=confirm("Are you sure you want to Disapproved this Trip");
		if (ok)
		{
 $.post("hosprequests.php", {id: ""+val, ustatus:""+'disapproved'}, function(data){
  if(data.length > 0) {   
        	
          if(data == 'Success'){
           removeTr(val); return false;
          }else{
            removeTr(val); return false;
          }	
		}
		return false;	
      });}
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
</script> 
{/literal}
<div style="width:78%;  float:left;"></div>
  <table class="outer_table" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
              
              { if $errors != ''} {$errors} {/if}</span></td>
          </tr>
          <tr>
            <td height="19" colspan="2" align="center"><div align="left" style="float:left; color:#F00; font-weight:bold;" >Note: If you are approving past date trips, please update driver and times of particular trip in dispatch report section.</div><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>
          </tr>
          <tr>
            <td height="19" colspan="2" align="left" class="admintopheading">Requests:
              <select name="st" id="st" onchange="return stchange(this.value,{$req});">
                <option value="">--Select--</option>
                <option value="active" {if $st eq 'active'}selected{/if}>Pending</option>
                <option value="approved" {if $st eq 'approved'}selected{/if}>Locked</option>
                <option value="disapproved" {if $st eq 'disapproved'}selected{/if}>Disapproved</option>
              </select><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;REQUESTS DETAIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By Appt. Type:
              <select name="type" class="required txt_boxX" id="type" onchange="return typechange(this.value);">
                      <option value="">Select</option>
                      			  {section name=q loop=$appdata}	
                 <option value="{$appdata[q].type}" {if $appdata[q].type eq '$type'} selected="selected" {/if}>{$appdata[q].type}</option>
                      {/section}
                    </select>--><input type="hidden" value="{$Page}" id="page" /><input type="hidden" name="req" id="req" value="{$req}"  /></td>
            
          </tr>
          <tr>
            <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><div style="border: #F00 0px solid; float:left;"></div>
                <table width="100%" border="0" class="">
                  <tr class="admintopheading" height="55">
                    <td align="center"><strong>Patient Name</strong></td>
                    <td align="center"><strong>Appointment date/time </strong></td>
                    <td align="center"><strong>Pick Address</strong></td>
                    <td align="center"><strong>Destination</strong></td>
                    <td align="center"><strong>Patient Phone</strong></td>
                    <td align="center"><strong>Options</strong></td>
                    {if $reqdetails[0].reqstatus eq 'approved'}
                    <td align="center"><strong>HIC Form</strong></td>
                    {/if}
                    <td align="center"><strong>Edit</strong></td>
                  </tr>
                  {section name=q loop=$reqdetails}
                  <tr valign="top" id="tr{$reqdetails[q].id}">
                    <td align="left"><b>{$reqdetails[q].clientname}</b></td>
                    <td align="center">{$reqdetails[q].appdate|date_format} / {$reqdetails[q].org_apptime}</td>
                    {* <td align="center">{$reqdetails[q].appdate|date_format} / {$reqdetails[q].org_apptime|date_format:"%I:%M %p"}</td> *}
                    <td align="center">{$reqdetails[q].pickaddr}</td>
                    <td align="center">{$reqdetails[q].destination}</td>
                    <td align="center">{$reqdetails[q].phnum}</td>
                    <td align="center"><a href="javascript:popWind('../../reqpreview.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].reqid}');">Details</a>&nbsp;
                      
                      {if $reqdetails[q].reqstatus eq 'active'} 
                      
                      <!--<a href="javascript:ChangeStatus('{$reqdetails[q].id}','2');">
					<img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg">
                    </a>--> 
                      <a rel="facebox" href="approve_request.php?id={$reqdetails[q].id}&rqid={$reqdetails[q].reqid}&appdate={$reqdetails[q].appdate}"> <img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg"> </a> <a href="javascript:ChangeStatus('{$reqdetails[q].id}','3');"> <img border="0" title="Disapprove" alt="Disapprove" src="../graphics/disable.jpg"> </a> {elseif $reqdetails[q].reqstatus eq 'disapproved'} <a href="javascript:ChangeStatus('{$reqdetails[q].id}','2');"> <img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg"> </a> {else} <img border="0" title="Locked" alt="Locked" src="../graphics/lock.jpg"> {/if} <a href="#" onclick="deleteRec('{$reqdetails[q].id}')" ><img border="0" title="Delete" alt="Delete" src="../images/icons/cross.png"></a></td>
                    {if $reqdetails[q].reqstatus eq 'approved'}
                    <td> {if $reqdetails[q].hic eq '1'} <a href="javascript:popWind('../reports/genreport.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].reqid}');">Yes</a>{else}No{/if}</td>
                    {/if}
                    <td><a href="#" onclick="window.open('../routingpanel/edit2.php?id={$reqdetails[q].id}')">Edit</a></td>
                  </tr>
                  {sectionelse}
                  <tr>
                    <td colspan="6" align="center" class="labeltxt"><b>No Record Found</b></td>
                  </tr>
                  {/section}
                </table>
              </td>
          </tr>
          <tr>
            <td colspan="2" align="center">{$paging}</td>
          </tr>
        </table></td>
    </tr>
  </table>

{ include file = innerfooter.tpl} 