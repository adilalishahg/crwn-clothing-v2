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
{literal}<style type="text/css">
<!--

body {
	background-color: #FFFFFF;
}-->
</style>{/literal}
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
					
                              <td height="19" align="left">
							  <span style="color:#FF0000; font-weight:bold;">Filter By : </span><select name="st" id="st" onchange="return stchange(this.value);" style="width:220px;">
  	<option value="">--Select--</option>
      <option value="sra" {if $st1 eq '1'}selected="selected"{/if}>Software Requirement Analyst</option>
	  <option value="php" {if $st1 eq '2'}selected="selected"{/if}>PHP Developer</option>
	  <option value="net" {if $st1 eq '3'}selected="selected"{/if}>.NET Developer</option>
	  <option value="jom" {if $st1 eq '4'}selected="selected"{/if}>JOOMLA Developer</option>
	  <option value="gra" {if $st1 eq '5'}selected="selected"{/if}>Graphic Designer</option>
</select>
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							[<a href="javascript:history.back();">Back</a>] 
							
						 </div>
							  </td>
        </tr>							
                            <tr>
<td height="19" align="center" class="admintopheading">MANAGE RESUMES</td>
                            </tr>
                            <tr>
                              <td height="44" align="center"  valign="top" style="padding-top:15px;">
							  <table width="100%" border="0" class="main_table">
                  <tr>
                    <td align="center" class="label_txt_heading" width="5%"><strong><strong>S.No. </strong></strong></td>
                    <td align="left" class="label_txt_heading" width="25%"><strong><strong>Sender Name</strong></strong></td>
               		<td align="left" class="label_txt_heading"><strong>Sender Email</strong></td>
					<td align="left" class="label_txt_heading" width="20%"><strong>Expected Salary</strong></td>
                    <td align="center" class="label_txt_heading" width="8%"><strong>Details</strong></td>
					<td align="center" class="label_txt_heading" width="10%"><strong>Options</strong></td>
                  </tr>
                {section name=q loop=$contacts}
				  <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                    <td align="center" valign="middle"><b>{if $smarty.get.Page}{math equation="(x+((y-1)*10))" x=$smarty.section.q.iteration y=$smarty.get.Page}{else}{$smarty.section.q.iteration}{/if}. </b></td>
					<td align="left" valign="middle">{$contacts[q].name}</td>
					<td align="left" valign="middle"><a href="mailto:{$contacts[q].email}">{$contacts[q].email}</a></td>                    <td align="left" valign="middle">{$contacts[q].salary}</td>
                    <td align="center" valign="middle"><b>              				
					<a href="../../{$contacts[q].cv}">View</a></b></td>
					<td align="center" valign="middle"><a href="#" onclick="return deleteRec('{$contacts[q].id}');" title="Remove"><img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                  </tr>
				  {sectionelse}
				 <tr>
				  <td colspan="7" align="center" style="color:#FF0000; font-weight:bold" ><b>No Resume Found</b></td>
				 </tr>
				 {/section}
                </table>				</td>
            </tr>
			{if $maxRecord gt 10}
			<tr>
			   <td align="center"><span style="padding-bottom:5px">{$paging}</span></td>
			</tr>
			{/if}
      </table>
    </td>
  </tr>
</table>		 
{ include file = innerfooter.tpl}
