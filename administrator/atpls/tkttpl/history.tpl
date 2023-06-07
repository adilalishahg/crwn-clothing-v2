{include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record?");

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

        <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]&nbsp;</div></td>

      </tr>

      <tr>

        <td height="19" align="center" class="admintopheading">TICKETS HISTORY- [{$driver.fname}{$driver.lname}]</td>

        </tr>

      <tr>

        <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">

                  <tr>

                    <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                    <td align="center" class="label_txt_heading"><strong>Driver </strong></td>
					<td width="15%" align="center" class="label_txt_heading"><strong>Date </strong></td>
					<td width="15%" align="center" class="label_txt_heading"><strong>Ticket Number</strong></td>
                    <td width="20%" align="center" class="label_txt_heading"><p><strong>Reason</strong><strong></strong></p></td>
                    <td width="10%" align="center" class="label_txt_heading"><strong>Cost</strong></td>
					<td width="8%" align="center" class="label_txt_heading"><strong>Options</strong></td>

                  </tr>

                {section name=q loop = $tdetails}

				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                    <td align="left" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>
                    <td align="left" valign="middle">{$tdetails[q].driver}</td>
					<td align="left" valign="middle">{$tdetails[q].date}</td>
                    <td align="left" valign="middle"><strong>{$tdetails[q].tck_num}</strong></td>
                    <td align="left" valign="middle">{$tdetails[q].reason} </td>
                    <td align="left" valign="middle">
                   {$tdetails[q].cost}</td>
					<td align="left" valign="middle">
                  <a href="#" onclick="return deleteRec('{$tdetails[q].id}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png" /></a>	                    </td>
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

