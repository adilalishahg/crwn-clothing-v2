{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record? ");

		if (ok)

		{ location.href="dtype_trash.php?delId="+id;

		return true;}else{			

			return false;}

	}

function restore(id)

		{

		var ok;

		ok=confirm("Are you sure you want to restore this record?");

		if (ok)

		{ location.href="dtype_trash.php?resid="+id;

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

        <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]<!--&nbsp;|&nbsp;<a title="Add Vehicle Type" href="addvehtype.php" rel="facebox"><img alt="Add" border="0" src="../graphics/add_12.gif"></a> --></div></td>

      </tr>

      <tr>

        <td height="19" align="center" class="admintopheading">DRIVERS TYPES TRASH </td>

        </tr>

      <tr>

        <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">

                  <tr align="center">

                    <td width="20%" class="label_txt_heading"><strong>S.No.</strong></td>

                    <td width="24%" class="label_txt_heading"><strong>Driver Type </strong></td>

                    <td width="24%" class="label_txt_heading"><strong>Deleted Date</strong></td>

                    <td width="20%" class="label_txt_heading"><strong>Deleted By</strong></td>

                    <td width="12%" class="label_txt_heading"><strong>Options</strong></td>

                  </tr>

                {section name=q loop = $vehtypedetails}

				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

                    <td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>

                    <td align="center" valign="middle">{$vehtypedetails[q].dtype_name}</td>

                    <td align="center" valign="middle">{$vehtypedetails[q].del_date}</td>

                    <td align="center" valign="middle">{$vehtypedetails[q].del_by}</td>

                    <td align="center" valign="middle">

                     {if $smarty.session.admuser.admin_level  eq '0'}

					<a href="#" title="Restore Driver Type"  onClick="return restore('{$vehtypedetails[q].dtype_id}');"> 

					<img border="0" alt="Restore" src="../graphics/restore.png"></a>&nbsp;&nbsp;

                    <a href="#" onClick="return deleteRec('{$vehtypedetails[q].dtype_id}');" title="Remove"> 

					<img alt="Remove" border="0"  src="../graphics/delete.png"></a>

                    {/if}

                    </td>

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

