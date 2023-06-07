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
			//document.delrecfrm.submit();
		}
		else
		{
			
			return false;
		}
			
	}

</script>
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                            <tr>
                              <td  align="center" valign="top">
  							  </td>
                            </tr>
                            
                            <tr>
                              <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
                              <td height="19" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							  [<a href="javascript:history.back();">Back</a>]| 
						 <a title="Add" href="addtestimonials.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">MANAGE TESTIMONIALS</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-top:15px; padding-left:15px;">
							  <table width="100%" border="0" class="main_table">
                  <tr>
                    <td width="10%" align="left" class="label_txt_heading"><strong>S.No. </strong></td>
                    <td width="20%" align="left" class="label_txt_heading"><strong><strong>Name</strong></strong></td>
                    <td align="left" class="label_txt_heading"><strong>Message</strong></td>
                    <td width="15%" align="left" class="label_txt_heading"><strong>Status</strong></td>
                    <td width="20%" align="left" class="label_txt_heading"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$testimonials}			
				  <tr>
                    <td align="left" valign="middle"><b>{if $smarty.get.Page}{math equation="(x+((y-1)*10))" x=$smarty.section.q.iteration y=$smarty.get.Page}{else}{$smarty.section.q.iteration}{/if}. </b></td>
                    <td align="left" valign="middle"><b>{$testimonials[q].fname} {$testimonials[q].lname}</b></td>
                    <td align="left" valign="middle"><a href="details.php?eId={$testimonials[q].id}" rel="facebox"><b>
					{$testimonials[q].message|truncate:30:"..."}...</b></a></td>
                    <td align="left" valign="middle">{if $testimonials[q].publish eq '0'}Un-Published{else}Published{/if}</td>
                    <td align="left" valign="middle">
					{if $testimonials[q].publish eq '0'}<a href="index.php?st={$testimonials[q].id}&pub_id=1" title="Status">Publish</a>{else}<a href="index.php?st={$testimonials[q].id}&pub_id=0" title="Status">Un-Publish</a>{/if}</a>&nbsp;|&nbsp;
					<a href="edittestimonials.php?id={$testimonials[q].id}" title="Edit"> 
					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;|&nbsp;
                    <a href="#" onclick="return deleteRec('{$testimonials[q].id}');" title="Remove"> 
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				  {sectionelse}
				 <tr>
				  <td colspan="5" align="center" style="color:#000000"><b>No Record Found</b></td>
				 </tr> 
				 {/section}
                </table>				</td>
            </tr>
			{if $maxRecord gt 10}
			<tr>
			   <td align="center"><a href="{$url1}"><img src="../../images/previous.jpg" width="30" height="30" border="0" /></a>&nbsp;{$paging}<a href="{$url2}"><img src="../../images/next.jpg" width="30" height="30" border="0" /></a></td>
			</tr>
			{/if}			
      </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}
