
{if $close eq '1'}
{literal}
<script language="javascript"><!--//
window.close();
//--></script>
{/literal}
{/if}
<table width="43%" border="0" align="center" cellpadding="0" cellspacing="0">



                            <tr>



                              <td height="25" align="left" valign="top">&nbsp;</td>



                            </tr>



                            



                            

                            <tr>

								<td height="19" align="center">&nbsp;</td>

                            </tr>



                            <tr>



                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">



							  <form name="ar" id="ar" method="post" action="getclaim.php" onSubmit="close_window();>



	  <table width="100%" border="0" cellspacing="4" cellpadding="2" align="center" class="outer_table">



            <tr>

              

              <td colspan="3" valign="top" class="admintopheading"><strong>Medicaid Resubmission</strong></td>

            </tr>



            <tr>

              <td valign="top" class="labeltxt">&nbsp;</td>

              <td colspan="2">

			  	 <input type="hidden" name="id" value="{$id}">

			  </td>

            </tr>
			
            <tr>              

              <td colspan="3" valign="top"><input type="text" name="reclaimid1" id="reclaimid1" value="{$recid1}" class="inputTxtField" size="10" maxlength="6" />&nbsp;-&nbsp;<input type="text" name="reclaimid2" id="reclaimid2" value="{$recid2}" class="inputTxtField" size="20" /></td>

            </tr>


            <tr>



              <td valign="top">&nbsp;</td>



              <td colspan="2">



			  <input type="submit" name="submit" value="Submit" class="btn"  />



			  </td>

            </tr>

          </table>



	      </form>							  </td>



            </tr>



			<tr>



			   <td>&nbsp;</td>



			</tr>			



      </table>