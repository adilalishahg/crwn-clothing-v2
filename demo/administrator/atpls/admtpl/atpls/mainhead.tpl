<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">

<head>

<meta MMTp-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<title>{$pgTitle}</title>

<link rel="stylesheet" href="theme/style.css" type="text/css">

<link rel="stylesheet" type="text/css" href="theme/chromestyle.css" />

<link href="theme/styles.css" rel="stylesheet" type="text/css">

<link href="facebox/facebox.css" rel="stylesheet" type="text/css">



<script language="JavaScript" type="text/javascript" src="js/wysiwyg.js"></script>

<script type="text/javascript" src="js/chrome.js"></script>

<script language="javascript" src="js/style.script.js"></script>

<script type="text/javascript" src="js/jdiv.js"></script>

<script language="javascript" type="text/javascript" src="scripts/jquery-1.2.6.js"></script>

<script language="javascript" type="text/javascript" src="facebox/facebox.js"></script>

{literal}

<script>

		 $(document).ready(function($) {

			  $('a[rel*=facebox]').facebox({

				loading_image : 'loading.gif',

				close_image   : 'closelabel.gif'

			  }) 

			})

			

		  function requestAtrip(){

			  $('a[rel*=facebox]').facebox({

	         title: 'Information',

	         message: 'This module is not currently integrated.'

            });

			facebox.show();

           }	

</script>

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

</script>

{/literal}

</head>

<body onLoad="MM_preloadImages('images/cp_13rolover.png','images/cp_16rolover.png','images/cp_18rolover.png','images/cp_26rolove.png','images/cp_27rolover.png','images/cp_28rolove.png','images/cp_35rolover.png','images/cp_36rolover.png','images/cp_37rolover.png')" bgcolor="#ffffff">

<table width="1010" border="0" cellpadding="0" cellspacing="0" align="center">



<tr align="right" valign="bottom" background="../MMTframes/header.jpg"> 

    <td height="151" align="right" background="images/header.jpg" style="background-repeat:no-repeat;"><table width="30%" height="67" border="0" cellpadding="1">

        <tr> 

          <td valign="bottom" align="right"><strong>Welcome {$smarty.session.adminname}</strong></td>

        </tr>

       </table></td>

  </tr> 

  

  <tr >

    <td colspan="17" style="background-image:url(images/header_18.gif); height:42px; background-repeat:repeat-x;">

     {include file=mainmenu.tpl}</td>

  </tr>

  <tr >

    <td colspan="17" height="35" bgcolor="#FFFFFF">&nbsp;</td>

  </tr>

 </table> 

