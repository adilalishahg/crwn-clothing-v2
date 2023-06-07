<table width="43%" border="0" align="center" cellpadding="0" cellspacing="0">



                            <tr>



                              <td height="25" align="left" valign="top">&nbsp;</td>



                            </tr>



                            



                            

                            <tr>

								<td height="19" align="center">&nbsp;</td>

                            </tr>



                            <tr>



                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">



							  <form name="ar" id="ar" method="post" action="approve_request.php">



	  <table width="100%" border="0" cellspacing="4" cellpadding="2" align="center" class="outer_table">



            <tr>

              

              <td colspan="3" valign="top" class="admintopheading"><strong>Approve Trip Request</strong></td>

            </tr>



            <tr>

              <td valign="top" class="labeltxt">&nbsp;</td>

              <td colspan="2">

			  	 <input type="hidden" name="id" value="{$id}">

			  	 <input type="hidden" name="reqid" value="{$id}">

				 <input type="hidden" name="rqid" value="{$rqid}">

			  </td>

            </tr>

			{if $appdate eq $currdate}

            <tr>

              

              <td width="38%" align="right" valign="top" class="labeltxt"><strong>Assign Driver:</strong>&nbsp;&nbsp;</td>

              

              <td width="62%" colspan="2" align="left">

               

                

                <select name="driver" id="driver" class="SelectBox" >                  

                  <option value="">Select</option>

			   {section name=n loop=$drivers}



			   <option value="{$drivers[n].drv_code}" >

                    

                    {$drivers[n].fname}&nbsp;{$drivers[n].lname}

                    

                  </option>



			   {/section}



			  </select>&nbsp;<span class="SmallnoteTxt">*</span>			  </td>

            </tr>

            <!--<tr>

              

              <td align="right" valign="top" class="labeltxt">&nbsp;&nbsp;</td>

              

              <td colspan="2" align="left"><input type="checkbox" name="sms" id="sms" value="Yes" />

           Send SMS to driver</td>

            </tr>-->

            <tr>

              <td align="right" valign="top" class="labeltxt">&nbsp;</td>

              <td colspan="2" align="left">{if $msg neq ''}{$msg}{/if}</td>

            </tr>

			{else}

            <tr>              

              <td colspan="3" valign="top">You can change below miles before actually going to approve this trip request<input type="hidden" name="hdriver" value="1" /> </td>

            </tr>

			{/if}
			
			<tr> 
			
			  <td width="38%" align="right" valign="top" class="labeltxt"><strong>Pick Up Address:</strong>&nbsp;&nbsp;</td>         

              <td width="62%" colspan="2" align="left">{$pickaddrmiles}</td>

            </tr>
			
			<tr>
			
			   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Destination Address:</strong>&nbsp;&nbsp;</td>	              
               <td width="62%" colspan="2" align="left">{$destinationmiles}</td>
			   
            </tr>
			<tr>
			
			   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Trip Type:</strong>&nbsp;&nbsp;</td>	              
               <td width="62%" colspan="2" align="left">{$trip_type_uss}</td>
			   
            </tr>
			
			<tr>
			
			   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Unloaded Miles:</strong>&nbsp;&nbsp;</td>	              
               <td width="62%" colspan="2" align="left"><input type="text" name="unloadmiles" id="unloadmiles" size="10" value="{$unloadmilage}" class="inputTxtField" /></td>
			   
            </tr>
			
			<tr>
			
			   <td width="38%" align="right" valign="top" class="labeltxt"><strong>Loaded Miles:</strong>&nbsp;&nbsp;</td>	              
               <td width="62%" colspan="2" align="left"><input type="text" name="calcmiles" id="calcmiles" size="10" value="{$calcmilage}" class="inputTxtField" /></td>
			   
            </tr>

            <tr>



              <td valign="top">&nbsp;</td>



              <td colspan="2">



			  <input type="submit" name="submit" value="Submit" class="btn"  />



			  <input type="reset" name="reset" value="Reset" class="btn"  />			  </td>

            </tr>

          </table>



	      </form>							  </td>



            </tr>



			<tr>



			   <td>&nbsp;</td>



			</tr>			



      </table>