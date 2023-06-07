{include file="headernew.tpl"}



<div class="submain"  style="min-height:400px;">
	<div class="wrap">
      <h1>Account Login </h1><hr/>  
      <div class="group">
         <form method="post" action="login.php"  autocomplete="off">
            <div class="container">
               <label for="uname"><b>Username</b></label>
               <input type="text" placeholder="Enter Username" name="username" required>

               <label for="psw"><b>Password</b></label>
               <input type="password" placeholder="Enter Password" name="password" required>

               <button type="submit" name="submit"  class="btn btn-primary btn-md" >Login</button>
               <input type="hidden" name="token_sent" value="{$token}" />
            </div>
         </form>
         <div class="top-space-error">
            {if $errors neq ''}<div class="red-line"><span style="color:#F00; font-weight:bold;">{$errors}</span></div>{/if}
            {if $messages neq ''}<div class="red-line"><span style="color:#F00; font-weight:bold;">{$messages}</span></div>{/if}
         </div>    
      </div> 
      <div class="group">
         <div class="container" style="margin-top: 20px;">
         Click here to request for an account. <a href="signup.php">Sign Up</a>
         </div>
      </div>  
   </div>
</div>
            
{include file="footerlast.tpl"}