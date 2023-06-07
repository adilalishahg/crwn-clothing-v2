 {literal}
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
.val {font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333; text-align:left;}
.admintopheading {
    background-color: #45afd4;
    font-size: 13px;
    font-weight: bold;
    color: #ffffff;
    height: 26px;
    padding-top: 3px;
    padding-left: 5px;
	text-align:left;
}	
    </style>
{/literal}
<div align="left">
  <div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
  
<table border="0" cellspacing="1" cellpadding="1" width="100%">
      <tr >
        <td class="tde" width="30%"  valign="top"><p class="style4">&nbsp; <a href="http://{$contact.0.url}"><img src="../images/logo.png" border="0" height="60px" width="100px"></a></td>
        <td class="tde" valign="top"  width="45%" align="center"><b>{$contact.0.title},<br />
          {$contact.0.address}, <br />
          {$contact.0.city}, {$contact.0.state}, {$contact.0.zip} <br />
          TEL:{$contact.0.phone}</b></td>
        <td class="tde" valign="top"  width="10%"><strong></strong></td>
        <td colspan="3" width="25%" align="right" valign="bottom">{$today|date_format:"%m/%d/%Y %H:%M"}</td>
      </tr>
   
 <!--<tr><td colspan="6" style="height:20px;"></td></tr>-->
 <tr><td colspan="6">
 <table width="100%" border="0">
  <tr>
    <td colspan="5"  class="admintopheading" style="text-align:center">Pay Period Summary<br/>
    Period: {$pstart|date_format}  -- {$pend|date_format}<br/>
    Driver Name: {$driverinfo.fname} {$driverinfo.lname}<br/><br />Hour Rate: $ {$totaldata.0.hrate|string_format:"%.2f"}  | Incentive Per Mile: $ {$totaldata.0.per_mile|string_format:"%.2f"}  | Incentive Per Run:  $ {$totaldata.0.per_run|string_format:"%.2f"} </td>
  </tr>
  <tr>
    <td class="admintopheading" style="font-size:12px;" width="5%" >#</td>
    <td class="admintopheading" style="font-size:12px;" width="20%" >Day</td>
    <td class="admintopheading" style="font-size:12px;" width="12%" >Total Hours</td>
    <!--<td class="admintopheading" style="font-size:12px;" width="9%" >$ Daily Amount</td>
   	<td class="admintopheading" style="font-size:10px;" width="10%" >Over Time</td>
    <td class="admintopheading" style="font-size:10px;" width="10%" >Over Time Amount</td>-->
    <td class="admintopheading" style="font-size:12px;" width="6%" >Total Miles</td>
    <!--<td class="admintopheading" style="font-size:10px;" width="10%" >Miles Incentive</td>-->
    <td class="admintopheading" style="font-size:12px;" width="6%" >Total Run</td>
    <!--<td class="admintopheading" style="font-size:10px;" width="10%" >Run Incentive</td>
    <td class="admintopheading" style="font-size:10px;" width="10%" >Total Amount</td>-->
  </tr>
  {section name=q loop = $data}
  <tr style="line-height:20px;" bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
    <td class="val">{$smarty.section.q.iteration}</td>
    <td class="val">{$data[q].dated|date_format:"%A"} {$data[q].dated|date_format:"%D"}</td>
    <td class="val">{$data[q].total_time}</td>
   <!-- <td class="val">$ {$data[q].hourpayment}</td>
    
    <td class="val">{$data[q].over_time}</td>
    <td class="val"></td>-->
  	<td class="val">{$data[q].tmiles|string_format:"%.2f"}</td>
    <!--<td class="val">{$data[q].milesinsentive}</td>-->
    <td class="val">{$data[q].runs}</td>
   <!-- <td class="val">{$data[q].runinsentive}</td>
    <td class="val">{$data[q].dayamount}</td>-->
  </tr>
  {/section}
  <tr>
    <td colspan="5">&nbsp;</td>
  </tr>
  <tr>	<td class="admintopheading"  colspan="2">Description</td>
  		<td class="admintopheading"  colspan="2">Total</td>
        <td class="admintopheading"  colspan="">Amount</td></tr>
  <tr>	<td class="val"  colspan="2">Week Hours</td>
  		<td class="val" colspan="2">{$totaldata.0.totaltime}</td>
        <td class="val" colspan="">$ {$totaldata.0.totalhourpayment|string_format:"%.2f"}</td></tr>
  <tr>	<td class="val"  colspan="2">Over Time Hours</td>
  		<td class="val" colspan="2">{$totaldata.0.totalovertime}</td>
        <td class="val" colspan="">$ {$totaldata.0.totalovertimepayment|string_format:"%.2f"}</td></tr> 
  <tr>	<td class="val"  colspan="2">Miles Incentive</td>
  		<td class="val" colspan="2">{$totaldata.0.miles}</td>
        <td class="val" colspan="">$ {$totaldata.0.totalmilesinsentive|string_format:"%.2f"}</td></tr> 
  <tr>	<td class="val"  colspan="2">Runs Incentive</td>
  		<td class="val" colspan="2">{$totaldata.0.runs}</td>
        <td class="val" colspan="">$ {$totaldata.0.totalruninsentive|string_format:"%.2f"}</td></tr>
  <tr><td colspan="6"><hr/></td></tr>
  <tr>	<td class="admintopheading"  colspan="4">Payable Amount Before Tax Deduction</td>
        <td class="admintopheading" colspan="">$ {$totaldata.0.payableamount|string_format:"%.2f"}</td></tr>                        
  
  <tr>
    <!--<td class="admintopheading"  colspan="2">Total</td>
    <td class="admintopheading" >{$totaldata.0.totaltime}</td>
    <td class="admintopheading" >$ {$totaldata.0.totalhourpayment|string_format:"%.2f"}</td>
   	<td class="admintopheading" >{$totaldata.0.totalovertime}</td>
    <td class="admintopheading" >$ {$totaldata.0.totalovertimepayment|string_format:"%.2f"}</td>
    <td class="admintopheading" >{$totaldata.0.miles}</td>
    <td class="admintopheading" >$ {$totaldata.0.totalmilesinsentive|string_format:"%.2f"}</td>
    <td class="admintopheading" >{$totaldata.0.runs}</td>
    <td class="admintopheading" >$ {$totaldata.0.totalruninsentive|string_format:"%.2f"}</td>
    <td class="admintopheading" >$ {$totaldata.0.payableamount|string_format:"%.2f"}</td>-->
  </tr>
</table>
 </td></tr>
 </table>
  </div>
</div>
