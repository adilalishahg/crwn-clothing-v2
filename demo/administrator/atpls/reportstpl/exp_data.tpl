{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

$(document).ready(function(){

		$('#searchReport').validate();

		$('#hosp').attr('disabled', true);

		});



function other()

{

	val = document.getElementById('hospname').value;

	if(val =='other')

	{

		$('#hosp').attr('disabled', false);

	}

	else

	{

		 $('#hosp').attr('disabled', true);

	}

}

</script>

{/literal}

<table width="600" border="0" cellspacing="0" cellpadding="0" class="" align="center" bgcolor="#FFFFFF">

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

<td height="19" colspan="2" align="center" class="admintopheading">Export Data</td>
                            </tr>

                            

                            <tr>

                              <td colspan="2" align="center"  valign="top">							  </td>
                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>
                            </tr>

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top">

							 <form name="searchReport" action="exp_data.php" method="get" id="searchReport"> 

							  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" class="">

            

           <tr>

              <td colspan="3" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
            </tr>

            <tr>

              <td width="21%" align="left" valign="top" class="labeltxt"><strong>Date:</strong></td>

              <td width="31%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$stdate}" class="inputTxtField required"/>                &nbsp;

                <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;">

                  <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />

                  <div class="suggestionList" id="autoSuggestionsList1">

  &nbsp;				</div>
			      </div>

                (mm/dd/yyyy)</td>

              <td align="right" valign="top">&nbsp;</td>
              </tr>



            
            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="2" align="left" valign="top">

			  <input type="submit" name="submit" id="submit" value='Search' class="inputButton btn"  />&nbsp;

			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />			  </td>
              </tr>
          </table>	
		                     </form>		  	                  </td>
                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>
                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top" height="35">&nbsp;</td>
                            </tr>

                          <tr>

                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">

							  <table width="95%" border="0" class="main_table">	   
                            {if $numRows == '0'}
  						     <tr>
							  <td width="70%" align="center" style="color:#FF0000;" ><b>No Record Found</b></td>
							 </tr> 
                            {else}
  						     <tr>
							  <td width="70%" align="center" style="color:#FF0000;"><a href="{$filename}"><u>Download</u></a> {$url}</td>
							 </tr> 							
							{/if}
							</table></td>
                    </tr>
      </table>

    </td>

  </tr>

</table>

		 

{ include file = innerfooter.tpl}

