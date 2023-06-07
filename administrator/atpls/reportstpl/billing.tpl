{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function showgraph(val){



  if(val == '1'){

     $("#graph1").show("slow"); 

   }

  if(val == '2'){

     $("#graph2").show("slow");

	 	 

   }   

  if(val == '3'){

     $("#graph1").hide("slow");   

     $("#graph2").hide("slow");  	 

   }     

   

}



function selbox(val){



if(val == '0'){

if(document.getElementById('box').checked == true)

   {

  $('#hospname').attr("disabled", true);

  $('#address').attr("disabled", true);

  $('#cisid').attr("disabled", false);

  //$('#box2').attr("disabled", true);   

  $('#box2').attr("checked", false);  

  $('#ssn').val("");   

  $('#ssn').attr("disabled", true); 

  return true;  

  }

else if(document.getElementById('box').checked == false){

  $('#hospname').attr("disabled", false);

  $('#address').attr("disabled", false);

  $('#ssn').attr("disabled", true); 

  $('#box').attr("disabled", false);

  $('#box2').attr("disabled", false); 

  $('#box2').attr("checked", false);     

  $('#cisid').attr("disabled", true); 

  $('#cisid').val(""); 

  return true;

  }else{

  return false;

    }

  }

 

if(val == '1'){

if(document.getElementById('box2').checked == true)

   {

  $('#hospname').attr("disabled", true);

  $('#address').attr("disabled", true);

  $('#cisid').val("");

  //$('#box').attr("disabled", true); 

  $('#cisid').attr("disabled", true);     

  $('#box').attr("checked", false);   

  $('#ssn').attr("disabled", false);  

  return true;  

  }

else if(document.getElementById('box2').checked == false){

  $('#hospname').attr("disabled", false);

  $('#address').attr("disabled", false);

  $('#cisid').attr("disabled", true); 

  $('#box').attr("disabled", false);

  $('#box').attr("checked", false); 

  $('#box2').attr("disabled", false);     

  $('#ssn').attr("disabled", true); 

  $('#ssn').val("");    

  return true;

  }else{

  return false;

    }

  }  

}



</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="44" colspan="2" align="center" valign="top">  							  </td>

                            </tr>

                            

                            <tr>

                              <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

		                    { if $errors != ''} {$errors} {/if}</span></td>

                            </tr>

<tr>

                              <td height="19" colspan="2" align="center">

							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">

							{if $noReq neq '0'}

							[<a href="javascript:history.back();">Back</a>]{/if}</div>							  </td>

        </tr>							

                            <tr>

<td height="19" colspan="2" align="center" class="admintopheading">Billing Report </td>

                            </tr>

                            

                            <tr>

                              <td colspan="2" align="center"  valign="top">							  </td>

                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top">

							 <form name="searchReport" action="billing.php" method="post"> 

							  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" class="">

            

           <tr>

              <td colspan="5" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>

            </tr>

            <tr>

              <td width="21%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>

              <td width="31%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$startdate}" class="inputTxtField date"/> <span style="color:#FF0000">   *</span>            &nbsp;

                <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;">

                  <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />

                  <div class="suggestionList" id="autoSuggestionsList1">

  &nbsp;				</div>

			      </div>

                (mm/dd/yyyy)</td>

              <td align="right" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>

              <td align="left" valign="top" class="labeltxt">&nbsp;</td>

              <td width="30%" align="left" valign="top"><input type="text" name="enddate" id="enddate" value="{$enddate}" class="inputTxtField date" />

                <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">

                  <div class="suggestionList" id="div">&nbsp; </div>

                </div>

                <span style="color:#FF0000">   *</span>       (mm/dd/yyyy)</td>

              </tr>

            <!--<tr>

              <td align="left" valign="top" class="labeltxt"><strong>Clininc Name:</strong></td>

              <td align="left" valign="top">

			  <select name="hospname" id="hospname">

			    <option value="0">All</option>

			   {section name=q loop=$hosp}

			    <option value="{$hosp[q].id}" {if $hospname eq $hosp[q].id}selected="selected"{/if}>{$hosp[q].hospname}</option>

				{/section}

			   </select>		  </td>

              <td width="16%" align="left" valign="top" class="labeltxt">&nbsp;</td>

              <td width="2%" align="right" valign="top" class="labeltxt">&nbsp;</td>

              <td align="left" valign="top">&nbsp;</td>
            </tr>-->

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Address :</strong></td>

              <td align="left" valign="top"><input type="text" name="address" id="address" value="{$address}" class="inputTxtField"/>			  </td>

              <td align="left" valign="top">&nbsp;</td>

              <td align="left" valign="top">&nbsp;</td>

              <td align="left" valign="top">&nbsp;</td>
            </tr>

			<tr>

              <td align="left" valign="top" class="labeltxt"><strong>Patient Name  :</strong></td>

              <td align="left" valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="inputTxtField"/>			  </td>

              <td align="left" valign="top">&nbsp;</td>

              <td align="left" valign="top">&nbsp;</td>

              <td align="left" valign="top">&nbsp;</td>

			</tr>

            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="4" align="left" valign="top">

			  <font color="#FF0000">

   			     <b>Note:*</b>

				 <ol><li>Combination of all fields are not mandatory</li>

				 <li>Both Start and End date must be provided.</li>

				 </ol> </font>			  </td>

              </tr>

            

            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="4" align="left" valign="top">

			  <input type="submit" name="submit" value='Report' class="inputButton btn"  />&nbsp;

			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />			  </td>

              </tr>

          </table>	

		                     </form>		  	                  </td>

                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">

						   {if $noReq neq '0'}

						   <br />

							  <table width="700" border="0" class="main_table">

							  <tr class="admintopheading">

								<td width="20%" align="center">

								<strong>Patient Name</strong>

								</td>

								<td width="15%" align="center">

								<strong>Requested Date</strong>

								</td>

								<td width="25%" align="center"><strong>App. Date</strong></td>

								<td width="15%" align="center">

								<strong>Pickup Address</strong>

								</td>

								<td align="center"><strong>Destination Address</strong></td>
								<td align="center"><strong><!--Traffic Delay-->Payment Status</strong></td>
								
								<td align="center"><strong>Options</strong></td>

								</tr>	   

							{section name=q loop=$reqdetails}

							  {if $reqdetails[q].rows neq '0'}

							  <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
								<td align="left" valign="middle">
								{$reqdetails[q].clientname}
								</td>
								<td align="center" valign="middle">
								{$reqdetails[q].appdate}
								</td>
								<td align="center" valign="middle">
									{$reqdetails[q].today_date}
								</td>
								<td align="center" valign="middle">   
									{$reqdetails[q].pickaddr}
								 </td>
								<td align="center" valign="middle">
									{$reqdetails[q].destination}
								</td>
								<td>
                                	<!--{if $reqdetails[q].traffic_delay == ''}N.A <a rel="facebox" href="trafficdelay.php">Update</a>{else $reqdetails[q].traffic_delay}{/if}-->                                    
                                    {$reqdetails[q].payment_status}
                                </td>
								<td>
                                {if $reqdetails[q].payment_status eq 'Pending'}
                                	<a href="#" style="font-weight:bold; font-size:10px;">Charge Now</a>
                                {else}
									<!--<a rel="facebox" href="bill_details.php?id={$reqdetails[q].id}">View</a>-->
                                {/if}
								</td>
								</tr>
							 {else}
							 <tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr>
							 {/if}
							 {/section} 
							 <!--<tr>
							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>
							 </tr>-->
							{/if}
							</table>
						 </td>
                    </tr>
			    <tr>
			   		<td colspan="2" align="center">{$pages}</td>

			</tr>			

      </table>

    </td>

  </tr>

</table>

{literal}

<script>selbox();</script>{/literal}		 

{ include file = innerfooter.tpl}

