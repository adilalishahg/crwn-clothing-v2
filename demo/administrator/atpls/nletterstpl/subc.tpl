{include file = headerinner.tpl}
{literal}
<script type="text/javascript">

function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record?");
		if (ok)
		{		
			
			location.href="subc.php?delId="+id;
			return true;
		}
		else
		{
			
			return false;
		}
			
	}
	

</script>
{/literal}

<table width="720" style="margin-bottom:10px;" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="outer_table" >
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                              <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
                              <td height="19" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="addmember.php" rel="facebox">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">SUBSCRIBERS MANAGEMENT                              							</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:20px;">
							  <table width="50%" border="0">
                  <tr>
                    <td  align="left" class="label_txt_heading"><strong>Email Address </strong></td>
                    <td  align="center" class="label_txt_heading"><strong>Options</strong></td>
				  </tr>
                {section name=q loop=$membdetail}
				  <tr bgcolor="{cycle values='#E1E9FF,#ffffff'}" >
                    <td align="left" class="labeltxt" valign="middle"><a href="mailto:{$membdetail[q].email}">{$membdetail[q].email}</a></td>
                    <td align="center" valign="middle">					
                   <a href="#" onClick="return deleteRec('{$membdetail[q].id}');" title="Remove">  
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				  {sectionelse}
				  <tr>
				  <td colspan="2" align="center" style="color:#FF0000; font-weight:bold;">No Record Found</td>
				  </tr>
				 {/section} 
                </table>				</td>
            </tr>
			<tr>
			   <td><center>{$paging}</center></td>
			</tr>			
      </table>
    </td>
  </tr>
</table>

	 
{ include file = innerfooter.tpl}
