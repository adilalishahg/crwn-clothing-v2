

  var mile1;

			 var mile2;

			 var tot;

			 var data1;

			 var data2;

			 var ad1;

			 var ad2;

			 var add1;

			 var add2

	function miles_calculation(ad1,ad2,id){

		$.post("Classes/milescalculation.php", {add1: ""+ad1,add2: ""+ad2}, function(data){

		if(data.length > 0) { 		var miles = data; $('#'+id).val(miles); 	}});}			

         function milescalculation(){	$("#submit").removeAttr("disabled", "disabled");

			 var add1=$('#autocomplete').val(); //alert(add1);

			 var add2=$('#autocomplete2').val();

			 var add3=$('#autocomplete3').val(); //last address

			 var add4=$('#autocomplete4').val();

			 var add5=$('#autocomplete5').val();

			 var type=$('#triptype').val();

			 switch (type) {

  case 'One Way':

  				miles_calculation(add1,add2,'bus');

      break;

  case 'Round Trip':

  				miles_calculation(add1,add2,'bus');

				miles_calculation(add2,add3,'truck');

      break;

  case 'Three Way':

  				miles_calculation(add1,add2,'bus');

				miles_calculation(add2,add4,'truck');

				miles_calculation(add4,add3,'car');

      break;

  case 'Four Way':

  				miles_calculation(add1,add2,'bus');

				miles_calculation(add2,add4,'truck');

				miles_calculation(add4,add5,'car');

				miles_calculation(add5,add3,'train');

      break;

  		default:

      break;

		}}

			function summary(){

			$("#submit").removeAttr("disabled", "disabled");

			 var mile1=$('#bus').val(); 

			 var mile2=$('#truck').val();

			 var mile3=$('#car').val();

			 var mile4=$('#train').val();

			 var rate_type=$('#rate_type').val();

			 var triptype=$('#triptype').val();

			 var wait_time=$('#wait_time').val();

			 var a = wait_time.split(':'); 

			 var time_unit = Math.round(((+a[0]) * 60  + (+a[1])) / 15);

			 var permile_ch=$('#permile_ch').val();

			 var pickup_ch=$('#pickup_ch').val(); 

			 var waittime_ch=$('#waittime_ch').val(); 

			 var totmiles	=	mile1;

			 

			 switch (triptype) {

  case 'One Way':

  				totmiles = (+mile1);	tt=1;	

      break;

  case 'Round Trip':

  				totmiles = ((+mile1)+(+mile2));	tt=2;	

      break;

  case 'Three Way':

  				totmiles = ((+mile1)+(+mile2)+(+mile3));	tt=3;

      break;

  case 'Four Way':

  				totmiles = ((+mile1)+(+mile2)+(+mile3)+(+mile4));	tt=4;

      break;

  		default:

      break;

		}

			 $('#milage').val(totmiles);

			 if(rate_type=='standard'){

			 var total_charges=(((+totmiles) * (+permile_ch)) + ((+pickup_ch) * (+tt)) + ((+waittime_ch) * (+time_unit))); }else{

			 var flat_fee=$('#flat_fee').val();

			 var total_charges=((+flat_fee) + ((+waittime_ch) * (+time_unit)));

			 }

			 $('#charges').val(total_charges);

			 } 

 ///End of miles calculation

  var currentDate = new Date();

  var day = currentDate.getDate();

  var month = currentDate.getMonth() + 1;

  var year = currentDate.getFullYear();

  var dt = month+"/"+day+"/"+year;

$('.date').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,scrollInput: false}).val('');

$('.stenddate').datetimepicker({timepicker:false,format:'m/d/Y',minDate:'0',maxDate:'+1970/06/30',closeOnDateSelect: true,scrollInput: false,scrollInput: false});

$('.enddate').datetimepicker({timepicker:false,format:'m/d/Y',closeOnDateSelect: true,scrollInput: false});

$('#datetimepicker1').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,scrollInput: false});

$('#datetimepicker2').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,scrollInput: false});

$('.dob').datetimepicker({timepicker:false,format:'m/d/Y',closeOnDateSelect: true,yearStart:year-130,yearEnd:year,maxDate:'0',scrollInput: false});

$('.Date2').datetimepicker({timepicker:false,format:'m/d/Y',closeOnDateSelect: true,yearStart:year-1,yearEnd:year+1,maxDate:'+1970/03/01',scrollInput: false});

$('.apdateqqq').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,yearStart:year,minDate:'+1970/02/02',maxDate:'+1970/06/30',scrollInput: false});





$('.apdate2').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,yearStart:year,yearEnd:year+1,minDate:'0',maxDate:'+1970/06/30',scrollInput: false}).val('');



$('#datetimepicker_e').datetimepicker({timepicker:false,format:'m/d/Y',closeOnDateSelect: true});

$('#datetimepicker1_e').datetimepicker({timepicker:false,format:'m/d/Y',closeOnDateSelect: true});

$('#datetimepicker2_e').datetimepicker({timepicker:false,format:'m/d/Y',closeOnDateSelect: true});

$('#dob_e').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,yearStart:year-130,yearEnd:year,maxDate:'0'});
$('.date_search').datetimepicker({timepicker:false,format:'m/d/Y',value:dt,closeOnDateSelect: true,scrollInput: false});


$(function() {

$(".phone").mask('(000) 000-0000');

$(".date").mask('00/00/0000');

$(".stenddate").mask('00/00/0000');

$(".time").mask('00:00');

 });

 function sameaddress(){

if($('#sameadd').attr('checked')){	

var v=$('#autocomplete').val();

var z=$('#psuiteroom').val();

var x=$('#picklocation').val();

var y=$('#pickup_instruction').val();

    $('#autocomplete3').val(v);

	$('#bsuiteroom').val(z);

    $('#backtolocation').val(x);

	$('#backto_instruction').val(y);

 } 

	else { 

	$('#autocomplete3').val('');

	$('#bsuiteroom').val('');

    $('#backtolocation').val('');

	$('#backto_instruction').val('');

 }}

 function samephone(fromm,too,id){ 

	if(document.getElementById(id).checked) { var v=$('#'+fromm).val(); 	$('#'+too).val(v);  }else { $('#'+too).val('');}}

function pUchoice(val){ 

    if(val == 'Will Call'){ 

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

	  return true;

    }else{

	$('#returnpickup').attr("class","form-control required");	

	$('#rpTime').show();

	return true; 	

	}	 }

function chTrip(val){

	wait_legs();

   	if(val == 'One Way'){

	$('#bck').hide();

	//$('#puchoice').removeAttr("class");

	$('#returnpickup').removeAttr("form-control time");	

	//$('#rpu').removeAttr("class");			

	$('#rpu').hide();

	$('#rpTime').hide();	

	/*//$('#trBackTo').hide();	

		

	$('#trBackTo3').hide();	

	$('#trBackTo4').hide();	

	//$('#backto').hide();	

	//To hide

  	$('#b0').hide();

	$('#b1').hide();	

	$('#b2').hide();

	$('#b3').hide();

	$('#b4').hide();

	$('#b5').hide();

		

	$('#three0').hide();

	$('#three1').hide();

	$("#three2").hide();

	$('#three3').hide();

	$("#three4").hide();

	$('#three5').hide();

	$("#three6").hide();

	$("#three7").hide();

	

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	

	$('#four0').hide();

	$('#four1').hide();



	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();	

	//Remove required attributes

	$('#backto').removeClass('required');

	$('#backtocity').removeClass('required');

	$('#backtostate').removeClass('required');

	//$('#backtozip').removeClass('required');

	 	

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	//$('#five_zip').removeClass('required');

	

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	//$('#four_zip').removeClass('required');

	

	$('#three_pickup').removeClass('required');

	$('#am_pm3').removeClass('required');

	$('#three_address').removeClass('required');

	$('#three_city').removeClass('required');

	$('#three_state').removeClass('required');

	//$('#three_zip').removeClass('required');*/

    return true;

    }

    else  if(val == 'Round Trip'){

    var pu=$('#puchoice').val();

	if(pu=='Will Call'){

	$('#returnpickup').removeAttr("class"); //form-control time	

	$('#rpTime').hide();	

    $('#rpu').show();	

 	}else{

	    $('#rpu').show();	

		$('#rpTime').show();

		$('#returnpickup').addClass("form-control time");	

	}

	$('#bck').show();

	$('#second').hide();

	$('#third').hide();

	/*$('#b1').show();	

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	$('#b5').show();

	//To hide

	$('#three0').hide();

	$('#three1').hide();

	$("#three2").hide();

	$('#three3').hide();

	$("#three4").hide();

	$('#three5').hide();

	$("#three6").hide();

	$("#three7").hide();

	

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	

	$('#four0').hide();

	$('#four1').hide();

	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();	

	//Add required attributes to second destination 

	$('#backto').addClass('required');

	$('#backtocity').addClass('required');

	$('#backtostate').addClass('required');

	//$('#backtozip').addClass('required');

	//Remove required attributes 	

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	//$('#five_zip').removeClass('required');

	

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	//$('#four_zip').removeClass('required');

	

	$('#three_pickup').removeClass('required');

	$('#am_pm3').removeClass('required');

	$('#three_address').removeClass('required');

	$('#three_city').removeClass('required');

	$('#three_state').removeClass('required');

	//$('#three_zip').removeClass('required');

				  */

	 return true;

    }

	else if(val == 'Three Way'){

	//To show feilds

	$('#bck').show();

	$('#second').show();

	$('#third').hide();

	 var pu=$('#puchoice').val();

	if(pu=='Will Call'){

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

    $('#rpu').show();	

 	}else{

	    $('#rpu').show();	

		$('#rpTime').show();

		$('#returnpickup').addClass("form-control time");	

	}

	/*$('#three1').show();

	$("#three2").show();

	$('#three3').show();

	$("#three4").show();

	$('#three5').show();

	$("#three6").show();

	$("#three7").show();

	

	$('#rpu').show();

	$('#b0').show();

	$('#b1').show();

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	$('#b5').show();

	

	//Add required attributes 

	//$('#backto').addClass('required');

	//$('#backtocity').addClass('required');

	//$('#backtostate').addClass('required');

	//$('#backtozip').addClass('required');

	

	$('#three_pickup').addClass('required');

	//$('#am_pm3').addClass('required');

	//$('#three_address').addClass('required');

	//$('#three_city').addClass('required');

	//$('#three_state').addClass('required');

	//$('#three_zip').addClass('required');

	//hide four and five attributes

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	

	$('#four0').hide();

	$('#four1').hide();

	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();

	//remove required of four and five

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	//$('#five_zip').removeClass('required');

	

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	//$('#four_zip').removeClass('required');*/

	

	return true;

    } 

	else if(val == 'Four Way'){

	//To show feilds

	$('#bck').show();

	$('#second').show();

	$('#third').show();

	 var pu=$('#puchoice').val();

	if(pu=='Will Call'){

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

    $('#rpu').show();	

 	}else{

	    $('#rpu').show();	

		$('#rpTime').show();

		$('#returnpickup').addClass("form-control time");	

	}

	/*$('#three1').show();

	$("#three2").show();

	$('#three3').show();

	$("#three4").show();

	$('#three5').show();

	$("#three6").show();

	$("#three7").show();

	

	$('#rpu').show();

	$('#b0').show();

	$('#b1').show();

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

	$('#b5').show();

	

	//Add required attributes 

	//$('#backto').addClass('required');

	//$('#backtocity').addClass('required');

	//$('#backtostate').addClass('required');

	//$('#backtozip').addClass('required');

	

	$('#three_pickup').addClass('required');

	//$('#am_pm3').addClass('required');

	//$('#three_address').addClass('required');

	//$('#three_city').addClass('required');

	//$('#three_state').addClass('required');

	//$('#three_zip').addClass('required');

	//hide four and five attributes

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide();

	$("#five7").hide();

	

	$('#four0').hide();

	$('#four1').hide();

	$("#four2").hide();

	$('#four3').hide();

	$("#four4").hide();

	$('#four5').hide();

	$("#four6").hide();

	$("#four7").hide();

	//remove required of four and five

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	//$('#five_zip').removeClass('required');

	

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required');

	$('#four_address').removeClass('required');

	$('#four_city').removeClass('required');

	$('#four_state').removeClass('required');

	//$('#four_zip').removeClass('required');*/

	

	return true;

    }

	else if(val == 'Five Way'){

//To show feilds		

	$('#five0').show();

	$('#five1').show();

	$("#five2").show();

	$('#five3').show();

	$("#five4").show();

	$('#five5').show();

	$("#five6").show();

	$("#five7").show();

	

	$('#four0').show();

	$('#four1').show();

	$("#four2").show();

	$('#four3').show();

	$("#four4").show();

	$('#four5').show();

	$("#four6").show();

	$("#four7").show();

	

	$('#three0').show();

	$('#three1').show();

	$("#three2").show();

	$('#three3').show();

	$("#three4").show();

	$('#three5').show();

	$("#three6").show();

	$("#three7").show();

	

	$('#rpu').show();

	$('#b0').show();

	$('#b1').show();

	$('#b2').show();

	$('#b3').show();

	$('#b4').show();

		$('#b5').show();

	//Add required attributes 	

	$('#backto').addClass('required');

	$('#backtocity').addClass('required');

	$('#backtostate').addClass('required');

	//$('#backtozip').addClass('required');

	

	$('#five_pickup').addClass('required');

	$('#am_pm5').addClass('required');

	$('#five_address').addClass('required');

	$('#five_city').addClass('required');

	$('#five_state').addClass('required');

	//$('#five_zip').addClass('required');

	

	$('#four_pickup').addClass('required');

	$('#am_pm4').addClass('required');

	$('#four_address').addClass('required');

	$('#four_city').addClass('required');

	$('#four_state').addClass('required');

	//$('#four_zip').addClass('required');

	

	$('#three_pickup').addClass('required');

	$('#am_pm3').addClass('required');

	$('#three_address').addClass('required');

	$('#three_city').addClass('required');

	$('#three_state').addClass('required');

	//$('#three_zip').addClass('required');

    return true;

    }

	else{

	return true; 	

	}	}

function samepickaddress(){

if(document.getElementById('sameadd').checked){	

var a=$('#picklocation').val();

var b=$('#autocomplete').val();

var c=$('#psuiteroom').val();

var d=$('#pickup_instruction').val(); //alert(b);

    $('#backtolocation').val(a);

	$('#autocomplete3').val(b);

    $('#bsuiteroom').val(c);

	$('#backto_instruction').val(d);

 } 

	else { 

	$('#backtolocation').val('');

	$('#autocomplete3').val('');

    $('#bsuiteroom').val('');

	$('#backto_instruction').val('');

 }}		

function PerfromAutomation(){

		var pname =  $('#pname').val();

		if(pname != ''){ 

			$.post("fetchdata_patient2.php", {pname: ""+pname}, function(data){ 

				if(data.length > 0) {

            	var fetchedData = data;

			  		formvals = new Array();	 

				    formvals = fetchedData.split('^'); 

				  	if(formvals.length > 0){		//alert(formvals[2]);

								if(formvals[0] != '')

								  $('#pname').val(formvals[0]);

								if(formvals[58] != '') {  $('#region').val(formvals[58]);  }

							  	if(formvals[1] != '')  $('#phnum').val(formvals[1]);

								if(formvals[2] != '')  $('#cisid').val(formvals[2]);

						  		if(formvals[3] != '')  $('#dob').val(formvals[3]);

							  	if(formvals[4] != '')  $('#po').val(formvals[4]);

							  	if(formvals[5] != '')  $('#patient_weight').val(formvals[5]);

								

								if(formvals[6] != '')  $('#p_phnum').val(formvals[6]);

								if(formvals[7] != '')  $('#d_phnum').val(formvals[7]); 

								if(formvals[8] != '')  $('#destination_instruction').val(formvals[8]); 

								if(formvals[9] != '')  $('#backto_instruction').val(formvals[9]);  

					

							   	if(formvals[15] != '')  $('#autocomplete').val(formvals[15]); 	 						  

						  		if(formvals[19] != '')	$('#autocomplete2').val(formvals[19]); 						  

						  		if(formvals[23] != '')	$('#autocomplete3').val(formvals[23]);						  

						  	    if(formvals[51] != '')  $('#picklocation').val(formvals[51]);

								if(formvals[52] != '')  $('#droplocation').val(formvals[52]);

								if(formvals[53] != '')  $('#backtolocation').val(formvals[53]);

								

								

								if(formvals[55] != '')  $('#psuiteroom').val(formvals[55]);

								if(formvals[56] != '')  $('#dsuiteroom').val(formvals[56]);

								if(formvals[57] != '')  $('#bsuiteroom').val(formvals[57]);

								

								if(formvals[43] != '')  $('#pickup_instruction').val(formvals[43]);								  



			

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

										// $('#rpTime').show();

										  }

									 }	

									 if(formvals[30] != ''){  $('#casemanager1').val(formvals[30]);	 }

									  if(formvals[31] != ''){ $('#comments').val(formvals[31]); 	 }	

									 if(formvals[32] != ''){  $('#insurance_name').val(formvals[32]); }

									 if(formvals[33] != ''){  $('#ssn').val(formvals[33]);  }

									 if(formvals[34] != ''){  $('#type').val(formvals[34]); }

									 

									 

									 if(formvals[35] != ''){  $('#triptype').val(formvals[35]); }

									 if(formvals[36] != ''){  $('#vehtype').val(formvals[36]); }

									 if(formvals[38] != ''){  $('#apptime').val(formvals[38]); 

									 

									 t=formvals[38];

										if(t){ 

												var res = t.split(":"); 

												var hours=((Number(res[0])+1));

												var ziro="0";

												if(hours<10){hours = ziro+hours; } 

												var minutes=res[1]; 

												$('#org_apptime').val(hours+':'+minutes); 

									 	 				  } }

									 if(formvals[39] != ''){

									 	if(formvals[39] ='Male'){$('#sex1').attr("checked", true); }

										else{$('#sex2').attr("checked", true);}

														   }

									if(formvals[41] != ''){  $('#cisid').val(formvals[41]); }

									if(formvals[43] != ''){  $('#pickup_instruction').val(formvals[43]); }

									if(formvals[44] != ''){  if(formvals[44] == 'Yes') $("#stretcher").attr("checked", true); }

									if(formvals[45] != ''){  if(formvals[45] == 'Yes') $('#dstretcher').attr("checked", true); }

									if(formvals[46] != ''){  if(formvals[46] == 'Yes')  $('#bar_stretcher').attr("checked", true); }

									if(formvals[47] != ''){  if(formvals[47] == 'Yes')  $('#escort').attr("checked", true); }

									if(formvals[48] != ''){  if(formvals[48] == 'Yes')  $('#wchair').attr("checked", true); }

									if(formvals[49] != ''){  if(formvals[49] == 'Yes')  $('#dwchair').attr("checked", true); }

									if(formvals[50] != ''){  if(formvals[50] == 'Yes')  $('#oxygen').attr("checked", true); }						   	

														   chTrip(formvals[35]);				 

						 		}

			   }   

		   });

	  return true;

	  }

 } 

function check_cecc(){	if(document.getElementById('check_recc').checked){	 $('#recc').show(); }else { $('#recc').hide(); }	}

function checkrecday(feildid){

	//alert(feildid);

	//if($('#'+feildid).attr('checked')){

	if(document.getElementById(feildid).checked){	

		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).removeAttr('disabled');

		var apptime = $('#apptime').val();  			$('#apt'+feildid).val(apptime); 

		var returnpickup = $('#returnpickup').val(); 	$('#ret'+feildid).val(returnpickup); 

		}

	else {

		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).attr('disabled','disabled');

		$('#org_apt'+feildid+', #apt'+feildid+', #ret'+feildid+', #td'+feildid).val('');

		}

	}

function popWind(url){

   myWindow = window.open( url, "myWindow", "status = 1, height = 850, width = 1060, scrollbars=1, resizable = 1" );

   myWindow.moveTo(0,0);

} 	



	 

	 