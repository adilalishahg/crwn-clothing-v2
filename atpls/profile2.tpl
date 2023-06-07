{include file="header.tpl"}
  <!-- START SECTION 2 -->
 <div class="def-section-wel stats" id="home-stats" data-stellar-background-ratio="0.4" style="min-height:500px">
		<div class="container">
			<div class="row">
	<div class="col-md-12">
      <div class="col-md-12 space-top">
        <h1>Customer/Account/ Profile Setting</h1>
        </div>
        <div class="w-col-12">
            <div class="row contact-wrap"> 
                <div class="status alert alert-success" style="display: none"></div>
                <form id="form" class="form" name="contact-form" method="post" action="profile2.php">
     {if $errors neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$errors}</div></div>{/if}
     {if $messages neq ''}<div class="row" style="color:#F00;"><div class="col-sm-6" style="margin-top:20px;">{$messages}</div></div>{/if}
                <div class="row" style="margin-top:20px;">
						
                        <!--<div class="col-sm-4">
							<div class="input-group">
							<span class="input-group-addon">Customer/Corporate Name</span>
							<input type="text" name="name" class="form-control" placeholder="Enter Name" required="required" {if $smarty.session.allowUser eq '1'} value="{$data.account_name}" {else}value="{$data.name}"{/if}>
							</div>
						</div>-->
						<div class="col-sm-4">
							<div class="input-group">
							<span class="input-group-addon">Phone</span>
							<input type="text" name="phone" class="form-control" data-mask="(999) 999-9999" placeholder="Enter Phone" required="required"  value="{$data.phone}">
							</div>
						</div>
                        <div class="col-sm-4">
							<div class="input-group">
							<span class="input-group-addon">User Name</span>
							<input type="text" name="username" class="form-control" placeholder="Enter User Name" required="required"  value="{$data.username}">
							</div>
						</div>
                        <div class="col-sm-4">
							<div class="input-group">
							<span class="input-group-addon">Password</span>
							<input type="text" name="password" class="form-control" placeholder="Enter Password" required="required"  value="{$data.password}">
							</div>
						</div>
					</div>
                     
                  
                    
                      <div class="row">     
                       <div class="form-group" style="margin-top:20px; margin-left:14px;">
                            <button type="submit" name="submit" class="btn btn-primary btn-xlg" required="required">Update</button>
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
{include file="footer_last.tpl"}
