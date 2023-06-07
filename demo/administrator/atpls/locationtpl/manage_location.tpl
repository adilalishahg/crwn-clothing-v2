{include file = headerinner.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function(){
	$('#search_btn').click(function(){
		$("#search_frm").validationEngine()
	});
    $('#searchdate').datepicker();
});
function deleteRec(id)
		{
	
		var ok;
		ok=confirm("Are you sure you want to delete this location?");
		if (ok)
		{				
			location.href="manage_location.php?delId="+id;
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
 		location.href="manage_location.php?state="+val;
		return true;
	}else{
		return false;
	}			
}	

function showdetails(froms,tos)
{
   	<!--var mywindow = window.open('location_detail.php?from='+froms+'&to='+tos,'AZ Pakistan Location Search','left=150,top=0,width=720,height=600,scrollbars=yes,resizable=no');-->
	myRef = window.open('location_detail.php?from='+froms+'&to='+tos,'mywin','left=150,top=20,width=720,height=600,toolbar=0,resizable=0,scrollbars=1');
				return false;
}
</script>
{/literal}
<table width="720"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="outer_table" >
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
                                                        
                            <tr>
                              <td height="19" colspan="8" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>
<tr>
							
                              <td height="19" colspan="8" align="center" style="padding:5px">
							  
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp; <a title="Add" href="new.php">
			                 <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
							
        </tr>				
		<form name="search_frm" id="search_frm" action="manage_location.php" method="post" >			
                            <tr>
                              <td colspan="2" align="center" valign="top" >&nbsp;</td>
                              <td width="8%" align="center" class="labeltxt" valign="top"><b>Keyword:</b></td>
                              <td width="16%" align="center" valign="top">{if $selected eq 'title'}<input type="text" name="keyword" id="keyword" value="{$keyword}" class="validate[required,length[0,100]]" />{else}<input type="text" name="searchdate" id="searchdate" value="{$keyword}" class="validate[required]" />{/if} &nbsp;</td>
                              <td width="16%" valign="top" align="left" style="padding-left:2px;"><select name="select" id="select" onchange="return stchange(this.value);">
                                <option value="title" {if $selected eq 'title'}selected{/if}>Title</option>
                                <option value="created_on"{if $selected eq 'created_on'}selected{/if}>Added On</option>
                              </select></td>
                              <td width="8%" align="center" style="padding-left:2px"><input type="submit" name="search_btn" id="search_btn" value="Search" class="btn" /> &nbsp;</td>
                              <td width="25%" align="center">&nbsp;</td>
                            </tr></form>
                            <tr>
                              <td align="center" >&nbsp;</td>
                              <td colspan="8" align="center" >&nbsp;</td>
                            </tr>
                            <tr>                       
                             
                              <td colspan="8" align="center" class="admintopheading">LOCATION MANAGEMENT</td>
                            </tr>
                            
                            <tr>
                              <td height="44" colspan="8" align="center"  valign="top" style="padding-bottom:50px;">
							  <table width="95%" border="0" class="main_table">
                  <tr>
                    <td  align="center" class="label_txt_heading"><strong><strong>S.No.</strong></strong></td>
                    <td  align="left" class="label_txt_heading"><strong>Title</strong></td>
                    <td  align="left" class="label_txt_heading"><strong>Description</strong></td>
					<td  align="left" class="label_txt_heading"><strong>Added On </strong></td>
					<td  align="left" class="label_txt_heading"><strong>Direction</strong></td>                               
                    <td  align="left" class="label_txt_heading"><strong>Options</strong></td>
				  </tr>
                {section name=q loop=$detail}
				  <tr>
				    <td align="center"><b>{if $smarty.get.Page}{math equation="(x+((y-1)*10))" x=$smarty.section.q.iteration y=$smarty.get.Page}{else}{$smarty.section.q.iteration}{/if}.</b></td>
                    <td align="left"><!--<a href="index.php?id={$detail[q].id}">--><strong>{$detail[q].title}</strong><!--</a>--></td>
                    <td align="left">{$detail[q].description}</td>
                    <td align="left">{$detail[q].created_on|date_format}</td>
                    <td align="left"><a href="#" onclick="javascript:showdetails('{$detail[q].from_direct}','{$detail[q].to_direct}');">Show</a></td>                                                     
                    <td align="left">					
					<a href="edit_location.php?id={$detail[q].id}" title="Edit"> 
					<img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;|&nbsp;
                    <a href="#" onclick="return deleteRec('{$detail[q].id}');" title="Remove"> 
					<img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				  	{sectionelse}
				 <tr>
				  <td colspan="6" align="center" style="color:#FF0000"><b>No Record Found</b></td>
				 </tr> 
				 {/section} 
                </table>				</td>
            </tr>
			{if $maxRecord > 10}
			<tr>
			   <td colspan="8"><center><a href="{$url1}"><img src="../../images/previous.jpg" width="30" height="30" /></a>&nbsp;<span style="padding-bottom:5px">{$paging}</span><a href="{$url2}"><img src="../../images/next.jpg" width="30" height="30" /></a></center></td>
			</tr>
			{/if}			
      </table>
    </td>
  </tr>
</table>

	 
{ include file = innerfooter.tpl}
