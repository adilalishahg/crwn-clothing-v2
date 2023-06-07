{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

//FETCH THE AUTOMATED DATA

$(document).ready(function (){	

		$("#vehiclename").autocomplete("rpc.php",{

		extraParams: {

        val: '1' }

        });

		$("#vehclass").autocomplete("rpc.php",{

		extraParams: {

        val: '2' }

        });		

		$("#manufacturer").autocomplete("rpc.php",{

		extraParams: {

        val: '3' }

        });		

		$("#vehyear").autocomplete("rpc.php",{

		extraParams: {

        val: '4' }

        });

		$("#vehmodel").autocomplete("rpc.php",{

		extraParams: {

        val: '5' }

        });

		$("#vehengine").autocomplete("rpc.php",{

		extraParams: {

        val: '6' }

        });

		$("#vehtransmission").autocomplete("rpc.php",{

		extraParams: {

        val: '7' }

        });

		$("#vehmileage").autocomplete("rpc.php",{

		extraParams: {

        val: '8' }

        });

		$("#vehexteriorcolor").autocomplete("rpc.php",{

		extraParams: {

        val: '9' }

        });		

		$("#vehinteriorcolor").autocomplete("rpc.php",{

		extraParams: {

        val: '10' }

        });

		$("#contactnum").autocomplete("rpc.php",{

		extraParams: {

        val: '11' }

        });		

  });	

</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp;[<a href="addvehicle.php">Add Vehicle</a>]</td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="admintopheading">Edit Vehicle </td>

                            </tr>

							

                            <tr>

<td height="19" align="center">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">

							  <form name="editveh" id="editveh" method="post" action="editvehicle.php?id={$id}" enctype="multipart/form-data">

	  <table width="600" border="0" cellspacing="2" cellpadding="2">

        <tr>

          <td colspan="4" align="center" valign="top">{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}		  </td>

        </tr>

        <tr>

          <td colspan="4" align="left" valign="top" class="admintopheading"><strong>Vehicle Information : </strong></td>

          </tr>

        <tr>

          <td colspan="4" align="center" valign="top">

        <table width="90%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>

        <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>

      </tr>

      <tr>

        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>

        <td align="left" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="2">

  <tr>

    <td colspan="2">&nbsp;</td>

    </tr>

  <tr>

    <td height="25" align="right" class="labeltxt">Category : </td>

    <td height="25">

	 <select name="clist" id="clist" class="required">

	  <option value="">--Select--</option>

	  {section name='q' loop=$clist}

	  <option value="{$clist[q].catid}" {if $categ eq $clist[q].catid}selected{/if}>{$clist[q].catname}</option>

	  {/section}	  

	 </select>	 </td>

  </tr>

  <tr>

    <td width="31%" height="25" align="right" class="labeltxt">Stock Number : </td>

    <td width="70%" height="25"><input type="text" name="stocknum" id="stocknum" value="{$stocknum}" class="required" />

      <input type="hidden" name="hidstocknum" id="hidstocknum" value="{$hidstocknum}" /></td>

  </tr>

  <tr>

    <td height="25" align="right" class="labeltxt">Vehicle name : </td>

    <td height="25"><input type="text" name="vehiclename" id="vehiclename" value="{$vehiclename}" class="required" /></td>

  </tr>

  <tr>

    <td height="25" align="right" class="labeltxt">Vehicle Class : </td>

    <td height="25"><input type="text" name="vehclass" id="vehclass" value="{$vehclass}" class="required" />

      <input type="hidden" name="hidvehclass" id="hidvehclass" value="{$hidvehclass}"/></td>

  </tr>

  <tr>

    <td height="25" align="right" class="labeltxt">Manufacturer: </td>

    <td height="25"><input type="text" name="manufacturer" id="manufacturer" value="{$manufacturer}" class="required chars" /></td>

  </tr>

  	  <tr>

			<td width="31%" height="25" align="right" class="labeltxt">Year: </td>

			<td width="70%" height="25"><input type="text" name="vehyear" id="vehyear" value="{$vehyear}" maxlength="4" class="required digits"/></td>

		  </tr>

		  <tr>

			<td height="25" align="right" class="labeltxt">Model: </td>

			<td height="25"><input type="text" name="vehmodel" id="vehmodel" value="{$vehmodel}" class="required" maxlength="15"/></td>

		  </tr>

		  <tr>

			<td height="25" align="right" class="labeltxt">Engine:</td>

			<td height="25"><input type="text" name="vehengine" id="vehengine" value="{$vehengine}" class="required digits" maxlength="4" /> 

			CC </td>

		  </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Transmission: </td>

		    <td height="25"><input type="text" name="vehtransmission" id="vehtransmission" value="{$vehtransmission}" class="required digits"  maxlength="5" /> 

		    CL </td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Mileage</td>

		    <td height="25"><input type="text" name="vehmileage" id="vehmileage" value="{$vehmileage}" class="required digits" maxlength="5" /></td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Exterior Color: </td>

		    <td height="25" valign="top"><input type="text" name="vehexteriorcolor" id="vehexteriorcolor" value="{$vehexteriorcolor}" class="required chars" maxlength="20" />

			<input type="text" name="exteriorcode" id="exteriorcode" value="{$exteriorcode}" class="iColorPicker" size="7" />			  </td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Interior Color: </td>

		    <td height="25" valign="top"><input type="text" name="vehinteriorcolor" id="vehinteriorcolor" value="{$vehinteriorcolor}"  class="required chars" maxlength="20"/>

		      <input type="text" name="interiorcode" id="interiorcode" value="{$interiorcode}" class="iColorPicker"  size="7" /></td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">&nbsp;</td>

		    <td height="25">&nbsp;</td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Description:</td>

		    <td height="25">

			<textarea name="vehdescription" cols="55" rows="10" class="required" id="vehdescription">{$vehdescription}</textarea></td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Price:</td>

		    <td height="25"><input type="text" name="vehprice" id="vehprice" value="{$vehprice}" class="required digits"  maxlength="8" /></td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Contact Number: </td>

		    <td height="25"><input name="contactnum" type="text" class="required" id="contactnum" value="{$contactnum}" maxlength="14"/></td>

		    </tr>

		  <tr>

		    <td height="25" align="right" class="labeltxt">Status :</td>

		    <td height="25"><select name="availability" id="availability" class="required">

              <option value="">--Select--</option>

     	      <option value="Available" {if $status eq 'Available'}selected{/if}>Available</option>

     	      <option value="Unavailable" {if $status eq 'Unavailable'}selected{/if}>Unavailable</option>

     	      <option value="Sold" {if $status eq 'Sold'}selected{/if}>Sold</option>			  			  

		      </select></td>

		    </tr>

</table>		</td>

        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>

      </tr>

      <tr>

        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>

        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>

      </tr>

    </table>    	</td>

        </tr>

         

        <tr>

          <td colspan="4" align="left" valign="top" class="admintopheading"><strong>Image :</strong></td>

          </tr>

        <tr>

          <td colspan="4" align="center" valign="top">

		  <table width="90%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td width="17" align="left" valign="top"><img src="../images/1.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>

        <td width="17" align="left" valign="top"><img src="../images/3.jpg" width="17" height="17" /></td>

      </tr>

      <tr>

        <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>

        <td align="left" valign="top">

		<table width="100%" border="0" cellspacing="2" cellpadding="2">

		 {if $timg neq ''} 

		  <tr>

		    <td height="35" align="right" class="labeltxt">&nbsp;</td>

		    <td height="35"><a href="../../{$limg|replace:'%2F':'/'}" rel="facebox"><img src="../../{$timg|replace:'%2F':'/'}" border="0" /></a>

			<input type="hidden" name="timg" id="timg" value="{$timg}" />

			<input type="hidden" name="limg" id="limg" value="{$limg}" />

			</td>

		  </tr>

         {/if}

		  <tr>

			<td width="31%" height="35" align="right" class="labeltxt">

			{if $timg neq ''}

			Replace Image :{else}

			Upload Image :

			{/if}

			</td>

			<td width="69%" height="35"><input type="file" name="vehlarge[]" id="vehlarge" {if $timg eq ''}class="required"{/if}/></td>

		  </tr>

		</table>		</td>

        <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>

      </tr>

      <tr>

        <td align="left" valign="top"><img src="../images/6.jpg" width="17" height="17" /></td>

        <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>

        <td align="left" valign="top"><img src="../images/8.jpg" width="17" height="17" /></td>

      </tr>

    </table>		  </td>

        </tr>

        <tr>

          <td align="left" valign="top">&nbsp;</td>

          <td colspan="3" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

          <td colspan="4" align="left" valign="top" class="admintopheading"><strong>Featured Vehicle?:</strong></td>

          </tr>

        <tr>

          <td width="48" align="right" valign="top">

		  <input name="featured" type="radio" id="featured1" value="yes" {if $featureprod eq 'yes'}checked{/if}/></td>

          <td width="70" align="left" class="labeltxt">Yes</td>

          <td width="20" align="left" class="labeltxt">

		  <input name="featured" type="radio" id="featured2" value="no"  {if $featureprod eq 'no'}checked{/if}/></td>

          <td width="436" align="left" class="labeltxt">No</td>

        </tr>

        <tr>

          <td colspan="4" align="left" valign="top">&nbsp;</td>

        </tr>

        

        <tr>

          <td align="right" valign="top">&nbsp;</td>

          <td colspan="3" align="left" valign="top">&nbsp;</td>

        </tr>

        <tr>

          <td align="right" valign="top">&nbsp;</td>

          <td colspan="3" align="center" valign="top">

		  <input type="submit" name="edit_veh" id="edit_veh" value="Edit Vehicle" />

		  <input type="reset" name="reset" id="reset" value="Reset" />		  </td>

        </tr>

        <tr>

          <td align="right" valign="top">&nbsp;</td>

          <td colspan="3" align="left" valign="top">&nbsp;</td>

        </tr>

		<tr>

		  <td colspan="4"><!--  CONTENT DETAIL --></td>

		</tr>

      </table>

	      </form>							  </td>

            </tr>

			<tr>

			   <td>&nbsp;</td>

			</tr>			

      </table>

    </td>

  </tr>

</table>		 

{ include file = innerfooter.tpl}

