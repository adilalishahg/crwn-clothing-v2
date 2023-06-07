<?php
   	include_once('DBAccess/Database2.inc.php');
	$db = new Database;	
	$db->connect();
	
	$pday = date("Y-m-d",strtotime("-1 day"));
	
	$Query = "SELECT n.*,ri.clientname,ri.appdate,ri.apptime FROM ".notifications." as n LEFT JOIN request_info as ri on n.reqid=ri.id WHERE ri.appdate > '$pday' AND n.account='".$_SESSION['userdata']['id']."' AND n.recieved='0' ORDER BY n.id ASC LIMIT 1"; 
   if($db->query($Query) && $db->get_num_rows() > 0)
	{	   $data = $db->fetch_one_assoc(); 
	$str='<div class="alert alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                    ×</button>
               <i class="fa fa-check" aria-hidden="true"  style="font-size:24px; color: #999"></i> <strong>Request for the Customer Name: '.$data['clientname'].' on Dated '.convertDateFromMySQL($data['appdate']).' at time '.$data['apptime'].' has been approved.</strong>
                              
            </div>';
	$Qup="UPDATE notifications SET recieved='1' WHERE id = '".$data['id']."'";
	$db->execute($Qup);
	
	print_r($str);
	 }
	// echo 'Salam jana';
	 $db->close();
?>
                    