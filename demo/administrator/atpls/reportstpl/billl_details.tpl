
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

<table width="650" border="0" align="left" cellpadding="3" cellspacing="2" bgcolor="#FFFFFF">

 <tr>

  <td>

<table width="650" border="0" cellspacing="2" cellpadding="2">			  

							


                                  <tr>

									<td height="25" colspan="4" class="admintopheading">View Details 																</td>
								  </tr>

								  <tr>

								    <td width="168" height="25" align="right" class="labeltxt">Patient Name: </td>

								    <td width="345" align="right" class="labeltxt">{$udata2[q].name}</td>
								    <td width="1" align="right" class="labeltxt">&nbsp;</td>
								    <td width="151" height="25">&nbsp;</td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Date: </td>

								    <td height="25" align="right" class="labeltxt">{$udata[q].aappdate}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Payment Method :</td>

								    <td height="25" align="right" class="labeltxt">Credit Card </td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

								

								  <tr>

								    <td height="25" align="right" class="labeltxt">Pickup Address: </td>

								    <td height="25" align="right" class="labeltxt">{$udata[q].pickaddr}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>

							

                                  <tr>

								    <td height="25" align="right" class="labeltxt">Drop Address: </td>

								    <td height="25" align="right" class="labeltxt">{$udata[q].destination}</td>
								    <td height="25" align="right" class="labeltxt">&nbsp;</td>
								    <td height="25">&nbsp;</td>
							      </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Traffic Delay: </td>
                                    <td height="25" align="right" class="labeltxt">{$udata[q].traffic_delay}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="left" class="labeltxt">Credit Card Details </td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Card Number </td>
                                    <td height="25" align="right" class="labeltxt">{$udata2[q].name}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Expiry Month: </td>
                                    <td height="25" align="right" class="labeltxt">{$udata2[q].card_exp_month}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Expiry Year: </td>
                                    <td height="25" align="right" class="labeltxt">{$udata2[q].card_exp_year}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Billing Address: </td>
                                    <td height="25" align="right" class="labeltxt">{$udata2[q].bill_addr}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Billing City: </td>
                                    <td height="25" align="right" class="labeltxt">{$udata2[q].bill_city}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">Billing State: </td>
                                    <td height="25" align="right" class="labeltxt">{$udata2[q].bill_state}</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25" align="right" class="labeltxt">&nbsp;</td>
                                    <td height="25">&nbsp;</td>
                                  </tr>

								  <!--<tr>

								    <td height="25" align="right" class="labeltxt">Status:</td>

								    <td height="25">

									{if $status=='0'}In Progress{/if}

									 {if $status=='1'}Delayed{/if}

									 {if $status=='2'}Reschedule{/if}

									 {if $status=='3'}Cancelled{/if}

									 {if $status=='4'}Successful{/if}

									

								    </td>

							      </tr>-->

			 {if $data[1].trip_user neq ''}

                <!-- <tr>

								    <td width="150" height="25" align="right" class="labeltxt">Consumer Name: </td>

								    <td width="486" height="25">{$data[1].trip_user}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Facility / Corporate: </td>

								    <td height="25">{$data[1].trip_clinic}</td>

							      </tr>

								  <tr>

								    <td height="25" align="right" class="labeltxt">Telephone:</td>

								    <td height="25">{$data[1].trip_tel}</td>

							      </tr>-->

                                  {/if}
              </table>

 </td>

</tr>

</table>

</div>

</div>

			