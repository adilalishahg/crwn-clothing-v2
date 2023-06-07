<?php

	session_start();







 echo"";







   $parts = pathinfo($_SERVER["SCRIPT_NAME"]);







   $part2 = dirname($parts['dirname']);















    $Xplode = explode('administrator',$part2);







    $size   = sizeof($Xplode);







  







    if($size == 1)







    {







     $path = '';







    }







	else if($size > 1){







     $path = '../';







    }







	else{







     $path = '';







    }







  







    include_once($path."configuration/config.php");







	//include_once("file:///D|/wamp/www/HTT_temp/administrator/commonfunctions.php");







    $path."alibs/Smarty.class.php";















	include_once($path."alibs/Smarty.class.php");







	$smarty = new Smarty();	







	$smarty->template_dir = $path."atpls";







	$smarty->compile_dir = $path."alibs/debug";







	$smarty->plugins_dir = array($path.'alibs/plugins');		





	if(!isset($_SESSION['allowUser'])){







	//header("Location: ".$path."login.php");















    echo '<script>location.href="'.$path.'login.php";</script>';







	exit;







	}	















	







	







	$file		= $_SERVER["SCRIPT_NAME"];







	$break		= Explode('/', $file);				//Exploding it with '/'.







	$scriptName	= $break[count($break) - 1];		//Getting the script name.















    define('DB_DSN','mysql:host=172.16.0.3;dbname=HTT1');







	define("DB_NAME",$dbs);







	define("DB_HOST",$dbname);







	define("DB_USER",$dbuser);







	define("DB_PASS",$dbpasswd);







	//include_once("file:///D|/wamp/www/HTT_temp/administrator/DBAccess/util.php");























	$dbObject = new Database();







	$dbObject->connect();







	$dbObject->close();







	







	//These are the mail administrators.







	//$administrators = $dbObject->executeScalar("Select email from admin_emails where type=2");























	class Database{







		







		var $rs=0;







		







		var $dbh;







    	var $database_name;







    	var $database_host;







    	var $database_user;







    	var $database_pass;







		







		//Create Class Object				







		function Database(){







			$database_name = DB_NAME;







        	$database_host = DB_HOST;







        	$database_user = DB_USER;







        	$database_pass = DB_PASS;







    







        	$this->database_name = $database_name;







        	$this->database_host = $database_host;







        	$this->database_user = $database_user;







        	$this->database_pass = $database_pass;







        	return 1;







		}		







		







		//Create New Database







		function create_db () {







     	   $database_name = $this->database_name;







	        return mysql_create_db($database_name);







    	}







    	







    	







		//Select Database







	     function select_db () {







     	   $database_name = $this->database_name;







	        return mysql_select_db($database_name);







	    }







	    







	    //Connect to Database







	    function connect () {







     	   $host = $this->database_host;







           $username = $this->database_user;







           $password = $this->database_pass;







           $this->dbh = mysql_connect($host, $username, $password);







           $this->select_db();







           return $this->dbh;







    	}	







    	







		//Query Database and Return Resource (For Selection Purpose)







		function query($sql){







			//print "<br> Temporary Shown: Be Patiences ... " . $sql;















			$this->rs=mysql_query($sql,$this->dbh);			







			if($this->rs){







				return true;







			}			







			else {







				echo "<BR>" . mysql_error() . "-->  $sql<BR>";	







				$_ip__ = $_SERVER['REMOTE_ADDR'];







				$HOST = $_SERVER['HTTP_HOST']; 







				$URI = $_SERVER['REQUEST_URI']; 







				







				$emsgyz = mysql_error() . " FOR " . $sql . "/r/n/r/n AT $HOST$URI BY $_ip__"; 







				//@mail("","Error inside ShopCart: - AdminSelect",$emsgyz,"From:checkit@checklist.com");







				















				return false;







			}







		}







		







		//Query Database and Return True/False (For Insert/Update/Delete)







		function execute($sql){







			//print "<br> Temporary Shown: Be Patiences ... " . $sql;















			if(mysql_query($sql,$this->dbh)){







				return true;







			}







			else {







				echo "<BR>" . mysql_error() . "-->$sql<BR>";	







				$_ip__ = $_SERVER['REMOTE_ADDR'];







				$HOST = $_SERVER['HTTP_HOST']; 







				$URI = $_SERVER['REQUEST_URI']; 







				







				$emsgyz = mysql_error() . " FOR " . $sql . "/r/n/r/n AT $HOST$URI BY $_ip__"; 







				//@mail("","Error inside ShopCart: - AdminExecute",$emsgyz,"From:checkit@checklist.com");







				















				return false;







			}		







			return false;					







		}







		







		//Fetch Single Record







		function fetch_row(){







			return mysql_fetch_row($this->rs);







		}







		//Fetch Single Record associative







		function fetch_row_assoc(){







			return mysql_fetch_assoc($this->rs);







		}		







		







		//Fetch All Records







		function fetch_all(){







			$ret= array();







			$num = $this->get_num_rows();







			







			for($i=0;$i<$num;$i++){







				array_push($ret,$this->fetch_row());







			}		







			return $ret;







		}







		







		//Fetch Number of Rows Returned







		function get_num_rows(){







			if($this->rs)







				return mysql_num_rows($this->rs);







			else







				return 0;







		}







		







		//Move in Rows One by One







		function move_to_row($num){







			if($num>=0 && $this->rs){







				return mysql_data_seek($this->rs,$num);







			}







			return 1;







		}											







		







		//Fetch Number of Columns.







		function get_num_columns(){







			return mysql_num_fields($this->rs);







		}







					







		







		//Fetch Column Names					







		function get_column_names(){







			$nofields= mysql_num_fields($this->rs);







			$fieldnames=array();







			for($k=0;$k<$nofields;$k++)







			{







				array_push($fieldnames,mysql_field_name($this->rs,$k));







			}







			return $fieldnames;







		}			







		







		//Fetch Last Error Produced by MySql (Use for debuging purpose)







		 function debug () {







     	   echo mysql_errno().": ". mysql_error ()."";







   		 }







   		







		







		//Fetch List of All Db Tables







    	function list_tables () {







     	   $database_name = $this->database_name;







        	return mysql_list_tables($database_name);







    	}







    	







    	 //Fetch MySql Recent Inserted Id







   		 function insert_id () {







     	   return mysql_insert_id ();







    	}







    	







    	//Fetch Records as an Array    	







    	function fetch_array ($res) {







          return mysql_fetch_array ($res);        







    	}







    	







    	//Fetch all record as an Associative Array







    	function fetch_all_assoc(){







			$ret= array();







			while ($row = mysql_fetch_assoc($this->rs)) {







				array_push($ret,$row);







			}					







			return $ret;







		}







		







		//Fetch single record as an Associative Array







		function fetch_one_assoc(){







			$ret= array();







			$ret = mysql_fetch_assoc($this->rs);







			return $ret;







		}







							







		//Fetch one cell from given query







		function  executeScalar($sql){







			$this->query($sql);







			$row = $this->fetch_row();







			return $row[0];







		}







		







		//Fetch 2 cell from given query







		function  executeTwise($sql){







			$this->query($sql);







			$row = $this->fetch_row();







			$temp = array();







			$temp[0] =  $row[0];







			$temp[1] =  $row[1];







			return $temp;







		}







		







		//Close Database Connection







    	function close(){







			mysql_close($this->dbh);







		}		







			







	}// End of class







		function  checkEmail($email) {







		 if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {















		  return true;







		 }else{ return false; }







		}















	// Utility Functions			







	function sql_replace($str){







		$str2 = stripslashes($str);		







		//return mysql_real_escape_string($str2);		







		return mysql_real_escape_string($str2);		







	}















   //Convert time from AM/PM to 24hoours







   function convertTimeToMySQL($str){







     $str2 = date('H:i:s', strtotime($str));







     return $str2;







   }







   







   //Convert time from 24hoours to AM/PM







   function convertTimeFromMySQL($str){







     $str2 = date("g:i A", strtotime($str));;







     return $str2;







   } 















   //Convert date from mm/dd/yy to yy/mm/dd







   function convertDateToMySQL($str){







     $str2 = explode('/',$str);







      //$yr = date('y');







	  //if($str2[2] > $yr){ $year = '19'.$str2[2]; }else{ $year = '20'.$str2[2]; }







      return $str2[2].'-'.$str2[0].'-'.$str2[1];







   }







   







   //Convert date from yy/mm/dd to mm/dd/yy







   function convertDateFromMySQL($str){







     $str2 = explode('-',$str);







     return $str2[1].'/'.$str2[2].'/'.$str2[0];







   } 







	







	















	function verify($var, $link)







	{







		if(isset($var) && $var!= '')







		{







			return true;







		}







		else







		{







			if($lin!='')







			{







				@header("Location:$link");







				return false;







			}







		}







	}	







	







	function debug($array)







	{







		echo "<pre>";







		print_r($array);







		exit;







	}







	function get_server_time()







	{







		$db = new Database;	







		$db->connect();







		$qtime = $db->query('SELECT NOW() AS tym');







		$get = $db->fetch_one_assoc();







		$xp = explode(' ',$get['tym']);







		$date = $xp[0];







		//$time = $xp[1];







		$time1 = explode(':',$xp[1]);







		$timehr=$time1[0]-2;







		$timemin=$time1[1]+3;







		if($timemin>60)







		{







			$diff = $timemin-60;







			$timehr+1;







			$timemin = $diff;







		}







		$timesec=$time1[2];







		







		$time=$timehr.":".$timemin.":".$timesec;







		$data = array($time, $date);







		return $data;







	}







	function log_me()







	{







		$db = new Database;	







		$db->connect();







		if(verify($_SESSION['admuser']['admin_id'],"") )







		{







			if($_SESSION['admuser']['admin_level']!='0')







			{







				$user = $_SESSION['admuser']['admin_id'];







				$url ="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];







				 $qtime = $db->query('SELECT NOW() AS tym');







				 $get = $db->fetch_one_assoc();







				 $xp = explode(' ',$get['tym']);







				 $date = $xp[0];







				 $time=$xp[1];		







				$logQuery = "INSERT INTO  ".TBL_ALOG." SET







																		link = '$url',







																		time = '$time',







																		date = '$date',







																		user = '$user'";







				if($db->query($logQuery))







				{







					return true;







				}







				else







				{







					return false;







				}







			}







		}







		$db->close();







	}
$db = new Database;	
$db->connect();
$query = "SELECT * FROM ".TBL_CONTACT;
    if($db->query($query) && $db->get_num_rows() > 0){$udata = $db->fetch_one_assoc();}
	date_default_timezone_set($udata['time_zone']);
	define("GEOCODE",$udata['google_coordinates']);
	 $st = $udata['st'];	
	  $_SESSION['st'] = $st;
$db->close();
log_me();
