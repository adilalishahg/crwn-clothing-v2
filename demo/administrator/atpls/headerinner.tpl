<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.hybriditservices.com/demos/httglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.hybriditservices.com/demos/httglobal-2/w3.org/1999/xhtml">
<head>
<meta MMTp-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.::Admin Panel::.</title>
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />
<link href="../theme/styles.css" rel="stylesheet" type="text/css">
<link href="../facebox/facebox.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../theme/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>
<script type="text/javascript" src="../js/chrome.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
<script src="../scripts/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="../scripts/jquery.validationEngine.js" type="text/javascript"></script>
<script type="text/javascript" src="../scripts/iColorPicker.js"></script>
<script type="text/javascript" src="../scripts/jquery.autocomplete.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/common.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/bar.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/pie.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/ui.datepicker.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.tablednd_0_5.js"></script>
<script language="javascript" type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<script language="javascript" type="text/javascript" src="../ckfinder/ckfinder.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.alerts.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.ui.draggable.js"></script>
<script src="../scripts/jquery.jmap.min.js" type="text/javascript"></script>
<link href="../theme/jquery.alerts.css" rel="stylesheet" type="text/css">
<link href="../theme/flora.datepicker.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../scripts/jquery.highlightFade.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>
<link rel="stylesheet" href="../theme/jquery.autocomplete.css" type="text/css" /> 
{literal}
<script>
try
  {
  adddlert("Welcome guest!");
  }
catch(err)
  {
  txt="There was an error on this page.\n\n";
  txt+="Error description: " + err.description + "\n\n";
  txt+="Click OK to continue.\n\n";
  }
$(document).ready(function(){					  
	$("#adduser").validationEngine();
	$("#date").mask("99/99/9999");
	$("#hicdate1").mask("99/99/9999");
	$("#hicdate2").mask("99/99/9999");
	$("#hicdate3").mask("99/99/9999");
	$("#hicdate4").mask("99/99/9999");
	$("#hicdate5").mask("99/99/9999");
	$("#hicdate6").mask("99/99/9999");
	$("#hicdate7").mask("99/99/9999");
	$("#hicdate8").mask("99/99/9999");
	$("#hicdate9").mask("99/99/9999");
	$("#hicdate10").mask("99/99/9999");
	$("#hicdate11").mask("99/99/9999");
	$("#hicdate12").mask("99/99/9999");
	$("#hicdate13").mask("99/99/9999");
	$("#hicdate14").mask("99/99/9999");
	$("#hicdate15").mask("99/99/9999");
	$("#hicdate16").mask("99/99/9999");
	$("#hicdate17").mask("99/99/9999");
	$("#hicdate18").mask("99/99/9999");
	$("#hicdate19").mask("99/99/9999");
	$("#hicdate20").mask("99/99/9999");
	$("#appmiledate").mask("99/99/9999");
	$("#ssn").mask("999-99-9999");
	$("#day_phnum").mask("(999) 999-9999");
	$("#dob").mask("19/39/9999");
	$("#tdate").mask("19/39/9999");	
	$("#lic_expirydate").mask("19/39/9999");	
	$("#vpurchasedon").mask("19/39/9999");	
	 $("#out").mask("23:59");
	 $("#in").mask("23:59");
    $("#startdate").mask("19/39/9999");
    $("#enddate").mask("19/39/9999");	
	$("#phnum").mask("(999) 999-9999");
	$("#h_phone").mask("(999) 999-9999");
	$("#appdate").datepicker();
	$("#apptime").mask("29:59");
	$('#returnpickup').mask("29:59");
    });
	 $(document).ready(function($) {
			  $('a[rel*=facebox]').facebox({
				loading_image : 'loading.gif',
				close_image   : 'closelabel.gif'				
			  });
			});		
$(document).ready(function() {
	$("#adminprof").validate();
    $("#addveh").validate();
	$("#updReq").validate();
	 $("#frm_sheet").validate();	
	$("#editveh").validate();	
	});			
</script>
<script type="text/javascript"> 
$(document).ready(function()
{
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
		var thumbOver = $(this).find("img").attr("src"); //Get image url and assign it to 'thumbOver'
		//Set a background image(thumbOver) on the &lt;a&gt; tag 
		$(this).find("a.thumb").css({'background' : 'url(' + thumbOver + ') no-repeat center bottom'});
		//Fade the image to 0 
		$(this).find("span").stop().fadeTo('normal', 0 , function() {
			$(this).hide() //Hide the image after fade
		}); 
	} , function() { //on hover out...
		//Fade the image to 1 
		$(this).find("span").stop().fadeTo('normal', 1).show();
	});
});
function popWind(url){
   myWindow = window.open( url, "myWindow", "status = 1, height = 850, width = 1060, scrollbars=1, resizable = 1" );
   myWindow.moveTo(0,0);
} 
function popWind2(url){
   myWindow = window.open( url, "myWindow", "status = 1, height = 850, width = 1060, scrollbars=1, resizable = 1" );
   myWindow.moveTo(0,0);
} 
</script>
{/literal}
</head>
<body>
<div id="wrapper_outer">
	<!-- start of inter container -->
    <div id="wrapper_inner">
        <!-- start of top banner -->
        <div id="banner">        	        	
<div class="banner_menu float_right">
            	<ul>
                	<li><a href="../index.php">Home</a></li>
                    <li><a href="../admin_profile.php">Admin Info</a></li>
                    <li class="last"><a href="../logout.php">Logout</a></li>
                </ul>
            </div>
            <!-- start of logo-->
            <div class="logo float_left">
				<img src="../images/logo.png" style="max-height:70px;max-width:70px;" alt="" />
            </div><!-- end of logo-->
<!--<div class="message-text" style="font-size: 12px;  text-align: center; width: 1000px; line-height: 23px; padding-top: 4px; color:#F00;">We would be doing maintenance from April 19, 2018 -- April 22,2018 from  08:00 PM to 12:00 AM MST. We are not expecting any down time in case of any issues please feel free to call us at (480) 717-5032 or (480) 275-9047
          Thank you for your patience</div> -->
                  </div> <!-- end of top banner -->
{include file = menu.tpl}
<div id="content_wrapper">
<!-- start of left side bar -->
            <div class="left_side_bar">
                <div class="left_side_link">
                <h1>Admin Menu</h1>
                    <div id="firstpane" class="menu_list">
    <!--    <p class="menu_head">CMS</p>
      	<div class="menu_body"> 
      	<a href="../cms/">Manage Contents</a>
        <a href="../services/">Manage Services</a>
		<a href="../gallery/">Our Gallery</a>
        <a href="../faqs/">Manage FAQs</a> 
      	 </div>-->            
                    
        <p class="menu_head">Accounts</p>
      	<div class="menu_body"> 
      	<a href="../accounts/">Manage Accounts</a> 
      	<a href="../accounts/add.php">Add New Account</a> </div>
         <p class="menu_head">Locations</p>
      	<div class="menu_body"> 
      	<a href="../locations/">Manage Locations</a> 
      	<a href="../locations/add.php">Add New Location</a> </div>
        
        <!-- <p class="menu_head">Company Code</p>
      	<div class="menu_body"> 
      	<a href="../ccode/">Manage Company Code</a> 
      	<a href="../ccode/add.php">Add Company Code</a> </div>-->
        
        <p class="menu_head">Attendance Management</p>
		<div class="menu_body">
		 <a href="../attandance/clockinout.php">Clock In/Out</a>
         <a href="../attandance/index.php">Manage Attendance</a>
         
		</div>
        <p class="menu_head">Drivers Management</p>
			<div class="menu_body">
		<a href="../drivers/index.php">Manage Drivers</a>
        <a href="../drivers/add-drv.php">Add Driver</a>
        <a href="../drivers/drvtypes.php">Manage Drivers Types</a>
        <!--<a href="../drivers/drv_trash.php">Drivers Trash</a>
        <a href="../drivers/dtype_trash.php">Drivers Types Trash</a>-->
        <a href="../dvmapping/index.php">Assign Vehicle to Driver</a>
        <a href="../tickets/index.php">Ticket Management</a>
       </div>
        <p class="menu_head">Options</p>
		<div class="menu_body">
		<a href="../requests/onego2.php">Recurring Trips</a>
        <a href="../requests/onego.php">Driver Assignment</a>
       	</div>
        <p class="menu_head">Patients Management </p>
		<div class="menu_body">
		<a href="../patients/">Manage Patients</a>
       	</div>
        <p class="menu_head">Reports</p>
		<div class="menu_body">
        <a href="../reports/payment.php">Accounts Receivables</a>
        <a href="../reports/invoices.php">Invoicing</a>
		<a href="../reports/index.php">Request Report</a>
        <a href="../reports/rep.php">Dispatch Report</a>
       <!--<a href="../reports/rep222.php">PDF Export</a>-->
       	<a href="../reports/gasreceipts.php">Gas Receipts</a>
		<a href="../reports/payperiod.php">Pay Period Report</a>
        <a href="../reports/rep_mtm.php">MTM Billing Report</a>
        <a href="../reports/lg_log.php">LogistiCare Trip Log</a>
       <!-- <a href="../reports/lg_log.php">LogistiCare Trip Log</a>-->
        <!-- <a href="../reports/odometerreports.php">Odometer Reading Report</a>
		--></div>
        {if $smarty.session.admuser.admin_level eq '0'}		
	    <p class="menu_head">Admin Users</p>
			<div class="menu_body">
		 <a href="../admusers/">Manage Users</a>
         <a href="../admusers/adduser.php">Add User</a>
         <a href="../logs/">Activity Log</a>
		</div>
		{/if}	
		<p class="menu_head">Vehicles Management</p>
		<div class="menu_body">
		<a href="../vehicles/vehtypes.php">Manage Vehicle Types</a>
        <!--<a href="../vehicles/vtype_trash.php">Vehicles Types Trash</a>-->
        <a href="../vehicles/index.php">Manage Vehicles</a>
        <a href="../vehicles/addvehicle.php">Add Vehicle</a>
        <!--<a href="../vehicles/veh_trash.php">Vehicles Trash</a>-->
        <a href="../maintenance/index.php">Maintenance Management</a>
        <a href="../maintenance/men_types.php">Maintenance Types</a>
		</div>				
	   {if $smarty.session.admuser.admin_level eq '0'}					
		<p class="menu_head">Web Settings</p>
		<div class="menu_body">
		 <a href="../admin_profile.php">Manage Admin Profile</a>
         <a href="../contact_details.php">Contact Information</a>
		 <a href="../copyright.php">Change Copyright</a>
		 <a href="../changepass.php">Change Password</a>
		  <!--<a href="../email.php">Email Management</a>-->
          <a href="../operatinghours.php">Operating Hours</a>
    <!--      <a href="../live.php">Chat</a>
          -->
		</div>
		{/if}
  </div>     
                </div>          
            </div> <!-- end of left side bar -->