<table width="600" border="0">

  <tr>

    <td colspan="3" align="center" class="admintopheading"><strong>COMMENTS</strong></td>

  </tr>

  <tr>

    <td width="28%" height="26" align="right" class="labeltxt"><strong>Driver Name :</strong></td>

    <td width="1%">&nbsp;</td>

    <td width="71%"><b>{$trips.drv_name}</b></td>

  </tr>

  <tr>

    <td align="right" valign="top"  class="labeltxt"><strong>Trip Details :</strong></td>

    <td>&nbsp;</td>

    <td><b>{$trips.trip_user} - </b><b>{$trips.trip_clinic}</b><br />
      <strong>From :</strong> {$trips.pck_add}<br />
      <strong>To :</strong> {$trips.drp_add}</td>

  </tr>

  <tr>

    <td height="25" align="right" class="labeltxt"><strong>Trip Status :</strong></td>

    <td>&nbsp;</td>

    <td>{if $trips.status eq '4'}
											 Successful
									     {elseif $trips.status eq '1'}
											 Delayed
										 {elseif $trips.status eq '3'}
										    Cancelled
										 {elseif $trips.status eq '5'}
										     In Progress
										 {elseif $trips.status eq '2'}
										     Rescheduled
										 {elseif $trips.status eq '7'}
										     Not at Home
										 {elseif $trips.status eq '8'}
										     Not Going		 							 											 										 {else}
										     In Progress
    {/if} </td>

  </tr>

  <tr>
    <td height="25" align="right" class="labeltxt"><strong>User Comments:</strong></td>
    <td>&nbsp;</td>
    <td>{$trips.trip_remarks}</td>
  </tr>
  <tr>
    <td height="25" align="right" class="labeltxt"><strong>Trip Comments:</strong></td>
    <td>&nbsp;</td>
    <td>{$data_comments[0].comments} / {$data_comments[1].comments}</td>
  </tr>

  <tr>

    <td height="25" align="right" class="labeltxt">&nbsp;</td>

    <td>&nbsp;</td>

    <td>&nbsp;</td>

  </tr>

</table>

