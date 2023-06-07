{include file = headerinner.tpl}

{literal} 
<script type="text/javascript">

function dvmap(val1,val2)

{

var brk =  Array();

var msg =  Array();

if (val1 != '' && val2 != ''){

brk = val1.split('^');

$.post("cnfrm.php", {id: ""+brk[0]}, function(cnfrm)

{

//alert('Confirm Return : '+ cnfrm);

if(cnfrm == 0)

{

//alert('i got 0 now');

cfm = confirm('This Vehicle is already assign to another driver. \ndo you really want to re-assign it?');

if(cfm)

{

$.post("dvmap.php", {drv: ""+val2, veh:""+brk[0], vehnp:""+brk[1]}, function(data)

															   {

																  if(data.length > 0)

																  {

																	  msg = data.split('^');

																  

																	  $(	"#msg").html(msg[0]);

																	  if(msg[1] == '0')

																	  {

																		  $("#dv"+msg[1]).html('Not assigned Yet');

																			$("#dv"+val2).html(brk[1]);

																		}

																		if(msg[1] != '0' || msg[1] != 'fail'  )

																		{

																			$("#dv"+msg[1]).html('Not assigned Yet');

																			$("#dv"+val2).html(brk[1]);			 

																		}
							 location.reload(); 
																		return true;

																	}

});

}

else

{

return false;

}	

}

else

{

//alert('i got 1 now');

$.post("dvmap.php", {drv: ""+val2, veh:""+brk[0], vehnp:""+brk[1]}, function(data)

																 {

																	if(data.length > 0)

																	{

																		msg = data.split('^');

																	

																		$(	"#msg").html(msg[0]);

																		if(msg[1] == '0')

																		{

																			$("#dv"+msg[1]).html('Not assigned Yet');

																			$("#dv"+val2).html(brk[1]);

																		}

																		if(msg[1] != '0' || msg[1] != 'fail'  )

																		{

																			$("#dv"+msg[1]).html('Not assigned Yet');

																			$("#dv"+val2).html(brk[1]);			 

																		}
				 location.reload(); 
																		return true;

																	}

});

}	

});

}

else

{

return false;

}	
//	location.reload();
  }	
function janoo(id){
	window.location.href = "unassign.php?id="+id;
	//alert(id)
	}
</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td height="307"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="okmsg"><span id="msg"></span></td>
        </tr>
        <tr>
          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">DRIVERS &amp; VEHICLES MAPPING</td>
        </tr>
        <tr>
          <td align="center"  valign="top"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="20%" align="center" class="label_txt_heading"><strong>Drivers</strong></td>
                <td width="15%" align="center" class="label_txt_heading"><strong>Assigned Vehicle</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>UnAssigned</strong></td>
                <td width="35%" align="center" class="label_txt_heading"><strong>Change Assigned Vehicle</strong></td>
              </tr>
              {section name=q loop = $drvdetails}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="center" valign="middle">{$drvdetails[q].fname} {$drvdetails[q].lname}</td>
                <td align="center" valign="middle"><span id="dv{$drvdetails[q].Drvid}">{if $dvdetails[q] eq '0'}Not assigned Yet{else}{$dvdetails[q]}{/if}</span></td>
                <td>{if $dvdetails[q] eq '0'}{else}<a href="#" onclick="janoo('{$drvdetails[q].Drvid}');" ><img alt="Un-Assign" border="0"  src="../images/icons/cross.png"></a>{/if}</td>
                <td align="center" valign="middle"><select name="vtype" id="vtype" class="required" onchange="return dvmap(this.value,'{$drvdetails[q].Drvid}')" style="width:300px">
                    <option value="">Select</option>
                    {section name=n loop=$vlist}
			          
                    <option value="{$vlist[n].id}^{$vlist[n].vnumber}" {if $vlist[n].id eq $drvdetails[q].veh_id}selected{/if}>{$vlist[n].vnumber} -  {$vlist[n].vname}</option>
                    {/section}
					
                  </select></td>
              </tr>
              {sectionelse}
              
              {/section}
            </table></td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 