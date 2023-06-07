{include file = headerinner.tpl}
{literal}
<style type="text/css">
<!--
.sterick {
	color: #F00;
}
-->
</style>
<script type="text/javascript">
function verify()
{
	var ok;
		ok=confirm("Are you sure you want to delete this record?");
		if (ok)
		{ 
          location.href="index.php?clear=clear"; 
		return true;
		}
		else
		{			
          location.href="index.php"; 
		return false;
		}
}
$(document).ready(function(){
    $('#searchReport').validationEngine();
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
  });
function quicksearch()
{
	var date = $('#q_date').val();
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
function compare()
{
	var date1 = $('#startdate').val();
	var date2 = $('#enddate').val();
	if(date1 > date2){
	alert("From: Date cannot be greater then To: Date");
	return false;
	}
	return true;
}
</script> 
{/literal}
<table width="720" border="0" cellspacing="0" cellpadding="0" class="" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            
            
            
            { if $errors != ''} {$errors} {/if}</td>
        </tr>
        <tr>
          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]&nbsp;|&nbsp; 
              
              
              
              [<a   href="javascript:verify();" >Clear Records</a>]&nbsp;|&nbsp; 
              
              <!--[<a href="index.php?state = trash">Trash Can</a>]&nbsp;|&nbsp; --> 
              
              [<span id="show_search"><a href="#" onclick="showsearch();"> Show Search</a></span><span id="hide_search"><a href="#" onclick="hidesearch();"> Hide Search</a></span>]&nbsp; <a title="Add Account Type" href="timein.php" rel="facebox"><!--<img alt="Add Time In" border="0" src="../graphics/add_12.gif">--></a></div></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td height="19" align="center"><div id="search_form">
              <form name="searchReport" id="searchReport" action="index.php" method="get" >
                <table width="80%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
                  <tr>
                    <td colspan="4" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                    <td align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$sdate}" class="validate[required] inputTxtField date"/>
                      <span class="sterick">*</span>&nbsp;
                      <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
                        <div class="suggestionList" id="autoSuggestionsList1"> &nbsp; </div>
                      </div>
                      (mm/dd/yyyy)</td>
                    <td align="right" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                    <td align="left" valign="top" class="date required"><input type="text" name="enddate" id="enddate" value="{$edate}" class="validate[required] inputTxtField date" />
                      <span class="sterick">*</span>
                      <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">
                        <div class="suggestionList" id="div">&nbsp; </div>
                      </div>
                      (mm/dd/yyyy)</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="labeltxt"><strong>User:</strong></td>
                    <td align="left" valign="top"><select name="user">
                        <option value="">Select User</option>
                    {section name=d loop=$users}
                        <option value="{$users[d].admin_id}" {if $users[d].admin_id eq $user_id} selected="selected" {/if}>{$users[d].admin_name} {$users[d].admin_lname}</option>
                    {/section}
                      </select>
                      <span class="sterick">*</span></td>
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
                    <td align="left" valign="top">{if $uid neq ''}
                      <input name="uid" type="hidden" id="uid" value="{$uid}" />
                      {/if}</td>
                    <td colspan="3" align="center" valign="top"><input type="submit" name="search" value='Search' class="inputButton btn" id="search" onclick="return compare();"  />
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
              <option value="">Select Month</option>
              



            {section name=dt loop=$dates}



            	
              <option value="{$dates[dt].date}" {if $dates[dt].date eq $month} selected="selected" {/if}>{$dates[dt].name}</option>
              



             {/section}



            
            </select></td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">LOG MANAGEMENT</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>User Name</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Date</strong></td>
               
                <!--  <td width="10%" align="center" class="label_txt_heading"><strong>Time</strong></td>-->
                
                <td align="center" class="label_txt_heading"><strong>link</strong></td>
              </tr>
              {section name=q loop = $log}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">
                <td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>
                <td align="center" valign="middle">{$log[q].user}</td>
                <td align="center" valign="middle">{$log[q].date}</td>
                
                <!--  <td align="center" valign="middle">{$log[q].time}</td>-->
                
                <td align="left" valign="middle">{$log[q].link}</td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="5" align="center"><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td align="center">{$pages}</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 