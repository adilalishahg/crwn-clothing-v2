    <div class="topfooter">

<div class="wrap">

<div class="group">

<div class="grid-3 topfooterleft">
<p><span>{$contactinfo.title}</span></p>
<p>{$contactinfo.address}, {$contactinfo.city}, {$contactinfo.state} {$contactinfo.zip}</p>
<p><strong>Phone:</strong> {$contactinfo.phone} <strong>E-mail:</strong> <a href="mailto:{$contactinfo.email}">{$contactinfo.email}</a></p>
</div>

<div class="w-row">
          <div class="w-col w-col-8 w-col-stack">
            <p class="nobot"  style="color:#FFF;">&copy 2020 {$contactinfo.title}. Powered by <a href="https://www.hybriditservices.com/" target="_blank">Hybrid IT Services</a></p>
          </div>
          <div class="w-col w-col-8 w-col-stack">
           
          </div>
        </div>
</div>


</div>


</div>
    
  </footer>
  <!--END FOOTER -->
  <!--JQUERY SCRIPTS -->
  {literal}
  <script type="text/javascript" src="js/modernizr.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js"></script>
  <script>
    WebFont.load({
      google: {
        families: ["Open Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic"]
      }
    });
  </script>
  <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<!--  <script src="js/jquery.min.js"></script>
-->  <script src="js/bootstrap.min.js"></script>
  <!--[if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif]-->
  <script type="text/javascript" src="js/jquery-moutheme.js"></script>
 <!-- <script type="text/javascript" src="js/default.js"></script>-->
<script type="text/javascript" src="js/main.js"></script>
  <script type="text/javascript" src="js/lightbox.min.js"></script>
  <script type="text/javascript" src="js/form.js"></script>
  <script type="text/javascript" src="js/jquery.mixitup.min.js"></script>
<!--  <script type="text/javascript" src="js/jquery.stellar.js"></script>
-->  <script src="js/jquery.datetimepicker.js"></script>
  <link rel="stylesheet" type="text/css" media="screen" href="css/jquery.datetimepicker.css">
 <script>
//setInterval ( "bringalerts()", 350000);
/*function bringalerts(){
				$.post("bringalerts.php", {not: ""+1}, function(data){  //alert(data);
				if(data.length > 0) {	//document.getElementById('alerts').innerHTML = (data);
				$("#alerts").append(data);
				}   
		   });
			}	*/
</script>   
  {/literal}
</body>
</html>