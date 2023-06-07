{include file="headernew.tpl"} 
<!-- START SECTION 2 -->
<div class="submain" id="home-stats" data-stellar-background-ratio="0.4" style="min-height:500px">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="col-md-12 space-top">
          <h1>{if $smarty.session.type eq 'ac'}Corporate{/if}{if $smarty.session.type eq 'pa'} Customer{/if} {if $smarty.session.type eq 'cm'} Case Manager{/if} Setting</h1>
        </div>
        <div class="w-col-12">
          <div class="row contact-wrap">
            <div class="status alert alert-success" style="display: none"></div>
            <form id="form" class="form" name="contact-form" method="post" action="account_profile2.php">
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
                <div class="col-sm-5">
                  <hr/>
                </div>
               <!-- <div class="col-sm-2" style="text-align:center">Setting</div>-->
                <div class="col-sm-5">
                  <hr/>
                </div>
              </div>
              <div class="row" style="margin-top:10px;">
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
                
               <!-- <div class="col-sm-4">
                  <input type="radio" checked="checked"  /> <a href="terms.php" target="_blank" > I am agreeing to <strong>Terms &amp; Conditions</strong> </a>
                  
                </div>-->
                
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