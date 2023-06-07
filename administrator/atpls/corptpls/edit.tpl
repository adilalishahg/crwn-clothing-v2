{ include file = headerinner.tpl}

{literal}

<script type="text/javascript">

function deleteRec(id)

		{

		var ok;

		ok=confirm("Are you sure you want to delete this record");

		if (ok)

		{		

			

			location.href="index.php?delId="+id;

			return true;

			//document.delrecfrm.submit();

		}

		else

		{

			

			return false;

		}

			

	}





function showReason(val){



  if(val == 'disapproved'){

    $('#reason').show('slow');	

  }else{

    $('#reason').hide('slow');  

  }



}

$(document).ready(function() {
	$("#edituser").validationEngine()
	$("#h_phone").mask("(999) 999-9999");
	$("#phnum").mask("(999) 999-9999");	
});

</script>

{/literal}


<table id="table1" class=""   border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="#FFFFFF" style="margin-bottom:10px; width:700px;">

  <tr>

    <td>

<table width="100%" border="0" cellspacing="0" cellpadding="0">

                            <tr>

                              <td height="25" align="right" valign="top">[<a href="javascript:history.back();">Back</a>]</td>

                            </tr>

                            

                            <tr>

                              <td height="19" align="center" class="admintopheading">Edit Facility </td>

                            </tr>

<tr>

          <td height="19" align="center">&nbsp;</td>

        </tr>							

                            <tr>

<td height="19" align="center">

{ if $msgs != '' }<font color="#009966" style="font-weight:bold">{$msgs}</font>{/if}

		    { if $errors != '' }<font color="#FF0000" style="font-weight:bold">{$errors}</font>{/if}</td>

                            </tr>

                            <tr>

                              <td height="44" align="center"  valign="top">

							  							  </td>

            </tr>

			<tr>

			   <td>&nbsp;</td>

			</tr>			

      </table>

    </td>

  </tr>

</table>		 

{ include file = innerfooter.tpl}

