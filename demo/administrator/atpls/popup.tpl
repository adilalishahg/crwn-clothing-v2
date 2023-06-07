<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Untitled Document</title>

<link href="stylesheet.css" rel="stylesheet" type="text/css" />

<link href="../theme/styles.css" rel="stylesheet" type="text/css">



<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>

<script language="javascript" type="text/javascript" src="../facebox/facebox.js"></script>

<script language="javascript" src="../swfobject.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>
<script language="javascript" type="text/javascript" src="../Mypopup/mypopup.js"></script>

<script language="javascript" type="text/javascript" src="../Mypopup/mypopup2.js"></script>
<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2.js"></script>

{literal}



<script>

  $(document).ready(function(){

 $('#popup').validate();

  });

function report(id)

{   

	location.href = '../pop_up/warning.php?tdid='+id;

}



setInterval ( "report('{/literal}{$trip.tdid}{literal}')", 500000);

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

</head>



<body >

<div id="flashPlayer2">



</div>

 

<script type="text/javascript"> 

   var so = new SWFObject("../dewplayer.swf", "mymovie2", "200", "0", "7", "#00000");

   so.addVariable("mp3", "../beep-5.mp3");

   so.addVariable("wmode", "transparent");

   so.addVariable("bgcolor", "#d1e391");

   so.addVariable("autoplay", "true");   

   so.addVariable("autoreplay", "1");   

   so.write("flashPlayer2");

</script>



<table width="380" border="0" cellspacing="0" cellpadding="0" style="border: solid 1px #185481;">

  <tr>

    <td class="label_txt_heading"><div class="top_head">Message Alert</div>

    

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

        <td width="93" height="20" align="right">Consumer</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.user}

          <input name="trip_id" type="hidden" id="trip_id" value="{$trip.tdid}"></td>
      </tr>

      <tr>

        <td width="93" height="20" align="right">Corporation:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.clinic}</td>
      </tr>

      <tr>

        <td width="93" height="20" align="right">Driver:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.driver} </td>
      </tr>

      <tr>

        <td height="20" align="right">Appointment:</td>

        <td height="20" colspan="2" align="left" class="name_text">{$trip.drp_time}

          <input name="drv_id" type="hidden" id="drv_id" value="{$trip.drv_id}"></td>
      </tr>

      <tr>

        <td height="20" align="right">Details:</td>

        <td height="20" colspan="2" align="left" class="name_text"><a onClick="window.open('../routingpanel/view_popup.php?id= {$trip.tdid}');">view trip details </a></td>
      </tr>
      <tr>
        <td height="20" align="right">Trip Status:</td>
        <td height="20" colspan="2" align="left" class="name_text"><select name="status" id="status" class="name_text required">
		<option value="">Select Status</option>

            <option value="5" selected="selected">In Progress</option>

            <option value="4">Dropped</option>

        
        </select>
        </td>
      </tr>

    
      <tr>

        <td height="20">&nbsp;</td>

        <td colspan="2" align="left"><!--<textarea name="comment" cols="25" rows="6" id="comment" class="text_field"></textarea>--></td>
      </tr>

      <tr>

        <td height="29">&nbsp;</td>

        <td width="2">&nbsp;</td>

        <td width="277"><input name="submit" type="submit" id="submit" value="Submit" class="btn"></td>
      </tr>
    </table>

    </form>

    </td>

  </tr>

</table> 







</body>

</html>

