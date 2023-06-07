<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.hybriditservices.com/demos/httglobal-2/w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.hybriditservices.com/demos/httglobal-2/w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  }
$(document).ready(function(){					  
	$("#date").mask("99/99/9999");
	$("#ssn").mask("999-99-9999");
	$("#day_phnum").mask("(999) 999-9999");
	$("#dob").mask("19/39/9999");	
	$("#lic_expirydate").mask("19/39/9999");	
	$("#vpurchasedon").mask("19/39/9999");	
	 $("#out").mask("23:59");
	 $("#in").mask("23:59");
    $("#startdate").mask("19/39/9999");
   $("#sdate").datepicker();
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
<style>
.rou_panel_main{width:auto; text-align:center; float:left; padding-left:15px; padding-right:15px; padding-top:15px; padding-bottom:15px;}
.rou_panel_img{width:auto;}
.rou_text{width:auto; text-align:center; float:left; font-family:Verdana, Geneva, sans-serif; font-weight:bold;}
</style>
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
				<img src="../images/logo.png" alt="Trans" width="140" height="60" />
            </div><!-- end of logo-->
        </div> <!-- end of top banner -->
{include file = menu.tpl}




{literal}

<script type="text/javascript">



function deleteRec(id)

		{

	

		

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{		

			

			location.href="index.php?delId="+id;

			return true;

			//document.delrecfrm.submit();

		}

		else

		{

			

			return false;

		}

			

	}

	

	

	function editRec(id)

		{

	

		

		var ok;

		ok=confirm("Are you sure you want to edit this record");

		if (ok)

		{		

			

			location.href="grid/default.php";

			return true;

			//document.delrecfrm.submit();

		}

		else

		{

			

			return false;

		}

			

	}





function getCatSorted(val){

  if(val != ''){

   location.href = 'index.php?vendor='+val;

   }else{

   location.href = 'index.php';   

   }

}

   function popWind(url){
   	myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 230, width = 340, scrollbars=0, resizable = 0" );
	window.myWindow1.focus()
   	myWindow1.moveTo(300,200);
   }
   function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 800, width = 1000, scrollbars=1, resizable = 0" );
   myWindow1.moveTo(110,50);
   myWindow1.focus();
   }
   function popWind3(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 500, width = 500, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(300,50);
   myWindow1.focus();
   }
function resetstate(){
	var ok;
	ok=confirm("Are you sure you want to reset driver assigment state?");
		if (ok)
		{	
	//	alert('salam');
	$.post("refresh.php", {}, function(data)
					{
						//if(data.length > 0)
					});
		return true;
	}
		else
		{
			return false;
		}
	}
   
</script>

{/literal}

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF"  style="margin-bottom:10px; margin-left:15px;" >
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
        <tr>
          <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</td>
        </tr>
        <tr>
          <td height="19" align="left">
          <div align="right" style=" text-align:center; padding-bottom:5px; height:100px; border: #F00 solid 0px;">
          <div class="admintopheading">ROUTING PANEL MANAGEMENT </div>
            </div>
             <!-- <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"><a title="Add New Trip" href="../mercy/" target="_blank"><img alt="Add New Trip" border="0" src="../graphics/add_trip.png"></a></div>
                <div class="rou_text">Add New Trip</div>
              </div>
              <div class="rou_panel_main">	
			<div class="rou_panel_img" align="center"><a title="Download Sample Sheet" href="../sample.xls"><img alt="Download Sample Sheet" border="0" src="../graphics/sample_sheet.png"></a></div>
            <div class="rou_text">Sample Sheet</div>
            </div>-->
              <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"><a title="Current Trips" href="gridto.php"><img alt="Current Trips" border="0" src="../graphics/surrent_trip_btn.png"></a></div>
                <div class="rou_text">Current Schedule</div>
              </div>
              <!--<div class="rou_panel_main">
			<div class="rou_panel_img" align="center"><a title="Calculate Fare" href="#" onclick="popWind('calculate_rate.php');"><img alt="Calculate Fare" border="0" src="../graphics/calculate1_btn.png"></a></div>
            <div class="rou_text">Calculate Fare</div>
            </div>
              <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"><a title="Real Time Summary" href="latesttrips.php" target="_self" ><img alt="Real Time Summary" border="0" src="../graphics/real_time_sum_btn.png"></a></div>
                <div class="rou_text">Real Time Summary</div>
              </div>-->
              <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"><a title="Schedule" href="futuretrips.php"  ><img alt="Schedule" border="0" src="../graphics/schedule.png"></a></div>
                <div class="rou_text">Schedule Calendar</div>
              </div>
             <!-- <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"><a title="Vacant Driver" href="../drivers/free_drv.php"   ><img alt="Vacant Driver" border="0" src="../graphics/vacant_driver.png"></a></div>
                <div class="rou_text">Vacant Driver</div>
              </div>
              <div class="rou_panel_main">
			<div class="rou_panel_img" align="center">  
			<a title="Add Routing Sheet" href="add-csv.php" rel="facebox"><img alt="Add Routing Sheet" border="0" src="../graphics/add_rounting_sheet.png"></a></div>
            <div class="rou_text">Add Routing Sheet</div>
            </div>--> 
              <!--<div class="rou_panel_main">
			<div class="rou_panel_img" align="center">
            <a title="Track Driver History" href="tracking_history.php" target="_blank" ><img alt="Track Driver History" border="0" src="../graphics/tracking-history.png" height="40" width="40"></a></div>
            <div class="rou_text">Track Driver History</div>
            </div> 
              <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"> <a title="Track All Drivers" href="hits-map-all-drivers-location.html"  target="_blank"><img alt="Track All Drivers" border="0" src="../graphics/googlemaps.png"></a></div>
                <div class="rou_text">Vehicle Tracking</div>
              </div>
              <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"> <a title="Refresh Drivers Assigment State" href="#" onclick="resetstate()"><img alt="Refresh Drivers Assigment State" border="0" src="../graphics/refresh.png"></a> </div>
                <div class="rou_text">Refresh Drivers Assigment State</div>
              </div>-->
              <div class="rou_panel_main">
                <div class="rou_panel_img" align="center"> <a title="NEXT DAY SCHEDULE" href="nextdaygrid.php?st=9" target="_blank" ><img alt="NEXT DAY SCHEDULE" border="0" src="../graphics/nextday.png"></a> </div>
                <div class="rou_text">Next Day Schedule</div>
              </div>
          
            
            
            <!--<a title="Next Day Schedule" href="" target="_blank" >NEXT DAY SCHEDULE</a>--></td>
        </tr>
        <tr>
          <td><div id="search_form">
              <form name="frm_sheet" action="index.php" method="post" id="frm_sheet">
                <!--<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >
                  <tr>
                    <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                  </tr>
                  <tr>
                    <td width="6%" align="left" valign="top" class="labeltxt"><strong>Date:</strong></td>
                    <td width="21%" align="left" valign="top"><input type="text" name="sdate" id="sdate" class="inputTxtField  required"/>
                      &nbsp;
                      <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
                        <div class="suggestionList" id="autoSuggestionsList1"> &nbsp; </div>
                      </div></td>
                    <td width="73%" colspan="2" align="left" valign="top" class="labeltxt"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                </table>-->
              </form>
            </div></td>
        </tr>
      <!--  <tr>
          <td height="19" align="center" class="admintopheading">ROUTING PANEL MANAGEMENT </td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr>
                <td align="left" class="label_txt_heading"><strong>Routing Sheet</strong></td>
                <td  align="left" class="label_txt_heading"><strong>Uploaded By</strong></td>
                <td  align="left" class="label_txt_heading"><strong>Last Uploaded</strong></td>
                <td  align="left" class="label_txt_heading"><strong>Download </strong></td>
                <td  align="left" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop=$vehdetail}
              {if $vehdetail[q].file_name neq ''}
              <tr valign="top" bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="left" valign="middle"><b>{$vehdetail[q].file_name}</b></td>
                <td align="left" valign="middle">{$vehdetail[q].admin_name}</td>
                <td align="left" valign="middle">{$vehdetail[q].timed}&nbsp;&nbsp;{$vehdetail[q].dated|date_format}</td>
                <td align="center" valign="middle"><a href="../routing-sheets/{$vehdetail[q].sheet_name}"><img src="../images/download_icon.png" border="0"></a></td>
                <td align="center" valign="middle"> {if $vehdetail[q].state eq '1'} <a href="grid.php?id={$vehdetail[q].sheet_id}&st=5&ad=0" title="View">View</a>&nbsp;&nbsp;
                  
                  {/if} <a href="#" onclick="return deleteRec('{$vehdetail[q].sheet_id}');" title="Remove"><img alt="Remove" border="0"  src="../graphics/delete.png" /></a> {if $vehdetail[q].blast neq '1'} <a href="e-blast.php?id={$vehdetail[q].sheet_id}"><img alt="Blast Email" title="Blast Email" border="0"  src="../images/email.png" /></a> {/if}
                  
                  
                  
                  {if $vehdetail[q].sms neq '1'} <a href="sms.php?id={$vehdetail[q].sheet_id}"><!--<img alt="Blast SMS" title="Blast SMS" border="0"  src="../images/email.png" />--><img src="../images/sms.png" alt="" border="0" style="margin-top:3px;"/></a> {/if} </td>
              </tr>
              {/if}
              
              {sectionelse}
              <tr>
                <td colspan="9" align="center"><b>NO RECORD FOUND</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center">{$pages}</td>
        </tr>-->
      </table></td>
  </tr>
</table>



	 

{ include file = innerfooter.tpl}

