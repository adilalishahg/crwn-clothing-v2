 {literal}
 <style type="text/css">
 .bg_col {  background-color:#ffe5d8; !important;
 background-image: none !important;
}
   #printable { display: block; }
    @media print
    {
      #non-printable { display: none; }
      #printable { display: block; }
    }
table { font-family:"Arial"}
table td { font-size:10px; color:#000;}
table td b { font-size:8px; font-weight:bold; padding-left:3px; color:#fb070e;}
    </style>
{/literal}
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td><div style="width:1030px; margin:auto;" ><table width="1030px" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="20"><table width="795" border="0" cellspacing="0" cellpadding="0" id="non-printable">
      <tr>
        <td width="572"><span style="color:#F00; font-size:12px;" >{if $sra eq '1'}Special Rates Authorized{/if}</span>
        </td>
        <td width="26" align="center" valign="middle"></td>
       <td width="27" align="left" valign="middle"><a href="javascript:window.print();"><img src="../images/print.gif" width="16" height="16" border="0" /></a></td>
      </tr>
    </table></td>
    </tr>
       <tr>
        <td>
        <table width="100%" border="0" style="font-family:Verdana, Geneva, sans-serif; font-size:7px;">
<tr>
<td align="center">&nbsp;<img src="../images/logo.png" alt="" width="120px;" height="100px;" /></td>
<td align="center"><strong>INVOICE</strong><br/>
{$cdata.title}<br/>
{$cdata.address}<br/>
{$cdata.city}, {$cdata.state} {$cdata.zip}<br/>
{$cdata.phone}<br/>
{$cdata.url}</td>
 <td align="center"><span style="font-weight:bold; text-decoration:underline;">Billing Information</span><br>
        <strong>Account Name:</strong> {$tdata.account_name}<br/>
        <strong>Billing address:</strong> {$tdata.address}, <br/>{$tdata.city}, {$tdata.state} {$tdata.zip}      
        </td>
  </tr>
  <tr>
    <td colspan="3">
    <table width="100%" border="0">
  <tr>
    <td width="10%">Pickup<br/>Charges</td>
    <td width="10%">Per Mile<br/>Charges</td>
    <td width="10%">Wait Time<br/>Charges</td>
    <td width="10%">No Show<br/>Fee</td>
    <td width="10%">After<br/>Hours<br/>Fee</td>
<!--    <td width="10%">Stretcher<br/>Charges</td>-->
    <td width="10%">2 Man Team<br/>Charges</td>
    <td width="10%">Bariatric<br/>Stretcher<br/>Charges</td>
    <td width="10%">Oxygen<br/>Charges</td>
    <td width="10%">Wheel Chair <br/>Rental<br/>Charges</td>
  </tr>
  <tr>
    <td colspan="10" height="20">&nbsp;</td>
  </tr>
  <tr>
     <td>$ {$rates.pickup_ch}</td>
     <td>$ {$rates.permile_ch}</td>
     <td>$ {$rates.waittime_ch}</td>
     <td>$ {$rates.noshow_ch}</td>
     <td>$ {$rates.afterhour_ch}</td>
<!--     <td>$ {$rates.stretcher_ch}</td>-->
     <td>$ {$rates.dstretcher_ch}</td>
     <td>$ {$rates.bstretcher_ch}</td>
     <td>$ {$rates.oxygen_ch}</td>
     <td>$ {$rates.doublewheel_ch}</td>
  </tr>
   <tr>
    <td colspan="10" height="30">&nbsp;</td>
  </tr>
<tr>
    <td colspan="3" ></td>
    <td colspan="2" ><strong>Invoice Date</strong></td>
    <td colspan="2" >{$smarty.now|date_format}</td>
    <td colspan="3" ></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td colspan="3">
    <table width="100%" border="1">
  	<tr style="background-color:#CCC;">
    <td align="center" width="4%"><strong>#</strong></td>
    <td align="center" width="8%"><strong>Date</strong></td>
    <td align="center" width="10%"><strong>Customer Name</strong></td>
    <td align="center" width="5%"><strong>PO#</strong></td>
    <td align="center" width="8%"><strong>Account</strong></td>
    <td align="center" width="13%"><strong>Pick Up Address</strong></td>
    <td align="center" width="13%"><strong>Delivery Address</strong></td>
    <td align="center" width="5%"><strong>Time</strong></td>
    <td align="center" width="10%"><strong>Vehicle Service</strong></td>
    <td align="center" width="10%"><strong>Miles</strong></td>
    <td align="center" width="18%"><strong>Out of Area / Misc Fee</strong></td>
    <td align="center" width="12%"><strong>Total $</strong></td>
  </tr>
 <tr>
    <td>Leg A</td>
    <td>{$tdata.appdate|date_format}</td>
    <td>{$tdata.clientname}</td>
	<td>{$tdata.po}<br/>{$tdata.legaid}</td>
    <td>{$tdata.account_name}</td>
    <td>{$tdata.pickaddr}</td>
    <td>{$tdata.destination}</td>
    <td>{$tdata.apptime|truncate:5:""}</td>
    <td>{$vdata.vehtype}<br />Pickup Charges: {$legA.pickup_ch}<br />Price Per Mile: {$legA.permile_ch}</td>
    <td>Total Miles = {$legA.miles}<br/>Free Miles = {$legA.freemiles}<br/>Bilable Miles = {$chargeablemile1}</td>
    <td>
{if $legA.miscellaneous_charges neq '0'}Misc. Chrg: {$legA.miscellaneous_charges}<br/>{/if}
{if $legA.dstretcher eq 'Yes'}2ManTeam Chrg: {$legA.dstretcher_rate}<br/>{/if}
{if $legA.oxygen eq 'Yes'}Oxg. Chrg: {$legA.oxygen_rate}<br/>{/if}
{if $legA.bstretcher eq 'Yes'}Bariatric Str. Chrg: {$legA.bstretcher_rate}<br/>{/if}
{if $legA.doublewheel eq 'Yes'}WheelChair Rental Chrg: {$legA.doublewheel_rate}<br/>{/if}
{if $legA.afterhour eq '1'}After Hour Fee: {$legA.afterhour_rate}<br/>{/if}
{if $legA.noshow eq '1'}No Show Fee: {$legA.noshow_rate}<br/>{/if}
{if $legA.waittime_unit neq '0'}Wait Time Charges: {$legA.waittime_rate}<br/>{/if}
    </td>
    <td>$&nbsp;{$legA.charges}</td>
 </tr>
 {if $tdata.triptype eq 'Round Trip'}
 <tr>
     <td>Leg B</td>
    <td>{$tdata.appdate|date_format}</td>
    <td>{$tdata.clientname}</td>
    <td>{$tdata.po}<br/>{$tdata.legbid}</td>
	<td>{$tdata.account_name}</td>
    <td>{$tdata.destination}</td>
    <td>{$tdata.backto}</td>
    <td>{$tdata.returnpickup|truncate:5:""}</td>
    <td>{$vdata.vehtype}<br />Pickup Charges: {$legB.pickup_ch}<br />Price Per Mile: {$legB.permile_ch}</td>
    <td>Total Miles = {$legB.miles}<br/>Free Miles = {$legB.freemiles}<br/>Bilable Miles = {$chargeablemile2}</td>
    <td>
{if $legB.miscellaneous_charges neq '0'}Misc. Chrg: {$legB.miscellaneous_charges}<br/>{/if}
{if $legB.dstretcher eq 'Yes'}2ManTeam Chrg: {$legB.dstretcher_rate}<br/>{/if}
{if $legB.oxygen eq 'Yes'}Oxg. Chrg: {$legB.oxygen_rate}<br/>{/if}
{if $legB.bstretcher eq 'Yes'}Bariatric Str. Chrg: {$legB.bstretcher_rate}<br/>{/if}
{if $legB.doublewheel eq 'Yes'}WheelChair Rental Chrg: {$legB.doublewheel_rate}<br/>{/if}
{if $legB.afterhour eq '1'}After Hour Fee: {$legB.afterhour_rate}<br/>{/if}
{if $legB.noshow eq '1'}No Show Fee: {$legB.noshow_rate}<br/>{/if}
{if $legB.waittime_unit neq '0'}Wait Time Charges: {$legB.waittime_rate}<br/>{/if}
    </td>
    <td>$&nbsp;{$legB.charges}</td>
 </tr>{/if}
 <tr>
 <td></td>
 <td colspan="9"> Grand Total: </td>
 <td>{$total_charges}</td>
 </tr>
  
  </table>
  </td></tr></table>
  </td>
      </tr>
    </table></div></td>
  </tr>
</table>