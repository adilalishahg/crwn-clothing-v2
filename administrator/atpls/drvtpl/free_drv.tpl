<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="MMTp://www.hybriditservices.com/demos/MMTglobal-2/w3.org/1999/xhtml">
<head>
<meta MMTp-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$pgTitle}</title>
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
  <!--alert(txt);-->
  }

$(document).ready(function(){					  

	$("#date").mask("99/99/9999");

	 /*$("form[id ^=frm_]").validate();*/

	$("#ssn").mask("999-99-9999");

	$("#day_phnum").mask("(999) 999-9999");

//$("#cell_num").mask("(999) 999-9999");

	$("#dob").mask("19/39/9999");	

	$("#lic_expirydate").mask("19/39/9999");	

	$("#vpurchasedon").mask("19/39/9999");	

   /* $("#editvehicle").validate();*/

	 $("#out").mask("23:59");

	 $("#in").mask("23:59");

    $("#startdate").mask("19/39/9999");

    $("#enddate").mask("19/39/9999");	

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

{literal}
<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record?");

		if (ok)

		{ location.href="index.php?delId="+id;

		return true;}else{			

			return false;}

	}

function rate_it(id, rate)

{

	$('input',id).rating('select',rate);

	//$('input',id).rating('disable')

}



function stchange(val)

{

  if (val != ''){		

 	location.href="index.php?st="+val;

	return true;}else{

			return false;

		}			

	}	

	

	

	 $(document).ready(function(){

	 

    $('#form1').validate();				  

	$("#stime").mask("29:59");

	$("#etime").mask("29:59");

	

  });

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
  <div class="logo float_left"> <img src="../images/logo.png" alt="" height="70" width="250" /> </div>
  <!-- end of logo--> 
</div>
<!-- end of top banner --> 
{include file = menu.tpl} <br />
<form id="form1" name="form1"  method="post" action="free_drv_array.php">
  <div style=" width:100%;">
    <div style="  width:100%; margin:auto; text-align:center;" align="center" >
      <table border="0" cellspacing="2" cellpadding="2" style="background-color: #FFFFFF;
    border: 1px solid #DDDDDD;   margin-top: 5px;
    padding: 3px 3px 3px 10px;
    width: 960px;" >
        <tr>
          <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
        </tr>
        <tr>
          <td width="21%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
          <td width="31%" align="left" valign="top"><input type="text" name="stime" id="stime" value="{$stime}" class="inputTxtField  required"/>
            &nbsp;
            <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
              <div class="suggestionList" id="autoSuggestionsList1"> &nbsp; </div>
            </div>
            (hh:mm)</td>
          <td width="16%" align="right" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
          <td align="left" valign="top" ><input type="text" name="etime" id="etime" value="{$etime}" class="inputTxtField  required" />
            (hh:mm)</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td></td>
          <td></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td colspan="3" align="left" valign="top"><font color="#FF0000"> <b>Note:*</b> </font>
            <ol>
              <li><font color="#FF0000">Combination of all fields are  mandatory</font></li>
              <li><font color="#FF0000">Both From and To time must be provided.</font></li>
              <li><font color="#FF0000">Driver must be on-duty.</font></li>
            </ol></td>
        </tr>
        <tr>
          <td align="left" valign="top">&nbsp;</td>
          <td colspan="3" align="left" valign="top"><input type="submit" name="search" value='submit' class="inputButton"  />
            &nbsp;
            <input type="reset" name="reset" value='Reset' class="inputButton"  /></td>
        </tr>
      </table>
    </div>
  </div>
</form>
<div style=" width:100%; padding-bottom:15px;">
  <div style="  width:960px; margin:auto; " align="center" >
    <table width="960" border="0" cellspacing="0" cellpadding="0" class="outer_table" align="center" bgcolor="#FFFFFF">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="44" colspan="2" align="center" valign="top"></td>
            </tr>
            <tr>
              <td height="19" colspan="2" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
                { if $errors != ''} {$errors} {/if}</td>
            </tr>
            <tr>
              <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="../routingpanel/index.php">Back</a>]&nbsp;</div></td>
            </tr>
            <tr>
              <td width="89%" align="center" class="admintopheading">FREE HOURS OF ENGAGED DRIVERS [Minimum Interval: {$duration} Minutes]</td>
            </tr>
            <tr>
              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
                  <tr>
                    <td  align="center" class="labeltxt"><strong>S.no.</strong></td>
                    <td  align="center" class="labeltxt"><strong>Driver Name</strong></td>
                    <td  align="center" class="labeltxt"><strong>Drive Code</strong></td>
                    <td  align="center" class="labeltxt"><strong>Last Trip </strong></td>
                    <td align="center"  class="labeltxt"><strong>Next Trip </strong></td>
                    <td align="center"  class="labeltxt"><strong>Free Time</strong></td>
                  </tr>
                  {section name=q loop = $data}
                  <tr valign="top">
                    <td align="center"><b>{$smarty.section.q.iteration}.</b></td>
                    <td align="center">{$data[q].drv_name}</td>
                    <td align="center">{$data[q].drv_code}</td>
                    <td align="center">{$data[q].last_time}</td>
                    <td align="center">{$data[q].next_time}</td>
                    <td align="center">{math equation="x / 60|ceil" x=$data[q].slot}:{math equation="x % 60" x=$data[q].slot}:00</td>
                  </tr>
                  {sectionelse}
                  <tr>
                    <td colspan="6" align="center"><b>No Record Found</b></td>
                  </tr>
                  {/section}
                </table></td>
            </tr>
            <tr>
              <td colspan="2" align="center">{$pages}</td>
            </tr>
            <tr>
              <td width="89%" align="center" class="admintopheading">FREE DRIVERS / NO TRIP ASSIGN [or trips have no time span]</td>
            </tr>
            <tr><td><table width="100%" border="0" class="main_table">
                  <tr>
                    <td  align="center" class="labeltxt"><strong>S.no.</strong></td>
                    <td  align="center" class="labeltxt"><strong>Driver Name</strong></td>
                    <td  align="center" class="labeltxt"><strong>Drive Code</strong></td>

                  </tr>
                  {section name=q loop = $v_drivers}
                  <tr valign="top">
                    <td align="center"><b>{$smarty.section.q.iteration}.</b></td>
                    <td align="center">{$v_drivers[q].drv_name}</td>
                    <td align="center">{$v_drivers[q].drv_code}</td>
                  </tr>
                  {sectionelse}
                  <tr>
                    <td colspan="3" align="center"><b>No Record Found</b></td>
                  </tr>
                  {/section}
                </table></td></tr>
          </table></td>
      </tr>
    </table>
  </div>
</div>
{ include file = innerfooter.tpl} 
