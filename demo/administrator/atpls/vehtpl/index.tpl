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



	



function stchange(val)



{



  if (val != ''){		



 	location.href="index.php?st="+val;



	return true;}else{



			return false;



		}			



	}	



</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            
            
            
            { if $errors != ''} {$errors} {/if}</td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp;<a title="Vehicle Types" href="vehtypes.php">Vehicle Types</a>&nbsp;|&nbsp;<a title="Vehicle Types" href="../maintenance/gethistory.php" rel="facebox">Maintenance History</a>&nbsp;|<a title="Vehicle Types" href="getmilhistory.php" rel="facebox"> Milage History</a>&nbsp;|&nbsp;<a title="Get Fuel History" href="getfuelhistory.php" rel="facebox">Fuel History</a>&nbsp;|&nbsp;<a title="Add Vehicle" href="addvehicle.php"><img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
        </tr>
        <tr>
          <td width="11%" height="19" align="center" class="admintopheading"><select name="st" id="st" onchange="return stchange(this.value);">
              <option value="">--Select--</option>
              <option value="All" {if $st eq 'All'}selected{/if}>All</option>
              <option value="Open" {if $st eq 'Open'}selected{/if}>Open</option>
              <option value="Suspended" {if $st eq 'Suspended'}selected{/if}>Suspended</option>
              <option value="Expired" {if $st eq 'Expired'}selected{/if}>Expired</option>
              <option value="Sold" {if $st eq 'Sold'}selected{/if}>Sold</option>
            </select></td>
          <td width="89%" align="center" class="admintopheading">VEHICLES MANAGEMENT</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>VIN Number</strong></td>
                <td width="25%" align="center" class="label_txt_heading"><strong>Name </strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Type </strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Assigned Miles </strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Last Re-Fill Date (mm/dd/yyyy)</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop = $vehdetails}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>
                <td align="center" valign="middle">{$vehdetails[q].vinn}</td>
                <td align="center" valign="middle">{$vehdetails[q].vname|wordwrap:30:'<br />
                  ':true}</td>
                <td align="center" valign="middle">{if $vehdetails[q].vtype eq ''}<a href="editvehicle.php?id={$vehdetails[q].id}" title="Edit Vehicle"> {$vehdetails[q].vehtype}</a>{else}{$vehdetails[q].vehtype|wordwrap:30:'<br />
                  ':true}{/if}</td>
                <td align="center" valign="middle"><strong>{$vehdetails[q].vehmileage}</strong></td>
                <td align="center" valign="middle"><strong>{$vehdetails[q].refildate}</strong></td>
                <td align="center" valign="top"><a href="editvehicle.php?id={$vehdetails[q].id}" title="Edit Vehicle"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp; <a href="addfuel.php?id={$vehdetails[q].id}" title="Manage Fuel" rel="facebox"> <img border="0" alt="Manage Fuel" src="../graphics/fuel.png" height="40" width="40"></a>&nbsp;&nbsp; <a href="#" onClick="return deleteRec('{$vehdetails[q].id}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="6" align="center"><b>No Record Found</b></td>
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