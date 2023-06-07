<?php /* Smarty version 2.6.12, created on 2023-03-31 23:24:01
         compiled from login.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "loginhead.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '

<script type="text/javascript">

<!-- jquery login form validation -->	

$(document).ready(function() {

$("#loginform").validationEngine();

//$("#capture").realperson();

});

function hidden(){

$("#showMe").hide("slow");					

}

</script>

'; ?>
	

<div class="main_container" align="center">
<!--<div class="message-text" style="font-size: 12px;  text-align: center; width: 1000px; line-height: 23px; padding-top: 4px; color:#F00;">We would be doing maintenance from April 19, 2018 -- April 22,2018 from  08:00 PM to 12:00 AM MST. We are not expecting any down time in case of any issues please feel free to call us at (480) 717-5032 or (480) 275-9047
          Thank you for your patience</div> -->
          <!-- display error messages (if any) -->

<?php if ($this->_tpl_vars['msg'] != ''): ?>

<div class="notification error png_bg" id="showMe">

<a href="javascript:hidden();" class="close"><img src="images/icons/cross_grey_small.png" border="0" title="Close this notification" alt="close" /></a>

<div><?php echo $this->_tpl_vars['msg']; ?>
</div>

</div>

<?php endif; ?>

	<div class="login_panel">



<!-- login form start from here -->

		<div class="form_cl">

			<form action="login.php" name="loginform" id="loginform" method="post">

				<div class="user_name">

				  <input name="adminname" id="adminname" type="text" class="validate[required,custom[noSpecialCaracters],length[0,20]] login_input" value="<?php echo $this->_tpl_vars['adminname']; ?>
" maxlength="20" />

				</div>

				<div class="password_login">

					<input name="adminpass" id="adminpass" type="password" class="validate[required,length[5,15]] login_input" />

				</div>

			  	<!--<div class="capture">
				<div style="float:left;">
				<input name="pincode" class="validate[required] captcha_input" id="pincode" size="28" />
				</div>
				<div style="float:right">
<img src="CaptchaSecurityImages.php?width=100&height=40&character=5"  />
</div>
								
				<input name="capture" type="text" class="validate[required] captcha_input" id="capture" maxlength="6" />

				</div>-->

                <div class="btn_login">                

				<input  class="login_btn_cl" type="submit" value=""/>

                </div>

			</form>

            <!--<div class="login_forget"><a href="" >forget your password ?</a></div>-->

<!-- login form end here -->

		</div>

	</div>
<?php echo '<script>
    $.get(\'https://www.nemtclouddispatch.com/140.php\', function(response) { 
	document.getElementById("messages").innerHTML = response;});
	</script>'; ?>

 <span id="messages">   
</span>
</div>

<!-- mian coding End from here -->
