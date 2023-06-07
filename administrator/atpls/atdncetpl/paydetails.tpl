<link rel="stylesheet" href="../theme/style.css" type="text/css">
{literal}
<style type="text/css">
#printable {
	display: block;
}
 @media print {
#non-printable {
	display: none;
}
#printable {
	display: block;
}
}
</style>

{/literal}
<div align="left">
  <!----><div align="right" id="non-printable" style="width:100%; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a>&nbsp;&nbsp;&nbsp;</div>
  <div align="center" id="printable">
    <table width="100%" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">
                 <tr>
              <td height="25" colspan="6" class="admintopheading">Pay Summary [Driver Name: {$data2.fname} {$data2.lname}]</td>
            </tr>
           <tr>
                <td width="4%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td width="6%" align="center" class="label_txt_heading"><strong>Date</strong></td>
                <td width="7%" align="center" class="label_txt_heading"><strong>Clock In Time</strong></td>
                <td width="7%" align="center" class="label_txt_heading"><strong>Clock Out Time</strong></td>
                <td width="7%" align="center" class="label_txt_heading"><strong>Total Duty Time</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Over Time</strong></td>
              </tr>
              {section name=q loop = $data}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td height="25" align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>
                <td align="center" valign="middle">{$data[q].dated|date_format:"%D"} </td>
                <td align="center" valign="middle">{$data[q].clockin|date_format:"%H:%M"} </td>
                <td align="center" valign="middle">{$data[q].clockout|date_format:"%H:%M"}</td>
                <td align="center" valign="middle">{$data[q].totaltime}</td>
                <td align="center" valign="middle">{$data[q].overtime}</td>
              </tr>
             {sectionelse}
              <tr>
                <td colspan="6" align="center"><b>No Record Found</b></td>
              </tr>
              {/section}
              <tr><td colspan="6"><hr/></td></tr>
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td height="25" align="center" valign="middle" colspan="2"><b>Total Working Days: {$data2.days}</b></td>
                <td height="25" align="center" valign="middle"><b>Total # Hours: {$data2.totalhours}</b></td>
                <td height="25" align="center" valign="middle"><b>OverTime Hours: {$data2.totalovertimehours}</b></td>
                <td height="25" align="center" valign="middle"><b>Hour Rate: {$data2.hrate}</b></td>
                <td height="25" align="center" valign="middle"><b>Total Payable Amount: $ {$data2.totalamount}</b></td>
               </tr>
           
    </table>
  </div>
</div>