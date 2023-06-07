{ include file = header_buzzer2.tpl}

{literal}




    <script src="js/jquery-1.4.2.min.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>	
	<script src="js/themes/jquery-ui-1.8.2.custom.min.js" type="text/javascript"></script>

{/literal}

<table  width="100%" border="0" cellspacing="0" cellpadding="0"  align="left" bgcolor="#FFFFFF">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="outer_table1">

        <tr>

          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

              

              <tr>

                <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

                  { if $errors != ''} {$errors} {/if}</span></td>

              </tr>

              

              <tr>

                <td height="19" align="center"><div id="search_form">

                    <form name="searchReport" action="grid.php?id={$id}" method="post">

                      <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" >

                        <tr>

                          <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>

                        </tr>

                        <tr>

                          <td width="21%" align="left" valign="top" class="labeltxt"><strong>Consumer:</strong></td>

                          <td width="31%" align="left" valign="top" class="labeltxt"><input type="text" name="user" id="user" value="{$user}" class="inputTxtField "/>

                            &nbsp;

                            <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />

                              <div class="suggestionList" id="autoSuggestionsList1"> &nbsp;</div>

                            </div></td>

                          <td align="left" valign="top" class="labeltxt"><strong>Facility / Corporate:</strong>&nbsp;</td>

                          <td align="left" valign="top" class="labeltxt"><input type="text" name="clinic" id="clinic" value="{$clinic}" class="inputTxtField date" />

                            <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">

                              <div class="suggestionList" id="div">&nbsp;</div>

                            </div></td>

                        </tr>

                        <tr>

                          <td align="left" valign="top" class="labeltxt"><strong>Driver ID:</strong></td>

                          <td align="left" valign="top" class="labeltxt">

                          <select name="driver" id="driver">

                              <option value="">Select Driver</option>

                    {section name=d loop=$drivers}	

                              <option value="{$drivers[d].drv_code}" {if $drivers[d].drv_code eq $drv } selected="selected" {/if}>{$drivers[d].fname} {$drivers[d].lname} - [ {$drivers[d].drv_code} ]</option> 

                    {/section}  

                            </select>

                          </td>

                          <td width="16%" align="left" valign="top" class="labeltxt">&nbsp;</td>

                          <td align="right" valign="top" class="labeltxt">&nbsp;</td>

                        </tr>

                        <tr>

                          <td align="left" valign="top">&nbsp;</td>

                          <td colspan="3" align="left" valign="top"><font color="#FF0000"> <b>Note:*</b>

                            <ol>

                              <li>Combination of all fields are not mandatory</li>

                            </ol>

                            </td>

                        </tr>

                        <tr>

                          <td align="left" valign="top">&nbsp;</td>

                          <td colspan="3" align="left" valign="top"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  />

                            &nbsp;

                            <input type="reset" name="reset" value='Reset' class="inputButton btn"  /></td>

                        </tr>

                      </table>

                    </form>

                  </div></td>

              </tr>

              <tr>

                <td height="19" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>

              </tr>

              <tr>

                <td class="tabs"><ul>
		
                                      <li {if $st== '5'}style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a href="grid.php?id={$id}&st=5">In Progress</a></li>

				    <li {if $st== '4'}  style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a href="grid.php?id={$id}&st=4">Completed</a></li>

                    <li {if $st== '3'}  style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a href="grid.php?id={$id}&st=3">Cancelled</a></li>

                    <li {if $st== '2'} style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a  href="grid.php?id={$id}&st=2">Rescheduled</a></li>

                    <li {if $st== '8'}style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a href="grid.php?id={$id}&st=8&ad=0">Not Going</a></li>
					
					  <li {if $st== '7'}style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a href="grid.php?id={$id}&st=7&ad=0">Not at Home</a></li>



                    <li {if $st== '0'}style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a href="grid.php?id={$id}&st=0">Addons</a></li>


<li {if $st== '9'}style="display:block; float:left; background: url(../images/tabs_hover.png) no-repeat; width:105px; height:18px; color:#FFF; padding-left: 0px; padding-top: 5px; text-align:center;" class="selected1"{/if}><a rel="facebox" href="add-sheet.php">Upload Sheet</a></li>
					

					 <li class="small"><a rel="facebox" title="Add" href="addgrid.php?id={$id}"> <img alt="Add" border="0" src="../graphics/add_12.gif"></a></li>

                  </ul>

				  

				  

				  </td>

              </tr>

              <tr>

                <td height="19" align="center" class="admintopheading">ROUTING SHEET DETAILS </td>

              </tr>

              <tr>

                <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table" cellpadding="0" cellspacing="0" >

                    <tr>
                      <td align="left" class="label_txt_heading"><strong>Code</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Facility</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Patient Name </strong></td>

                       <td align="left" class="label_txt_heading"><strong>Driver</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Pick Address</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Drop Address</strong></td>

                      <td align="left" class="label_txt_heading"><strong>Pickup Time</strong></td>

					    <td align="left" class="label_txt_heading"><strong>Drop Time</strong></td>						

					  <td align="left" class="label_txt_heading"><strong>Miles</strong></td>

					   <td align="left" class="label_txt_heading"><strong>Trip Type</strong></td>

                      <td align="center" class="label_txt_heading"><strong>Options</strong></td>
                      <td align="center" class="label_txt_heading"><strong>GPS/Call</strong></td>
                    </tr>

                    {section name=q loop=$membdetail}

<tr valign="top"  bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_code}</b></td>

                      <td align="left" valign="top" class="grid_content"><b>{$membdetail[q].trip_clinic}</b></td>

                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_user}</td>

                      <td align="left" valign="top" class="grid_content">
                      	{if $membdetail[q].drv_id neq ''}
                      		{$membdetail[q].driver} - [ {$membdetail[q].drv_id} ]
						{else}
                        	{if $st== '5'}
                        	<select name="staff1" id="staff1" class="required" onchange="return dvmap(this.value,'{$membdetail[q].tdid}','{$membdetail[q].trip_date}','{$membdetail[q].pck_time}')">
								<option value="">--Select--</option>
								{section name=r loop=$driverdata}
								<option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $staff1}selected{/if}>{$driverdata[r].drv_code}--{$driverdata[r].fname} {$driverdata[r].lname}</option>
								{/section}
							</select>
                            {/if}
                        {/if}
                      </td>

                      <td align="left" valign="top" class="grid_content">{$membdetail[q].pck_add}</td>

					  

                      <td align="left" valign="top" class="grid_content">{$membdetail[q].drp_add}</td>

					  

					    <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} W/C{else} {$membdetail[q].pck_time}{/if}</td>

						

						  <td align="left" valign="top" class="grid_content">{if $membdetail[q].wc eq '1'} --:--{else}{$membdetail[q].drp_time}{/if}</td>

					  

                      <td align="left" valign="top" class="grid_content">{$membdetail[q].trip_miles}</td>

					  

                       <td align="left" valign="top" class="grid_content">{if $membdetail[q].type == '1'}<img src="../images/one-way.png" title="One-Way Trip">{else}<img  title="Two-Way Trip" src="../images/two-way.png">{/if}</td>

					   

					  <td align="left" valign="top" class="grid_icon">
<a rel="facebox" href="editgrid-new.php?id={$membdetail[q].tdid}&type={if $st eq 6}1{else}2{/if}" title="Edit"> <img border="0" alt="Edit" src="../graphics/edit.png"></a>&nbsp;&nbsp;		  
				{if $st eq 4} 	
					  <a rel="facebox" href="viewgrid.php?id={$membdetail[q].tdid}" title="View">                     
					  {if $membdetail[q].status eq '4'}
				     	 Successful
					  {/if}	 
					  {if $membdetail[q].status eq '1'}
					     Delayed
					  {/if}					  </a>&nbsp;&nbsp;
				{else}
					  <a rel="facebox" href="viewgrid.php?id={$membdetail[q].tdid}" title="View"> View</a>&nbsp;&nbsp;
				{/if}
				{if $smarty.session.admuser.admin_level eq '0'}	 <a href="#"  onclick="return deleteRec('{$membdetail[q].tdid}','{$id}');"  title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png"></a>
				{/if}&nbsp;</td>
                <td>{if $membdetail[q].gpsurl neq ''}<a href="{$membdetail[q].gpsurl}"><img alt="GPS" border="0"  src="../graphics/gps.png"></a>{else}<img alt="GPS" border="0"  src="../graphics/dgps.png">{/if}&nbsp;&nbsp;{if $membdetail[q].sip neq ''}<a href="sip:{$membdetail[q].sip}"><img alt="Call" border="0"  src="../graphics/call_driver.png"></a>{else}<img alt="Call" border="0"  src="../graphics/dcall.png">{/if}</td>
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