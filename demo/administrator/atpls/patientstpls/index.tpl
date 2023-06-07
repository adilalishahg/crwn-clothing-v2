{ include file = headerinner.tpl}

{literal} 
<script type="text/javascript">
function deleteRec(id)
		{
		var ok;
		ok=confirm("Are you sure you want to delete this record?");
		if (ok)
		{		
		location.href="index.php?did="+id;
		return true;
		}
		else
		{
			return false;
		}
	}
function aap(vl){
	if(vl=='on') aap=1;
	if(vl=='off') aap=0;
	location.href="index.php?aap="+aap;
	}	
function status(vl){
	location.href="index.php?status="+vl;
	}	
function cisid(vl){
	location.href="index.php?cisid="+vl;
	}	
function byname(vl){ //alert(vl);
	location.href="index.php?name="+vl;
	}				
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                <td height="19" align="center">
                <!--<div align="left" id="add_div" style="padding-right:20px; padding-bottom:0px; font-weight:bold;"> Auto addition during the 1<sup>st</sup> time of Trip Request process:<select name="aap" id="aap" onchange="aap(this.value)">
                <option value="on" {if $add_auto_patient eq '1'} selected="selected"{/if}>ON</option><option value="off" {if $add_auto_patient eq '0'} selected="selected"{/if}>OFF</option></select>
                </div>-->
                <div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"><!--
            Search By Insurance ID:<input type="text" name="cisid" id="cisid" value="{$cisid}" onblur="cisid(this.value);" />-->&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; Search By Name:<input type="text" name="byname" id="byname" value="{$byname}" onblur="byname(this.value);" />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a>
               <!-- Filter Members:<select name="status" id="status" onchange="status(this.value)">
                <option value="current" {if $status eq 'current'} selected="selected"{/if}>CURRENT</option>
                <option value="inactive" {if $status eq 'inactive'} selected="selected"{/if}>INACTIVE</option></select>--> | [<a href="javascript:history.back()">Back</a>] | <a title="Add" href="add.php"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a><!-- | <a href="add_patients_xls.php" rel="facebox" >
          <img alt="Add" border="0" src="../graphics/add_xls.png" title="Upload Patients Data Through .xls" height="27" width="25"></a>| <a href="add_patients_xlsx.php" rel="facebox" >
          <img alt="Add" border="0" src="../graphics/xlsx.png" title="Upload Patients Data Through .xlsx" height="27" width="25"></a>--> </div></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">PATIENTS MANAGEMENT</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:20px;"><table width="100%" border="0" class="main_table">
                    <tr>
                      <td width="20%" align="left" class="label_txt_heading"><strong>Patient Name</strong></td>
                      <!--<td width="10%" align="left" class="label_txt_heading"><strong>Insurance ID</strong></td>-->
                      <td width="45%" align="left" class="label_txt_heading"><strong>Address</strong></td>
                      <td width="15%" align="left" class="label_txt_heading"><strong>Patient Phone #</strong></td>
                      <td width="10%" align="center" class="label_txt_heading"><strong>Options</strong></td>
                    </tr>
                    {section name=q loop=$admdetail}
                    <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td align="left" valign="middle"><b>{$admdetail[q].name}</b></td>
                      <!--<td align="left" valign="middle">{$admdetail[q].insurance}</td>-->
 <td align="left" valign="middle">{$admdetail[q].address} {if $admdetail[q].roomsite neq ''},{$admdetail[q].roomsite}{/if} <!--{$admdetail[q].city}, {$admdetail[q].state} {$admdetail[q].zip}--></td>
                      <td align="left" valign="middle">{$admdetail[q].phone}</td>
                      <td align="center" valign="middle"><a href="edit.php?id={$admdetail[q].id}" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp; <a href="#" onclick="return deleteRec('{$admdetail[q].id}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
                    </tr>
                    {/section}
                  </table></td>
              </tr>
              <tr>
                <td align="center">{$paging}</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 