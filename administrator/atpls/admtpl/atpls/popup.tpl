{literal}

<script>

$(document).ready(function($){

		$('#popup').validate();

						   })

function report(id)

{

	location.href = '../pop_up/warning.php?tdid='+id;

}



setInterval ( "report('{/literal}{$trip.tdid}{literal}')", 50000);

function e_sound(soundobj) 

{

	if((!document.all)&&(document.getElementById))

	{

		var thissound= eval("document."+soundobj);

		thissound.Play();	

	}

	else if(document.all)

	{

		var a=eval("document.all."+soundobj+".src");

	document.all.sound.src=a;

	}

	else

	{

		return;

	}

}

e_sound('buzz');

</script>

<style type="text/css">

.snd {

height:0;

width:0;

position:absolute;

top:0;

left:0

}

</style>

{/literal}





<head>

<meta MMTp-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<link href="stylesheet.css" rel="stylesheet" type="text/css" />

<link href="../theme/styles.css" rel="stylesheet" type="text/css">

</head>



<body  onfocus="if(document.all)document.all.sound.src='beep-5.wav'">

<embed class="snd" NAME="buzz" SRC="beep-5.wav" AUTOSTART="true" loop="true" HIDDEN="true">



<table width="380" border="0" cellspacing="0" cellpadding="0" style="border: solid 1px #185481;">

  <tr>

    <td><div class="top_head">Message Alert</div>

    

    </td>

  </tr>

  <tr>

    <td colspan="2" class="name_head">

    <form name="popup" id="popup" action="../pop_up/action.php" method="post">

    <table width="380" border="0" cellspacing="2" cellpadding="0">

      <tr>

        <td height="5" colspan="3" align="right"></td>

        </tr>

      <tr>

        <td width="69" height="20" align="right">Corporate:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.user}

          <input name="trip_id" type="hidden" id="trip_id" value="{$trip.tdid}"></td>

      </tr>

      <tr>

        <td width="69" height="20" align="right">Facility:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.clinic}</td>

      </tr>

      <tr>

        <td width="69" height="20" align="right">Driver:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.driver} </td>

      </tr>

      <tr>

        <td height="20" align="right">Appintment:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.drp_time}

          <input name="drv_id" type="hidden" id="drv_id" value="{$trip.drv_id}"></td>

      </tr>

      <tr>

        <td height="20" align="right">Rating:</td>

        <td height="20" colspan="2" align="left" class="name_text">&nbsp; &nbsp;

         <select name="rate" class="name_text required">

        	<option value="">Select to rate</option>

            <option value="1">Poor</option>

            <option value="2">Normal</option>

            <option value="3">Fair</option>

            <option value="4">Good</option>

            <option value="5">Excellent</option>

            

        </select>

        </td>

      </tr>

      <tr>

        <td height="20">&nbsp;</td>

        <td colspan="2" align="left"><textarea name="comment" cols="25" rows="6" id="comment" class="text_field"></textarea></td>

      </tr>

      <tr>

        <td height="29">&nbsp;</td>

        <td width="15">&nbsp;</td>

        <td width="296"><input name="submit" type="submit" id="submit" value="Submit"></td>

      </tr>

    </table>

    </form>

    </td>

  </tr>

</table> 







</body>

</html>

