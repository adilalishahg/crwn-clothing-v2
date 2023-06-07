<tr> <td colspan="6"> <table width="950"> </table> </td></tr>
  <tr style="padding-top:10px;">
    <td width="280" height="100" style="background:url(<?php echo MYSURL; ?>images/logo.jpg); background-repeat:no-repeat"></td>
    <td class="adminwelcome" >Welcome to Vonage Administrator Panel </td>
  </tr>
  <tr><!--class="adminame"-->
    <td colspan="0" class="adminwelcome">Welcome <?php echo $_SESSION['admin_name']."!"?></td>
    <td width="600" align="right" colspan="4" class="changPass">
		<a  href="change_pass.php">[Change Password]</a>
		<a href="logout.php">[Logout]</a>
	</td>
  </tr>
  <tr>
    <td colspan="17">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="17">
		<?php include("include/menu.php");?>
	</td>
  </tr>
  