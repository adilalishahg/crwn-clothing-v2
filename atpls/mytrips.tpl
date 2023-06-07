{include file="headernew.tpl"}
{*include file="slider.tpl"*}
{*include file="services_homepage.tpl"*}
<meta http-equiv="refresh" content="300">

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
	</script> 
{/literal}
  <!-- START SECTION 2 -->
 <div class="submain" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Trips Request Report</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="mytrips.php">
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
                                <option value="approved" {if $reqstatus eq 'approved'} selected="selected"{/if} >Approved</option>
                                <option value="disapproved" {if $reqstatus eq 'disapproved'} selected="selected"{/if} >Disapproved</option>
                                <option value="active" {if $reqstatus eq 'active'} selected="selected"{/if} >Pending</option>
                                <option value="inactive" {if $reqstatus eq 'inactive'} selected="selected"{/if} >Cancelled</option>
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
    <th>Appointment date/time</th>
    <th>Pick Address</th>
    <th>Drop Address</th>
    <th>Phone #</th>
    <!--<th>Case Manager</th>-->
    <th>Status</th>
    <th>Options</th>
  </thead>
  {section name=q loop=$Requests}
  <tr>
    <td>{$Requests[q].clientname}</td>
    <td>{$Requests[q].appdate|date_format} -- {$Requests[q].org_apptime}</td>
    {* <td>{$Requests[q].appdate|date_format} -- {$Requests[q].org_apptime|date_format:"%I:%M %p"}</td> *}
    <td>{$Requests[q].pickaddr}</td>
    <td>{$Requests[q].destination}</td>
    <td>{$Requests[q].phnum}</td>
    <!--<td>{$Requests[q].casemanager_name}</td>-->
    <td>
     {if $Requests[q].reqstatus eq 'approved'}Approved{/if}
     {if $Requests[q].reqstatus eq 'disapproved'}Disapproved{/if}
     {if $Requests[q].reqstatus eq 'active'}Pending{/if}
     {if $Requests[q].reqstatus eq 'inactive'}Cancelled{/if}
    
    </td>
    
    <td><a href="javascript:popWind('reqpreview.php?id={$Requests[q].id}');"><i class="fa fa-file-alt" style="color:#0059b7"></i></a>&nbsp;
    {if $Requests[q].editable eq 'Yes'}<a href="edittriprequest.php?id={$Requests[q].id}" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>
    {else}<a href="#" onclick="alert('Unable to make changes inside of 48 hours, please call our dispatch line to have these changes approved {$contactinfo.phone}')" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>{/if}
     {if $Requests[q].reqstatus eq 'active' || $Requests[q].reqstatus eq 'approved'}
     	{if $Requests[q].cancellable eq 'Yes'}
<a href="#"  onclick="return deleteRec('{$Requests[q].id}');"  title="Cancel" style="color:red;font-weight:bold;font-size:16px;"> X</a> {/if}
{/if}
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