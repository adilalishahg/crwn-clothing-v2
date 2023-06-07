<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trip Detail</title>
</head>
<link href="css/preview.css" rel="stylesheet" type="text/css">
{literal}
<style>
.ptxt{
  font-family:Arial, Helvetica, sans-serif;
  font-weight:bold;
  font-size:11px;
}
    #printable { display: block; }
    @media print
    {
        #non-printable { display: none; }
        #printable { display: block; }
    }
.tde { border-bottom:1px solid #666; }
.headingsection { background-color:#CCC; color:#000; text-align:center;}	
.p { width:140px; line-height:14px; text-align:justify; height:auto; margin:0; padding:0; float:left;}
.headus { font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; color:#000;}
.declined { font-family:Verdana, Geneva, sans-serif; font-size:12px; font-weight:bold; color: #F00; font-weight:bold;}
.val {font-family:Verdana, Geneva, sans-serif; font-size:12px; color: #333;}
</style>
{/literal}
<div align="left"></div>
  <table border="0" cellspacing="1" cellpadding="1" width="1000px" align="center" id="non-printable">
  <tr><td style="text-align:right;">
  <span ><a href="javascript:window.print();"><img src="images/print.gif" border="0" /></a></span>
  </td></tr></table>
  <div align="center" id="printable">
    <table border="0" cellspacing="1" cellpadding="1" width="1000px">
      <tr >
        <td class="tde" colspan="2"  valign="top"><img src="images/van.png" border="0" height="80px" width="120px"></td>
        <td class="tde" valign="top" align="center" colspan="2"><b>Appointment Request</b></td>
        <td class="tde" valign="top" colspan="2">
        <table align="right"><tr><td style="text-align:right;"><strong> <font color="#000000" size="1px" >{$contact.0.title}<br />
          {$contact.0.address} <br />
          {$contact.0.city}, {$contact.0.state}, {$contact.0.zip} <br />
          TEL:{$contact.0.phone}</font></strong></td></tr></table>
        
          
          </td>
      </tr>

<tr><td colspan="6" class="headingsection"><strong>Account Information</strong></td></tr>
<tr><td colspan="3"><span class="headus">Location/Account Name:</span> <span class="val">{$dt.officelocation} / {$dt.account_name}</span></td>
<td colspan="3"><span class="headus">Facility Employee Completing Request:</span> <span class="val">{$dt.submitter_name}</span></td>
</tr>
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Patient Information</strong></td></tr>
<tr>
<td colspan="3"><span class="headus">Patient Name:</span> <span class="val">{$dt.clientname}</span></td>
<td colspan="3"><span class="headus">Unit/Room #:</span> <span class="val">{$dt.room_number}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Date of Birth:</span> <span class="val">{$dt.dob|date_format}</span></td>
<td colspan="3"><span class="headus">Patient Weight (bls):</span> <span class="val">{$dt.patient_weight}</span></td>
</tr>
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Reason for Appointment</strong></td></tr>
<tr>
<td colspan="3"><span class="headus">Procedure/ Consult Requested:</span> <span class="val">{$dt.consult_requested}</span></td>
<td colspan="3"><span class="headus">Consulting Physician:</span> <span class="val">{$dt.physician_name}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Phone #:</span> <span class="val">{$dt.physician_phone}</span></td>
<td colspan="3"><span class="headus">Reason:</span> <span class="val">{$dt.reason}</span></td>
</tr>
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Appointment Detail</strong></td></tr>
<tr>
<td colspan="3"><span class="headus">Appointment Date Requested:</span> <span class="val">{$dt.appdate_requested|date_format}</span></td>
<td colspan="3"><span class="headus">Actual Appointment Date:</span> <span class="val">{if $dt.appdate neq '0000-00-00'}{$dt.appdate|date_format}{else}--{/if}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Time:</span> <span class="val">{$dt.apptime}</span></td>
<td colspan="3"><span class="headus">Appointment Location/Office Name:</span> <span class="val">{$dt.appointment_location}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Address:</span> <span class="val">{$dt.address}</span></td>
<td colspan="3"><span class="headus">Suite #:</span> <span class="val">{$dt.suite}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Telephone:</span> <span class="val">{$dt.phone}</span></td>
<td colspan="3"><span class="headus">Trip type:</span> <span class="val">{$dt.triptype}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Mode of Transport:</span> <span class="val">{$dt.vehtype}</span></td>
{if $dt.converted_on neq '0000-00-00 00:00:00'}<td colspan="3"><span class="headus">Appointment Converted Date:</span> <span class="val">{$dt.converted_on|date_format:"%m/%d/%Y %H:%M"}</span></td>{/if}
</tr>
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Questions</strong></td></tr>
<tr>
<td colspan="3"><span class="headus">Clinical Needs:</span> <span class="val">{$dt.clinical_needs}</span></td>
<td colspan="3"><span class="headus">Is patient on Anticoagulant Therapy:</span> <span class="val">{$dt.anticoagulant_therapy}</span></td>
</tr>
<tr>{if $dt.anticoagulant_therapy eq 'Yes'}
<td colspan="3"><span class="headus">Does it need to be held?:</span> <span class="val">{$dt.needtobeheld}</span></td>{/if}
<td colspan="3"><span class="headus"># of Days to Hold Before Appointment:</span> <span class="val">{$dt.holddays}</span></td>
</tr>
<tr>
<td colspan="3"><span class="headus">Does patient need to be NPO prior to appointment?:</span> <span class="val">{$dt.npo_prior}</span></td>
{if $dt.npo_prior eq 'Yes'}
<td colspan="3"><span class="headus">How many hours prior to appointment?:</span> <span class="val">{$dt.npo_prior_hours}</span></td>{/if}
</tr>
<tr>
<td colspan="3"><span class="headus">Attendant Required?:</span> <span class="val">{$dt.attendant}</span></td>
</tr>
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Responsible Party Notification</strong></td></tr>
<tr>
<td colspan="2"><span class="headus">Name:</span> <span class="val">{$dt.notification_name}</span></td>
<td colspan="2"><span class="headus">Relationship:</span> <span class="val">{$dt.notification_relationship}</span></td>
<td colspan="2"><span class="headus">Phone:</span> <span class="val">{$dt.notification_phone}</span></td>
</tr>
{if $dt.vehtype eq 'ALS' || $dt.vehtype eq 'BLS'}
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Questions</strong></td></tr>
<tr>
<td colspan="4"><span class="headus">Reason Ambulance Transportation is Required?:</span> <span class="val">{$dt.reason_ambulance}</span></td>
<td colspan="2"><span class="headus">Ambulance is required for Bed Confinement?:</span> <span class="val">{$dt.bed_confinement}</span></td>
</tr>
{if $dt.bed_confinement eq 'Yes'} 
<tr>
<td colspan="2"><span class="headus"><input type="checkbox" checked="checked" disabled="disabled"  /></span> <span class="val">Unable to get out of bed without assistance</span></td>
<td colspan="2"><span class="headus"><input type="checkbox" checked="checked" disabled="disabled"  /></span> <span class="val">Unable to ambulate</span></td>
<td colspan="2"><span class="headus"><input type="checkbox" checked="checked" disabled="disabled"  /></span> <span class="val">Unable to sit in a wheelchair or chair</span></td>
</tr>
{/if}
<tr>{if $dt.facesheet neq ''}
<td colspan="3"><a href="borrifiles/{$dt.facesheet}" target="_blank">Attached Resident Face Sheet</a></td>{/if}
{if $dt.facesheet neq ''}
<td colspan="3"><a href="borrifiles/{$dt.necessityform}" target="_blank">Attach Completed Medical Necessity Form</a></td>{/if}
</tr>
{/if}
<tr style="height:5px;"><td colspan="6">&nbsp;</td></tr>
<tr><td colspan="6" class="headingsection"><strong>Request Status: </strong>{$dt.status}</td></tr>
{if $dt.special_comments neq ''} <tr><td colspan="6"><span class="headus">Special Comments:</span> <span class="val">{$dt.special_comments}</span></td></tr> {/if}
{if $dt.decline_notes neq ''} <tr><td colspan="6"><span class="declined">Decline Notes:</span> <span class="val">{$dt.decline_notes}</span></td></tr> {/if}
</table>
</div>

