<?php /* Smarty version 2.6.12, created on 2023-03-31 23:25:23
         compiled from mainhead.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['pgTitle']; ?>
</title>
<link rel="stylesheet" href="theme/style.css" type="text/css">
<link rel="stylesheet" href="theme/chat.css" type="text/css">
<link rel="stylesheet" type="text/css" href="theme/chromestyle.css" />
<link href="theme/styles.css" rel="stylesheet" type="text/css">
<link href="facebox/facebox.css" rel="stylesheet" type="text/css">
<link href="theme/validationEngine.jquery.css" rel="stylesheet" type="text/css" media="screen" title="no title" charset="utf-8" />
<script language="javascript" type="text/javascript" src="scripts/jquery-1.2.6.js"></script>
<script type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="js/chrome.js"></script>
<!----><script language="javascript" type="text/javascript" src="facebox/facebox.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery.tablednd_0_5.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery.validationEngine-en.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery.validationEngine.js"></script>
<script language="javascript" type="text/javascript" src="scripts/jquery.maskedinput-1.2.2.js"></script>
<script type="text/javascript" src="scripts/chat.js"></script>
<?php echo '
<script>
$(document).ready(function() {
	$("#adminprof").validate();
    $("#addveh").validate();	
	$("#editveh").validate();	
	});			
</script>
<script type="text/javascript"> 
$(document).ready(function()
{
	//slides the element with class "menu_body" when paragraph with class "menu_head" is clicked 
	$("#sefirstpane p.menu_head").click(function()
    {
$(this).css({backgroundImage:"url(images/icons/down.png)"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
       	$(this).siblings().css({backgroundImage:"url(left.png)"});
	});
	//slides the element with class "menu_body" when mouse is over the paragraph
	$("#firstpane p.menu_head").click(function()
    {
   $(this).css({backgroundImage:"url(images/icons/down.png)"}).next("div.menu_body").slideDown(500).siblings("div.menu_body").slideUp("slow");
         $(this).siblings().css({backgroundImage:"url(images/icons/left.png)"});
	});
});
</script>
<!-- Dashboard class is defined -->
<script type="text/javascript"> 
$(document).ready(function() {
	$("ul.gallery li").hover(function() { //On hover...
		var thumbOver = $(this).find("img").attr("src"); //Get image url and assign it to \'thumbOver\'
		//Set a background image(thumbOver) on the &lt;a&gt; tag 
		$(this).find("a.thumb").css({\'background\' : \'url(\' + thumbOver + \') no-repeat center bottom\'});
		//Fade the image to 0 
		$(this).find("span").stop().fadeTo(\'normal\', 0 , function() {
			$(this).hide() //Hide the image after fade
		}); 
	} , function() { //on hover out...
		//Fade the image to 1 
		$(this).find("span").stop().fadeTo(\'normal\', 1).show();
	});
});
</script>
'; ?>

</head>
<body>
<div id="wrapper_outer">
	<!-- start of inter container -->
    <div id="wrapper_inner">
        <!-- start of top banner -->
        <div id="banner">        	        	
<div class="banner_menu float_right">
            	<ul>
                	<li><a href="index.php">Home</a></li> <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>
                    <li><a href="admin_profile.php">Admin Info</a></li><?php endif; ?>
                    <li class="last"><a href="logout.php">Logout</a></li>
                </ul>
            </div>
            <!-- start of logo-->
            <div class="logo float_left">
            	<img src="images/logo.png" style="max-height:70px; max-width:200px;" alt="" />
            </div><!-- end of logo-->
<div class="message-text" style="font-size: 12px; text-align: center; width: 1000px; line-height: 23px; padding-top: 4px; color:#F00;">
            <?php echo $_SESSION['driver_quota_message']; ?>

            </div>
                 </div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "mainmenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="content_wrapper">
<!-- start of left side bar -->
            <div class="left_side_bar">
                <div class="left_side_link">
                <h1>Admin Menu</h1>
                    <div id="firstpane" class="menu_list">
                    
      <!--  <p class="menu_head">CMS</p>
      	<div class="menu_body"> 
      	<a href="cms/">Manage Contents</a>
        <a href="services/">Manage Services</a>
		<a href="gallery/">Our Gallery</a>
        <a href="faqs/">Manage FAQs</a> 
      	 </div> -->           
        <p class="menu_head">Accounts</p>
      	<div class="menu_body"> 
      	<a href="accounts/">Manage Accounts</a> 
      	<a href="accounts/add.php">Add New Account</a> </div>
        <p class="menu_head">Locations</p>
      	<div class="menu_body"> 
      	<a href="locations/">Manage Locations</a> 
      	<a href="locations/add.php">Add New Location</a> </div>
       
       <!--  <p class="menu_head">Company Code</p>
      	<div class="menu_body"> 
      	<a href="ccode/">Manage Company Code</a> 
      	<a href="ccode/add.php">Add Company Code</a> </div>-->
        
        <p class="menu_head">Attendance Management</p>
		<div class="menu_body">
        <a href="attandance/clockinout.php">Clock In/Out</a>
		<a href="attandance/index.php">Manage Attendance</a>
		</div>
        <p class="menu_head">Drivers Management</p>
			<div class="menu_body">
		<a href="drivers/index.php">Manage Drivers</a>
        <a href="drivers/add-drv.php">Add Driver</a>
        <a href="drivers/drvtypes.php">Manage Drivers Types</a>
        <!--<a href="drivers/drv_trash.php">Drivers Trash</a>
        <a href="drivers/dtype_trash.php">Drivers Types Trash</a>-->
        <a href="dvmapping/index.php">Assign Vehicle to Driver</a>
        <a href="tickets/index.php">Ticket Management</a>
       </div>
        <p class="menu_head">Options</p>
		<div class="menu_body">
		<a href="requests/onego2.php">Recurring Trips</a>
        <a href="requests/onego.php">Driver Assignment</a>
       	</div>
        <p class="menu_head">Patients Management </p>
		<div class="menu_body">
		<a href="patients/">Manage Patients</a>
       	</div>
        <p class="menu_head">Reports</p>
		<div class="menu_body">
        <!----><a href="reports/payment.php">Accounts Receivables</a>
        <a href="reports/invoices.php">Invoicing</a>
		<a href="reports/index.php">Request Report</a>
        <a href="reports/rep.php">Dispatch Report</a>
       
       	<a href="reports/gasreceipts.php">Gas Receipts</a>
		<a href="reports/payperiod.php">Pay Period Report</a>
        <!--<a href="reports/rep_mtm.php">MTM Billing Report</a>
        <a href="reports/lg_log.php">LogistiCare Trip Log</a>-->
       <!--  <a href="reports/milagereport.php">Update Milage</a>
        <a href="reports/odometerreports.php">Odometer Reading Report</a>-->
		</div>
        <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>		
	    <p class="menu_head">Admin Users</p>
			<div class="menu_body">
		 <a href="admusers/">Manage Users</a>
         <a href="admusers/adduser.php">Add User</a>
         <!--<a href="logs/">Activity Log</a>-->
		</div>
		<?php endif; ?>	
		<p class="menu_head">Vehicles Management</p>
		<div class="menu_body">
		<a href="vehicles/vehtypes.php">Manage Vehicle Types</a>
        <!--<a href="vehicles/vtype_trash.php">Vehicles Types Trash</a>-->
        <a href="vehicles/index.php">Manage Vehicles</a>
        <a href="vehicles/addvehicle.php">Add Vehicle</a>
        <!--<a href="vehicles/veh_trash.php">Vehicles Trash</a>-->
        <a href="maintenance/index.php">Maintenance Management</a>
        <a href="maintenance/men_types.php">Maintenance Types</a>
		</div>				
	   <?php if ($_SESSION['admuser']['admin_level'] == '0'): ?>					
		<p class="menu_head">Web Settings</p>
		<div class="menu_body">
		 <a href="admin_profile.php">Manage Admin Profile</a>
         <a href="contact_details.php">Contact Information</a>
		 <a href="copyright.php">Change Copyright</a>
		 <a href="changepass.php">Change Password</a>
		  <!--<a href="email.php">Email Management</a>-->
          <a href="operatinghours.php">Operating Hours</a>
  <!--        <a href="live.php">Chat</a>
          -->
		</div>
		<?php endif; ?>
  </div>     
                </div>          
            </div> <!-- end of left side bar -->