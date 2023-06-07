{include file="headernew.tpl"}
<div class="submain">
<div class="container">

        <!-- Marketing Icons Section -->
        <div class="row"  style="min-height:600px;">
           <!--{include file="alert.tpl"}-->
            <div class="col-lg-12" style="text-align:center;">
            <div id="content" class="wrapper"  style="text-align:center;">
            
          {if $smarty.session.allowUser eq '1' } 
           <div class="fullWidthBucket">
            <!--<h1 class="main-head">Welcome {if $smarty.session.type eq 'ac' }Healthcare Partners{else}Healthcare Partners{/if}</h1>-->
            <div class="login-page-main">
            <a href="triprequest.php">
            <div class="col-md-3">
            <div class="panel panel-default text-center">
            <i class="fa fa-ambulance" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head">New Trip Request</h4>
            </div>
            </div>
            </a>
            </div>

             <div class="login-page-main">
             <a href="grid.php">
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-file-alt" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head">Today Trip</h4>
            </div>
            </div>
          </div>
          </a>
          </div>

          <div class="login-page-mian">
          <a href="mytrips.php"> 
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-user-plus" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head">Trip Reports</h4>
            </div>
            </div>
          </div> </a>
          </div>
         
          </div>
          {else}
	      <div class="fullWidthBucket-main">
            <h1 class="main-head-transfer">Welcome to {$contactinfo.title}</h1>  
            <div class="col-md-4"></div>
            <!--<div class="login-page-main">
             <a href="triprequest.php">
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-edit" aria-hidden="true"  style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head-login">REQUEST A TRIP<br/>&nbsp;</h4>
            </div>
            </div>
          </div>
             </a>       
          </div>-->
          
          
             <div class="login-page-main">
             <a href="login.php">
            <div class="col-md-4">
             <div class="panel panel-default text-center">
            <i class="fa fa-hospital" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head-login">ACCOUNT LOGIN</h4>
            </div>
            </div>
          </div>
          </a>
          </div>
          
          
          <!--<div class="login-page-main">
          <a href="login.php">
            <div class="col-md-3">
             <div class="panel panel-default text-center">
            <i class="fa fa-user" aria-hidden="true" style="font-size:114px; color:#fff; padding-top: 20px;"></i>
            <div class="panel-body">
            <h4 class="ser-head-login">CUSTOMER LOGIN</h4>
            </div>
            </div>
          </div>
          </a>
          
          
          </div>-->
          </div>
      {/if}    
                </div>
    </div>
            </div>
        </div>

</div>

{include file="footerlast.tpl"}