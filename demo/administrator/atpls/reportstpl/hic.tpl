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

<table id="table1"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">

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

<td height="19" colspan="2" align="center" class="admintopheading">REPORTS</td>

                            </tr>

                            

                            <tr>

                              <td colspan="2" align="center"  valign="top">							  </td>

                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top">

							 <form name="searchReport" action="hic.php" method="post"> 

							  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" >

            

           <tr>

              <td colspan="5" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
            </tr>

            <tr>

              <td width="21%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>

              <td width="31%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$startdate}" class="inputTxtField date"/>                &nbsp;

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

                (mm/dd/yyyy)</td>
              </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Facility Name:</strong></td>

              <td align="left" valign="top">

			  <select name="hospname" id="hospname">

			    <option value="0">All</option>

			   {section name=q loop=$hosp}

			    <option value="{$hosp[q].id}" {if $hospname eq $hosp[q].id}selected="selected"{/if}>{$hosp[q].hospname}</option>

				{/section}

			   </select>		  </td>

              <td width="16%" align="left" valign="top" class="labeltxt"><strong>A H CCC S #:</strong></td>

              <td width="2%" align="right" valign="top" class="labeltxt">

			  <input type="checkbox" id="box" name="box" onclick="return selbox('0');" {if $box1 eq 'on'}checked="checked"{/if}/>			  </td>

              <td align="left" valign="top"><input type="text" name="cisid" id="cisid" value="{$cisid}" class="inputTxtField" {if $hospname}disabled{else}disabled{/if}/></td>
            </tr>

            <tr>

              <td align="left" valign="top" class="labeltxt"><strong>Address :</strong></td>

              <td align="left" valign="top"><input type="text" name="address" id="address" value="{$address}" class="inputTxtField"/>			  </td>

              <td align="left" valign="top"><span class="labeltxt"><strong>Social Security Number :</strong></span></td>

              <td align="left" valign="top"><span class="labeltxt">

                <input type="checkbox" id="box2" name="box2" onclick="return selbox('1');" {if $box2 eq 'on'}checked="checked"{/if} />

              </span></td>

              <td align="left" valign="top"><input type="text" name="ssn" id="ssn" value="{$ssn}" class="inputTxtField" {if $hospname}disabled{else}disabled{/if}/></td>
            </tr>

			<tr>

              <td align="left" valign="top" class="labeltxt"><strong>Patient Name  :</strong></td>

              <td align="left" valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="inputTxtField"/>			  </td>

              <td align="left" valign="top" class="labeltxt"><strong>HIC Form Generated:</strong></td>

              <td align="left" valign="top"><span class="labeltxt">
                <input  type="checkbox" id="hic" name="hic" value="1" {if $hic eq '1'}checked="checked"{/if}/>
              </span></td>

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


							  <table width="100%" border="0" cellspacing="0" cellpadding="0">                    

                           

							

                            <tr>


                            <td align="center" class="admintopheading">REQUESTS DETAIL </td>

                            </tr>

                            
                          {if $noReq neq '0'}

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								<div style="width:700px; border: #F00 0px solid; float:left;">
								
						   
						   <br />
							  <table width="85%" border="0" class="main_table">

							  <tr class="admintopheading">

								<td width="20%" align="center">

								<strong>{if $showClient eq 'no'}Facility.{else}Facility Name{/if}</strong>

								</td>

								<td width="15%" align="center">

								<strong>{if $showClient eq 'no'}Contact Person{else}Appointment Date/Time{/if} </strong>

								</td>
							   <td  width="15%"  align="center" ><strong>Pick Address</strong></td>

								<td width="25%" align="center"><strong>Destination Address </strong></td>

								<td width="15%" align="center">

								<strong>{if $showClient eq 'no'}Requests Date{else}Date of Birth{/if}</strong>

								</td>
                                <td align="center"><strong>Patient Phone# </strong></td>
								<td align="center"><strong>HIC (Generated) </strong></td>

								</tr>	   

							{section name=q loop=$reqdetails}

							  {if $reqdetails[q].rows neq '0'}

							  <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">

								<td align="left" valign="middle">

								<b>{if $showClient eq 'no'}{$reqdetails[q].hospname}{else}{$reqdetails[q].clientname}{/if}</b>

								</td>

								<td align="center" valign="middle">

								{if $showClient eq 'no'}

								{$reqdetails[q].firstname} {$reqdetails[q].lastname}{else}

								{$reqdetails[q].appdate|date_format} / {$reqdetails[q].apptime}

								{/if}

								</td>
								<td align="center" valign="middle"> {$reqdetails[q].pickaddr }</td>
									<td align="center" valign="middle"> {$reqdetails[q].destination }</td>

								

								<td align="center" valign="middle">   

								{if $showClient eq 'no'}								 

								 {$reqdetails[q].reqdate|date_format}{else}

								  {$reqdetails[q].dob|date_format}

								{/if}								 

								 </td>
								 <td align="center" valign="middle">

								{if $showClient eq 'no'}

								{$reqdetails[q].hosp_phnum}{else}

								{$reqdetails[q].phnum}

								{/if}

								</td>

								<td align="center" valign="middle">

								{if $reqdetails[q].hic eq '1'} <a href="javascript:popWind('genreport.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].reqid}');">Yes </a>{else}No{/if}


								</td>

								</tr>

							 {else}

							 <tr>

							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>

							 </tr> 				 

							 {/if}

							{sectionelse}

							 <tr>

							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>

							 </tr> 

							 {/section} 

							</table> 					
                			</div>
                </td>

            </tr>
			 {else}

							 <tr>

							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>

							 </tr> 				 

							 {/if}
			<tr>

			   <td colspan="2" align="center"></td>

			</tr>
						
      </table>

						     			       </td>


                    </tr>

			    <tr>

			 

			</tr>			

      </table>

    </td>

  </tr>

</table>
<table><tr><td align="left">{$pages}</td></tr></table>

{literal}

<script>selbox();</script>{/literal}		 

{ include file = innerfooter.tpl}

