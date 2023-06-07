{*include file = headerinner.tpl*}

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

<div align="right" id="non-printable" style="width:700px; background-color:#FFFFFF"><a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>

<div align="center" id="printable">

<table width="700" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">

 <tr>

  <td>

<table width="650" border="0" cellspacing="2" cellpadding="2">			  

							

								  <tr>

								    <td height="25" colspan="3" align="right" class="labeltxt"><a href="http://{$contact.0.url}"><img src="../../images/logo.png" border="0"></a></td>

								    <td height="25" align="right"><strong>
						{$contact.0.title}<br>
							{$contact.0.address},{$contact.0.city},<br />{$contact.0.state},{$contact.0.zip}<br>
							Ph # {$contact.0.phone}</strong></td>
							      </tr>

                                  <tr>

									<td height="25" colspan="4" class="admintopheading">Attendance Information </td>
								  </tr>

								  <tr>

								    <td width="103" height="25" align="right" class="labeltxt"><strong>Driver:</strong></td>

								    <td width="159" align="right" class="labeltxt">{$data[0].fname} {$data[0].lname}</td>
								    <td width="200" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
		    </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>Date:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$date}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td width="162" height="25">&nbsp;</td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>Start Milage:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$data[0].smilage}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>End Milage:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$data[0].emilage}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

								

								  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>Total Milage:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$data[0].tmileage}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>Time In:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$data[0].time_in}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

                                  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>Time Out:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$data[0].time_out}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt"><strong>Total Hours:</strong></td>

								    <td height="25" align="right" class="labeltxt">{$thr}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>
              </table>

 </td>

</tr>

</table>

</div>

</div>

{*include file = innerfooter.tpl*}				