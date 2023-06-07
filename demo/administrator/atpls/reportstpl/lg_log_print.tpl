 {literal}
<link rel="stylesheet" href="../theme/style.css" type="text/css">
<style type="text/css">
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
	
    </style>
{/literal}
<div align="left">
  <div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>
  <div align="center" id="printable">

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

<!--<tr>


<td colspan="9" align="center"><strong>DRIVER'S NAME:</strong>  {$data.0.name}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
<strong>Vehicle Number:</strong>  {$dataV.vin}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<strong>Driving License Number:</strong>  {$data.0.license}</td>
</tr>-->
<tr>

<td colspan="3" align="center" style="font-size:13px;"  width="35%"><u>{$contact.title|upper}</u><br/>  <strong>PROVIDER NAME</strong> </td>
<td colspan="3" align="center" style="font-size:13px;" width="35%"><u>{$stdate|date_format:"%m/%d/%Y"} - {$enddate|date_format:"%m/%d/%Y"}</u><br/> <strong> WEEK ENDING</strong> </td>
<td colspan="3" width="30%"></td>
</tr>

<tr>

<td colspan="3" align="center"  style="font-size:13px;"><u>{$data.0.name}</u><br/>  <strong>DRIVER'S NAME (as it appears on driver license)</strong> </td>
<td colspan="3" align="center" style="font-size:13px;"><u>{$dataV.vin|substr:-6}</u><br/>  <strong>Vehicle Number (Last six of VIN)</strong> </td>
<td colspan="3"></td><td></td>
</tr>
{literal}
{/literal}
<tr><td colspan="10">
<table width="100%" border="1" cellspacing="0">
  <tr>
    <td style="text-align:center" width="5%">Date of<br/>Service</td>
    <td style="text-align:center"  width="5%">LogistiCare<br/>Job #<br/>A or B</td>
    <td style="text-align:center"  width="15%">Recipient Name</td>
    <td style="text-align:center" width="1%">A<br/>W<br/>S</td>
    <td style="text-align:center" width="5%">Pick-up<br/>Time</td>
    <td style="text-align:center" width="5%">Drop off<br/>Time</td>
    
    <td style="text-align:center" width="5%">Total Trip<br/>Mileage</td>
    <td style="text-align:center" width="5%">Per Trip<br/>Billed<br/>Amount</td>
    <td style="text-align:center" width="25%">Recipient's Signature</td>
    <td style="text-align:center" colspan="2" width="15%">Driver and Passenger confirm by initialing that passenger was properly secured<br/>
    
    <table width="100%" border="0">
  <tr>
    <td width="50%" style="text-align:center">&nbsp;Rider</td>
    <td width="50%" style="text-align:center">&nbsp;Driver</td>
  </tr>
</table></td>
  </tr>
  {section name=q loop=$data}
  <tr>
    <td style="text-align:center">{$data[q].date|date_format:"%m/%d/%Y"}</td>
    <td style="text-align:center">{$data[q].ccode}</td>
    <td style="text-align:center">{$data[q].trip_user}</td>
    <td style="text-align:center">{$data[q].vehtype|substr:0:1}</td>
    <td style="text-align:center">{if $data[q].aptime eq '00:00:00'}--:--{else}{$data[q].aptime|date_format:"%I:%M"}<!-- {$data[q].aptime|date_format:"%p"}-->{/if}</td>
    <td style="text-align:center">{if $data[q].drp_atime eq '00:00:00'}--:--{else}{$data[q].drp_atime|date_format:"%I:%M"}<!-- {$data[q].drp_atime|date_format:"%p"}-->{/if}</td>
    
    <td style="text-align:center">{$data[q].trip_miles}</td>
    <td style="text-align:center">$ {$data[q].charges}</td>
    <td style="text-align:center">{if $data[q].signature neq ''}<img src="../../iphone/signature/{$data[q].signature}" width="100" height="50" />{/if}</td>
    <td style="text-align:center">{if $data[q].patient_initial eq ''}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{else}{$data[q].patient_initial}{/if}</td>
    <td style="text-align:center">&nbsp;&nbsp;{$data[q].dfname|substr:0:1|upper}{$data[q].dlname|substr:0:1|upper}&nbsp;&nbsp;</td>
  </tr>
  
<!-- {if $smarty.section.q.iteration%3==0}  <br/><br/><br/><br/><br/><br/><br/><br/><br/>
  {/if}--> 
  
  {/section}
</table>


</td></tr>

              <tr><td colspan="10"><br/><hr/><br/></td></tr>
              <tr><td colspan="10"  style="text-align:left" valign="top">
<strong>**NOTE*** Leg of Transport</strong> - a leg of transport is the point at pick-up to the destination. Example: Picking recipient up at residence and transporting to the doctor's office would be considered on leg, picking the recipient up at the doctor's office and transporting back to the residence would be considered the second leg at the trip. Each leg of the transport must be documented on separate lines. A signature is required for each leg of the transport. Pick-up and drop-off times must be documented and in military time.
 <br/><br/>
 </td></tr>
<tr><td colspan="8"><strong>Driver's Comments:</strong> ______________________________________________________________________________________________</td></tr>
<tr><td colspan="8"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</strong> ______________________________________________________________________________________________<br/><strong>
I understand that the Broker will verify the accuracy of the mileage being reported and I hereby certify the information<br/> herein is true, correct and accurate.</strong>
</td></tr>


<tr><td colspan="10" >
<br/>
<div style="text-align:left; padding-left:10px;"> 
DRIVER'S SIGNATURE:   {if $data.0.drsignature neq ''}<u><img src="../{$data.0.drsignature}" width="120" height="60" /></u>{/if}</div>
</td></tr>


  </table>

<strong> </strong>
  </div>
</div>

