{include file="headernew.tpl"}
{*include file="slider.tpl"*}
{*include file="services_homepage.tpl"*}
<meta http-equiv="refresh" content="300">
  <!-- START SECTION 2 -->
 <div class="submain" id="home-stats" data-stellar-background-ratio="0.4">
		<div class="container">
			<div class="row" style="min-height:400px">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
    
        <h1>Export Trips Sheet</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="mytrips2.php"  autocomplete="off">
     {if $errors neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$errors}</div></div>{/if}
     {if $messages neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$messages}</div></div>{/if}
                <div class="row">
						<div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">From</span>
								<input type="text" name="stdate" class="form-control enddate" value="{$stdate}" placeholder="Start Date" required="required" >								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:20px;">
							<div class="input-group">
								<span class="input-group-addon">To</span>
								<input type="text" name="enddate" class="form-control enddate" value="{$enddate}" placeholder="End Date" required="required">								
							</div>
						</div>
                        <div class="col-sm-3" style="margin-top:2px;">
							<div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Export Report</button>
                        </div>
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
						
					</div>
                      <div class="row">     
                        <div class="form-group" style="margin-top:20px; margin-left:14px;">
                           {if $filename neq ''} <a href="{$filename}" >Click Here to Download Trip Sheet</a>{/if}
                        </div>
                   </div>
                   
                  
                </form> 
            </div>
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