<head>
<meta http-equiv="refresh" content="30">
</head>

{ include file = header_buzzer3.tpl}

{literal} 
<script type="text/javascript">
 $(document).ready(function() { 
});
refreshed();
</script>
{/literal}

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">
<tr><td style="background-color:#09F;">{include file = menu.tpl}</td></tr>

  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td  align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
                  
                  
                  
                  { if $errors != ''} {$errors} {/if}</span></td>
              </tr>
              <tr>
                <td height="19" align="center" class="admintopheading">Drivers Location Network Status</td>
              </tr>
              <tr>
                <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td align="left" class="label_txt_heading"><strong>#</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver Name</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Driver Code</strong></td>
                      <td align="left" class="label_txt_heading"><strong>LogIn Status</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Last Updated</strong></td>
                      <td align="left" class="label_txt_heading"><strong>Location Method</strong></td>
                    </tr>
                    {section name=q loop=$data}
                    <tr valign="top" id="{$data[q].tdid}"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td >{$smarty.section.q.iteration}</td>
                      <td >{$data[q].fname} {$data[q].lname}</td>
                      <td >{$data[q].drv_code}</td>
                      <td >{if $data[q].login_status eq '1'} LogIn {else}<span style="color:#F00;">LogOut</span>{/if}</td>
                      <td >{$data[q].last_updated}</td>
                      <td >{$data[q].location_method}</td>
                    </tr>
                    {sectionelse}
                    <tr>
                      <td colspan="7" align="center" valign="top" class="grid_content"><strong>No Record Found!</strong></td>
                    </tr>
                    {/section}
                  </table></td>
              </tr>
              <tr>
                <td>{$paging}</td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 