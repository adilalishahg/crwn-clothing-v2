{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record?");

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



</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">

  <tr>

     <td valign="top">

	   <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
                            

                            <tr>

                              <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

		                    { if $errors != ''} {$errors} {/if}</span></td>

                            </tr>

<tr>

                              <td height="19" align="center">

							  <div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;">

							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="adduser.php">

			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>

							  </td>

        </tr>							

                            <tr>

<td height="19" align="center" class="admintopheading">ADMIN USERS  MANAGEMENT                              							</td>

                            </tr>

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:20px;">

							  <table width="100%" border="0" class="main_table">

                  <tr>

                    <td width="20%" align="left" class="label_txt_heading"><strong>Name</strong></td>

                    <td align="left" class="label_txt_heading"><strong>Email Address </strong></td>

                    <td width="15%" align="left" class="label_txt_heading"><strong>Username</strong></td>

                    <td width="10%" align="left" class="label_txt_heading"><strong>Log</strong></td>

                    <td width="10%" align="left" class="label_txt_heading"><strong>Status</strong></td>

                    <td width="10%" align="center" class="label_txt_heading"><strong>Options</strong></td>

                  </tr>

                {section name=q loop=$admdetail}

				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

                    <td align="left" valign="middle"><b>{$admdetail[q].admin_name} {$admdetail[q].admin_lname}</b></td>

                    <td align="left" valign="middle">{$admdetail[q].admin_email_address}</td>

                    <td align="left" valign="middle">{$admdetail[q].admin_uname}</td>

                    <td align="left" valign="middle"><a href="../logs/index.php?uid={$admdetail[q].admin_id}"><strong>View Log</strong></a></td>

                    <td align="left" valign="middle">{$admdetail[q].admin_status}</td>

                    <td align="center" valign="middle">

					<a href="edituser.php?eId={$admdetail[q].admin_id}" title="Edit"> 

					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;

                    <a href="#" onclick="return deleteRec('{$admdetail[q].admin_id}');" title="Remove"> 

					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>

                  </tr>

				 {/section} 

                </table>				</td>

            </tr>

			<tr>

			   <td align="center">{$paging}</td>

			</tr>			

      </table>

    </td>

  </tr>

</table>

     </td>

  </tr>

</table>		 

{ include file = innerfooter.tpl}

