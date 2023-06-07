<?php /* Smarty version 2.6.12, created on 2022-07-21 12:51:02
         compiled from footerlast.tpl */ ?>
    <div class="topfooter">

<div class="wrap">

<div class="group">

<div class="grid-3 topfooterleft">
<p><span><?php echo $this->_tpl_vars['contactinfo']['title']; ?>
</span></p>
<p><?php echo $this->_tpl_vars['contactinfo']['address']; ?>
, <?php echo $this->_tpl_vars['contactinfo']['city']; ?>
, <?php echo $this->_tpl_vars['contactinfo']['state']; ?>
 <?php echo $this->_tpl_vars['contactinfo']['zip']; ?>
</p>
<p><strong>Phone:</strong> <?php echo $this->_tpl_vars['contactinfo']['phone']; ?>
 <strong>E-mail:</strong> <a href="mailto:<?php echo $this->_tpl_vars['contactinfo']['email']; ?>
"><?php echo $this->_tpl_vars['contactinfo']['email']; ?>
</a></p>
</div>

<div class="w-row">
          <div class="w-col w-col-8 w-col-stack">
            <p class="nobot"  style="color:#FFF;">&copy 2020 <?php echo $this->_tpl_vars['contactinfo']['title']; ?>
. Powered by <a href="https://www.hybriditservices.com/" target="_blank">Hybrid IT Services</a></p>
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
  <?php echo '
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
				if(data.length > 0) {	//document.getElementById(\'alerts\').innerHTML = (data);
				$("#alerts").append(data);
				}   
		   });
			}	*/
</script>   
  '; ?>

</body>
</html>