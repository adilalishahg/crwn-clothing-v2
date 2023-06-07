<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">

<head>

<meta MMTp-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>{$pgTitle}</title>

<link rel="stylesheet" href="../theme/style.css" type="text/css">

<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />

<link href="../theme/styles.css" rel="stylesheet" type="text/css">

<link href="../facebox/facebox.css" rel="stylesheet" type="text/css">

<link href="../Mypopup/mypopup.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="../js/wysiwyg.js"></script>

<script type="text/javascript" src="../js/chrome.js"></script>

<script language="javascript" src="../js/style.script.js"></script>

<script type="text/javascript" src="../js/jdiv.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>

<script type="text/javascript" src="../js/sliding_popup.js"></script>

<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>

<script language="javascript" type="text/javascript" src="../Mypopup/mypopup.js"></script>

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



  <!--Added for the rating module in MMT

<script src="../scripts/jquery.rating.js" type="text/javascript" language="javascript"></script>

<link href="../theme/jquery.rating.css" type="text/css" rel="stylesheet"/>

End-->

{literal}

<script>

		 $(document).ready(function($) {

			  $('a[rel*=facebox]').facebox({

				loading_image : 'loading.gif',

				close_image   : 'closelabel.gif'

			  }) 

			  

			   $('a[rel*=mypopup]').mypopup();

			});



   $(document).ready(function(){

		fetchdata();						  

	$("#date").mask("19/39/9999");

	 $("form[id ^=frm_]").validate();

	$("#ssn").mask("999-99-9999");

	$("#day_phnum").mask("(999) 999-9999");

	$("#cell_num").mask("(999) 999-9999");

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

  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();

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

		

function fetchdata()

{

		

		$.post("../pop_up/fetchdata.php", {sheetid: ""+1}, function(data){

			if(data.length > 0)

			{

				var fetchedData = data;

				formSeprate = fetchedData;	

  		  	 

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

	setInterval ( "fetchdata()", 10000);

	setInterval ( "arr()", 20000);



//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//  FUNCTION END   \\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//	

</script>

{/literal}

</head>



<body bgcolor="#FFFFFF">

<table width="1010" border="0" cellpadding="0" cellspacing="0" align="center">



<tr align="right" valign="bottom" background="../MMTframes/header.jpg" id="non-printable"> 

    <td height="151" align="right" background="../images/header.jpg"><table width="30%" height="67" border="0" cellpadding="1">

        <tr> 

          <td valign="bottom" align="right"><strong>Welcome {$smarty.session.adminname}</strong></td>

        </tr>

      </table></td>

  </tr> 

  

  <tr id="non-printable">

    <td colspan="17" style="background-image:url(../images/header_18.gif); height:42px; background-repeat:repeat-x;">

     {include file=menu.tpl}</td>

  </tr>

  <tr id="non-printable">

    <td colspan="17" height="35" bgcolor="#FFFFFF">&nbsp;</td>

  </tr>

 </table> 

