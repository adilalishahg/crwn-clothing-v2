<?php
$qry_footer  = "SELECT * FROM " .  TBL_COPY_RIGHTS ;
	if($db->query($qry_footer) && $db->get_num_rows() > 0){
		$footer = $db->fetch_all_assoc();
	 }
	 $Query = "SELECT * FROM  ".TBL_RATES;
	if($db->query($Query) && $db->get_num_rows() > 0)
	{
		$rates = $db->fetch_all_assoc();
	}
  /////// Testimonials//////////
	$qry= "SELECT * FROM " .  TBL_TESTIMONIALS."  WHERE publish='1' order by rand()";
	if($db->query($qry) && $db->get_num_rows() > 0){
		$data = $db->fetch_all_assoc();
	 }
	 $testi = $data[0]['message'];
	 $author= $data[0]['fname'].' '.$data[0]['lname'];
	 $foot = $footer[0]['description'];
	 
	 $smarty->assign("testi",$testi);
	 $smarty->assign("author",$author);
	 $smarty->assign("foot",$foot);
?>