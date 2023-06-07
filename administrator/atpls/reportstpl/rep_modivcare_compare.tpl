{ include file = headerinner.tpl}
{literal} 
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
$(document).ready(function(){
						   $('#searchReport').validate();
						   $('#hosp').attr('disabled', true);
						   });
function other()
{
	val = document.getElementById('hospname').value;
	if(val =='other')
	{
	$('#hosp').attr('disabled', false);
	}
	else
	{
	 $('#hosp').attr('disabled', true);
	}
}
$(document).ready(function(){	

$("#startdate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
});
</script> 
{/literal}
<table  border="0" cellspacing="0" cellpadding="0" class="outer_table" align="right" bgcolor="#FFFFFF" >
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            { if $errors != ''} {$errors} {/if}</span></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> {if $noReq neq '0'}
              [<a href="javascript:history.back();">Back</a>]{/if}</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">ModiVCare Rides Sainity Check / Rides List</td>
        </tr>
        <!--<tr>
                              <td colspan="2" align="center"  valign="top">							  </td>
                            </tr>
                            <tr>
                              <td colspan="2" align="center"  valign="top">&nbsp;</td>
                            </tr>-->
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" width="100%">
               <!-- <tr>
                  <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                </tr>-->
                <tr>
                  <td width="10%" align="left" valign="top" class="labeltxt"><strong>Date:</strong></td>
                  <td width="35%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$stdate}" class="required" size="10"/>     (mm/dd/yyyy)</td>
                </tr>
                
                
                
                <tr>
                  <td align="left" colspan="2" valign="top">&nbsp;</td>
                  <td colspan="2" align="left" valign="top">
                  <input type="submit" name="submit" id="submit" value='Show Report' class="inputButton btn"  />
                  <input type="reset" name="reset" value='Reset' class="inputButton btn"  /></td>
                </tr>
              </table>
            </form></td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr class="admintopheading">
                <td width="5%" align="center"><strong>Ride Date</strong></td>
                <td width="10%" align="center"><strong>Ride ID</strong></td>
                <td width="10%" align="center"><strong>ModiVCare ID</strong></td>
                <td width="10%" align="center"><strong>Trips / Match / Exist</strong></td>
              </tr>
              {section name=q loop=$data}
              <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
                <td align="center" valign="top">{$stdate}</td>
                <td align="center" valign="top">{$data[q].id}</td>
                <td align="center" valign="top">
                
                {section name=p loop=$trips}
                {if $trips[p].modiv_detail_id eq $data[q].id} {$trips[p].modiv_id} {/if}
                {/section}
                
                </td>
                <td align="center" valign="top">
                
                {section name=p loop=$trips}
                {if $trips[p].modiv_detail_id eq $data[q].id} <span style="color:#F00; font-weight:bold;">Exist</span> {/if}
                {/section}
                
                </td>
                
              </tr>
             
              {sectionelse}
              <tr>
                <td colspan="4" align="center" ><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
       </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 