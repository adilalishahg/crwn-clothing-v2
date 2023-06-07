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

<div align="right" id="non-printable" style="width:700px; background-color:#FFFFFF">{if $st eq 'approved'}{if $hic neq 1}<a rel="facebox" href="confirm.php?id={$id}&reqid={$reqid}"><img src="../images/export.png" border="0" /></a>{/if}{/if}&nbsp;&nbsp;<a href="javascript:window.print();"><img src="../images/print.gif" border="0" /></a></div>

<div align="center" id="printable">

<table width="700" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">

 <tr>

  <td>

<table width="100%" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">

				  <tr>

					<td width="671" colspan="5" rowspan="2" valign="top"><p class="style4">&nbsp;

					<a href="http://www.hybriditservices.com/demos/httglobal-2/" target="_blank"><img src="../../images/logo.png" border="0"></a></td>

					<td width="388" height="33" colspan="6" valign="top"><p align="right" class="style4"><em><b>TRANSPORTATION Order</b></em>		</td>

				  </tr>

							  <tr>

								<td colspan="6" align="right" valign="top">
							<strong>
						<font color="#000000" size="1px" >Hybrid Track Trans,<br />
        928 S Terrace Rd.#104, <br />
        TEMPE, AZ, 85281 <br />
        TEL:(480) 307-7328</font></strong>  </td>

							  </tr>

							  <tr>

								<td width="671" colspan="11" valign="top"></td>

							  </tr>

				              <tr valign="middle" class="pheading" height="35">

				                <td colspan="4"><h3>{$clinic}</h3></td>

				                <td colspan="4">&nbsp;</td>

				                <td colspan="3">&nbsp;</td>

            </tr>

				          

	              <tr valign="middle"  height="35">

					<td width="671" colspan="4" class="admintopheading">Pickup Address</td>

					<td width="226" colspan="4" class="admintopheading">Destination</td>

					<td width="164" colspan="3" class="admintopheading">Back To: </td>

				  </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

								<td colspan="4" align="left">{$pickaddress}</td>

								<td colspan="4" align="left">{$destination}</td>

								<td colspan="3" align="left">{$backto}</td>

  </tr>

                  <tr valign="middle" class="pheading" height="35">

					<td width="671" colspan="4" class="admintopheading">Vehicle Preferrences </td>

					<td colspan="7" class="admintopheading">Trip Type </td>

				  </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

								<td colspan="4" align="left">{$vehtype}</td>

								<td colspan="7">{$triptype}</td>

			</tr>

							  <tr>

								<td width="671" colspan="11" valign="top"></td>

							  </tr>

				  <tr valign="middle"  class="pheading" height="35">

					<td colspan="2" class="admintopheading">Appointment Date</td>

					<td colspan="4" class="admintopheading">Appointment Time</td>

					<td class="admintopheading">Return Pick Up Time </td>

					

					<td colspan="2" class="admintopheading">Todays Date</td>

				  </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

								<td colspan="2" align="left">{$appdate|date_format}</td>

								<td colspan="4" align="left">{$apptime}</td>

								<td align="left" >{$returnpickup}</td>

								
								<td colspan="2" align="left">{$todaydate|date_format}</td>

  </tr>

							  <tr>

								<td width="671" colspan="11" valign="top"></td>

							  </tr>

				  <tr valign="middle"  class="pheading"  height="35">

					<td colspan="2" class="admintopheading">Patient Name</td>

					<td colspan="4" class="admintopheading">Patient Phone Number</td>

		

					<!--{if $cisid neq ''}

					<td colspan="2" class="admintopheading">AHCCCS#</td>
					{else}

					<td colspan="2" class="admintopheading">Account Coordinator</td>						

				    {/if}-->

					<td colspan="2" class="admintopheading">&nbsp;</td>

				  </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

								<td colspan="2" align="left">{$pname}</td>

								<td colspan="4" align="left">{$phnum}</td>

								

			                    {if $cisid neq ''}								

								<td colspan="2" align="left">{$cisid}</td>{else}

								<td colspan="2" align="left">{$casemanager2}</td>								

				                {/if}

								<td colspan="2">&nbsp;</td>

  </tr>

							 

		

				

</table>

 </td>

</tr>

</table>

</div>

</div>

{*include file = innerfooter.tpl*}				