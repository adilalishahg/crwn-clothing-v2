{include file = headerinner.tpl}



{literal}



<script type="text/javascript">



function deleteRec(id)



		{



		var ok;



		ok=confirm("Are you sure you want to delete this record");



		if (ok)



		{ location.href="history.php?id={/literal}{$id}{literal}&delId="+id;



		return true;}else{			



			return false;}



	}



	



function stchange(val)



{



  if (val != ''){		



 	location.href="index.php?st="+val;



	return true;}else{



			return false;



		}			



	}	



</script>



{/literal}



<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">



  <tr>



    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">



      



      <tr>



        <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}



          { if $errors != ''} {$errors} {/if}</td>



      </tr>



      <tr>



        <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]&nbsp;</div></td>



      </tr>



      <tr>



        <td height="19" align="center" class="admintopheading">FUEL CONSUMPTION - [{$vehicle.vname}-{$vehicle.vnumber}]</td>



        </tr>



      <tr>



        <td height="44" align="center"  valign="top"><table width="100%" border="0" class="main_table">



                  <tr>



                    <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>



                    <!--<td width="15%" align="center" class="labeltxt"><strong>Vehicle Number</strong></td>



                    <td width="15%" align="center" class="labeltxt"><strong>Vehicle Name </strong></td>-->



                    <td align="center" class="label_txt_heading"><strong>Driver</strong></td>



                    <td width="20%" align="center" class="label_txt_heading"><strong>Last Re-Fill Date <br />

                        (mm/dd/yyyy)</strong></td>



                    <td width="20%" align="center" class="label_txt_heading"><strong>Quantity(Gallons)/</strong><br/>



                    <strong>Amount</strong></td>



                    <td width="10%" align="center" class="label_txt_heading"><strong>Options</strong></td>



                  </tr>



                {section name=q loop = $fdetails}



				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">



                    <td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>



                    <!--<td align="center" valign="middle">{$fdetails[q].veh_num_plate}</td>



                    <td align="center" valign="middle">{$fdetails[q].veh_name}</td>-->



                    <td align="center" valign="middle">{$fdetails[q].driver}</td>



                    <td align="center" valign="middle"><strong>{$dt}</strong></td>



                    <td align="center" valign="middle"><strong>{$fdetails[q].qty} / ${$fdetails[q].fuel_amt|number_format}</strong></td>



                    <td align="center" valign="middle">



                   {if $smarty.session.admuser.admin_level eq '0'}



                   <a href="#" onClick="return deleteRec('{$fdetails[q].fid}');" title="Remove"> 



					<img alt="Remove" border="0"  src="../graphics/delete.png"></a>	



                    {else}



                    N/A



                    {/if}				



                    </td>



                  </tr>



				  {sectionelse}



				  <tr>



				    <td colspan="7" align="center"><b>No Record Found</b></td>



				  </tr>



				 {/section} 



                  {if $smarty.session.admuser.admin_level neq '0'}



                  <tr>



				    <td colspan="7" align="center"><b>Only Super Admin is Allowed to Remove Record from this Module!</b></td>



				  </tr> {/if}



                </table></td>



      </tr>



      <tr>



        <td align="center">{$paging}</td>



      </tr>



    </table></td>



  </tr>



</table>



{ include file = innerfooter.tpl}



