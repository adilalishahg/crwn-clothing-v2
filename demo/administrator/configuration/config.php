<?php







	$rootPath =$_SERVER['DOCUMENT_ROOT']."/";















	error_reporting(E_ERROR | E_CORE_ERROR | E_COMPILE_ERROR);







	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);







	ini_set("display_errors","on");















	$adminPrefix			= "../";					//admin prefix.







	$sizeLimit = 1500000;





















//FOR TEST SERVER KEYSTONE



		
		$dbname 	= "localhost";				//host name.
		$dbuser 	= "rubyhits_rubyhit";	  	//database user.
		$dbpasswd 	= "yfKDVjkbll1";		//database passwd.
		$dbs		= "rubyhits_rubyhit";		//database name.		



# defines Working times







define("STIME","00:00:00");







define("ETIME","23:59:59");















	define('ABSPATH', dirname(__FILE__).'/');	







define("TBL_ADMIN","admin");







define("TBL_CONTENTS","contents");







define("TBL_COUNTRIES","countries");







define("TBL_HOSPITALS","hospitals");







define("TBL_TESTIMONIALS","testimonials");







define("TBL_COPY_RIGHTS","copy_rights"); 







define("TBL_REQUESTS","requests");







define("TBL_FORMS","request_info");







define("TBL_REOCCURENCE","recurring");







define("TBL_CM","casemanagers");







define("TBL_CONTACT","contact_info");







define("TBL_VEHICLES","vehicles");







define("TBL_VEHTYPES","vehtype");







define("TBL_DRIVERS","drivers");







define("TBL_MNTNCE","maintenance");







define("TBL_MENTYPES","mentype");







define("TBL_DRVTYPES","drivertype");















define("TBL_DVMAPPING","dv_mapping");







define("TBL_FUELLOG","fuellog");







define("TBL_TRIPLOG","triplog");







define("TBL_TRIPS","trips");







define("TBL_TRIP_DET","trip_details");







define("TBL_SHEET","sheets");







define("TBL_TCKT","tickets");















define("TBL_SEO","seo");







define("TBL_STATES","states");







define("TBL_ATNDS","attendance");







define("TBL_RATING","rating");







define("TBL_ALOG","activity_log");







define("TBL_RATES","rates");



define("TBL_CREDIT_CARD","credit_card");







define("TBL_ACCNTTYPES","accnttype");



define("TBL_EMAIL","email");



define("TBL_ADDRESS","address");

define("TBL_PROGRAM","program_types");



?>



