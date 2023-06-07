{include file="headernew.tpl"} 
<!-- START SECTION 2 -->
<div class="submain" id="home-stats" data-stellar-background-ratio="0.4" style="min-height:500px">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12 space-top">
          <h1>{if $smarty.session.type eq 'ac'}Account{/if}{if $smarty.session.type eq 'pa'} Customer{/if}{if $smarty.session.type eq 'cm'} Case Manager{/if} Information</h1>
        </div>
        <div class="w-col-12">
          <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="form" class="form" name="contact-form" method="post" action="account_profile.php">
              {if $errors neq ''}
              <div class="row" style="color:#F00;">
                <div class="col-sm-6" style="margin-top:20px;">{$errors}</div>
              </div>
              {/if}
              {if $messages neq ''}
              <div class="row" style="color:#F00;">
                <div class="col-sm-6" style="margin-top:20px;">{$messages}</div>
              </div>
              {/if}
              <div class="row" style="margin-top:10px;">
                <div class="col-sm-12">
                  <hr/>
                </div>
                
              </div>
              
              {if $smarty.session.type eq 'ac'}
              <div class="row" style="margin-top:0px;">
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Account Name</span>
                    <input type="text" name="account_name" class="form-control" placeholder="Account Name" required="required"  value="{$data.account_name}" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Address</span>
                    <input type="text" name="address" class="form-control" placeholder="Enter Address" required="required"  value="{$data.address}" >
                  </div>
                </div>
                <!--<div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Address 2</span>
                    <input type="text" name="address2" class="form-control" placeholder="Enter Address2"  value="{$data.address2}" >
                  </div>
                </div>-->
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">City &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="city" class="form-control" placeholder="Enter City" required="required"  value="{$data.city}" >
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top:10px;">
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">State&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <select name="state" id="state" class="form-control" required="required" >
                      <option value="" >Select</option>
                      
			   {section name=n loop=$states}
             
                      <option value="{$states[n].abbr}" {if $states[n].abbr eq $data.state}selected{/if}> {$states[n].statename} </option>
                      
			   {/section}
                    
                    </select>
                  </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Zip Code</span>
                    <input type="text" name="zip" class="form-control" placeholder="Enter Zip Code" required="required"  value="{$data.zip}" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="phone" class="form-control" placeholder="Enter phone" required="required"  value="{$data.phone}">
                  </div>
                </div>
                
              </div>
              {/if}
             
             
              
              
              <div class="row" style="margin-top:10px;">
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="email" class="form-control" placeholder="Enter Email" required="required"  value="{$data.email}" >
                  </div>
                </div>
                <!--<div class="col-sm-4">
                  <input type="radio" checked="checked"  /> <a href="terms.php" target="_blank" > I am agreeing to <strong>Terms &amp; Conditions</strong> </a>
                  
                </div>-->
                
                
                
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">User Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" name="username" class="form-control" placeholder="Enter User Name" required="required"  value="{$data.username}">
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="input-group"> <span class="input-group-addon">Password</span>
                    <input type="password" name="password" class="form-control" placeholder="Enter Password" required="required"  value="{$data.password}">
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
{include file="footerlast.tpl"} 
<script src="js/inputmasking.js"></script>