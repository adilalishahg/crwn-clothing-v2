{ include file = headerinner.tpl}
{literal}
<script type="text/javascript">

function deleteRec(id)
		{ var ok;
		ok=confirm("Are you sure you want to delete this record");
		if (ok)
		{ $.post("../requests/delete.php", {id: id}, function(data)
			{ });
			$('#tr'+id).hide();
			//location.reload();
			 //location.href="reqdetails.php?delId="+id;
		return true;}else{			
			return false;}
}

function disapprove(id,reqid)
		{
		//alert(reqid);
		var ok;
		ok=confirm("Are you sure you want to Disapprove this request. \n Refresh this page to affect changes!");
		if (ok)
		{ 
		$.post("disapprove.php", {tripid: ""+id, req_id: ""+reqid }, function(data){  }); 
		//location.href="reqdetails.php?delId="+id; 
		
		return true;}else{			
			return false;}
	}
function stchange(st,qrstr)
{
  if (qrstr != ''){		
 	location.href="reqdetails.php?st="+st+qrstr;
	return true;}else{
			return false;
		}			
	}	
function ChangeStatus(val,st){
var ans= 1;
if(st == '3'){
     jPrompt('Specify the reason for disapproving:', '', 'Medical Transportation', function(r) {
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
    jPrompt('Specify the reason for disapproving:', '', 'Medical Transportation', function(r) {
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
<table  border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" class="outer_table">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">                    
                            <tr>
                 <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
                             <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="index.php">Back</a>]</div>							  </td>
        </tr>							
                           <tr>
<td height="19" align="left" class="admintopheading">Requests:
  <!--<select name="st" id="st" onchange="return stchange(this.value,{$req});">-->
  <select name="st" id="st" onchange="return stchange(this.value,'{$qrstr}');">
  <option value="">--Select--</option>
  <option value="active" {if $st eq 'active'}selected{/if}>Pending</option>
  <option value="approved" {if $st eq 'approved'}selected{/if}>Locked</option>
  <option value="disapproved" {if $st eq 'disapproved'}selected{/if}>Disapproved</option>
</select></td>
                           <td align="center" class="admintopheading">REQUESTS DETAIL </td>
                            </tr>
                            <tr>
                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								
							  <table width="100%" border="0" class="main_table">
                  <tr class="admintopheading" height="55">
                    <td align="center"><strong>Patient Name.</strong></td>
                    <td align="center"><strong>Appointment date/time </strong></td>
                    <td align="center"><strong>Pick Address</strong></td>
                    <td align="center"><strong>Destination</strong></td>
                    <td align="center"><strong>Patient Phone</strong></td>
                    <td align="center"><strong>Options</strong></td>
				<!--	{if $reqdetails[0].reqstatus eq 'approved'}
					   <td align="center"><strong>Invoice & Trans.</strong></td>
					{/if}-->
					<td align="center"><strong>Edit</strong></td>
                  </tr>
                {section name=q loop=$reqdetails}
				  <tr valign="top" id="tr{$reqdetails[q].id}">
                    <td align="left"><b>{$reqdetails[q].clientname}{if $reqdetails[q].modiv_id neq ''}<img style="margin-top: -11px;" border="0" width="60" height="30" title="ModivCare" alt="ModivCare" src="../graphics/modiv30.svg" />{/if}</b></td>
                    <td align="center">{$reqdetails[q].appdate|date_format} / {$reqdetails[q].apptime}</td>
                    <td align="center">{$reqdetails[q].pickaddr}</td>
                    <td align="center">{$reqdetails[q].destination}</td>
                    <td align="center">{$reqdetails[q].phnum}</td>
                    <td align="center">
<a href="javascript:popWind('reqpreview.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].reqid}&st={$st}');">Details</a>&nbsp;
<!-- <a href="javascript:popWind2('medical_invoice.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].req_id}')" ><span style="color:#F00;">Invoice</span></a><br/>-->{if $reqdetails[q].transportation_log neq ''}<a href="view_log.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].reqid}" rel="facebox" ><span style="color:#F00; font-size:9px;">Trans.<br/> Log</span> </a>{/if}
				{if $reqdetails[q].modiv_id eq ''}
				<a href="#" onclick="deleteRec('{$reqdetails[q].id}')" ><img border="0" title="Delete" alt="Delete" src="../images/icons/cross.png"></a>{/if}
                {if $reqdetails[q].reqstatus eq 'active'}
					<a href="javascript:ChangeStatus('{$reqdetails[q].id}','2');">
					<img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg">					</a>
                    <a href="javascript:ChangeStatus('{$reqdetails[q].id}','3');">
					<img border="0" title="Disapprove" alt="Disapprove" src="../graphics/disable.jpg">					</a>									
				   {elseif $reqdetails[q].reqstatus eq 'disapproved'}	
					<a href="javascript:ChangeStatus('{$reqdetails[q].id}','2');">
					<img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg">					</a>									
			     {/if}			</td>
                  <td>
                  {if $reqdetails[q].modiv_id eq ''}
                  <a href="#" onclick="window.open('../routingpanel/edit2.php?id={$reqdetails[q].id}')">Edit</a>{/if}                  
                  <!--<br/>{if $reqdetails[q].reqstatus eq 'approved'}<a href="#" onclick="disapprove('{$reqdetails[q].id}','{$reqdetails[q].reqid}')" >DisApp</a>{/if}--></td>
 				 </tr>
				{sectionelse}
				 <tr>
				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>
				 </tr> 
				 {/section} 
                </table>				
               			
                </td>
            </tr>
			<tr>
			   <td colspan="2" align="center">{$paging}</td>
			</tr>			
      </table>
    </td>
  </tr>
</table>		 

{ include file = innerfooter.tpl}