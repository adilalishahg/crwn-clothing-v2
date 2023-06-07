{include file="headernew.tpl"}
{*include file="slider.tpl"*}
{*include file="services_homepage.tpl"*}
<meta http-equiv="refresh" content="500">

{literal} 
<script type="text/javascript">
function deleteRec(id,st)
		{ //alert(st);
		var ok;
		ok=confirm("Are you sure you want to cancel this trip?");
		if (ok)
		{		
			location.href="mytrips.php?delId="+id;
			return true;
			//document.delrecfrm.submit();
		}
		else
		{
			return false;
		}
	}
function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 1000, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 650, width = 1000, scrollbars=1, resizable = 1" );
   myWindow1.moveTo(40,50);
   myWindow1.focus();
   }
	
	</script> 
{/literal}
  <!-- START SECTION 2 -->
 <div class="submain" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Dispatch Report</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="dispatch_report.php">
     {if $errors neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$errors}</div></div>{/if}
     {if $messages neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$messages}</div></div>{/if}
                <div class="row">
						<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">From</span>
								<input type="text" name="stdate" class="form-control enddate" value="{$stdate}" placeholder="Start Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">To</span>
								<input type="text" name="enddate" class="form-control enddate" value="{$enddate}" placeholder="End Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Status</span>
                                <select name="reqstatus" id="reqstatus" class="form-control">
                                <option value="" > All </option>
                                <option value="5" {if $reqstatus eq '5'} selected="selected"{/if} >Pending</option>
                                <option value="10" {if $reqstatus eq '10'} selected="selected"{/if} >Driver Arrived</option>
                                <option value="6" {if $reqstatus eq '6'} selected="selected"{/if} >Picked Up</option>
                                <option value="4" {if $reqstatus eq '4'} selected="selected"{/if} >Completed</option>
                                <option value="3" {if $reqstatus eq '3'} selected="selected"{/if} >Cancelled</option>
                                <option value="7" {if $reqstatus eq '7'} selected="selected"{/if} >Billable No-Show</option>
                                <option value="8" {if $reqstatus eq '8'} selected="selected"{/if} >non-Billable No-Show</option>
                                
                               <!-- <option value="3" {if $reqstatus eq '3'} selected="selected"{/if} >Cancelled</option>-->
                                </select>
														
							</div>
						</div>
						<!--<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Region</span>
							<input type="text" name="password" class="form-control" placeholder="Enter Region" required="required">
							</div>
						</div>-->
					</div>
                      <div class="row">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Show Report</button>
                        </div>
                   </div>
                </form> 
            </div>
             </div>
         <div class="w-col-12">
         <table width="100%" border="0" class="table">
  <thead>
    <th>Patient Name</th>
    <th>Date/Pick Time</th>
    <th>Pick Address</th>
    <th>Drop Address</th>
    <!--<th>Phone #</th>-->
    <!--<th>Case Manager</th>-->
    <th>Status</th>
    <th>Detail</th>
  </thead>
  {section name=q loop=$Requests}
  <tr>
    <td>{$Requests[q].clientname}</td>
    <td>{$Requests[q].date|date_format}<br/>{$Requests[q].pck_time|date_format:"%H:%M:%S"}</td>
    <td>{$Requests[q].pck_add}</td>
    <td>{$Requests[q].drp_add}</td>
    <!--<td>{$Requests[q].phnum}</td>-->
    <!--<td>{$Requests[q].casemanager_name}</td>-->
    <td>
      			{if $Requests[q].status=='5'}Pending{/if}
                {if $Requests[q].status=='1'}Completed{/if}
                {if $Requests[q].status=='10'}Driver Arrived{/if}
                {if $Requests[q].status=='3'}Cancelled{/if}
                {if $Requests[q].status=='4'}Completed{/if}
                {if $Requests[q].status=='6'}Picked Up{/if}
                {if $Requests[q].status=='7'}Billable No-Show{/if}
                {if $Requests[q].status=='8'}non-Billable No-Show{/if}
                {if $Requests[q].status=='9'}Pending{/if}
    
    </td>
    
    <td><a  href="javascript:popWind2('details.php?id={$Requests[q].tdid}');" title="View">&nbsp;&nbsp;<i class="fa fa-file-alt" style="color:#0059b7;  font-size:24px;"></i></a>&nbsp;
    <!--{if $Requests[q].editable eq 'Yes'}<a href="edittriprequest.php?id={$Requests[q].id}" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>
    {else}<a href="#" onclick="alert('Unable to make changes inside of 48 hours, please call our dispatch line to have these changes approved {$contactinfo.phone}')" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>{/if}
     {if $Requests[q].reqstatus eq 'active' || $Requests[q].reqstatus eq 'approved'}
     	{if $Requests[q].cancellable eq 'Yes'}
<a href="#"  onclick="return deleteRec('{$Requests[q].id}');"  title="Cancel" style="color:red;font-weight:bold;font-size:16px;"> X</a> {/if}
{/if}-->
</td>
  </tr>
  {sectionelse}
  <tr>
    <td colspan="7" style=" text-align:center;">&nbsp;No record found!.</td>
    
  </tr>
  {/section}
  <tr>
    <td colspan="7" style=" text-align:center;">{$pages}</td> 
  </tr>
</table>

         </div> 

      </div>
      </div>
      </div>
      </div>
   <!-- END SECTION 2 -->

{*include file="flipserviceshomepage.tpl"*}
{include file="footerlast.tpl"}
<script src="js/inputmasking.js"></script>
<script src="js/triprequest.js"></script>