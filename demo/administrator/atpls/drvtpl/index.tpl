{include file = headerinner.tpl}
{literal} 
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record?");
		if (ok)
		{ location.href="index.php?delId="+id;
		return true;}else{			
			return false;}
	}
function rate_it(id, rate)
{
	$('input',id).rating('select',rate);
	//$('input',id).rating('disable')
}
function stchange(val)
{
  if (val != ''){		
 	location.href="index.php?st="+val;
	return true;}else{
			return false;
		}			
	}	
function byname(vl){ //alert(vl);
	location.href="index.php?name="+vl;
	}		
</script> 
{/literal}
{if $smarty.session.driver_quota_message neq ''}<p style="color:#F00; font-size:12px; text-align:center; font-weight:bold;">{$smarty.session.driver_quota_message}</p>{/if}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center">
          <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
          Search By Name:<input type="text" name="byname" placeholder="First Name Or Last Name Only" id="byname" value="{$byname}" onblur="byname(this.value);" size="30" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a> &nbsp;|&nbsp;&nbsp; [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp;<a title="Driver Types" href="drvtypes.php">Driver Types</a>&nbsp;{if $count lt 20 }|&nbsp;<a title="Add Driver" href="add-drv.php"><img alt="Add" border="0" src="../graphics/add_12.gif"></a>{/if} </div></td>
        </tr>
        <tr>
          <td width="11%" height="19" align="center" class="admintopheading"><select name="st" id="st" onchange="return stchange(this.value);">
              <option value="">--Select--</option>
              <option value="All" {if $st eq 'All'}selected{/if}>All</option>
              <option value="Active" {if $st eq 'Active'}selected{/if}>Active</option>
              <option value="Suspended" {if $st eq 'Suspended'}selected{/if}>Suspended</option>
              <option value="Left" {if $st eq 'Left'}selected{/if}>Left</option>
            </select></td>
          <td width="89%" align="center" class="admintopheading">DRIVERS MANAGEMENT</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td  align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td  align="center" class="label_txt_heading"><strong>Code</strong></td>
                <td  align="center" class="label_txt_heading"><strong>SSN</strong></td>
                <td  align="center" width="80px" class="label_txt_heading"><strong>Name </strong></td>
                <td width="50px" align="center" class="label_txt_heading"><strong>Type </strong></td>
                <td align="center" class="label_txt_heading"><strong>Contact Information </strong></td>
               <!-- {if $smarty.session.admuser.admin_level eq '0'}	
                <td width="70px" align="center" class="label_txt_heading"><strong>Avg. Rating</strong></td>{/if}
                <td width="50px" align="center" class="label_txt_heading"><strong>Driver Trips</strong></td>-->
                <td width="50px" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop = $drvdetails}
              <tr valign="top" bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="center"><b>{$smarty.section.q.iteration}.</b></td>
                <td align="center">{$drvdetails[q].drv_code}</td>
                <td align="center">{$drvdetails[q].ssn}</td>
                <td align="center">{$drvdetails[q].name} </td>
                <td align="center">{$drvdetails[q].dtype_name}</td>
                <td align="center">{$drvdetails[q].addr|wordwrap:30:'<br />
                  ':true}, {$drvdetails[q].city}<br />
                  <b>{$drvdetails[q].day_phnum}</b></td>
                  {if $smarty.session.admuser.admin_level eq '0'}	
               <!-- <td><div class="rating"> {if $drvdetails[q].rating gt 0}
                    {section name=r loop=$drvdetails[q].rating} <img src="../theme/rate.png"/> {/section}
                    {/if} </div></td>{/if}-->
                <!--<td align="center"><a href="history.php?dataset={$drvdetails[q].drv_code}">{$drvdetails[q].tot} - Trip{if $drvdetails[q].trips gt 1}s{/if}</a></td>
                <td align="center"><a href="history.php?dataset={$drvdetails[q].drv_code}">Trips</a></td>-->
                <td align="center"><a href="editdrv.php?id={$drvdetails[q].Drvid}" title="Edit Driver"> <img border="0" alt="Edit" src="../graphics/edit.png" /></a>&nbsp;&nbsp; <!--<a href="#" onclick="return deleteRec('{$drvdetails[q].Drvid}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png" /></a>--></td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="8" align="center"><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center">{$pages}</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 