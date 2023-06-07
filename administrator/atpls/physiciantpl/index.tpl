{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record?");
		if (ok)
		{		
			
			location.href="index.php?id="+id;
			return true;
		}
		else
		{
			
			return false;
		}
			
	}

</script>
{/literal}
{literal}<style type="text/css">
<!--

body {
	background-color: #FFFFFF;
}-->
</style>{/literal}
<table width="700" border="0" cellspacing="0" cellpadding="0"align="center" bgcolor="#FFFFFF" class="outer_table" style="margin-bottom:10px;">
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
							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="addphysician.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">PHYSICIAN DETAILS</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="100%" border="0" class="main_table">
                  <tr>
                    <td width="10%" align="left" class="label_txt_heading"><strong>S.No.</strong></td>   
					<td width="20%" align="left" class="label_txt_heading"><strong>Physician Name</strong></td>                
                    <td align="left" class="label_txt_heading"><strong>Specialities</strong></td>
					<td align="left" class="label_txt_heading"><strong>Address</strong></td>
					<td width="15%" align="left" class="label_txt_heading"><strong>Status</strong></td>
                    <td width="25%" align="left" class="label_txt_heading"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$testimonials}
			
				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                    <td align="left" valign="middle"><b>{$smarty.section.q.iteration}. </b></td>                   
                    <td align="left" valign="middle"><b>{$testimonials[q].name}</b></td>                              
                    <td align="left" valign="middle"><b>{$testimonials[q].specialities}</b></td>
					<td align="left" valign="middle"><b>{$testimonials[q].address}</b></td>
					<td align="left" valign="middle">{if $testimonials[q].status eq '0'}Un-Published{else}Published{/if}</td>
                    <td align="left" valign="middle"><a href="index.php?st={$testimonials[q].id}&pub_id={$testimonials[q].status}" title="Status">{if $testimonials[q].status eq '0'}Published{else}Un-Published{/if}</a>&nbsp;|&nbsp;<a href="editphysician.php?id={$testimonials[q].id}" title="Edit"> 
					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;|&nbsp;
                    <a href="#" onclick="return deleteRec('{$testimonials[q].id}');" title="Remove"> 
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				 {sectionelse}
                 <tr><td colspan="5" align="center">No Record Found</td></tr>
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
{ include file = innerfooter.tpl}
