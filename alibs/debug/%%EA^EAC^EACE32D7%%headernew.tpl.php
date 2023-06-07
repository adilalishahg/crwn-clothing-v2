<?php /* Smarty version 2.6.12, created on 2023-03-31 23:23:55
         compiled from headernew.tpl */ ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<!-- SITE TITTLE -->
<meta charset="utf-8">
<title><?php echo $this->_tpl_vars['pg']; ?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="generator" content="HTML5 Template">
<!-- CSS STYLE -->
<link rel="stylesheet" type="text/css" href="css/newcss/normalize.css">
<link rel="stylesheet" type="text/css" href="css/newcss/base.css">
<link rel="stylesheet" type="text/css" href="css/newcss/style.css">
<link rel="stylesheet" type="text/css" href="css/newcss/fontawesome-all.min">
<link rel="stylesheet" type="text/css" href="css/newcss/lightbox.css">
<link rel="stylesheet" type="text/css" href="css/newcss/tooltipster.css">
<link rel="stylesheet" type="text/css" href="css/newcss/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<!-- FAVICON -->
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
<!-- MOBILE ICON -->
</head>
<?php echo '
<style>
td,th{
	padding: 1em;
}
input{
	width: 15em;
}
table{
	border: solid 3px #A40026;
}
.redbar {
	height: 20px;
	background-color: #000;
}
.submain {
	margin-top: 35px;
	padding-top: 50px;
	clear: both;
	padding-bottom: 25px;
	background-color: white;
	position: relative;
}
.submain:before {
	content: \'\';
	position: absolute;
	left: 0;
	top: -22px;
	width: 100%;
	height: 35px;
	background: #000;
	-webkit-transform: skewY(0.75deg);
	-moz-transform: skewY(0.75deg);
	-ms-transform: skewY(0.75deg);
	-o-transform: skewY(0.75deg);
	transform: skewY(0.75deg);
	-webkit-backface-visibility: hidden;
	z-index: -9999999999999999999999;
}
header[role=banner] {
	padding-top: 25px;
	padding-bottom: 25px;
}
@media screen and (min-width: 480px) {
.wrap {
 width: 98%;
}
}
@media screen and (min-width: 640px) {
.grid-2.no-margin:nth-child(n) {
 margin-bottom: 0;
 margin-right: 0;
}
}
 @media screen and (min-width: 1065px) {
header[role=banner] *[class^="grid"] {
 display: inline-block;
 vertical-align: middle;
 float: none;
}
}
@media screen and (min-width: 640px) {
.grid-2.no-margin {
 width: 33.33333%;
}
}
.wrap {
	max-width: 1170px;
	width: 92%;
	margin: 0px auto;
	position: relative;
}
@media screen and (min-width: 640px) {
.grid-4.no-margin:last-child {
 margin-right: 0;
}
}
@media screen and (min-width: 640px) {
.grid-4.no-margin:nth-child(n) {
 margin-bottom: 0;
 margin-right: 0;
}
}
@media screen and (min-width: 1065px) {
header[role=banner] *[class^="grid"] {
 display: inline-block;
 vertical-align: middle;
 float: none;
}
}
@media screen and (min-width: 640px) {
.grid-4.no-margin {
 width: 66%;
}
}
@media screen and (min-width: 640px) {
.grid-4:last-child {
 margin-right: 0;
}
}
.phone_top{
	color: #414042;
	font-size: 28px;
	font-weight: 300;
	margin-bottom: 16px;
	display: inline-block;
	float: none;
}
.socialicons {
	display: inline-block;
	float: none;
	margin-left: 16px;
}
.fa-stack {
	display: inline-block;
	height: 2em;
	line-height: 2em;
	position: relative;
	vertical-align: middle;
	width: 2em;
}
.facebook a {
	color: #3b5998;
}
.fa-stack-1x {
	line-height: inherit;
}
.fa-stack-1x, .fa-stack-2x {
	left: 0;
	position: absolute;
	text-align: center;
	width: 100%;
}
.fa, .far, .fas {
	font-family:"Font Awesome 5 Free";
}
@media screen and (min-width: 480px) {
.wrap {
 width: 98%;
}
}
.wrap {
	max-width: 1170px;
	width: 92%;
	margin: 0px auto;
	position: relative;
}
/*! Header
//////////////////////////////////////////////*/

header[role=banner] {
	padding-top:25px;
	padding-bottom:25px;
}
header[role=banner] nav[role=navigation] {
	display: none;
}
 @media screen and (min-width: 640px) {
 header[role=banner] nav[role=navigation] {
 display: block;
}
 header[role=banner] nav[role=navigation] ul {
 margin-top:16px;
}
 header[role=banner] nav[role=navigation] ul li {
 display:inline-block;
 margin-left:8px;
 margin-right:8px;
 color:#414042;
 font-size:13px;
 text-transform:uppercase;
 vertical-align: middle;
 text-align:center;
 font-weight:bold;
}
 header[role=banner] nav[role=navigation] ul li i {
 font-weight:bold;
}
 header[role=banner] nav[role=navigation] ul li a {
 color:#414042;
}
 header[role=banner] nav[role=navigation] ul li ul li a {
 color:white;
}
}
header[role=banner] nav[role=navigation] ul li:hover ul {
	display:block !important;
}
 @media screen and (max-width: 1100px) {
 header[role=banner] nav[role=navigation] ul li ul {
 width:200px !important;
 margin-left: 20px !important;
}
}
header[role=banner] nav[role=navigation] ul li ul {
	position: absolute;
	padding: .25em 0;
	display: none;
	z-index: 9999999;
	margin-left: -60px;
	margin-top: -5px;
	padding-top: 20px;
	width: 200px;
}
header[role=banner] nav[role=navigation] ul li ul li {
	position: relative;
	z-index: 100;
	-webkit-border-radius: 0;
	border-radius: 0;
	width: 100%;
	font-size: 13px;
	text-align: left;
	background-color: #BE1E2D;
	display: block;
	padding: 6%;
	z-index: 9999999;
	border-bottom: 1px solid white;
	text-align:center;
}
header[role=banner] nav[role=navigation] ul li ul li:last-of-type {
	border-bottom:none;
}
header[role=banner] nav[role=navigation] ul li ul li:hover {
	background-color:#a2202c;
	transition: all 0.5s ease;
}
.mobile__button p {
	display: block;
}
 @media screen and (min-width: 640px) {
 .mobile__button p {
 display: none;
}
}
.mobile__nav {
	display: none;
}
.mobile__nav ul li ul {
	display: none;
}
.mobile__nav ul li ul li {
	font-size:14px;
	font-weight:bold;
}
.mobile__nav a {
	-webkit-transition: 0.2s ease-in-out;
	-moz-transition: 0.2s ease-in-out;
	-o-transition: 0.2s ease-in-out;
	transition: 0.2s ease-in-out;
	color:#222;
	padding-top:15px;
	padding-bottom:15px;
	border-bottom:1px solid #ececec;
	display:block;
}
.mobile__nav a:hover,  .mobile__nav a:focus {
}
 @media screen and (min-width: 640px) {
 .mobile__nav {
 display: none;
}
}
.redbar {
	height:20px;
	background-color:#000;
}
 @media screen and (min-width: 1065px) {
 .rightheader {
 text-align:right !important;
}
}
.rightheader {
	text-align:right;
}
 @media screen and (min-width: 1065px) {
header[role=banner] *[class^="grid"] {
 display: inline-block;
 vertical-align: middle;
 float: none;
}
}
nav ul, nav ol {
	list-style: none;
	list-style-image: none;
}
.rightheader {
	text-align: center;
}
 @media screen and (min-width: 1065px) {
.rightheader {
 text-align: right !important;
}
}
html, body, iframe, div, section, header, p, a, ul, ol, li, article, footer, h1, h2, h3, h4 {
	margin: 0;
	padding: 0;
}
.topfooter {
	padding-top: 50px;
	clear: both;
	padding-bottom: 25px;
	background-color: #414042;
	position: relative;
}
 @media screen and (min-width: 1065px) {
.topfooterleft {
 text-align: left !important;
 margin-bottom: 0px !important;
}
}
@media screen and (min-width: 640px) {
.grid-3, .grid-half {
 width: 49.24242%;
}
}
@media screen and (min-width: 1065px) {
.topfooter *[class^="grid"] {
 display: inline-block;
 vertical-align: middle;
 float: none;
}
}
.topfooterleft p {
	color: white;
	font-size: 16px;
	margin-bottom: 5px;
}
.topfooterleft p span {
	font-size: 18px;
	font-weight: bold;
}
.topfooterright i {
	display: inline-block;
	vertical-align: middle;
	float: none;
	font-size: 32px;
	color: white;
	margin-right: 16px;
}
.topfooterright p {
	display: inline-block;
	vertical-align: middle;
	float: none;
	font-size: 20px;
	font-weight: bold;
	color: white;
	margin-bottom: 0px;
}
.topfooter p a {
	color: white;
}
a:active, a:hover {
	outline: 0;
}
 @media screen and (min-width: 1065px) {
.topfooterright {
 text-align: right !important;
}
}
</style>
'; ?>

<body>
<!-- START HEADER -->
<div class="redbar"> </div>
<header role="banner">
  <div class="wrap">
    <div class="group">
      <div class="grid-2 logoarea no-margin"> <a href="https://upscaletransport.com/"><img src="images/logo.png" ></a> </div>
      
      <div class="grid-4 rightheader no-margin">
        <p class="phone_top"><?php echo $this->_tpl_vars['contactinfo']['phone']; ?>
</p>
        <div class="socialicons"> </div>
        <nav role="navigation">
          <div class="menu-main-menu-container">
            <ul id="menu-main-menu" class="menu">
              <li id="menu-item-27" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-27"><a href="index.php">Home</a></li>
              
              
              <?php if ($_SESSION['allowUser'] == '1'): ?>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="triprequest.php">REQUEST A TRIP</a></li>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="mytrips.php">REQUEST REPORT</a></li>
              <!--<li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="dispatch_report.php">DISPATCH REPORT</a></li>-->
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130">REPORTS
                  <ul>
                    <li style="color:#FFF; cursor:pointer;"><a href="mytrips.php">REQUEST REPORT</a></li>
                    <li style="color:#FFF; cursor:pointer;"><a href="dispatch_report.php">DISPATCH REPORT</a></li>
                    <li style="color:#FFF; cursor:pointer;"><a href="invoice_report.php">INVOICES REPORT</a></li>
                  </ul>              
              </li>
              <!--
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="mytrips2.php">EXPORT TRIPS</a></li>-->
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="grid.php">TODAY TRIPS</a></li>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="account_profile.php">ACCOUNT PROFILE</a></li>
              <!--<li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="account_profile2.php">SETTING</a></li>-->
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="logout.php">LOG OUT</a></li>
              
              <?php else: ?>
             <!-- <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="triprequest.php">REQUEST A TRIP</a></li>-->
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="login.php">ACCOUNT LOGIN</a></li>
              <!--<li id="menu-item-29" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29"><a href="login.php"> LOGIN</a></li>-->
              <?php endif; ?>
              
              
            </ul>
          </div>
        </nav>
        <div class="mobile-nav">
          <div class="mobile__button">
            <p><span>☰</span></p>
          </div>
          <nav class="mobile__nav">
            <div class="menu-main-menu-container">
              <ul id="menu-main-menu-1" class="menu">
              <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-27"><a href="index.php">HOME</a></li>
              <?php if ($_SESSION['allowUser'] == '1'): ?>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="triprequest.php">REQUEST A TRIP</a></li>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="mytrips.php">REQUEST REPORT</a></li>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="dispatch_report.php">DISPATCH REPORT</a></li>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="invoice_report.php">INVOICES REPORT</a></li>
              <!--<li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="mytrips2.php">EXPORT REPORT</a></li>-->
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="grid.php">TODAY TRIPS</a></li>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="account_profile.php">ACCOUNT PROFILE</a></li>
              <!--<li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="account_profile2.php">SETTING</a></li>-->
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="logout.php">LOG OUT</a></li>
              
              <?php else: ?>
              <li id="menu-item-130" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-11 current_page_item menu-item-130"><a href="login.php">ACCOUNT LOGIN</a></li>
             <!-- <li id="menu-item-29" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-29"><a href="login.php"> LOGIN</a></li>-->
              <?php endif; ?>
              </ul>
            </div>
          </nav>
        </div>
        
      </div>
    </div>
  </div>
</header>
<div class="fullWidthBucket">
  <div class="col-sm-12 col-md-12" id="alerts"> </div>
</div>
<!-- END HEADER --> 
<!-- START SLIDER -->