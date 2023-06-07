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

<table id="table1" class="outer_table" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">

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

<td height="19" colspan="2" align="center" class="admintopheading">RECLAIMS</td>

                            </tr>

                            

                            <tr>

                              <td colspan="2" align="center"  valign="top">							  </td>

                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top">

							 <form name="searchReport" action="reclaim.php" method="post"> 

							  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" >

            

           <tr>

              <td colspan="5" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
            </tr>
			<tr  >

              <td colspan="5" valign="top" class="" align="left"><span style=" font-size:12px; font-weight:bold;">Both AHCCCS # & Date are required for each one</span></td>
            </tr>

            <tr>

              <td colspan="2" align="left" valign="top" class="labeltxt"><strong>AHCCCS #:</strong><br /><input type="text" name="cisid1" id="cisid1" value="{$cisid1}" class="inputTxtField" tabindex="1" /><br /><input type="text" name="cisid2" id="cisid2" value="{$cisid2}" class="inputTxtField" tabindex="3" /><br /><input type="text" name="cisid3" id="cisid3" value="{$cisid3}" class="inputTxtField" tabindex="5" /><br /><input type="text" name="cisid4" id="cisid4" value="{$cisid4}" class="inputTxtField" tabindex="7" /><br /><input type="text" name="cisid5" id="cisid5" value="{$cisid5}" class="inputTxtField" tabindex="9" /><br /><input type="text" name="cisid6" id="cisid6" value="{$cisid6}" class="inputTxtField" tabindex="11" /><br /><input type="text" name="cisid7" id="cisid7" value="{$cisid7}" class="inputTxtField" tabindex="13" /><br /><input type="text" name="cisid8" id="cisid8" value="{$cisid8}" class="inputTxtField" tabindex="15" /><br /><input type="text" name="cisid9" id="cisid9" value="{$cisid9}" class="inputTxtField" tabindex="17" /><br /><input type="text" name="cisid10" id="cisid10" value="{$cisid10}" class="inputTxtField" tabindex="19" /><br /><input type="text" name="cisid11" id="cisid11" value="{$cisid11}" class="inputTxtField" tabindex="21" /><br /><input type="text" name="cisid12" id="cisid12" value="{$cisid12}" class="inputTxtField" tabindex="23" /><br /><input type="text" name="cisid13" id="cisid13" value="{$cisid13}" class="inputTxtField" tabindex="25" /><br /><input type="text" name="cisid14" id="cisid14" value="{$cisid14}" class="inputTxtField" tabindex="27" /><br /><input type="text" name="cisid15" id="cisid15" value="{$cisid15}" class="inputTxtField" tabindex="29" /><br /><input type="text" name="cisid16" id="cisid16" value="{$cisid16}" class="inputTxtField" tabindex="31" /><br /><input type="text" name="cisid17" id="cisid17" value="{$cisid17}" class="inputTxtField" tabindex="33" /><br /><input type="text" name="cisid18" id="cisid18" value="{$cisid18}" class="inputTxtField" tabindex="35" /><br /><input type="text" name="cisid19" id="cisid19" value="{$cisid19}" class="inputTxtField" tabindex="37" /><br /><input type="text" name="cisid20" id="cisid20" value="{$cisid20}" class="inputTxtField" tabindex="39" /></td>

              <td colspan="2" align="right" valign="top" class="labeltxt"><strong>Date:</strong>&nbsp;(<span style="font-size:10px">mm/dd/yyyy</span>)<br /><input type="text" name="hicdate1" id="hicdate1" value="{$hicdate1}" class="inputTxtField date" tabindex="2" /><br /><input type="text" name="hicdate2" id="hicdate2" value="{$hicdate2}" class="inputTxtField date" tabindex="4" /><br /><input type="text" name="hicdate3" id="hicdate3" value="{$hicdate3}" class="inputTxtField date" tabindex="6" /><br /><input type="text" name="hicdate4" id="hicdate4" value="{$hicdate4}" class="inputTxtField date" tabindex="8" /><br /><input type="text" name="hicdate5" id="hicdate5" value="{$hicdate5}" class="inputTxtField date" tabindex="10" /><br /><input type="text" name="hicdate6" id="hicdate6" value="{$hicdate6}" class="inputTxtField date" tabindex="12" /><br /><input type="text" name="hicdate7" id="hicdate7" value="{$hicdate7}" class="inputTxtField date" tabindex="14" /><br /><input type="text" name="hicdate8" id="hicdate8" value="{$hicdate8}" class="inputTxtField date" tabindex="16" /><br /><input type="text" name="hicdate9" id="hicdate9" value="{$hicdate9}" class="inputTxtField date" tabindex="18" /><br /><input type="text" name="hicdate10" id="hicdate10" value="{$hicdate10}" class="inputTxtField date" tabindex="20" /><br /><input type="text" name="hicdate11" id="hicdate11" value="{$hicdate11}" class="inputTxtField date" tabindex="22" /><br /><input type="text" name="hicdate12" id="hicdate12" value="{$hicdate12}" class="inputTxtField date" tabindex="24" /><br /><input type="text" name="hicdate13" id="hicdate13" value="{$hicdate13}" class="inputTxtField date" tabindex="26" /><br /><input type="text" name="hicdate14" id="hicdate14" value="{$hicdate14}" class="inputTxtField date" tabindex="28" /><br /><input type="text" name="hicdate15" id="hicdate15" value="{$hicdate15}" class="inputTxtField date" tabindex="30" /><br /><input type="text" name="hicdate16" id="hicdate16" value="{$hicdate16}" class="inputTxtField date" tabindex="32" /><br /><input type="text" name="hicdate17" id="hicdate17" value="{$hicdate17}" class="inputTxtField date" tabindex="34" /><br /><input type="text" name="hicdate18" id="hicdate18" value="{$hicdate18}" class="inputTxtField date" tabindex="36" /><br /><input type="text" name="hicdate19" id="hicdate19" value="{$hicdate19}" class="inputTxtField date" tabindex="38" /><br /><input type="text" name="hicdate20" id="hicdate20" value="{$hicdate20}" class="inputTxtField date" tabindex="40" /></td>

              <td align="left" valign="top" class="labeltxt">&nbsp;</td>

              <td width="30%" align="left" valign="top">&nbsp;

                <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">

                  <div class="suggestionList" id="div">&nbsp; </div>
                </div>

                </td>
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


                            <td align="center" class="admintopheading">HIC FORMS</td>

                            </tr>

                            
                          {if $noReq neq '0'}

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">
								<div style="width:700px; border: #F00 0px solid; float:left;">
								
						   
						   <br />
							  <table width="85%" border="0" class="main_table">

							  <tr class="admintopheading">

								<td width="20%" align="center">

								<strong>AHCCCS #</strong>

								</td>

								<td width="15%" align="center">

								<strong>Date</strong>

								</td>
								<td align="center"><strong>HIC (Generated) </strong></td>

								</tr>	   

							{section name=q loop=$reqdetails}

							  {if $reqdetails[q].rows neq '0'}

							  <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">

								<td align="left" valign="middle">

								<b>{$reqdetails[q].cisid}</b>

								</td>

								<td align="center" valign="middle">

								{$reqdetails[q].appdate|date_format:"%m/%d/%Y"} 

								</td>

								<td align="center" valign="middle">

								<a href="javascript:popWind('genreport.php?id={$reqdetails[q].id}&reqid={$reqdetails[q].req_id}&reclaim=true');">View</a>


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