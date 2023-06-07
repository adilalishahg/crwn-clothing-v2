<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script type="text/javascript" src="../scripts/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../scripts/jquery-ui-1.8.2.custom.min.js"></script>
<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>
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
		 
			   $('a[rel*=mypopup]').mypopup();
			   
			   $(document).bind('reveal.mypopup', function(){
                   $('#mypopup').draggable();
                  }); 
				  
				  $(document).bind('reveal.mypopup2', function(){
                   $('#mypopup2').draggable();
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

    $('#addvehicle').validate();

    $('#editvehicle').validate();

    $('#add-driver').validate();

    $('#editdrv').validate();

    $('#add-admuser').validate();

    $('#edit-admuser').validate();		
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
<!--<style type="text/css">
    #printable { display: block; }
	.pick { background-image: url(../images/pick.gif);}
	.drop { background-image: url(../images/drop.gif);}
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
    </style>-->
 <style type="text/css">
	<!--.pick { background-image: url(../images/pick.gif);}-->
	@keyframes pick_class {
  from { background-color:#ffb3b3; }
  to { background-color: inherit; }
}
	.pick_class {
  -webkit-animation: pick_class 5s infinite; /* Safari 4+ */
  -moz-animation:    pick_class 5s infinite; /* Fx 5+ */
  -o-animation:      pick_class 5s infinite; /* Opera 12+ */
  animation:         pick_class 5s infinite; /* IE 10+ */
}

	@keyframes drop_class {
  from { background-color:#b3ff99; }
  to { background-color: inherit; }
}
	.drop_class {
  -webkit-animation: drop_class 5s infinite; /* Safari 4+ */
  -moz-animation:    drop_class 5s infinite; /* Fx 5+ */
  -o-animation:      drop_class 5s infinite; /* Opera 12+ */
  animation:         drop_class 5s infinite; /* IE 10+ */
}   
</style>
<script type="text/javascript">
		var formSeprate;	
		var ar = new Array();	
		var formSepratepu;	
		var puar = new Array();				
function fetchdata()
{		$.post("../pop_up/fetchdata.php", {sheetid: ""+1}, function(data){
			if(data.length > 0)
			{    //alert('In');
				var fetchedData = data;
				formSeprate = fetchedData;	
			}   
		});
	$.post("../pop_up/fetchdataup.php", {sheetid: ""+1}, function(data1){
			if(data1.length > 0){
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
	{ $('#'+id).addClass("drop");
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
$('#'+id).addClass("pick");
		}
}

	//setInterval ( "fetchdata()", 80000);
	//setInterval ( "arr(); arrpu();", 20000);
</script>
{/literal}
</head>
<body>
<div  style="width:100%;" >
<!-- start of inter container -->
<div  id="wrapper_inner" style="width:100%;">
<div id="content_wrapper" style="width:99%;">
