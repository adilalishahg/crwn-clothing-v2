{ include file = headerinner.tpl}
{literal}
<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>
<script type="text/javascript">
function showgraph(val){
  if(val == '1'){
     $("#graph1").show("slow"); 
   }
  if(val == '2'){
     $("#graph2").show("slow");
   }   
  if(val == '3'){
     $("#graph1").hide("slow");   
     $("#graph2").hide("slow");  	 
   }     
}
function selbox(val){
if(val == '0'){
if(document.getElementById('box').checked == true)
   {
  $('#hospname').attr("disabled", true);
  $('#address').attr("disabled", true);
  $('#cisid').attr("disabled", false);
  //$('#box2').attr("disabled", true);   
  $('#box2').attr("checked", false);  
  $('#ssn').val("");   
  $('#ssn').attr("disabled", true); 
  return true;  
  }
else if(document.getElementById('box').checked == false){
  $('#hospname').attr("disabled", false);
  $('#address').attr("disabled", false);
  $('#ssn').attr("disabled", true); 
  $('#box').attr("disabled", false);
  $('#box2').attr("disabled", false); 
  $('#box2').attr("checked", false);     
  $('#cisid').attr("disabled", true); 
  $('#cisid').val(""); 
  return true;
  }else{
  return false;
    }
  }
if(val == '1'){
if(document.getElementById('box2').checked == true)
   {
  $('#hospname').attr("disabled", true);
  $('#address').attr("disabled", true);
  $('#cisid').val("");
  //$('#box').attr("disabled", true); 
  $('#cisid').attr("disabled", true);     
  $('#box').attr("checked", false);   
  $('#ssn').attr("disabled", false);  
  return true;  
  }
else if(document.getElementById('box2').checked == false){
  $('#hospname').attr("disabled", false);
  $('#address').attr("disabled", false);
  $('#cisid').attr("disabled", true); 
  $('#box').attr("disabled", false);
  $('#box').attr("checked", false); 
  $('#box2').attr("disabled", false);     
  $('#ssn').attr("disabled", true); 
  $('#ssn').val("");    
  return true;
  }else{
  return false;
    }
  }  
}
$(document).ready(function(){	

$("#startdate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
$("#enddate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
});
</script>
{/literal}
<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">
  <tr>
    <td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                             { if $errors != '' || $msgs != ''} <tr>
                              <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
		                    { if $errors != ''} {$errors} {/if}</span></td>
                            </tr>{/if}
<tr>
                              <td height="19" colspan="2" align="center">
							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">
							{if $noReq neq '0'}{/if}
							[<a href="javascript:history.back();">Back</a>]</div>							  </td>
        </tr>							
                            <tr>
<td height="19" colspan="2" align="center" class="admintopheading">REQUEST REPORTS</td>
                           </tr>
                            <tr>
                              <td height="44" colspan="2" align="center"  valign="top">
							 <form name="searchReport" action="index.php" method="get"> 
							  <table width="100%" border="0" cellspacing="2" cellpadding="2" align="center" class="">
          <!-- <tr>
              <td colspan="5" valign="top" class="admintopheading" align="left">SEARCH CRITERIA</td>
            </tr>-->
            <tr>
              <td width="20%" align="left" valign="top" class="labeltxt"><strong>From:</strong></td>
              <td width="30%" align="left" valign="top"><input type="text" name="startdate" id="startdate" value="{$startdate}" class="inputTxtField date" size="10"/>
                (mm/dd/yyyy)</td>
              <td width="15%" align="left" valign="top" class="labeltxt"><strong>To:</strong>&nbsp;</td>
              <td width="35%" align="left" valign="top">&nbsp;<input type="text" name="enddate" id="enddate" value="{$enddate}" class="inputTxtField date" size="10" />
             (mm/dd/yyyy)</td>
              </tr>

            <tr>
<td align="left"  class="labeltxt" valign="top"><strong>Account:</strong>&nbsp;</td>
             <td align="left" valign="top">
                <select name="hospname" class=" txt_boxX" id="hospname"  >
                      <option value="">All</option>
                      			  {section name=q loop=$hosp}	
                 <option value="{$hosp[q].id}" {if $hosp[q].id eq $hospname} selected="selected" {/if}>{$hosp[q].account_name}</option>
                      {/section}
                    </select>
              </td>
                    <td width="2%" align="left" valign="top" class="labeltxt"><strong>Patient Name  :</strong></td><td colspan="2"><input type="text" name="pname" id="pname" value="{$pname}" class="inputTxtField" autocomplete="off"  onKeyUp="searchSuggest();" /><div id="layer1"></div></td>
            </tr>

            <tr>

             <!-- <td align="left" valign="top" class="labeltxt"><strong>Company Code :</strong></td>

              <td colspan="1" align="left" valign="top"><select name="code" class=" txt_boxX" id="code"  >
                      <option value="">All</option>
                      			  {section name=q loop=$ccode}	
                 <option value="{$ccode[q].code}" {if $ccode[q].code eq $code} selected="selected" {/if}>{$ccode[q].code} - - {$ccode[q].company}</option>
                      {/section}
                    </select></td>-->
<td align="left" valign="top"  class="labeltxt"><strong>Filter By Date:</strong>&nbsp;</td>
             

              <td align="left" valign="top"><span class="labeltxt">
                <select  name="by_date" >
                  <option value="today_date" {if $by_date eq 'today_date'} selected="selected" {/if}>By Request date</option>
                  <option value="appdate" {if $by_date eq 'appdate'} selected="selected" {/if}>By Appointment Date</option>
                </select>
              </span></td>
             
            </tr>

			

            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="4" align="left" valign="top">

			  <font color="#FF0000">
				 <ol><li>[ Total Requests: {$total}] [ Approved: {$app}] [ Pending: {$pend}] [ Disapproved: {$disap}]</li>
				 </ol> </font>			  </td>
              </tr>

            

            <tr>

              <td align="left" valign="top">&nbsp;</td>

              <td colspan="4" align="left" valign="top">

			  <input type="submit" name="submit" value='Report' class="inputButton btn"  />&nbsp;

			  <input type="reset" name="reset" value='Reset' class="inputButton btn"  />			  </td>
              </tr>
          </table>	

		                     </form>		  	                  </td>

                            </tr>

                           <!-- <tr>

                              <td colspan="2" align="center"  valign="top" class="admintopheading">GRAPH</td>

                            </tr>

                            <tr>

                              <td colspan="2" align="center"  valign="middle" height="35">

							   <input type="button" onclick="showgraph(1);" value="General" class="btn">

							   {if $noReq neq '0'}

							   <input type="button" onclick="showgraph(2);" value="Search Based" class="btn">

							   <input type="button" onclick="showgraph(3);" value="x" class="btn">							   

							   {else}

							   <input type="button" value="Search Based" disabled="disabled" class="btn">							   

							   {/if}

							    

							   							  </td>

                            </tr>

                            <tr>

                              <td width="49%" align="right"  valign="top" > 

							 {if $noReq eq '0'}

							 <div id="graph1" style="display:none; position:relative; margin-left:73%;">{$graph1->create()}</div>

							 {else}

							  <div id="graph1" style="display:none;">{$graph1->create()}</div>

							 {/if}

							  

							  </td>

                              <td width="51%" align="left"  valign="top" >

							  {if $noReq neq '0'}

								 <div id="graph2" style="display:none;">{$graph2->create()}</div>

							   {/if}</td>

                            </tr>							-->

                            <tr>

                              <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;">

						   {if $noReq neq '0'}

						   <br />

							  <table width="85%" border="0" class="main_table">

							  <tr class="admintopheading">

								<td width="40%" align="center">

								<strong>Account Name</strong>

								</td>
								<td align="center"><strong>Requests Status </strong></td>
								</tr>	   
							{section name=q loop=$reqdetails}
							  {if $reqdetails[q].rows neq '0'}
							  <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
								<td align="left" valign="middle">
								<b>{$reqdetails[q].account_name}</b>
								</td>
								<td align="center" valign="middle">

																
{if $showPatient eq 'no'}
								<a href="reqdetails.php?req={$reqdetails[q].account}&st=active{if $startdate neq ''}&startdate={$startdate}{/if}{if $enddate neq ''}&enddate={$enddate}{/if}{if $pname neq ''}&pname={$pname}{/if}&by_date={$by_date}{if $apptype neq ''}&apptype={$apptype}{/if}" target="_blank">Pending</a> | <a href="reqdetails.php?req={$reqdetails[q].account}&st=approved{if $startdate neq ''}&startdate={$startdate}{/if}{if $enddate neq ''}&enddate={$enddate}{/if}{if $pname neq ''}&pname={$pname}{/if}&by_date={$by_date}{if $apptype neq ''}&apptype={$apptype}{/if}"  target="_blank">Approved</a> | <a href="reqdetails.php?req={$reqdetails[q].account}&st=disapproved{if $startdate neq ''}&startdate={$startdate}{/if}{if $enddate neq ''}&enddate={$enddate}{/if}{if $pname neq ''}&pname={$pname}{/if}&by_date={$by_date}{if $apptype neq ''}&apptype={$apptype}{/if}"  target="_blank">Disapproved</a>

								 {else}

{if $g2activeReqs > 0}<a href="reqdetails.php?req={$reqdetails[q].account}&cisid={$reqdetails[q].cisid}&st=active{if $startdate neq ''}&startdate={$startdate}{/if}{if $enddate neq ''}&enddate={$enddate}{/if}&by_date={$by_date}{if $apptype neq ''}&apptype={$apptype}{/if}&{if $pname neq ''}&pname={$pname}{/if}"  target="_blank">Active({$g2activeReqs})</a>{else}Active({$g2activeReqs}){/if} 

 | {if $g2appReqs > 0}<a href="reqdetails.php?req={$reqdetails[q].account}&cisid={$reqdetails[q].cisid}&st=approved{if $startdate neq ''}&startdate={$startdate}{/if}{if $enddate neq ''}&enddate={$enddate}{/if}&by_date={$by_date}{if $apptype neq ''}&apptype={$apptype}{/if}&{if $pname neq ''}&pname={$pname}{/if}"  target="_blank">Approved({$g2appReqs})</a>{else}Approved({$g2appReqs}){/if}

 | {if $g2disappReqs > 0} | <a href="reqdetails.php?req={$reqdetails[q].account}&cisid={$reqdetails[q].cisid}&st=disapproved{if $startdate neq ''}&startdate={$startdate}{/if}{if $enddate neq ''}&enddate={$enddate}{/if}&by_date={$by_date}{if $apptype neq ''}&apptype={$apptype}{/if}&{if $pname neq ''}&pname={$pname}{/if}"  target="_blank">Disapproved({$g2disappReqs})</a>{else}Disapproved({$g2disappReqs}){/if}								

								{/if}

								</td>

								</tr>

							 {else}

							 <tr>

							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>

							 </tr> 				 

							 {/if}

							{sectionelse}

							 <tr>

							  <td colspan="5" align="center" class="labeltxt"> <b>No Record Found</b></td>

							 </tr> 

							 {/section} 

							</table>

						      {/if}				       </td>

                    </tr>

			   <!-- <tr>

			   <td colspan="2" align="center">{$pages}</td>

			</tr>		-->	

      </table>

    </td>

  </tr>

</table>

{literal}

<script>selbox();</script>{/literal}		 

{ include file = innerfooter.tpl}

