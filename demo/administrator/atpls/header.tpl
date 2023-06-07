<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">
<head>
<meta MMTp-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Admin Panel.::.</title>
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />
<link href="../theme/styles.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="../js/wysiwyg.js"></script>
<script type="text/javascript" src="../js/chrome.js"></script>
<script language="javascript" src="../js/style.script.js"></script>
<script type="text/javascript" src="../js/jdiv.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/bar.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/pie.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/ui.datepicker.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.alerts.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.ui.draggable.js"></script>


<body>
<div style=" float:left; width:100%" align="center">
<div style="width:1004">
<table>
  <tr style="padding-top:10px;">
    <td height="100" colspan="2">
		{if $smarty.session.id >0}
		<div id="header"><img src="images/admpanel.gif" /></div>
	{else}	
    	<div id="header"><img src="images/login.gif" /></div>
    {/if}
	</td>
  </tr>
  <tr><!--class="adminame"-->
    <td width="280" colspan="0" class="adminwelcome">Welcome <?php echo $_SESSION['admin_name']."!"?></td>
    <td width="600" align="right" colspan="4" class="changPass">
		<a  href="change_pass.php">[Change Password]</a>
		<a href="logout.php">[Logout]</a>	</td>
  </tr>
  <tr>
    <td colspan="17">&nbsp;</td>
  </tr>
  <tr >
    <td colspan="17">
     {include file=menu.tpl}	</td>
  </tr>
 </table> 
