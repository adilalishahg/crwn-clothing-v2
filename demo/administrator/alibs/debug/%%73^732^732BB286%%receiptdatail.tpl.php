<?php /* Smarty version 2.6.12, created on 2019-04-24 16:02:04
         compiled from reportstpl/receiptdatail.tpl */ ?>
 <?php echo '
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<style type="text/css">
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
	.tdheight { height:21px; vertical-align:bottom; }
.tde { border-bottom:1px solid #666; }	
.p { width:140px; line-height:14px; text-align:justify; height:auto; margin:0; padding:0; float:left;}
.headus { font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; color:#000;}
.val {font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}	
    </style>
'; ?>

<div align="left">
  <div align="right" id="non-printable" style="width:950px; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
  <div style="text-align:center"><img src="../../receipts/<?php echo $this->_tpl_vars['data']['receipt_path']; ?>
" height="400" width="600"  /></div>

    
     

  </div>
</div>