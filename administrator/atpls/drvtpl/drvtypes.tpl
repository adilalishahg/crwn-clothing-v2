{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record? \nAll Drivers under this type will also be deassociated!");

		if (ok)

		{ location.href="drvtypes.php?delId="+id;

		return true;}else{			

			return false;}

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

        <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp;<a title="Add Driver Type" href="add-drvtype.php" rel="facebox"><img alt="Add" border="0" src="../graphics/add_12.gif"></a></a> </div></td>

      </tr>

      <tr>

        <td height="19" align="center" class="admintopheading">DRIVER TYPES </td>

        </tr>

      <tr>

        <td height="44" align="center"  valign="top"><table width="70%" border="0" class="main_table">

                  <tr align="center">

                    <td width="5%" class="label_txt_heading"><strong>S.No.</strong></td>

                    <td width="25%" class="label_txt_heading"><strong>Driver Type </strong></td>

                    <td width="30%" class="label_txt_heading"><strong>Job Duration (hours) </strong></td>

                    <td width="20%" class="label_txt_heading"><strong>Total Drivers  </strong></td>

                    <td width="20%" class="label_txt_heading"><strong>Options</strong></td>

                  </tr>

                {section name=q loop = $drvtypedetails}

				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

                    <td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>

                    <td align="center" valign="middle">{$drvtypedetails[q].dtype_name}</td>

                    <td align="center" valign="middle">{$drvtypedetails[q].dtype_duration}</td>

                    <td align="center" valign="middle">{if $drvqdetails[q] eq ''}0{else}{$drvqdetails[q]}{/if}</td>

                    <td align="center" valign="middle">

					<a href="editdrvtype.php?id={$drvtypedetails[q].dtype_id}" title="Edit Driver Type" rel="facebox"> 

					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;

                    <a href="#" onClick="return deleteRec('{$drvtypedetails[q].dtype_id}');" title="Remove"> 

					<img alt="Remove" border="0"  src="../graphics/delete.png"></a>					</td>

                  </tr>

				  {sectionelse}

				  <tr>

				    <td colspan="5" align="center"><b>No Record Found</b></td>

				  </tr>

				 {/section} 

                </table></td>

      </tr>

      <tr>

        <td align="center">{$paging}</td>

      </tr>

    </table></td>

  </tr>

</table>

{ include file = innerfooter.tpl}

