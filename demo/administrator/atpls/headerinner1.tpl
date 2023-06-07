<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.hybriditservices.com/demos/httglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.hybriditservices.com/demos/httglobal-2/w3.org/1999/xhtml">

<head>

<meta MMTp-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Admin Panel.::.AZ Secure Trans</title>

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



<!--<script src="MMTp://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAdUEjy77Apg8cV-krWrQ7exQlCw3P91oSVaavChCcALS3NokerBSv_WLWYQG2sOoC22S2Brq8ZxeQIw"  type="text/javascript"></script>-->

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

  <!--alert(txt);-->

  }



$(document).ready(function(){					  

	$("#adduser").validationEngine();

	$("#date").mask("99/99/9999");



	 /*$("form[id ^=frm_]").validate();*/



	$("#ssn").mask("999-99-9999");



	$("#day_phnum").mask("(999) 999-9999");



//$("#cell_num").mask("(999) 999-9999");



	$("#dob").mask("19/39/9999");

	

	$("#tdate").mask("19/39/9999");	



	$("#lic_expirydate").mask("19/39/9999");	



	$("#vpurchasedon").mask("19/39/9999");	



   /* $("#editvehicle").validate();*/



	 $("#out").mask("23:59");



	 $("#in").mask("23:59");



    $("#startdate").mask("19/39/9999");



    $("#enddate").mask("19/39/9999");	


	

	$("#phnum").mask("(999) 999-9999");

	$("#h_phone").mask("(999) 999-9999");

	//$("#ssn").mask("999-99-9999");

	$("#appdate").datepicker();

	$("#apptime").mask("29:59");

	$('#returnpickup').mask("29:59");

    /*$('#addvehicle').validate();



    $('#editvehicle').validate();



    $('#add-driver').validate();



    $('#editdrv').validate();



    $('#add-admuser').validate();



    $('#edit-admuser').validate();			

*/

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



   myWindow = window.open( url, "myWindow", "status = 1, height = 650, width = 720, scrollbars=1, resizable = 1" );

   myWindow.moveTo(0,0);



} 

function popWind2(url){



   myWindow = window.open( url, "myWindow", "status = 1, height = 650, width = 860, scrollbars=1, resizable = 1" );

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

				<img src="../images/logo.png" alt="" width="80"  height="70" />

            </div><!-- end of logo-->

        </div> <!-- end of top banner -->

{include file = menu.tpl}

<div id="content_wrapper">

<!-- start of left side bar -->

             <!-- end of left side bar -->