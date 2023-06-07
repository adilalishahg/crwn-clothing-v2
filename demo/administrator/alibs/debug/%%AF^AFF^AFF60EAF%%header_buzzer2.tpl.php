<?php /* Smarty version 2.6.12, created on 2019-04-24 16:06:46
         compiled from header_buzzer2.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $this->_tpl_vars['pgTitle']; ?>
</title>
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
<!--<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>
<script language="JavaScript" type="text/javascript" src="../js/wysiwyg.js"></script>
<script type="text/javascript" src="../js/chrome.js"></script>
<script language="javascript" src="../js/style.script.js"></script>
<script type="text/javascript" src="../js/jdiv.js"></script>-->
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui-1.8.2.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>
<!--<script language="javascript" type="text/javascript" src="../Mypopup/mypopup.js"></script>
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
<link href="../theme/flora.datepicker.css" rel="stylesheet" type="text/css" />-->
<!--<script language="javascript" type="text/javascript" src="../scripts/jquery.highlightFade.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.ui.draggable.js"></script>
--><?php echo '
<script>
try
  {
  adddlert("Welcome guest!");
  }
catch(err)
  {
  txt="There was an error on this page.\\n\\n";
  txt+="Error description: " + err.description + "\\n\\n";
  txt+="Click OK to continue.\\n\\n";
  <!--alert(txt);-->
  }

		 $(document).ready(function($) {

			  $(\'a[rel*=facebox]\').facebox({

				loading_image : \'loading.gif\',

				close_image   : \'closelabel.gif\'

			  }) 
		 
			   $(\'a[rel*=mypopup]\').mypopup();
			   
			   $(document).bind(\'reveal.mypopup\', function(){
                   $(\'#mypopup\').draggable();
                  }); 
				  
				  $(document).bind(\'reveal.mypopup2\', function(){
                   $(\'#mypopup2\').draggable();
                  }); 

			});
            
			

			

   $(document).ready(function(){

		fetchdata();						  

	$("#date").mask("19/39/9999");

	 $("form[id ^=frm_]").validate();

	$("#ssn").mask("999-99-9999");

	$("#day_phnum").mask("(999) 999-9999");

	$("#dob").mask("19/39/9999");	

	$("#lic_expirydate").mask("19/39/9999");	

	$("#vpurchasedon").mask("19/39/9999");	

    $("#editvehicle").validate();

	 $("#out").mask("23:59");

	 $("#in").mask("23:59");

    $("#startdate").mask("99/99/9999");

    $("#enddate").mask("99/99/9999");	

    $(\'#addvehicle\').validate();

    $(\'#editvehicle\').validate();

    $(\'#add-driver\').validate();

    $(\'#editdrv\').validate();

    $(\'#add-admuser\').validate();

    $(\'#edit-admuser\').validate();		
	 $("#dt1").mask("29:59");

		$("#pu1").mask("29:59");

		$("#pu2").mask("29:59");

		$("#dt2").mask("29:59");
	

  });



   function popWind(url){

   myWindow = window.open( url, "myWindow", 

"status = 1, height = 650, width = 720, scrollbars=1, resizable = 1" );

   myWindow.moveTo(0,0);

   }



			

</script>
<style type="text/css">
    #printable { display: block; }
	.pick { background-image: url(../images/pick.gif);}
	.drop { background-image: url(../images/drop.gif);}
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
    </style>
'; ?>

</head>
<body>
<div  style="width:100%;" >
<!-- start of inter container -->
<div  id="wrapper_inner" style="width:100%;">
<div id="content_wrapper" style="width:99%;">