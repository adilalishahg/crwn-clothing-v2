{include file = headerinner.tpl}
{literal} 
<script type="text/javascript">
$(document).ready(function(){
//$("#startdate").datepicker( {maxDate: '-1', dateFormat: 'mm/dd/yy'} );
//$("#enddate").datepicker( {maxDate: '-1', dateFormat: 'mm/dd/yy'} );
//alert('kjhfkljg');
//alert(date.getDay());
  });
function Disabledays1(date) {
 var day = date.getDay();
 if (day == 0) {
 return [true] ; 
 } else { 
 return [false] ;
 }
 }
 $(function() {
 $( "#startdate" ).datepicker({
maxDate: '-1', dateFormat: 'mm/dd/yy',	 
 beforeShowDay: Disabledays1
 });
 $( "#enddate" ).datepicker({
maxDate: '+5', dateFormat: 'mm/dd/yy',	 
 beforeShowDay: Disabledays2
 });
 });
function Disabledays2(date) {
 var day = date.getDay();
 if (day == 6) {
 return [true] ; 
 } else { 
 return [false] ;
 }
 }
/* $(function() {
 
 });*/
 
function changeapproval(val,id)
{ 
  if (val != '' && id != ''){		
	{ 	
	 $.post("changeapproval.php", {id: ""+id,val: ""+val}, function(data){
	 if(data.length > 0 ){  
		 }
	});
	}
	}	}

</script> 
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
    { if $msgs != '' || $errors != ''}
        <tr>
          <td height="19" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            
            { if $errors != ''} {$errors} {/if}</td>
        </tr>{/if}
        <tr>
          <td height="19" align="center"><div align="right" id="add_div" style="padding-right:20px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a></div></td>
        </tr>
        <tr>
          <td></td>
        </tr>
        <tr>
          <td height="19" align="center"><div id="search_form">
              <form name="searchReport" action="payperiod.php" method="post" id="searchReport">
                <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
                  <tr>
                    <td colspan="8" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
                    <td align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$startdate}" readonly="readonly" class="required"/>
                      &nbsp;<span style="color:#FF0000">*</span>
                      <div class="suggestionsBox" id="suggestions1" style="display: none; position:absolute;"> <img src="images/upArrow.png" style="position: relative; top: 7px; left: -10px;" alt="upArrow" />
                        <div class="suggestionList" id="autoSuggestionsList1"> &nbsp; </div>
                      </div>
                      (mm/dd/yyyy)</td>
                    <td align="right" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
                    <td align="left" valign="top"><input type="text" name="enddate" id="enddate" value="{$enddate}" readonly="readonly" class="required" />
                      <span style="color:#FF0000">*</span>
                      <div class="suggestionsBox" id="layer" style="display: none; position:absolute;">
                        <div class="suggestionList" id="div">&nbsp; </div>
                      </div>
                      (mm/dd/yyyy)</td>
                             <td align="left" valign="top" class="labeltxt"><strong>Driver :</strong></td>
                    <td align="left" valign="top"><select name="drv_id" id="drv_id" >
                        <option value="">All Drivers</option>
                    {section name=d loop=$datadr}
                     <option value="{$datadr[d].Drvid}" {if $datadr[d].Drvid eq $drv_id } selected="selected" {/if}>{$datadr[d].fname} {$datadr[d].lname}</option>
                    {/section}
                      </select></td>
                    <td width="16%" align="left" valign="top" class="labeltxt">&nbsp;</td>
                    <td align="right" valign="top" class="labeltxt">&nbsp;</td>
                  </tr>
                  <tr>
                    <td align="left" valign="top">&nbsp;</td>
                    <td colspan="3" align="center" valign="top"><input type="submit" name="search" value='&nbsp;&nbsp;Search&nbsp;&nbsp;' class="inputButton btn" id="search"  />
                      &nbsp;
                      <input type="reset" name="reset" value='&nbsp;&nbsp;Reset&nbsp;&nbsp;' class="inputButton btn"  /></td>
                      <td></td>
                      <td><!--{if $drv_id neq ''}<input type="button" onclick="javascript:popWind('paydetails.php?id={$data.0.driver_id}&startdate={$startdate}&enddate={$enddate}');" value="Show Pay Summary" class="inputButton btn"  />{/if}--></td>
                  </tr>
                </table>
              </form>
            </div></td>
        </tr>
        <tr>
          <td height="19" align="center" class="admintopheading">Pay Period Report</td>
        </tr>
        <tr>
          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">
              <tr>
                <td width="3%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>
                <td  width="12%" class="label_txt_heading"><strong>Driver Name</strong></td>
                <td width="8%" align="center" class="label_txt_heading"><strong>Pay Period Start</strong></td>
                <td width="8%" align="center" class="label_txt_heading"><strong>Pay Period End</strong></td>
                <td width="7%" align="center" class="label_txt_heading"><strong>Total Hours</strong></td>
                <td width="10%" align="center" class="label_txt_heading"><strong>Over Time</strong></td>
                <td width="6%" align="center" class="label_txt_heading"><strong>Total Rides</strong></td>
                <td width="6%" align="center" class="label_txt_heading"><strong>Total Miles</strong></td>
            	<td width="6%" align="center" class="label_txt_heading"><strong>Payable Amount</strong></td>
                <td width="4%" align="center" class="label_txt_heading"><strong>Options</strong></td>
              </tr>
              {section name=q loop = $datainfo}
              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}" height="25">
                <td align="center" valign="middle"><b>&nbsp;{$smarty.section.q.iteration}.</b></td>
                <td align="left" valign="middle">&nbsp;{$datainfo[q].fname} {$datainfo[q].lname}</td>
                <td align="center" valign="middle">{$datainfo[q].pstart|date_format:"%D"}</td>
                <td align="center" valign="middle">{$datainfo[q].pend|date_format:"%D"}</td>
                <td align="center" valign="middle">{$datainfo[q].totaltime}</td>
                <td align="center" valign="middle">{$datainfo[q].totalovertime}</td>
                <td align="center" valign="middle">{$datainfo[q].runs}</td>
                <td align="center" valign="middle">{$datainfo[q].miles|string_format:"%.2f"}</td>
                <td align="center" valign="middle">$ {if $datainfo[q].payableamount neq ''}{$datainfo[q].payableamount|string_format:"%.2f"}{else}0{/if}</td>
                <td align="center" valign="top">&nbsp;<a href="javascript:popWind('payperioddetails.php?Drvid={$datainfo[q].Drvid}&drv_code={$datainfo[q].drv_code}&pstart={$datainfo[q].pstart}&pend={$datainfo[q].pend}');">  Detail </a></td>
              </tr>
              {sectionelse}
              <tr>
                <td colspan="9" align="center"><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
       
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 