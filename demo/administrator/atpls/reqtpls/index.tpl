{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{ location.href="index.php?delId="+id;

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



function ChangeStatus(val,st){

var ans= 1;

if(st == '3'){

     jPrompt('Specify the reason for disapproving:', '', 'MMT GLOBAL Transport', function(r) {

	  if(typeof(r) == "undefined"){

	    Ask();

	  }else{

	  ans = r;  	 

      AjaxSend(val,st,ans);

	  }

	});

}

if(st == '2'){

   AjaxSend(val,st,ans);

  }

}	



function removeTr(val){

  $('#tr'+val).remove();

}



function Ask(){

    jPrompt('Specify the reason for disapproving:', '', 'MMT GLOBAL Transport', function(r) {

	  if(typeof(r) == "undefined"){

	  jAlert('You must Specify a reason for disapproving'); 

	   Ask();

	   return false;

	  }else{

	  return r; }

	});

}	



function AjaxSend(val,st,ans){

    $.post("hosprequests.php", {queryString: ""+val, sta:""+st, rea: ""+ans}, function(data){

	  if(data.length > 0) {   

        if(data == 'Success' && st == '3'){	removeTr(val);	

		return true;	

		}

		else if(data == 'Success' && st == '2'){ removeTr(val);		

		return true;		

		} 

        else{

		return false;	

		} 		

      }

	 });

}



</script>

{/literal}

<table id="table1" class="outer_table"   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="44" align="center" valign="top">  							  </td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="okmsg"><span class="okmsg">{ if $msgs != ''} {$msgs} {/if}

		                    { if $errors != ''} {$errors} {/if}</span></td>

                            </tr>

<tr>

                              <td height="19" align="center">

							  <div align="right" id="add_div" style="padding-right:40px; padding-bottom:5px;">

							[<a href="javascript:history.back();">Back</a>]</div>							  </td>

        </tr>							

                            <tr>

<td width="71%" height="19" align="center" class="admintopheading">REQUESTS MANAGEMENT</td>

                            </tr>

                            

                            <tr>

                              <td height="44" align="center"  valign="top" style="padding-bottom:50px;">

							  <table width="100%" border="0" class="main_table">

                  <tr class="admintopheading">

                    <td width="20%" align="center"><strong>Account Name</strong></td>

                    <td width="15%" align="center"><strong>Account Address</strong></td>

                    <td width="15%" align="center"><strong>Total Requests </strong></td>

                    <td width="15%" align="center"><strong>Options</strong></td>

                  </tr>	   

			    {section name=q loop=$reqdetails}

				  {if $reqdetails[q].rows neq '0'}

				  <tr id="tr{$reqdetails[q].id}" bgcolor="{cycle values="#ffffff,#dfedfa"}">

                    <td align="left" valign="middle"><b>{$reqdetails[q].account_name}</b></td>

                    <td align="center" valign="middle">{$reqdetails[q].address}, {$reqdetails[q].city}, {$reqdetails[q].state} {$reqdetails[q].zip}</td>

                    <td align="center" valign="middle">{$reqdetails[q].cnt}</td>

                    <td align="center" valign="middle">

				    <a href="reqdetails.php?req={$reqdetails[q].account}" title="Approve Single Trip"><img alt="Approve Single Trip" border="0" src="../images/normal.png" title="Approve Single Trip"></a><br/><a href="reqdetails_with_auto_approve.php?req={$reqdetails[q].account}" title="Approve Multiple Trips"><img alt="Approve Single Trip" border="0" src="../images/multiple.png" title="Approve Multiple Trips"></a>				</td>

 				 </tr>

				 {else}

				 <tr>

				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>

				 </tr> 				 

				 {/if}

				{sectionelse}

				 <tr>

				  <td colspan="6" align="center" class="labeltxt"> <b>No Record Found</b></td>

				 </tr> 

				 {/section} 

                </table>				</td>

            </tr>
<!--
			<tr>

			   <td align="center">{$paging}</td>

			</tr>	-->		

      </table>

    </td>

  </tr>

</table>		 

{ include file = innerfooter.tpl}

