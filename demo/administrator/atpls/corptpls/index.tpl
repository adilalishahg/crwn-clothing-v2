{ include file = headerinner.tpl}
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
function ChangeStatus(val,st){
    $.post("hosprequests.php", {queryString: ""+val, sta:""+st}, function(data){
	  if(data.length > 0) {    
        if( st == '3'){
		//$('#ap'+val).html('<a href="javascript:ChangeStatus('+val+',0);">Approve</a>');
        // $("#div"+val).hide('slow');
		removeTr(val);
		//$('#tr'+val).remove(); 		
		return true;	
		}
		else if( st == '2'){
		//$('#ap'+val).html('<a href="javascript:ChangeStatus('+val+',1);">Disapprove</a>');
        //$("#div"+val).hide('slow');
		removeTr(val);
       // $("#tr"+val).remove();					
		return true;		
		} 
        else{
		return false;	
		} 		
      }
	 }); 
}	
function removeTr(val){
//  alert(""+val);
  $('#tr'+val).remove();
}	
function byname(){var vl = $('#byname').val();
	location.href="index.php?name="+vl;
	}
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:720px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            
            { if $errors != ''} {$errors} {/if}</span></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;">
           Search By Name:<input type="text" name="byname" placeholder="Enter Facility Name" id="byname" value="{$byname}" size="30" />&nbsp;&nbsp;&nbsp;<input type="button" name="" id="search" value="Search" class="btn" onclick="byname();"  />
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php" ><img alt="Refresh Page" border="0" src="../images/multiple.png" title="Refresh Page"></a> &nbsp;
          
           [<a href="javascript:history.back();">Back</a>]| <a title="Add" href="add.php"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a> </div></td>
        </tr>
        <tr>
          <td width="11%" height="19" align="center" class="admintopheading"><select name="st" id="st" onchange="return stchange(this.value);">
              <option value="">--Select--</option>
              <option value="inactive" {if $st eq 'inactive'}selected{/if}>Inactive</option>
              <option value="approved" {if $st eq 'approved'}selected{/if}>Approved</option>
              <option value="disapproved" {if $st eq 'disapproved'}selected{/if}>Disapproved</option>
            </select></td>
          <td width="100%" align="center" class="admintopheading">HOSPITALS MANAGEMENT</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="20%" align="center" class="label_txt_heading"><strong>Name.</strong></td>
             <!--   <td align="center" class="label_txt_heading"><strong>Manage Rate</strong></td>-->
                <td width="25%" align="center" class="label_txt_heading"><strong>Facility</strong></td>
                <td width="20%" align="center" class="label_txt_heading"><strong>Address</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Phone</strong></td>
                <td width="20%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop=$membdetail}
              <tr id="tr{$membdetail[q].id}" bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="left" valign="middle"><b>{$membdetail[q].firstname} {$membdetail[q].lastname}</b></td>
          <!--<td align="center" valign="middle"><a href="../rate_management/index.php?id={$membdetail[q].id}"><span style="color:#F00;">Manage</span></a></td>-->
                <td align="center" valign="middle">{$membdetail[q].hospname}</td>
                <td align="center" valign="middle">{$membdetail[q].street_address}</td>
                <td align="center" valign="middle">{$membdetail[q].hosp_phnum}</td>
                <td align="center" valign="middle"><span id="ap{$membdetail[q].id}"> {if $membdetail[q].Status eq 'inactive' || $membdetail[q].Status eq 'disapproved'} <a href="javascript:ChangeStatus('{$membdetail[q].id}','2');"> <img border="0" title="Approve" alt="Approve" src="../graphics/enable.jpg"> </a> {else} <a href="javascript:ChangeStatus('{$membdetail[q].id}','3');"> <img border="0" title="Disapprove" alt="Disapprove" src="../graphics/disable.jpg"></a> {/if} </span>&nbsp;&nbsp; <a href="edit.php?id={$membdetail[q].id}" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp; <a href="#" onclick="return deleteRec('{$membdetail[q].id}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a></td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="6" align="center" class="labeltxt"><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td colspan="2" width="720px" align="center">{$paging}</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 