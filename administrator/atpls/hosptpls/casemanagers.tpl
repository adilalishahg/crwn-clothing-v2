{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record?");

		if (ok)

		{ location.href="casemanagers.php?delId="+id;

		return true;}else{			

			return false;}

	}

	

function stchange(val)

{

  if (val != ''){		

 	location.href="casemanagers.php?hosp="+val;

	return true;}else{

	location.href="casemanagers.php";

	return true;

		}			

	}	

	

</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                                                        

                            <tr>

                              <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

		                    { if $errors != ''} {$errors} {/if}</span></td>

                            </tr>

<tr>

                              <td height="19" colspan="2" align="center">

							  <div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;">

							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="addcm.php">

			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>							  </td>

        </tr>							

                            <tr>

                              <td width="16%" height="19" align="center"><div align="left">

                                <select name="hosp_name" id="hosp_name" onChange="return stchange(this.value);">

                                  <option value="">All Facilitys</option>

                                  

				{section name=r loop=$hosp}

				

                                  <option value="{$hosp[r].id}" {if $hospid eq $hosp[r].id}selected="selected"{/if}>{$hosp[r].hospname}</option>

                                  

				{/section}

			  

                                </select>

                              </div></td>

                              <td width="100%" align="center">&nbsp;</td>

                            </tr>

                            <tr>

                              <td height="19" colspan="2" align="center" class="admintopheading">CASE MANAGERS  MANAGEMENT</td>

                            </tr>

                            

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top">

							  <table width="100%" border="0" class="main_table">

                  <tr>

                    <td width="20%" align="center" class="label_txt_heading"><strong>Name</strong></td>

                    <td align="center" class="label_txt_heading"><strong>Email Address </strong></td>

                    <td width="25%" align="center" class="label_txt_heading"><strong>Facility</strong></td>

                    <td width="15%" align="center" class="label_txt_heading"><strong>User name </strong></td>

                    <td width="20%" align="center" class="label_txt_heading"><strong>Phone</strong></td>

                    <td width="8%" align="center" class="label_txt_heading"><strong>Options</strong></td>

                  </tr>

                {section name=q loop=$cm}

				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

                    <td align="left" valign="middle"><b>{$cm[q].fname} {$cm[q].lname}</b></td>

                    <td align="center" valign="middle">{$cm[q].email}</td>

                    <td align="center" valign="middle">{$cm[q].hospname}</td>

                    <td align="center" valign="middle">{$cm[q].username}</td>

                    <td align="center" valign="middle">{$cm[q].phone}</td>

                    <td align="center" valign="middle">

					<a href="editcm.php?id={$cm[q].cm_id}" title="Edit"> 

					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;

                    <a href="#" onClick="return deleteRec('{$cm[q].cm_id}');" title="Remove"> 

					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>

 				 </tr>

				{sectionelse}

				 <tr>

				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>

				 </tr> 

				 {/section} 

                </table>				</td>

            </tr>

			<tr>

			   <td colspan="2" align="center">{$paging}</td>

			</tr>			

      </table>

    </td>

  </tr>

</table>		 

{ include file = innerfooter.tpl}

