

{literal}


<link rel="stylesheet" href="../theme/style.css" type="text/css">

<script type="text/javascript">
	function stchange(val)

{

  if (val != ''){		

 	location.href="grid.php?st="+val;

	return true;}else{

			return false;

		}			

	}	
   
</script>
{/literal}

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">


  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="outer_table1">

        <tr>

          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

              

              <tr>

                <td  align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

                  { if $errors != ''} {$errors} {/if}</span></td>

              </tr>

              

              <tr>

                <td height="19" align="center"><div id="search_form">

                    <form name="searchReport" action="grid.php" method="post">

                      <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >

                      

                        <tr>

                          <td colspan="8" align="left" valign="middle" class="labeltxt">
                          
                          <table border="0" width="380">
                          <tr><td rowspan="2"  align="left" valign="top" class="labeltxt"><strong>A.H.C.C.C.S ID:</strong></td>
                          <td rowspan="2"  align="left" valign="top" class="labeltxt">
						  <input type="text" name="progid" id="progid" value="{$ahid}" />
						  </td>                    
                          
                         
                            <td valign="top"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  />

&nbsp;                            </td>
                          <td rowspan="2"  align="left" valign="top" class="labeltxt"><a href="../index.php"><img src="../images/person_icon.png" border="0"  /></a></td>
                          </tr>
                          
                          </table>
                          
                          </td>

                        </tr>

                        


                      </table>

                    </form>

                  </div></td>

              </tr>

              

              

              <tr>

                <td height="19" align="center" class="admintopheading">ADDRESS MANAGEMENT&nbsp;<span style="margin-left:180px;"><select name="st" id="st" onchange="return stchange(this.value);">

              <option value="1" {if $st eq '1'}selected{/if}>Locked</option>

              <option value="0" {if $st eq '0'}selected{/if}>Un-Locked</option>

            </select></span></td>

              </tr>

              <tr>

                <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0" >

                    <tr>
                      <td align="left" class="label_txt_heading"><strong>A.H.C.C.C.S ID</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Patient Name</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Phone</strong></td>

                       <td align="left" class="label_txt_heading"><strong>Email</strong></td>
					   
					   <td align="left" class="label_txt_heading"><strong>Address</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Status</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Option</strong></td>                      
                    </tr>
<div id="sc"></div>
                    {section name=q loop=$ahcccs}

<tr  valign="top"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td align="left" valign="top" class="grid_content">{$ahcccs[q].cisid}</td>

                      <td align="left" valign="top" class="grid_content">{$ahcccs[q].clientname}</td>

                      <td align="left" valign="top" class="grid_content">{$ahcccs[q].phnum}</td>

                      <td align="left" valign="top" class="grid_content">{$ahcccs[q].email}</td>
					  
					  <td align="left" valign="top" class="grid_content">{$ahcccs[q].pickaddr}</td>

                      <td align="left" valign="top" class="grid_content">{if $ahcccs[q].locks eq '1'}Locked{else}Un-Locked{/if}</td>				  
                      <td align="left" valign="top" class="grid_content"><a href="grid.php?reqid={$ahcccs[q].id}&status={$ahcccs[q].locks}">{if $ahcccs[q].locks eq '1'}Un-Locked{else}Locked{/if}</a></td>
					    

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