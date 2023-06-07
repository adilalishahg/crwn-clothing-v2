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

<td height="19" colspan="2" align="center" class="admintopheading">Generated Claims Sheet</td>
                            </tr>

                            

                            <tr>

                              <td colspan="2" align="center"  valign="top">							  </td>
                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="top">&nbsp;</td>
                            </tr>

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top">

							 <form name="searchReport" action="claims.php" method="post" id="searchReport"> 

							  <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" >

            

           <tr>

              <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
            </tr>

            <tr>

              <td width="21%" align="left" valign="top" class="labeltxt"><strong>From Date:</strong></td>

              <td width="31%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$stdate}" class="inputTxtField date required"/>                &nbsp;

                

                (mm/dd/yyyy)</td>

              <td width="10%" align="right" valign="top" class="labeltxt"><strong>To Date:</strong></td>
              <td width="38%" align="left" valign="top"><input type="text" name="enddate" id="enddate" value="{$enddate}" class="inputTxtField date required"/>&nbsp;<br/>
			  
                (mm/dd/yyyy)</td>
            </tr>



            
            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="3" align="left" valign="top">

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

