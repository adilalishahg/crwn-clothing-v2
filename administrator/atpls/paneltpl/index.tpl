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
	
function stchange(val)
{
  if (val != ''){		
 	location.href="index.php?state="+val;
	return true;}else{
			return false;
	}			
}

</script>
{/literal}
<table class="outer_table" width="720" border="0" cellspacing="0" cellpadding="0"align="center" bgcolor="#FFFFFF">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                                       
                            <tr>
                              <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
                              <td height="19" align="left">
							  <span style="color:#FF0000; font-weight:bold;">Filter By : </span><select name="st" id="st" onchange="return stchange(this.value);" style="width:220px;">
  	<option value="">--Select--</option>
      <option value="left" {if $st1 eq '1'}selected="selected"{/if}>Left Panel</option>
	  <option value="right" {if $st1 eq '2'}selected="selected"{/if}>Right Panel</option>	  
</select>
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>]| <a title="Add" href="addpanel.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">PANEL MANAGEMENT</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="95%" border="0" class="main_table">
                  <tr>
                    <td width="8%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>                   
                    <td align="left" class="label_txt_heading"><strong>Image</strong></td>
                    <td width="25%" align="left" class="label_txt_heading"><strong>URL</strong></td>
					<td width="15%" align="left" class="label_txt_heading"><strong>Status</strong></td>
	                <td width="25%" align="left" class="label_txt_heading"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$testimonials}
			
				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                    <td align="left" valign="middle"><b>{if $smarty.get.Page}{math equation="(x+((y-1)*10))" x=$smarty.section.q.iteration y=$smarty.get.Page}{else}{$smarty.section.q.iteration}{/if}. </b></td>                   
                    <td align="left" valign="middle"><a href="{$target}{$testimonials[q].image}" rel="facebox"><b>{$testimonials[q].image}</b></a></td>                     
                    <td align="left" valign="middle"><a href="http://{$testimonials[q].link}" target="_blank">{$testimonials[q].link}</a></td>
					<td align="left" valign="middle"><b>{if $testimonials[q].status eq '0'}Non-Featured{else}Featured{/if}</b></td>	
                    <td align="left" valign="middle">
					 <a href="index.php?st={$testimonials[q].id}&pub_id={$testimonials[q].status}&ptype={$testimonials[q].panel_type}" title="Image Status">
					{if $testimonials[q].status eq '1'}Non-Featured{else}Featured{/if}</a>&nbsp;|&nbsp;
					<a href="editpanel.php?id={$testimonials[q].id}" title="Edit"> 
					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;|&nbsp;
                    <a href="#" onclick="return deleteRec('{$testimonials[q].id}');" title="Remove"> 
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				 {sectionelse}
                 <tr><td colspan="5" align="center" style="color:#FF0000;">No Record Found</td></tr>
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
