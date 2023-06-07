<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{$pgTitle}</title>
<link href="../style/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
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
        #non-printable { display: none;
		float:left; 
		  }
        #printable { display: block; }
    }
</style>
{/literal}
<div style="float:left;"><img src="../images/logo.png" alt="" width="179" height="98" /></div><div id="non-printable" ><a href="javascript:this.print();"><img src="../images/print.gif" alt="" width="33" height="31" hspace="100" vspace="13" border="0"/></a>&nbsp;</div>
<div class="payroll_main">
<div class="print_main_head" style="padding-top:80px; width:450px;"> Pay Period {$from_date} - {$to_date} </div>
<div style="float:left; width:650px; padding-left:0px;">
<table width="100%" border="1" cellspacing="0" cellpadding="0" >
  <tr style="color:#FFFFFF; background:#333333; text-align:center; height:22px; border-right:1px, solid #999999; ">
    <td width="14%" style="border-right:1px solid #999999;">First Name </td> 
    <td width="13%" style="border-right:1px solid #999999;">Last Name </td>
    <td width="20%" style="border-right:1px solid #999999;">Staff / Driver Code </td>
    <td width="11%" style="border-right:1px solid #999999;">Hourly Rate </td>
    <td width="12%" style="border-right:1px solid #999999;">Report Type </td>
    <td width="13%" style="border-right:1px solid #999999;">Total Hours  </td>
    <td width="17%" style="border-right:1px solid #999999;">Total Pay </td>
  </tr>
  <tr style="height:22px;">
    <td style="border-right:1px solid #999999;  border-left:1px solid #999999;  border-bottom:1px solid #999999;" align="center">{$fname}</td>
    <td class="print_tbl" align="center">{$lname}</td>
    <td class="print_tbl" align="center">{$code}</td>
    <td class="print_tbl" align="center">{$payrate}</td>
    <td class="print_tbl" align="center">{$Wchoice}</td>
    <td class="print_tbl" align="center">{$totHours} Hrs</td>
    <td class="print_tbl" align="center">${$totSalary}</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="90%"><table width="98%" border="0" cellspacing="0" cellpadding="0" style="padding-top:65px;">
      <tr>
        <td colspan="7">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="7">Daily Attendance Record </td>
      </tr> 
	   <tr style="color:#FFFFFF; background:#333333; text-align:center;">    
      <!--<tr style="background-color:#000000; color:#FFFFFF; height:22px; text-align:center">-->
        <td style="border-right:1px solid #999999;">Date</td>
        <td style="border-right:1px solid #999999;">Day</td>
        <td style="border-right:1px solid #999999;">Start Mileage</td>
        <td style="border-right:1px solid #999999;">End Mileage</td>        
        <td style="border-right:1px solid #999999;">Time in</td>
        <td style="border-right:1px solid #999999;">Time Out</td>
        <td class="print_day_head">Duration (HH:MM)</td>		
      </tr>
      {section name=q loop=$pay}
      <tr>
        <td class="print_days" align="center">{$pay[q].date|date_format:"%m/%d/%Y"}</td>
        <td class="print_days" align="center">{$pay[q].day}</td>
        <td class="print_days" align="center">{$pay[q].smilage}</td>
        <td class="print_days" align="center">{$pay[q].emilage}</td>
        <td class="print_days" align="center">{$pay[q].time_in}</td>
        <td class="print_days" align="center">{$pay[q].time_out}</td>          
        <td class="print_days" align="center">{$pay[q].duration}</td>
      </tr>
      {sectionelse}
      <tr>
        <td class="print_days" colspan="7">No Record Found</td>
      </tr>      
      {/section}     
    </table></td>   
  </tr>
</table>
</div>
</div>
</body>
</html>