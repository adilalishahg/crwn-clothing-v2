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
{literal}<style type="text/css">
<!--

body {
	background-color: #FFFFFF;
}-->
</style>{/literal}
<table width="720" class="outer_table" border="0" cellspacing="0" cellpadding="0"align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
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
                              <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>]| 
							
						 <a title="Add" href="addform.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">MANAGE FORMS/BROCHURES</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-top:15px;">
							  <table width="95%" border="0" class="main_table">
                  <tr>
                    <td align="left" class="label_txt_heading" width="5%"><strong><strong>S.No. </strong></strong></td>
                    <td align="left" class="label_txt_heading" width="25%"><strong><strong>Title</strong></strong></td>
                    <td align="left" class="label_txt_heading"><strong>Description</strong></td>
                    <td align="left" class="label_txt_heading" width="10%"><strong>Document</strong></td>
                    <td align="left" class="label_txt_heading" width="13%"><strong>Status</strong></td>
                    <td align="left" class="label_txt_heading" width="20%"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$testimonials}
			
				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                    <td align="left"><b>{if $smarty.get.Page}{math equation="(x+((y-1)*10))" x=$smarty.section.q.iteration y=$smarty.get.Page}{else}{$smarty.section.q.iteration}{/if}. </b></td>
                    <td align="left"><b>{$testimonials[q].title}</b></td>
                    <td align="left"><a href="details.php?eId={$testimonials[q].id}" rel="facebox">{$testimonials[q].description|truncate:30:"..."|strip_tags}</a></td>
                    <td align="center">{if $testimonials[q].file_ext eq 'jpg'}<a href="{$target_path}{$testimonials[q].file_name}" rel="facebox">{else}<a href="{$target_path}{$testimonials[q].file_name}" target="_blank">{/if}<b>View</b></a></td>
                    <td align="left">{if $testimonials[q].status eq '0'}Un-Published{else}Published{/if}</td>
                    <td align="left">
                    <a href="index.php?st={$testimonials[q].id}&pub_id={$testimonials[q].status}" title="Status">
					{if $testimonials[q].status eq '1'}Un-Published{else}Published{/if}</a>|					
					<a href="editform.php?id={$testimonials[q].id}" title="Edit"> 
					<img border="0" alt="Edit" src="../graphics/edit.png"></a>|
                    <a href="#" onclick="return deleteRec('{$testimonials[q].id}');" title="Remove"> 
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				  {sectionelse}
				 <tr>
				  <td colspan="6" align="center" style="color:#FF0000;"><b>No Record Found</b></td>
				 </tr> 
				 {/section}
                </table>				</td>
            </tr>
			{if $maxRecord gt 10}
			<tr>
			   <td align="center"><a href="{$url1}"><img src="../../images/previous.jpg" width="30" height="30" border="0" /></a>&nbsp;{$paging}&nbsp;<a href="{$url2}"><img src="../../images/next.jpg" width="30" height="30" border="0" /></a></td>
			</tr>	
            {/if}			
      </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}


