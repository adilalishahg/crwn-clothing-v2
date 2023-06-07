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
.val {font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}	
    </style>
{/literal}
<div align="left">
  <div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">
<!---->
<table width="100%" border="0" class="main_table">
<!--<tr><td colspan="9"> 
             <img src="../images/logo.png" width="100px" height="60px" border="0" /> <br/><br/>
              </td></tr>-->
<!--<tr>
<td colspan="5"><strong>Provider Name:</strong>________________________________ </td>
<td colspan="5"><strong>WEEK ENDING:</strong>________________________________ </td>
<td colspan="2"><strong>From</strong> - <strong>To :</strong><br/><strong>Total Completed Trips:</strong><br/><strong>Total Miles:</strong></td>
<td colspan="3">{$stdate|date_format:"%m/%d/%Y"} - {$enddate|date_format:"%m/%d/%Y"}<br/>{$st4}<br/>{$tmiles}</td>
</tr>-->

<tr><td colspan="3" width="30%" align="left" style="border-bottom:#000 solid 1px;"  class="headus"><strong>Transportation Provider:</strong> </td>
<td colspan="3" width="30%" style="border-bottom:#000 solid 1px;" class="val"> {$contact.title|upper}</td>
<td colspan="3">&nbsp;</td></tr>

<tr><td colspan="3" align="left" style="border-bottom:#000 solid 1px;" class="headus"><strong>Date of Service:</strong>  </td>
<td colspan="3"  style="border-bottom:#000 solid 1px;" class="val"> {$stdate|date_format:"%m/%d/%Y"} - {$enddate|date_format:"%m/%d/%Y"}</td>
<td colspan="3">&nbsp;</td></tr>

<tr><td colspan="3" align="left" style="border-bottom:#000 solid 1px;" class="headus"><strong>Driver's License Number:</strong>  </td>
<td colspan="3"  style="border-bottom:#000 solid 1px;" class="val"> {$data.0.license}</td>
<td colspan="3">&nbsp;</td></tr>

<tr><td colspan="3" align="left" style="border-bottom:#000 solid 1px;" class="headus"><strong>Vehicle ID Number (VIN, Last five digits:</strong>  </td>
<td colspan="3"  style="border-bottom:#000 solid 1px;" class="val"> {$dataV.vin|substr:-5}</td>
<td colspan="3">&nbsp;</td></tr>
<tr><td colspan="9">
<table width="100%" border="1" cellspacing="0">
  <tr>
   
    <td style="text-align:center"  width="5%">MTM Trip Number</td>
    <td style="text-align:center"  width="15%">Beneficiary Printed Name</td>
    <td style="text-align:center" width="5%">Scheduled<br/>Pickup Time</td>
    <td style="text-align:center" width="5%">Pickup<br/>Arrival</td>
    <td style="text-align:center" width="5%">Pickup<br/>Departure</td>
	<td style="text-align:center" width="5%">Drop off<br/>Time</td>
    
    
    
    
    
    <td style="text-align:center" width="5%">Pickup<br/>Odometer</td>
    <td style="text-align:center" width="5%">Drop Off<br/>Odometer</td>
    <td style="text-align:center" width="20%">Recipient's Signature</td>
    
  </tr>
  {section name=q loop=$data}
  <tr>
  	<td style="text-align:center">{$data[q].ccode}</td>
    <td style="text-align:center">{$data[q].trip_user}</td>
    <td style="text-align:center">{if $data[q].pck_time eq '00:00:00'}--:--{else}{$data[q].pck_time}<!-- {$data[q].pck_time|date_format:"%p"}-->{/if}</td>
    <td style="text-align:center">{$data[q].arrived_time|date_format:"%H:%M:%S"}</td>
    <td style="text-align:center">{if $data[q].aptime eq '00:00:00'}--:--{else}{$data[q].aptime}<!-- {$data[q].pck_time|date_format:"%p"}-->{/if}</td>
    <!-- <td style="text-align:center">{$data[q].date|date_format:"%m/%d/%Y"}</td>-->
    <td style="text-align:center">{if $data[q].drp_time eq '00:00:00'}--:--{else}{$data[q].drp_time}<!-- {$data[q].pck_time|date_format:"%p"}-->{/if}</td>
   
    
    <!--<td style="text-align:center">{if $data[q].drp_atime eq '00:00:00'}--:--{else}{$data[q].drp_atime}{/if}</td>-->
    
    <td style="text-align:center">{$data[q].startmilage}</td>
    <td style="text-align:center">{$data[q].endmilage}</td>
    <td style="text-align:center">{if $data[q].signature neq ''}<img src="../../iphone/signature/{$data[q].signature}" width="100" height="50" />{/if}</td>
    
  </tr>
  
<!-- {if $smarty.section.q.iteration%3==0}  <br/><br/><br/><br/><br/><br/><br/><br/><br/>
  {/if}--> 
  
  {/section}
</table>


</td></tr>
              <tr><td colspan="9"><br/><hr/>
              </td></tr>
              <tr><td colspan="10"  style="text-align:left" valign="top">
 Each leg of the transport must be documented on separate lines. A signature is required for each leg of the transport. <strong>All times must be documented using military time format.</strong> No shows will be indicated with NS in the Drop-Off Time.
 
<br/><br/>
<strong>I certify that all information contained herein is true and accurate, and understand that this statement is made subject to the applicable penalties under federal and state law for making false declarations.</strong>
</td></tr> 
<tr><td colspan="6" style="text-align:left; padding-left:1px; border-bottom:#000 solid 1px;">

<strong>DRIVER'S SIGNATURE:</strong>   {if $data.0.drsignature neq ''}<u><img src="../{$data.0.drsignature}" width="120" height="60" /></u>{/if}
</td></tr>
<tr><td colspan="6" style="text-align:left; padding-left:1px; border-bottom:#000 solid 1px;"><br/>
<strong>DRIVER'S PRINTED NAME:</strong> {$data.0.name}	
</td></tr>  </table>


  </div>
</div>

