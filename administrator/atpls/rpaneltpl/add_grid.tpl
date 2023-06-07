<p>&nbsp;</p>



<p>{literal}

<link rel="stylesheet" href="../theme/style.css" type="text/css">

<link rel="stylesheet" type="text/css" href="../theme/chromestyle.css" />

<link href="../theme/styles.css" rel="stylesheet" type="text/css">

<script language="javascript" type="text/javascript" src="../scripts/jquery-1.2.6.js"></script>

<script language="javascript" type="text/javascript" src="../scripts/jquery.validate.js"></script>



<script language="javascript" type="text/javascript" src="../scripts/jquery.maskedinput-1.2.2"></script>

  <script>



   $(document).ready(function(){



							 // strip();

  $('#staff2').removeClass('required');

	   $('#pck_add2').removeClass('required');



	 $('#pu2').removeClass('required');



	  $('#address3').removeClass('required');

	 $('#dt2').removeClass('required');

	 $('#miles2').removeClass('required');

	 

	  $('#staff2').attr('disabled', true);



	 $('#pck_add2').attr('disabled', true);



	 $('#pu2').attr('disabled', true);



	  $('#address3').attr('disabled', true);



	 $('#dt2').attr('disabled', true);



	 $('#miles2').attr('disabled', true);

	 

	 

	 

    $('#addgrid').validate();



		$("#phone").mask("999-999-9999");



		$("#dt1").mask("29:59");



		$("#pu1").mask("29:59");



		$("#pu2").mask("29:59");



		$("#dt2").mask("29:59");



  });



   



  function chck(val)



  {



	  if(val.checked)



	  {



		  rtrip();



	  }



	  else



	  {



		  strip();



	  }



  }



  



  



function chkwc(){







if(document.getElementById('pck_wc').checked == true){



   $('#pu2').attr('disabled', true);

     $('#dt2').attr('disabled', true);



  }else{



     $('#pu2').attr('disabled', false);

      $('#dt2').attr('disabled', false);

  }  









if(document.getElementById('drp_wc').checked == true){



   $('#dt2').attr('disabled', true);



  }else{



     $('#dt2').attr('disabled', false);



  }  







}  





function show()



 {

 

    if( $('#chk').attr('checked')){

	$('#mnum').show();

       	

     }else{

	 

	 	$('#mnum').hide();

	 

	 

	 }



 }  

 function show2()



 {

 

    if( $('#chk2').attr('checked')){

	$('#mnum2').show();

       	

     }else{

	 

	 	$('#mnum2').hide();

	 

	 

	 }



 }  



 function strip()



 {



	 $('#staff2').attr('disabled', true);



	 $('#pck_add2').attr('disabled', true);



	 $('#pu2').attr('disabled', true);



	  $('#address3').attr('disabled', true);



	 $('#dt2').attr('disabled', true);



	 $('#miles2').attr('disabled', true);



    

	 

 }



  function rtrip()



 {



	 $('#staff2').removeAttr('disabled');



	 $('#pck_add2').removeAttr('disabled');



	 $('#pu2').removeAttr('disabled');



	  $('#address3').removeAttr('disabled');



	 $('#dt2').removeAttr('disabled');



	 $('#miles2').removeAttr('disabled');

	 

	   $('#staff2').addClass('required');

	   $('#pck_add2').addClass('required');



	 $('#pu2').addClass('required');



	  $('#address3').addClass('required');

	 $('#dt2').addClass('required');

	 $('#miles2').addClass('required');



	 



	 add1 = $('#address1').val();



	 add2 = $('#address2').val();



	 miles = $('#miles1').val();



	 drv = $('#staff1').val();



	 



	 $('#staff2').attr('value', drv);



	 $('#pck_add2').attr('value', add2);



	  $('#address3').attr('value', add1);



	 $('#miles2').attr('value', miles);



 }



 	var geocoder, location1, location2;

 

	function initialize() {



		geocoder = new GPatientGeocoder();

	}

	

	

 

	function showLocation() {

	

	

		geocoder.getLocations(document.forms[0].address1.value, function (response) {

			if (!response || response.Status.code != 200)

			{

				alert("Sorry, we were unable to geocode the first address");

			}

			else

			{

				location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};

				geocoder.getLocations(document.forms[0].address2.value, function (response) {

					if (!response || response.Status.code != 200)

					{

						alert("Sorry, we were unable to geocode the second address");

					}

					else

					{

						location2 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};

						calculateDistance();

					}

				});

			}

		});

	}

	

	

	function showLocation2() {

	

	

		geocoder.getLocations(document.forms[0].pck_add2.value, function (response) {

			if (!response || response.Status.code != 200)

			{

				alert("Sorry, we were unable to geocode the first address");

			}

			else

			{

				location1 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};

				geocoder.getLocations(document.forms[0].address3.value, function (response) {

					if (!response || response.Status.code != 200)

					{

						alert("Sorry, we were unable to geocode the second address");

					}

					else

					{

						location2 = {lat: response.Placemark[0].Point.coordinates[1], lon: response.Placemark[0].Point.coordinates[0], address: response.Placemark[0].address};

						calculateDistance2();

					}

				});

			}

		});

	}

 

	function calculateDistance()

	{

		try

		{

			var glatlng1 = new GLatLng(location1.lat, location1.lon);

			var glatlng2 = new GLatLng(location2.lat, location2.lon);

			var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);

			var kmdistance = (miledistance * 1.609344).toFixed(1);

           

			document.getElementById("miles1").value = miledistance;

			

		}

		catch (error)

		{

			alert(error);

		}

	}

	

	function calculateDistance2()

	{

		try

		{

			var glatlng1 = new GLatLng(location1.lat, location1.lon);

			var glatlng2 = new GLatLng(location2.lat, location2.lon);

			var miledistance = glatlng1.distanceFrom(glatlng2, 3959).toFixed(1);

			var kmdistance = (miledistance * 1.609344).toFixed(1);

           

			document.getElementById("miles2").value = miledistance;

			

		}

		catch (error)

		{

			alert(error);

		}

	}

	

	

	function dp(value)

	{

		var v    = $('#miles1').val();

		var brk  = value.split(":");

		if( v >= 0 && v <= 10 ){

			var nmin = parseInt(brk[1])+parseInt(20);		

		}else if( v >= 10 && v <= 15 ){

			var nmin = parseInt(brk[1])+parseInt(30);

		}else if( v >= 15 && v <= 20 ){

			var nmin = parseInt(brk[1])+parseInt(40);

		}else if( v >= 20 && v <= 25 ){

			var nmin = parseInt(brk[1])+parseInt(45);

		}else if( v >= 25 && v <= 30 ){

			var nmin = parseInt(brk[1])+parseInt(50);

		}else if( v >= 30 && v <= 35 ){

			var nmin = parseInt(brk[1])+parseInt(55);

		}else if( v >= 35 && v <= 40 ){

			var nmin = parseInt(brk[1])+parseInt(60);

		}else if( v >= 40 && v <= 45 ){

			var nmin = parseInt(brk[1])+parseInt(65);

		}else if( v >= 45 && v <= 50 ){

			var nmin = parseInt(brk[1])+parseInt(70);

		}else if( v >= 50  ){

			var nmin = parseInt(brk[1])+parseInt(120);		 

		}else{

			var nmin = 0;

		}

		var ndate = new Date(0,0,0,brk[0],nmin,0);

		$('#dt1').attr('disabled', false);

		if(ndate.getHours() < 10)

			var hrs = '0'+ndate.getHours();

		else

			var hrs = ndate.getHours();

		if(ndate.getMinutes() < 10)

			var mins = '0'+ndate.getMinutes();

		else

			var mins = ndate.getMinutes();		  

		$('#dt1').val(hrs+':'+mins);

	}







     function dp2(value)

	 {

	

		var v    = $('#miles2').val();

		var brk  = value.split(":");

		if( v >= 0 && v <= 10 ){

			var nmin = parseInt(brk[1])+parseInt(20);		

		}else if( v >= 10 && v <= 15 ){

			var nmin = parseInt(brk[1])+parseInt(30);

		}else if( v >= 15 && v <= 20 ){

			var nmin = parseInt(brk[1])+parseInt(40);

		}else if( v >= 20 && v <= 25 ){

			var nmin = parseInt(brk[1])+parseInt(45);

		}else if( v >= 25 && v <= 30 ){

			var nmin = parseInt(brk[1])+parseInt(50);

		}else if( v >= 30 && v <= 35 ){

			var nmin = parseInt(brk[1])+parseInt(55);

		}else if( v >= 35 && v <= 40 ){

			var nmin = parseInt(brk[1])+parseInt(60);

		}else if( v >= 40 && v <= 45 ){

			var nmin = parseInt(brk[1])+parseInt(65);

		}else if( v >= 45 && v <= 50 ){

			var nmin = parseInt(brk[1])+parseInt(70);

		}else if( v >= 50  ){

			var nmin = parseInt(brk[1])+parseInt(120);		 

		}else{

			var nmin = 0;

		}

		var ndate = new Date(0,0,0,brk[0],nmin,0);

		$('#dt2').attr('disabled', false);

		if(ndate.getHours() < 10)

			var hrs = '0'+ndate.getHours();

		else

			var hrs = ndate.getHours();

		if(ndate.getMinutes() < 10)

			var mins = '0'+ndate.getMinutes();

		else

			var mins = ndate.getMinutes();		  

		$('#dt2').val(hrs+':'+mins);		

	}
function PerfromAutomation(){
		var shid =  $('#cisid').val();
		var code =  '0';
		if(shid != ''){ 
			$.post("../mercy/fetchdata.php", {hid: ""+shid, id: ""+code}, function(data){
				if(data.length > 0) {
	            	var fetchedData = data;
			  		formvals = new Array();	 
				    formvals = fetchedData.split('^'); 
				  	if(formvals.length > 0){
								if(formvals[0] != '')
								  $('#consumer').val(formvals[0]);
							  	if(formvals[1] != '')							  
								  $('#phone').val(formvals[1]);
						  	  	/*if(formvals[2] != '')						  
								  $('#email').val(formvals[2]);*/
								if(formvals[3] != '')						  
								  $('#dob').val(formvals[3]);
							  	if(formvals[4] != '')					  
								  $('#casemanager2').val(formvals[4]);
							  	if(formvals[15] != '')							  
						  		  $('#address1').val(formvals[15]+', '+formvals[16]+', '+formvals[17]+', '+formvals[18]);
						  		if(formvals[16] != '')							  
						  		  $('#pckcity').val(formvals[16]);
						  		if(formvals[17] != '')							  
						  		  $('#pckstate').val(formvals[17]);
						  	    if(formvals[18] != '')							  
								  $('#pckzip').val(formvals[18]);
						  	  	if(formvals[19] != '')							  
								  $('#address2').val(formvals[19]+', '+formvals[20]+', '+formvals[21]+', '+formvals[22]);
						  		if(formvals[20] != '')							  
							  	  $('#drpcity').val(formvals[20]);
								if(formvals[21] != '')							  
								  $('#drpstate').val(formvals[21]);
						  	  	if(formvals[22] != '')						  
						  		  $('#drpzip').val(formvals[22]);
								  if(formvals[27] != ''){							  
								  $('#appdate').val(formvals[27]); }
								  if(formvals[29] != ''){
										if(formvals[29] == '00:00:00'){
										   pUchoice('Will Call');
										   $('#puchoice').val('Will Call');
										}else{					
										 $('#puchoice').val('Time');		  
										 $('#returnpickup').val(formvals[29]); 
										 $('#returnpickup').attr("class","txt_box required");	
										 $('#rpTime').show();
										  }
									 }	
									 if(formvals[30] != ''){							  
								  		$('#casemanager1').val(formvals[30]);
									 }
									  if(formvals[31] != ''){							  
							  		$('#comments').val(formvals[31]);
									 }	
									 if(formvals[32] != ''){							  
								  		$('#triptype').val(formvals[32]);
									 }
									 if(formvals[33] != ''){							  
								  		$('#vehtype').val(formvals[33]);
									 }
									 if(formvals[34] != ''){							  
								  		$('#progtype').val(formvals[34]);
									 }				 
						 		}
			   }   
		   });
	  return true;
	  }
 }
  function milecalculation1 (){
	 var add1 = $("#address1").val();
	 var add2 = $("#address2").val();
	 if(add1 != '' && add2 != ''){ 
	 $.post("milecalculation.php", {address1: ""+add1, address2: ""+add2}, function(data){
		 var miles = data; 
		 $("#miles1").val(miles);
		 });
	 }
	}	
  function milecalculation2 (){
	 var add1 = $("#pck_add2").val();
	 var add2 = $("#address3").val();
	 if(add1 != '' && add2 != ''){ 
	 $.post("milecalculation.php", {address1: ""+add1, address2: ""+add2}, function(data){
		 var miles = data; 
		 $("#miles2").val(miles);
		 });
	 }
	}
</script>



{/literal}







</p>

<body onLoad="initialize();">

<table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">



        <tr>



          <td align="center" class="headingbg">{ if $msgs != ''} {$msgs} {/if}



		  { if $errors != ''} {$errors} {/if} </td>



        </tr>



        <tr>



          <td class="admintopheading">Add Trip</td>



        </tr>



        <tr>



          <td align="left" valign="top">



		  <table width="650" border="0" cellspacing="0" cellpadding="0" align="center">



  <tr>



    <td width="17" align="left" valign="top"><img src="../images/1.jpg" alt="d" width="17" height="17" /></td>



    <td align="left" valign="top" background="../images/2.jpg">&nbsp;</td>



    <td width="17" align="left" valign="top"><img src="../images/3.jpg" alt="d" width="17" height="17" /></td>



  </tr>



  <tr>



    <td align="left" valign="top" background="../images/4.jpg">&nbsp;</td>



    <td align="left" valign="top" width="100%"><form name="addgrid" id="addgrid" method="post" action="addgrid.php" enctype="multipart/form-data" >

    <table width="940" border="0">

  <tr>

    <td valign="top">

    <table cellpadding="0" cellspacing="0" border="0" width="450">

    	<tr>



                                 <td colspan="2" class="admintopheading">Trip Information</td>

                                 </tr>



                                 <tr>



                                 <td colspan="2">&nbsp;</td>

                                 </tr>



								  <tr>

								    <td height="25" align="right" class="labels">Trip Code:</td>

								    <td height="25"><input type="text" name="trip_code" id="trip_code" class="" />

							        <span style="color:#FF0000"> </span></td>

							      </tr>

								  <tr>



								    <td width="139" height="25" align="right" class="labels">Patient ID: </td>



								    <td width="305" height="25"><input type="text" name="cisid" id="cisid" class="required" maxlength="15" onBlur="return PerfromAutomation();"/></td>

							      </tr>

								  <tr>



								    <td width="139" height="25" align="right" class="labels">Patient Name: </td>



								    <td width="305" height="25"><input type="text" name="consumer" id="consumer"  class="Chars inputTxtField" maxlength="45"/></td>

							      </tr>



								  <tr>





								    <td height="25" align="right" class="labels">Facility: </td>



								    <td height="25"><select name="clinic" id="clinic">



                              <option value="">Select Facility</option>



                    {section name=d loop=$userdata2}	



                              <option value="{$userdata2[d].hospname}" >{$userdata2[d].hospname}</option> 



                    {/section}  



                            </select><!--<input type="text" name="clinic" id="clinic" class="required Chars  inputTxtField" maxlength="75" />--></td>

							      </tr>



								  <tr>



								    <td height="25" align="right" class="labels">Telephone:</td>



								    <td height="25"><input type="text" name="phone" id="phone" class="inputTxtField"/><span style="color: #FF0000"> </span>								      <span class="SmallnoteTxt">e.g (001-02-1234)</span></td>

							      </tr>



                                  	  <tr>



								    <td height="25" align="right" class="labels">Remarks:</td>



								    <td height="25"><textarea name="remarks" id="remarks" cols="35" class=""></textarea><span style="color:#FF0000"></span></td>

							      </tr> 



                                  <tr>



                                 <td colspan="2">&nbsp;</td>

                                 </tr>

    </table>

    </td>

    <td valign="top">

    <table cellpadding="0" cellspacing="0" border="0" width="450">

    								 <tr>

                                 <td colspan="2" class="admintopheading">One Way Details</td>

                                 </tr>

                                 <tr>

                                 <td colspan="2">&nbsp;</td>

                                 </tr>

                                 <tr>

								    <td height="25" align="right" class="labels">Driver Code:</td>



								    <td height="25"><select name="staff1" id="staff1" class="">



									  <option value="">--Select--</option>



									  {section name=r loop=$driverdata}



									  <option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $staff1}selected{/if}>{$driverdata[r].drv_code}--{$driverdata[r].fname} {$driverdata[r].lname}</option>



									  {/section}



									</select><span style="color:#FF0000"></span></td>

							      </tr>

                                 <!--<tr>

                                   <td height="25" align="right" class="labels"></td>

                                   <td height="25"><input type="checkbox" name="chk" value="1" id="chk" onClick="show();" />

                                     (Click Here to enter mobile number)<br>

                               

                                       <input type="text" name="mnum" id="mnum"  style="display:none"  /></td>

                                 </tr>-->

								  <tr>

								    <td height="25" align="right" class="labels">Pickup Address: </td>



								    <td height="25"><textarea name="address1" id="address1" cols="35" class="required"></textarea><span style="color:#FF0000"> * </span></td>

							      </tr>

                                 <tr>

							    <td height="25" align="right" class="labels">DropAddress:</td>



								    <td height="25"><textarea cols="35" name="address2" id="address2" class="required"></textarea><span style="color:#FF0000"> * </span></td>

							      </tr>

								    <tr>



								    <td height="25" align="right" class="labels">Miles:</td>



								    <td height="25"><input type="text" name="miles1" id="miles1" class="" maxlength="5"/>  <input type="button" id="cmb" value="Calculate" onClick="milecalculation1();" ><span style="color:#FF0000"></span></td>

							      </tr>

								  <tr>



								    <td height="25" align="right" class="labels">Pickup Time: </td>



								    <td height="25"><input onChange="dp(this.value);" type="text" name="pu1" id="pu1" class="required"/> <span style="color:#FF0000"> * </span></td>

							      </tr> 

								   <tr>



								    <td height="25" align="right" class="labels">Drop Time: </td>



								    <td height="25"><input type="text" name="dt1" id="dt1" class="required"/><span style="color:#FF0000"> * </span></td>

							      </tr>

					

    </table>

    

    </td>

  </tr>

  <tr>

    <td colspan="2"><table width="930" border="0" cellspacing="2" cellpadding="2">			  



						





                                   <tr>



                                  <td colspan="2" class="admintopheading"><input name="rndtrip" type="checkbox" id="rndtrip"  onchange="chck(this);"/>Round Trip Details</td>

                                  </tr>



                                  <tr>



                                 <td colspan="2">&nbsp;</td>

                                 </tr>



								  



                                  <tr>



								    <td width="397" height="25" align="right" class="labels">Driver Code:</td>



								    <td width="519" height="25"><select name="staff2" id="staff2" class="">



									  <option value="">--Select--</option>



									  {section name=r loop=$driverdata}



									  <option value="{$driverdata[r].drv_code}" {if $driverdata[r].drv_code eq $staff2}selected{/if}>{$driverdata[r].drv_code}--{$driverdata[r].fname} {$driverdata[r].lname}</option>



									  {/section}



									</select><span style="color:#FF0000"></span></td>

							      </tr>

                                  <!--<tr>

                                   <td height="25" align="right" class="labels"></td>

                                   <td height="25"><input type="checkbox" name="chk2" value="1" id="chk2" onClick="show2();" />

                                     (Click Here to enter mobile number)<br>

                               

                                       <input type="text" name="mnum2" id="mnum2"  style="display:none"  /></td>

                                 </tr>-->

                                  <tr>



                                    <td height="25" align="right" class="labels">Pickup Address:</td>



                                    <td height="25"><label>



                                      <textarea cols="35" name="pck_add2" id="pck_add2" class="required"></textarea>



                                    <span style="color:#FF0000"> * </span> </label></td>

                                  </tr>

   <tr>



								    <td height="25" align="right" class="labels">Drop Address:</td>



								    <td height="25"><label>



								      <textarea cols="35" name="address3" id="address3" class="required"></textarea><span style="color:#FF0000"> * </span>



								    </label></td>

							      </tr>



                                   <tr>



								    <td height="25" align="right" class="labels">Miles:</td>



								    <td height="25"><input type="text" name="miles2" id="miles2" class="" maxlength="5"/><input type="button" id="cmb2" value="Calculate" onClick="milecalculation2();" ><span style="color:#FF0000"></span></td>

							      </tr> 



								  <tr>



								    <td height="25" align="right" class="labels">Pick Time: </td>



								    <td height="25"><input type="text" name="pu2" id="pu2" class="required" onChange="dp2(this.value);"/>or <input type="checkbox" id="pck_wc" name="pck_wc" value="1" onChange="chkwc();" />



								    W/C<span style="color:#FF0000"> * </span></td>

							      </tr>



                               

								 

								

								  

								  

								   <tr>



								    <td height="25" align="right" class="labels">Drop Time: </td>



								    <td height="25"><input type="text" name="dt2" id="dt2" class="required"/> <!--or <input type="checkbox" id="drp_wc" name="drp_wc" value="1"  onchange="chkwc();" />-->



							<!--	    W/C-->



								    <span style="color:#FF0000"> * </span></td>

							      </tr>



								 <!-- <tr>

								    <td height="25" align="right" class="labels">&nbsp;</td>

								    <td height="25"><input type="checkbox" name="sms" id="sms" value="{$membdetail[q].tdid}" />

							        Send SMS on Driver Mobile Number.</td>

							      </tr>-->



								



								  



								  



								  



								  



								  <tr>



									<td height="25">&nbsp;</td>



									<td height="25">



									<input class="inputButton btn" type="submit" value="Add" name="addgrid" id="addgrid"/>



									<input class="inputButton btn" type="reset" value="Reset" name="reset" />									</td>

								  </tr>

			  </table></td>

    </tr>

</table>





								

								<input type="hidden" value="{$id}" name="id" id="id">



								</form></td>



    <td align="left" valign="top" background="../images/5.jpg">&nbsp;</td>



  </tr>



  <tr>



    <td align="left" valign="top"><img src="../images/6.jpg" alt="d" width="17" height="17" /></td>



    <td align="left" valign="top" background="../images/7.jpg">&nbsp;</td>



    <td align="left" valign="top"><img src="../images/8.jpg" alt="d" width="17" height="17" /></td>



  </tr>



</table>		  </td>



        </tr>



</table>



</body>