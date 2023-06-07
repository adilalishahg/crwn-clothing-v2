{ include file = headerinner.tpl}



{literal} 
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

$("#appmiledate").datepicker( {yearRange:'-120:00', dateFormat: 'mm/dd/yy'} );
});

</script> 
{/literal}
<table border="0" cellspacing="0" cellpadding="0" class="outer_table" align="right" bgcolor="#FFFFFF">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        {if $errors != '' || $msgs != ''}<tr>
          <td height="19" colspan="2" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}
            
            
            
            { if $errors != ''} {$errors} {/if}</span></td>
        </tr>{/if}
        <tr>
          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> {if $noReq neq '0'}
              
              
              
              [<a href="javascript:history.back();">Back</a>]{/if}</div></td>
        </tr>
        <tr>
          <td height="19" colspan="2" align="center" class="admintopheading">UPDATE MILAGE</td>
        </tr>
        <tr>
          <td height="44" colspan="2" align="center"  valign="top"><form name="searchReport" action="milagereport.php" method="get" id="searchReport">
              <table   border="0" cellspacing="2" cellpadding="2" align="center" class="" style="width:100%;">
               <tr>
                  <td width="20%" align="left" valign="top" class="labeltxt"><strong>Appointment Date:</strong></td>
                  <td width="30%" align="left" valign="top"><input type="text" name="appmiledate" id="appmiledate" value="{$appmiledate}" class="inputTxtField date required" /> (mm/dd/yyyy)</td><td></td> <td></td>
                 <!-- <td align="left" width="20" valign="top" class="labeltxt"><strong>Company Code :</strong></td>

              <td width="30%" align="left" valign="top"><select name="code" class=" txt_boxX" id="code"  >
                      <option value="">All</option>
                      			  {section name=q loop=$ccode}	
                 <option value="{$ccode[q].code}" {if $ccode[q].code eq $code} selected="selected" {/if}>{$ccode[q].code} - - {$ccode[q].company}</option>
                      {/section}
                    </select></td>-->
                </tr>
                <tr>
                  <td align="left" valign="top">&nbsp;</td>
                  <td colspan="2" align="left" valign="top"><input type="submit" name="submit" id="submit" value='Report' class="inputButton btn"  />
                    &nbsp;
                    <input type="reset" name="reset" value='Reset' class="inputButton btn"  /></td>
                    <td colspan="2"><span style="color:#F00;" >Total Miles: &nbsp;&nbsp;&nbsp;{$totalmilage}</span></td>
                </tr>
              </table>
            </form></td>
        </tr>
        
        <tr>
          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="95%" border="0" class="main_table">
              <tr class="admintopheading">
                <td width="15%" align="center"><strong>Patient Name </strong></td>
                <td width="15%" align="center"><strong> Appointment Date/Time </strong></td>
                <td width="20%" align="center"><strong> Pick Address</strong></td>
                <td width="20%" align="center"><strong>Destination</strong></td>
                <td width="10%" align="center"><strong>Patient Phone #</strong></td>
                <td width="15%" align="center"><strong> Total Miles</strong></td>
              </tr>
              {section name=q loop=$data}
              
              
              
              {if $reqdetails[q].rows neq '0'}
              <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">
                <td align="center" valign="top"><p>{$data[q].clientname}</p></td>
                <td align="center" valign="top"><p>{$data[q].appdate|date_format} / {$data[q].apptime}</p></td>
                <td align="center" valign="top">{$data[q].pickaddr}</td>
                <td align="center" valign="top">{$data[q].destination}</td>
                <td align="center" valign="top">{$data[q].phnum}</td>
                
                <!--<td align="center" valign="top"><a href="javascript:popWind('details.php?id={$data[q].id}');">View</a></td>-->
                
                <td align="center" valign="top">{if $data[q].totmilage neq ''}{$data[q].totmilage}{else}0.0{/if}&nbsp;&nbsp;<!--|&nbsp;&nbsp;<a href="approve_request.php?tid={$data[q].id}{if $appmiledate neq ''}&date={$appmiledate}{/if}" rel="facebox">Change</a>--></td>
              </tr>
              {/if}
              {sectionelse}
              <tr>
                <td colspan="7" align="center" ><b>No Record Found</b></td>
              </tr>
              {/section}
            </table></td>
        </tr>
        <tr>
          <td colspan="2" align="center">{if $totalRows gt 0}{$pages}{/if}</td>
        </tr>
      </table></td>
  </tr>
</table>
{ include file = innerfooter.tpl} 