<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">

<head>

<meta MMTp-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>{$pgTitle}</title>

<link rel="stylesheet" href="../theme/style.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />
<link href="../theme/styles.css" rel="stylesheet" type="text/css">

<link rel="stylesheet" href="../theme/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />


<link href="../Mypopup/mypopup.css" rel="stylesheet" type="text/css">

<link href="../Mypopup/mypopup2.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../theme/style.css" type="text/css">

<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />

<link href="../theme/styles.css" rel="stylesheet" type="text/css">

<link href="../facebox/facebox.css" rel="stylesheet" type="text/css">

<link href="../Mypopup/mypopup.css" rel="stylesheet" type="text/css">

<link href="../Mypopup/mypopup2.css" rel="stylesheet" type="text/css">
<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>

<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/wysiwyg.js"></script>

<script type="text/javascript" src="../js/chrome.js"></script>

<script language="javascript" src="../js/style.script.js"></script>

<script type="text/javascript" src="../js/jdiv.js"></script>





<script type="text/javascript" src="../scripts/jquery-ui-1.8.2.custom.min.js"></script>


<script language="javascript" type="text/javascript" src="../Mypopup/mypopup.js"></script>

<script language="javascript" type="text/javascript" src="../Mypopup/mypopup2.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/functions.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/jquery.alerts.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>



<script language="javascript" type="text/javascript" src="../scripts/common.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/bar.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/pie.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/ui.datepicker.js"></script>

<link href="../theme/jquery.alerts.css" rel="stylesheet" type="text/css">

<link href="../theme/flora.datepicker.css" rel="stylesheet" type="text/css" />

<script language="javascript" type="text/javascript" src="../scripts/jquery.highlightFade.js"></script>







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
  <!--alert(txt);-->
  }

		 $(document).ready(function($) {

			  $('a[rel*=facebox]').facebox({

				loading_image : 'loading.gif',

				close_image   : 'closelabel.gif'

			  }) 

			  
             $.mypopup('');
			  $.mypopup2('');
			 
			   $('a[rel*=mypopup]').mypopup();

			});
            
			
$(document).bind('reveal.mypopup', function(){
                   $('#mypopup').draggable();
                  }); 
				  
				  $(document).bind('reveal.mypopup2', function(){
                   $('#mypopup2').draggable();
                  }); 
			

   $(document).ready(function(){

		fetchdata();						  

	$("#date").mask("19/39/9999");

	 $("form[id ^=frm_]").validate();

	$("#ssn").mask("999-99-9999");

	$("#day_phnum").mask("(999) 999-9999");

<!--	$("#cell_num").mask("(999) 999-9999");-->

	$("#dob").mask("19/39/9999");	

	$("#lic_expirydate").mask("19/39/9999");	

	$("#vpurchasedon").mask("19/39/9999");	

    $("#editvehicle").validate();

	 $("#out").mask("23:59");

	 $("#in").mask("23:59");

    $("#startdate").mask("99/99/9999");

    $("#enddate").mask("99/99/9999");	

    $('#addvehicle').validate();

    $('#editvehicle').validate();

    $('#add-driver').validate();

    $('#editdrv').validate();

    $('#add-admuser').validate();

    $('#edit-admuser').validate();			

  });



   function popWind(url){

   myWindow = window.open( url, "myWindow", 

"status = 1, height = 650, width = 720, scrollbars=1, resizable = 1" );

   myWindow.moveTo(0,0);

   }



			

</script>

  <style type="text/css">



    #printable { display: block; }



    @media print

    {

        #non-printable { display: none; }

        #printable { display: block; }

    }

    </style>

<script type="text/javascript">

<!--

function MM_findObj(n, d) { //v4.01

  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {

    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}

  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];

  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);

  if(!x && d.getElementById) x=d.getElementById(n); return x;

}



function MM_preloadImages() { //v3.0

  var d=document; if(d.Images){ if(!d.MM_p) d.MM_p=new Array();

    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)

    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}

}

function flvFSTI3(v1,v2){//v1.01

var v3;if (v1.filters[0]&&v1.filters[0].status==2){v1.filters[0].Stop();}if (v2==0){v3="blendTrans(Duration="+v1.STI8+")";}else {v3="revealTrans(Duration="+v1.STI8+",Transition="+(v2-1)+")";}v1.style.filter=v3;}



function flvFSTI1(){//v1.01

// Copyright 2003, Marja Ribbers-de Vroed, FlevOOware (www.STI1.nl/dreamweaver/)

var v1=arguments,v2=document,v3;v2.STI4=new Array();v2.STI7=(navigator.userAgent.toLowerCase().indexOf("mac")!=-1);for (var v4=0;v4<v1.length-2;v4+=5){v3=MM_findObj(v1[v4]);if (v3){v3.STI5=v3.src;v3.STI6=v1[v4+1];v3.STI2=v1[v4+2];v3.STI3=v1[v4+3];v3.STI8=v1[v4+4];v2.STI4[v2.STI4.length]=v3;if (v3.filters&&!v2.STI7){flvFSTI3(v3,v3.STI2);v3.onfilterchange=flvFSTI4;v3.filters[0].Apply();}v3.src=v3.STI6;if (v3.filters&&!v2.STI7){v3.filters[0].Play();}}}}



function flvFSTI2(){//v1.01

var v1,v2=document,v3=v2.STI4,v4;for (v4=0;v3&&v4<v3.length&&(v1=v3[v4])&&v1.STI5;v4++){if (v1.filters&&!v2.STI7){flvFSTI3(v1,v1.STI3);v1.filters[0].Apply();}v1.src=v1.STI5;if (v1.filters&&!v2.STI7){v1.filters[0].Play();}}}

function flvFSTI4(){//v1.01

this.style.filter="";}

//-->





//     F U N C T I O N     T  O    M  A K E   P O P  U P      O N   T H E    S C R E E N    //

		var formSeprate;	

		var ar = new Array();	

	

		var formSepratepu;	

		var puar = new Array();				

		

function fetchdata()

{

		

		$.post("../pop_up/fetchdata.php", {sheetid: ""+1}, function(data){

			if(data.length > 0)

			{

				var fetchedData = data;

				formSeprate = fetchedData;	

  		  	 

			}   

		});

		$.post("../pop_up/fetchdataup.php", {sheetid: ""+1}, function(data1){

			if(data1.length > 0)

			{

				var fetchedData1 = data1;

				formSepratepu = fetchedData1;	

  		  	 

			}   

		});		

}



function arr()

{

	

	if(ar.length == 0)

	{

		ar = formSeprate.split('^');



		var id = ar[1];

		ar.shift();

		

	}

	else

	{

		var id  = ar.shift();

	}

	

	if(ar.length != 0)

	{ 

		jQuery.mypopup({ ajax: '../pop_up/popup.php?id='+id});

		//CreatePopup("../popup.php?id="+id, 200, 1500);

	}

}



function arrpu()

{

	

	if(puar.length == 0)

	{

		puar = formSepratepu.split('^');



		var id = puar[1];

		puar.shift();

		

	}

	else

	{

		var id  = puar.shift();

	}

	

	if(puar.length != 0)

	{ 

		jQuery.mypopup2({ ajax: '../pop_up/popup2.php?id='+id});

		//CreatePopup("../popup.php?id="+id, 200, 1500);

	}

}



	setInterval ( "fetchdata()", 10000);

	setInterval ( "arr(); arrpu();", 20000);



//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//  FUNCTION END   \\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//	

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
				<img src="../images/logo.png" alt="" />
            </div><!-- end of logo-->
        </div> <!-- end of top banner -->
{include file = menu.tpl}
<div id="content_wrapper">
<!-- start of left side bar -->
            <div class="left_side_bar">
                <div class="left_side_link">
                <h1>Hybrid Track Trans Admin Menu</h1>
                    <div id="firstpane" class="menu_list"> <!--Code for menu starts here-->
		{if $smarty.session.admuser.admin_level eq '0'}			
		<p class="menu_head">Corporation</p>
		<div class="menu_body">
		<a href="../Corporates/">Manage Corporation</a>
        <a href="../Corporates/add.php">Add Corporate</a>
        <a href="../Corporates/casemanagers.php">Casemanager </a>
        <a href="../Corporates/addcm.php">Add Casemanager </a>
		</div>
		{/if}
		<p class="menu_head">Vehicles Management</p>
		<div class="menu_body">
		<a href="../vehicles/vehtypes.php">Manage Vehicle Types</a>
        <a href="../vehicles/vtype_trash.php">Vehicles Types Trash</a>
        <a href="../vehicles/index.php">Manage Vehicles</a>
        <a href="../vehicles/addvehicle.php">Add Vehicle</a>
        <a href="../vehicles/veh_trash.php">Vehicles Trash</a>
        <a href="../maintenance/index.php">Maintenance Management</a>
        <a href="../maintenance/mem_types.php">Maintenance Types</a>
		</div>				
		<p class="menu_head">Drivers Management</p>
		<div class="menu_body">
		<a href="../drivers/index.php">Manage Drivers</a>
        <a href="../drivers/add-drv.php">Add Driver</a>
        <a href="../drivers/drvtypes.php">Manage Drivers Types</a>
        <a href="../drivers/drv_trash.php">Drivers Trash</a>
        <a href="../drivers/dtype_trash.php">Drivers Types Trash</a>
        <a href="../dvmapping/index.php">Assign Vehicle to Driver</a>
        <a href="../tickets/index.php">Ticket Management</a>
       </div>
	   {if $smarty.session.admuser.admin_level eq '0'}			
	    <p class="menu_head">Admin Users</p>
		<div class="menu_body">
		 <a href="../admusers/">Manage Users</a>
         <a href="../admusers/adduser.php">Add User</a>
		</div>
		{/if}
		<p class="menu_head">Attendance Management</p>
		<div class="menu_body">
		 <a href="../attandance/index.php">Manage Attendance</a>
         <a href="../attandance/timein.php">Add TimeIn</a>
		</div>
		<p class="menu_head">Reports</p>
		<div class="menu_body">
		  <a href="../reports/index.php">Corporate Report</a>
         <a href="../reports/rep.php">Trip Report</a>

		</div>
	   {if $smarty.session.admuser.admin_level eq '0'}					
		<p class="menu_head">Testimonials</p>
		<div class="menu_body">
		 <a href="../testimonials/">Manage Testimonials</a>
         <a href="../testimonials/addtestimonials.php">Add Testimonial</a>
		</div>		
		<p class="menu_head">Web Settings</p>
		<div class="menu_body">
		 <a href="../admin_profile.php">Manage Admin Profile</a>
         <a href="../contact_details.php">Contact Information</a>
		 <a href="../copyright.php">Change Copyright</a>
		 <a href="../changepass.php">Change Password</a>
		</div>
		{/if}
  </div>     
                    </div>          
                    
            </div> <!-- end of left side bar -->