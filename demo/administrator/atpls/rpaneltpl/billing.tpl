{ include file = headerinner.tpl}



{literal}

<script type="text/javascript">



function deleteRec(id)

		{

	

		

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{		

			

			location.href="index.php?delId="+id;

			return true;

			//document.delrecfrm.submit();

		}

		else

		{

			

			return false;

		}

			

	}

	

	

	function editRec(id)

		{

	

		

		var ok;

		ok=confirm("Are you sure you want to edit this record");

		if (ok)

		{		

			

			location.href="grid/default.php";

			return true;

			//document.delrecfrm.submit();

		}

		else

		{

			

			return false;

		}

			

	}





function getCatSorted(val){

  if(val != ''){

   location.href = 'index.php?vendor='+val;

   }else{

   location.href = 'index.php';   

   }

}

   function popWind(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 230, width = 340, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(300,200);
   }
   function popWind2(url){
   myWindow1 = window.open( url, "myWindow1", 
"status = 1, height = 600, width = 600, scrollbars=0, resizable = 0" );
   myWindow1.moveTo(200,10);
   }
</script>

{/literal}



<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="outer_table" style="margin-bottom:10px;" >

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">

                          
                            

                          <tr>
          <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</td>
        </tr>

<tr>

                              <td height="19" align="center">

							  <div align="left" id="add_div" style="padding-right:40px; padding-bottom:5px;">

							 	<a rel="facebox" href="add_addon.php"><img alt="Add" border="0" src="../graphics/add_trip.png"></a>	<a href="../sample.xls"><img alt="Add" border="0" src="../graphics/sample_sheet.png"></a>&nbsp;<a href="gridto.php"><img alt="Current Trips" border="0" src="../graphics/surrent_trip_btn.png"></a>&nbsp;<a href="#" onclick="popWind('calculate_rate.php');"><img alt="Calculate Fare" border="0" src="../graphics/calculate1_btn.png"></a>&nbsp;<a href="#" onclick="popWind2('latesttrips.php');"><img alt="Real Time Summary" border="0" src="../graphics/real_time_sum_btn.png"></a></div></td>

        </tr>					

        				<tr>

                        <td>

                         <div id="search_form">

              <form name="frm_sheet" action="index.php" method="post" id="frm_sheet">

                <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" class="outer_table">

                  <tr>

                    <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                  </tr>

                  <tr>

                    <td width="21%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>

                    <td width="31%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$sdate}" class="inputTxtField date required"/>

                      &nbsp;

                      <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />

                        <div class="suggestionList" id="autoSuggestionsList1"> &nbsp; </div>
                      </div>

                    (mm/dd/yyyy)</td>

                    <td width="16%" align="right" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>

                    <td align="left" valign="top" class="labeltxt"><input type="text" name="enddate" id="enddate" value="{$edate}" class="inputTxtField date required" />

                      <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">

                        <div class="suggestionList" id="div">&nbsp; </div>
                      </div>

                    (mm/dd/yyyy)</td>
                  </tr>

                  <tr>

                    <td align="left" valign="top">&nbsp;</td>

                    <td colspan="2" align="left" valign="top"><font color="#FF0000"> <b>Note:*</b>

                      <ol>

                        <li>Both Start and End date must be provided.</li>
                      </ol>

                      </font></td>

                    <td align="right" valign="bottom" ><a title="Add" href="add-csv.php" rel="facebox"></a> </td>
                  </tr>

                  <tr>

                    <td align="left" valign="top">&nbsp;</td>

                    <td colspan="2" align="left" valign="top"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  />

                      &nbsp;

                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  /></td>
                    <td align="right" valign="bottom"><a title="Add" href="add-csv.php" rel="facebox"><img alt="Add" border="0" src="../graphics/add.png" /></a></td>
                  </tr>
                </table>

              </form>

            </div>

                        </td>

                        </tr>		

                            <tr>

                              <td height="19" align="center" class="admintopheading">Billing</td>

                            </tr>

                           

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">

							  <table width="700" border="0" class="main_table">

                  <tr>

                    <td align="left" class="label_txt_heading"><strong>Routing Sheet</strong></td>

                    <td  align="left" class="label_txt_heading"><strong>Uploaded By</strong></td>

                    <td  align="left" class="label_txt_heading"><strong>Last Uploaded</strong></td>

                    <td  align="left" class="label_txt_heading"><strong>Download </strong></td>

                    <td  align="left" class="label_txt_heading"><strong>Options</strong></td>

				  </tr>

                {section name=q loop=$vehdetail}
                  {if $vehdetail[q].file_name neq ''}

				  <tr valign="top" bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

				   

                    <td align="left" valign="middle"><b>{$vehdetail[q].file_name}</b></td>

                    <td align="left" valign="middle">{$vehdetail[q].admin_name}</td>

					<td align="left" valign="middle">{$vehdetail[q].timed}&nbsp;&nbsp;{$vehdetail[q].dated|date_format}</td>

                    <td align="center" valign="middle"><a href="../routing-sheets/{$vehdetail[q].sheet_name}"><img src="../images/download_icon.png" border="0"></a></td>

                  

                    <td align="center" valign="middle">

					{if $vehdetail[q].state eq '1'}

					<a href="grid.php?id={$vehdetail[q].sheet_id}&st=5&ad=0" title="View">View</a>&nbsp;&nbsp;

					{/if}

    

                    <a href="#" onclick="return deleteRec('{$vehdetail[q].sheet_id}');" title="Remove"><img alt="Remove" border="0"  src="../graphics/delete.png" /></a>

       

                    {if $vehdetail[q].blast neq '1'}

                    <a href="e-blast.php?id={$vehdetail[q].sheet_id}"><img alt="Blast Email" title="Blast Email" border="0"  src="../images/email.png" /></a>

                    {/if}
					
					
					
					{if $vehdetail[q].sms neq '1'}

                    <a href="sms.php?id={$vehdetail[q].sheet_id}"><!--<img alt="Blast SMS" title="Blast SMS" border="0"  src="../images/email.png" />--><img src="../images/sms.png" alt="" border="0" style="margin-top:3px;"/></a>

                    {/if}
					

                    </td>

                  </tr>
                  {/if}

				  {sectionelse}

				   <tr>

				     <td colspan="9" align="center"><b>NO RECORD FOUND</b></td>

				   </tr>

				 {/section} 

                </table>				</td>

            </tr>

		<tr>

          <td colspan="2" align="center">{$pages}</td>

        </tr>

      </table>

    </td>

  </tr>

</table>



	 

{ include file = innerfooter.tpl}

