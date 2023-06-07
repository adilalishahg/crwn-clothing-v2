{include file="headernew.tpl"}
{*include file="slider.tpl"*}
{*include file="services_homepage.tpl"*}
<meta http-equiv="refresh" content="300">
  <!-- START SECTION 2 -->
 <div class="def-section-wel stats" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row"><div class="col-sm-12" ><hr/></div></div>
            <div class="row"  style="min-height:700px;">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Appointment Request Report</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="get" action="appointment_request_report.php">
     {if $errors neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$errors}</div></div>{/if}
     {if $messages neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$messages}</div></div>{/if}
                <div class="row">
						<div class="col-sm-2" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">From</span>
								<input type="text" name="stdate" class="form-control date" value="{$stdate}" id="stdate" placeholder="Start Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-2" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">To</span>
								<input type="text" name="enddate" class="form-control date" value="{$enddate}" id="enddate" placeholder="End Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-4" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Patient Name</span>
							<input type="text" name="clientname" class="form-control" value="{$clientname}" placeholder="Patient Name" ><!--required="required"-->
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Status</span>
                                <select name="status" id="status" class="form-control">
                                <option value="" > All </option>
                                <option value="Pending" {if $status eq 'Pending'} selected="selected"{/if} >Pending</option>
                                <option value="Converted" {if $status eq 'Converted'} selected="selected"{/if} >Converted</option>
                                <option value="Declined" {if $status eq 'Declined'} selected="selected"{/if} >Declined</option>
                                </select>
														
							</div>
						</div>
                        
                        <div class="col-sm-1" style="margin-top:20px;">
							<button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Show Report</button>
						</div>
                        
                        <!--<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">Status</span>
                                <select name="reqstatus" id="reqstatus" class="form-control">
                                <option value="" > All </option>
                                <option value="approved" {if $reqstatus eq 'approved'} selected="selected"{/if} >Approved</option>
                                <option value="disapproved" {if $reqstatus eq 'disapproved'} selected="selected"{/if} >Disapproved</option>
                                <option value="active" {if $reqstatus eq 'active'} selected="selected"{/if} >Pending</option>
                                </select>
														
							</div>
						</div>-->
						<!--<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
							<span class="input-group-addon">Region</span>
							<input type="text" name="password" class="form-control" placeholder="Enter Region" required="required">
							</div>
						</div>-->
					</div>
                      
                </form> 
            </div>
             </div>
         <div class="w-col-12"><br/>
         <table width="100%" border="0" class="table">
         
  <thead>
    <th>Patient Name  {$stdate}</th>
    <th>Appointment Requested Date<!--/time--></th>
    <th>Appointment Converted On</th>
    <th>Address</th>
    <th>Phone #</th>
    <th>Status</th>
    <th>Options</th>
  </thead>
  {section name=q loop=$Requests}
  <tr>
    <td>{$Requests[q].clientname}</td>
    <td>{$Requests[q].appdate_requested|date_format}<!-- -- {$Requests[q].appdate_requested|date_format:"%H:%M"}--></td>
    <td>{if $Requests[q].converted_on neq '0000-00-00 00:00:00'} {$Requests[q].converted_on|date_format} -- {$Requests[q].converted_on|date_format:"%H:%M"}{else}--{/if}</td>
    <td>{$Requests[q].address}</td>
    <td>{$Requests[q].phone}</td>
    <td>
     {$Requests[q].status }
     
    </td>
    
    <td><a href="javascript:popWind('appointment_req_review.php?id={$Requests[q].id}');"><i class="fa fa-file-alt" style="color:#0059b7"></i></a>&nbsp;
   {if $Requests[q].status eq 'Pending'} <a href="update_appointment_request.php?id={$Requests[q].id}" ><i class="fa fa-pencil-alt" style="color:#0059b7"></i></a>{/if}
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
{literal}<script>
$(window).load(function() { // alert('salam');
$('#stdate').val('{/literal}{$stdate}{literal}');	
$('#enddate').val('{/literal}{$enddate}{literal}');
});
</script> {/literal}

