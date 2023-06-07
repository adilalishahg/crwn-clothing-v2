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



<table width="100%" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">



				  <tr>



					<td colspan="4" rowspan="2" valign="top"><p class="style4">&nbsp;



					<a href="http://{$contact.0.url}" target="_blank"><img src="../../images/logo.png" border="0"></a></td>



					<td height="33" colspan="5" valign="top"><p align="right" class="style4"><em><b>TRANSPORTATION Order</b></em>		</td>



				  </tr>



							  <tr>



								<td colspan="5" align="right" valign="top">

								<strong>

						{$contact.0.title}<br>

							{$contact.0.address},{$contact.0.city},<br />{$contact.0.state},{$contact.0.zip}<br>

							Ph # {$contact.0.phone}</strong>  </td>



							  </tr>



							  <tr>



								<td colspan="10" valign="top"></td>



							  </tr>



				              <tr valign="middle" class="pheading" height="35">



				                <td colspan="3"><h3>{$clinic}</h3></td>



				                <td colspan="3">&nbsp;</td>



				                <td colspan="3">&nbsp;</td>



            </tr>



				              <tr valign="middle" class="pheading" height="35">

				                <td colspan="3">&nbsp;</td>

				                <td colspan="2">&nbsp;</td>

            </tr>

				              <!--<tr valign="middle" class="pheading" height="35">



				              

				                <td colspan="3">Program Type:</td>



				                <td colspan="2">A.H.C.C.C.S</td>



            </tr>-->



	              <tr valign="middle"  height="35">



					<td colspan="3" class="admintopheading">Pickup Address</td>



					<td colspan="3" class="admintopheading">Destination</td>



					<td colspan="3" class="admintopheading">Back To: </td>



				  </tr>



							  <tr align="left" valign="middle" height="35" class="labeltxt2">



								<td colspan="3">{$pck}</td>



								<td colspan="3">{$drp}</td>



								<td colspan="3">{$backto}</td>



  </tr>



                  <tr valign="middle" class="pheading" height="35">



					<td colspan="3" class="admintopheading">Vehicle Preferrences </td>



					<td colspan="6" class="admintopheading">Trip Type </td>



				  </tr>



							  <tr align="left" valign="middle" height="35" class="labeltxt2">



								<td colspan="3">{$vehtype}</td>



								<td colspan="6">{$triptype}</td>



			</tr>



							  <tr>



								<td colspan="10" valign="top"></td>



							  </tr>



				  <tr valign="middle"  class="pheading" height="35">



					<td class="admintopheading">Service Date</td>



					<td colspan="3" class="admintopheading">Appointment Time</td>



					<td width="142" class="admintopheading">Return Pick Up Time </td>



					<td colspan="2" class="admintopheading">Case Manager</td>

	



					<td colspan="2" class="admintopheading">Todays Date</td>



				  </tr>



							  <tr align="left" valign="middle" height="35" class="labeltxt2">



								<td>{$appdate|date_format}</td>



								<td colspan="3">{$apptime}</td>



								<td >{$returnpickup}</td>



							<td colspan="2">{$casemanager1}</td>



								<td colspan="2">{$todaydate|date_format}</td>



  </tr>



							  <tr>



								<td colspan="10" valign="top"></td>



							  </tr>



				  <tr valign="middle"  class="pheading"  height="35">



					<td class="admintopheading">Patient Name</td>



					<td colspan="3" class="admintopheading">Patient Phone Number</td>
					
					<td colspan="2" class="admintopheading">Date of Birth</td>



				



					{if $cisid neq ''}



					<td colspan="2" class="admintopheading">AHCCCS#</td>

					{else}



									



				    {/if}



					<td width="1" colspan="2" class="admintopheading">&nbsp;</td>



				  </tr>



							  <tr align="center" valign="middle" height="35" class="labeltxt2">



								<td align="left">{$pname}</td>



								<td colspan="3" align="left">{$phnum}</td>
								
								<td colspan="2" align="left">{$dob|date_format}</td>



							



			                    {if $cisid neq ''}								



								<td colspan="2">{$cisid}</td>{else}



							

				                {/if}



								<td colspan="2">&nbsp;</td>



  </tr>

  					{if $phyname neq ''}

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td colspan="8" align="left" class="admintopheading">Physician Information</td>

		    </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td align="left" class="admintopheading">Physician Name</td>

							    <td colspan="3" align="left" class="admintopheading">Physician Hospital</td>

							    <td colspan="2" class="admintopheading">Physician Address</td>

							    <td colspan="2" class="admintopheading">Physician Phone / Fax</td>

		    </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td align="left">{$phyname}</td>

							    <td colspan="3" align="left">{$phyclinic}</td>

							    <td colspan="2">{$phyadd}</td>

							    <td colspan="2">{$phypnone}/{$phyfax}</td>

		    </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td colspan="8" align="left" class="admintopheading"> Reason for Visit</td>

		    </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td colspan="8" align="left">{$phyreason}</td>

		    </tr>

            {/if}

            {if $comments neq ''}

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td colspan="8" align="left" class="admintopheading">Comments:</td>

		    </tr>

							  <tr align="center" valign="middle" height="35" class="labeltxt2">

							    <td colspan="8" align="left">{$comments}</td>

		    </tr>

            {/if}



							 



			



				 

							  

</table>



 </td>



</tr>



</table>



</div>



</div>



{*include file = innerfooter.tpl*}				