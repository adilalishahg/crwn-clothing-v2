{include file = headerinner.tpl}



{literal}



<script type="text/javascript">



function chk_date(date)



{



	



}











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



		ok=confirm("Are you sure you want to delete this record?");



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



          [<a href="javascript:history.back();">Back</a>]</div></td>



        </tr>



        



        <!--<tr>



          <td height="19" align="left" ><br />



			<select name="q_date" id="q_date" onchange="quicksearch();">



             <option value="">Select Month </option>



            {section name=dt loop=$dates}



            	<option value="{$dates[dt].date}" {if $dates[dt].date eq $month} selected="selected" {/if}>{$dates[dt].name}</option>



             {/section}



            </select>



            </td>



        </tr>-->



        <tr>



          <td height="19" align="center" class="admintopheading">MILAGE HISTORY - [{$vehicle.vname} - {$vehicle.vnumber} ]</td>



        </tr>



        <tr>



          <td height="44" align="center"  valign="top" style="padding-bottom:20px;"><table width="100%" border="0" class="main_table">



              <tr>



                <td width="5%" align="center" class="label_txt_heading"><strong>S.No.</strong></td>



<!--                <td width="20%" align="center" class="labeltxt"><strong>Vehicle Number</strong></td>



                <td width="20%" align="center" class="labeltxt"><strong>Vehivle Name</strong></td>-->



                <td width="25%" align="center" class="label_txt_heading"><strong>Trip Consumer</strong></td>



                <td width="20%" align="center" class="label_txt_heading"><strong>Trip Corporation</strong></td>



                <td width="15%" align="center" class="label_txt_heading"><strong>Pick up Address</strong></td>



                <td width="15%" align="center" class="label_txt_heading"><strong>Drop Address</strong></td>



                <td width="15%" align="center" class="label_txt_heading"><strong>Total Miles</strong></td>



                <!--<td width="15%" align="center" class="labeltxt"><strong>Remarks</strong></td>-->



               <!-- <td width="15%" align="center" class="labeltxt"><strong>Options</strong></td>-->



              </tr>



              {section name=q loop = $data}



              <tr bgcolor="{cycle values="#eeeeee,#d0d0d0"}">



                <td align="center" valign="middle"><b>{$smarty.section.q.iteration}.</b></td>



                <!--<td align="center" valign="middle">{$data[q].vnumber}</td>



                <td align="center" valign="middle">{$data[q].vname}</td>-->



                <td align="center" valign="middle">{$data[q].trip_user}</td>



                <td align="center" valign="middle">{$data[q].trip_clinic}</td>



                <td align="center" valign="middle">{$data[q].pck_add}</td>



                <td align="center" valign="middle">{$data[q].drp_add} </td>



                <td align="center" valign="middle">{$data[q].trip_miles} </td>



                <!--<td align="center" valign="middle">{$data[q].remarks} </td>-->



                <!--<td align="center" valign="middle"><strong>{$vehdetails[q].refildate}</strong></td>-->



               <!-- <td align="center" valign="top"><a href="edit.php?id={$data[q].id}" title="Edit Record" rel="facebox"> <img border="0" alt="Edit" src="../graphics/edit.png" /></a>&nbsp;&nbsp; <a href="#" onclick="return deleteRec('{$drvdetails[q].Drvid}');" title="Remove"> <img alt="Remove" border="0"  src="../graphics/delete.png" /></a></td>-->



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