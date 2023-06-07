 {include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record?");

		if (ok)

		{ location.href="index.php?delId="+id;

		return true;}else{			

			return false;}

	}

function rate_it(id, rate)

{

	$('input',id).rating('select',rate);

	//$('input',id).rating('disable')

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

          <td height="44" colspan="2" align="center" valign="top"></td>

        </tr>

        <tr>

          <td height="19" colspan="2" align="center" class="okmsg">{ if $msgs != ''} {$msgs} {/if}

            { if $errors != ''} {$errors} {/if}</td>

        </tr>

        <tr>

          <td height="19" colspan="2" align="center"><div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;"> [<a href="javascript:history.back();">Back</a>]</div></td>

        </tr>

        <tr>

          <td width="11%" height="19" align="center" class="admintopheading">&nbsp;</td>

          <td width="89%" align="center" class="admintopheading">DRIVER TRIPS HISTORY <br/>[PT: Propse Pick/Drop Time]<br/>[AT: Actual Pick/Drop Time]</td>

        </tr>

        <tr>

          <td height="44" colspan="2" align="center"  valign="top" style="padding-bottom:50px;"><table width="100%" border="0" class="main_table">

              <tr>

                <td  align="center" class="label_txt_heading"><strong>Hospital</strong></td>

                <td  align="center" class="label_txt_heading"><strong>From</strong></td>

                <td  align="center" width="80px" class="label_txt_heading"><strong>To</strong></td>

                <td align="center" class="label_txt_heading"><strong>Date</strong></td>

                <td  align="center" class="label_txt_heading"><strong>Pick Times</strong></td>
                <td  align="center" class="label_txt_heading"><strong>Drop Times</strong></td>

                 <!--<td  align="center" class="labeltxt"><strong>Actual App <br />Date/Time</strong></td>-->

                  <td align="center" class="label_txt_heading"><strong>Miles </strong></td>

                   <td align="center" class="label_txt_heading"><strong>Comnt.</strong></td>

                <!--<td align="center" class="label_txt_heading"><strong>Rating</strong></td>-->

                <td align="center" class="label_txt_heading"><strong>Status</strong></td>

              </tr>

              {section name=q loop = $trips}

              <tr valign="top" bgcolor="{cycle values="#eeeeee,#d0d0d0"}">

                <td align="center"><b>{$trips[q].trip_clinic}</b></td>

                <td align="center">{$trips[q].pck_add}</td>

                <td align="center">{$trips[q].drp_add}</td>

                <td align="center">{$trips[q].date|date_format:"%m/%d/%Y"}</td>

                <td align="center">PT {$trips[q].pck_time|date_format:"%H:%M"}<br/>AT {$trips[q].aptime|date_format:"%H:%M"}</td>
                <td align="center">PT {$trips[q].drp_time|date_format:"%H:%M"}<br/>AT {$trips[q].drp_atime|date_format:"%H:%M"}</td>

                  

                 <!-- <td align="center">{$trips[q].drp_atime}</td>-->

                  <td align="center">{$trips[q].trip_miles}</td>

                  <td align="center"><a href="cmnts.php?trip_id={$trips[q].tdid}" rel = "facebox">Read </a></td>

               <!-- <td>

                <div class="rating">

              {section name=r loop=$trips[q].drv_rating}

                <img src="../theme/rate.png"/>

                {/section}

                </div>

                </td>-->

                <td align="center">{if $trips[q].drv_rating lt '2'}Poor {elseif $trips[q].drv_rating gt '4' }Excellent{else}Fair{/if}</td>

              </tr>

              {sectionelse}

              <tr>

                <td colspan="10" align="center"><b>No Record Found</b></td>

              </tr>

              {/section}

            </table></td>

        </tr>

        <tr>

          <td colspan="2" align="center">{$pages}</td>

        </tr>

      </table></td>

  </tr>

</table>

{ include file = innerfooter.tpl} 