{include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function chk_date(date)

{

	

}



$(document).ready(function(){

    $('#searchReport').validationEngine();

  });

  

$(document).ready(function(){

	var sdate = $('#startdate').val();	

	if(sdate!='' )

	{

		showsearch();

	}

	else

	{

		hidesearch();

	}

	$('#pub_date').datepicker();



		//hidesearch();

  });

function quicksearch()

{

	var date = $('#q_date').val();

	//alert("This is date "+date);

	location.href="index.php?q_date="+date;

}

function showsearch()

{

		$('#search_form').show();

			$('#hide_search').show();

				$('#show_search').hide();

}

function hidesearch()

{

	$('#search_form').hide();

	$('#hide_search').hide();

				$('#show_search').show();

}

function Search()

{

	var date = $('#pub_date').val();

	//alert("This is date "+date);

	location.href="index.php?date="+date;

}



function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{ location.href="index.php?del_id="+id;

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

          <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}

            { if $errors != ''} {$errors} {/if}</td>

        </tr>

        <tr>

          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;">

            [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp; 

            [<a href="gettckhistory.php" rel="facebox">Ticket History</a>]&nbsp;|&nbsp; 

            <!--[<a href="index.php?state = trash">Trash Can</a>]&nbsp;|&nbsp; -->

            [<span id="show_search"><a href="#" onclick="showsearch();"> Show Search</a></span><span id="hide_search"><a href="#" onclick="hidesearch();"> Hide Search</a></span>]&nbsp;|&nbsp;

            <a title="Add Vehicle" href="add.php" ><img alt="Add Time In" border="0" src="../graphics/add_12.gif"></a></div></td>

        </tr>      

        <tr>

          <td height="19" align="center"><div id="search_form">

              <form name="searchReport" id="searchReport" action="index.php" method="post">

                <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">

                  <tr>
                    <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                    <td align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$sdate}" class="validate[required] inputTxtField date"/>
                      &nbsp;
                      <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />

                        <div class="suggestionList" id="autoSuggestionsList1"> &nbsp; </div>

                      </div>

                    <strong>(mm/dd/yyyy)</strong></td>

                    <td align="right" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                    <td align="left" valign="top"><input type="text" name="enddate" id="enddate" value="{$edate}" class="validate[required] inputTxtField date" />

                      <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">

                        <div class="suggestionList" id="div">&nbsp; </div>

                      </div>

                    <strong>(mm/dd/yyyy)</strong></td>

                  </tr>

                  <tr>

                    <td align="left" valign="top" class="labeltxt"><strong>Driver :</strong></td>

                    <td align="left" valign="top"><select name="drv_id">

                    <option value="">Select Driver</option>

                    {section name=d loop=$drivers}

                      <option value="{$drivers[d].Drvid}" {if $drivers[d].Drvid eq $drv_id } selected="selected" {/if}>{$drivers[d].fname} {$drivers[d].lname}</option>

                    {/section}

                    </select></td>

                    <!--<input type="text" name="drv_id" id="drv_id" value="{$drv_id}" class="inputTxtField" />-->

                    <td width="16%" align="left" valign="top" class="labeltxt">&nbsp;</td>

                    <td align="right" valign="top" class="labeltxt">&nbsp;</td>

                  </tr>

                  <tr>

                    <td align="left" valign="top">&nbsp;</td>

                    <td colspan="3" align="left" valign="top"><font color="#FF0000"> <b>Note:*</b>

                      <ol>

                        <li>Combination of all fields are not mandatory</li>

                        <li>Both Start and End date must be provided.</li>

                      </ol>

                      </font></td>

                  </tr>

                  <tr>

                    <td align="right" valign="top" style="padding-right:30px;">&nbsp;</td>

                    <td colspan="3" align="right" valign="top" style="padding-right:50px;"><input type="submit" name="search" value='Search' class="inputButton btn" id="search"  />

                      &nbsp;

                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  /></td>

                  </tr>

                </table>

              </form>

            </div></td>

        </tr>

        <tr>

          <td height="19" align="left" style="padding-bottom:10px;"><br />

			<select name="q_date" id="q_date" onchange="quicksearch();">

             <option value="">Select Month </option>

            {section name=dt loop=$dates}

            	<option value="{$dates[dt].date}" {if $dates[dt].date eq $month} selected="selected" {/if}>{$dates[dt].name}</option>

             {/section}

            </select>

            </td>

        </tr>

        <tr>

          <td height="19" align="center" class="admintopheading">TICKET MANAGEMENT</td>

        </tr>

        <tr>

          <td height="44" align="center"  valign="top"><table width="100%" border="0" class="main_table">

              <tr>

                <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>

                <td width="20%" align="center" class="label_txt_heading"><strong>Driver Name</strong></td>

                <td width="15%" align="center" class="label_txt_heading"><strong>Ticket Number</strong></td>

                <td width="20%" align="center" class="label_txt_heading"><strong>Date</strong></td>

                <td width="20%" align="center" class="label_txt_heading"><strong>Reason</strong></td>

                <td width="10%" align="center" class="label_txt_heading"><strong>Cost</strong></td>

                <td width="15%" align="center" class="label_txt_heading"><strong>Options</strong></td>

              </tr>

              {section name=q loop = $ticket}

              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

                <td align="left" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>

                <td align="left" valign="middle">{$ticket[q].driver}</td>

                <td align="left" valign="middle">{$ticket[q].tck_num}</td>

                <td align="left" valign="middle">{$ticket[q].date}</td>

                <td align="left" valign="middle">{$ticket[q].reason}</td>

                <td align="left" valign="middle">{$ticket[q].cost}</td>

                <td align="center" valign="minddle"><a href="edit.php?id={$ticket[q].id}" title="Edit Driver"> <img border="0" alt="Edit" src="../graphics/edit.png" /></a>&nbsp;&nbsp; <a href="#" onclick="return deleteRec('{$ticket[q].id}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png" /></a></td>

              </tr>

              {sectionelse}

              <tr>

                <td colspan="7" align="center"><b>No Record Found</b></td>

              </tr>

              {/section}

            </table></td>

        </tr>

        <tr>

          <td align="center">{$paging}</td>

        </tr>

      </table></td>

  </tr>

</table>

{ include file = innerfooter.tpl} 