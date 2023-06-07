{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("This will result in deleting all businesses associated with this category. Proceed?");
		if (ok)
		{		
			
			location.href="category.php?id="+id;
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
{literal}<style type="text/css">
<!--

body {
	background-color: #FFFFFF;
}-->
</style>{/literal}
<table width="1010" border="0" cellspacing="0" cellpadding="0"align="left" bgcolor="#FFFFFF">
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
							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="addcategory.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">CATEGORY MANAGEMENT </td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="40%" border="0" class="main_table">
                  <tr>
                    <td width="15%" align="left" class="label_txt_heading"><strong>S.No.</strong></td>
                   
                    <td align="left" class="label_txt_heading"><strong>Title</strong></td>
                    
                    <td width="20%" align="left" class="label_txt_heading"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$testimonials}
			
				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                    <td align="left" valign="middle"><b>{$smarty.section.q.iteration}. </b></td>
                   
                    <td align="left" valign="middle"><b>
					{$testimonials[q].category}</b></td>
             
                    <td align="left" valign="middle">
					
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
