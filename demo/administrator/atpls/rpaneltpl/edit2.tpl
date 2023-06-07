{ include file = headerinner.tpl}

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBBE53xDKH93kCWSWREyehlzH8N_t2R2lw"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggest.js"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggest2.js"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggestpick.js"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggestdrop.js"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggestdrop3.js"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggestdrop4.js"></script>

<script language="JavaScript" type="text/javascript" src="../mercy/suggestdrop5.js"></script>

{literal}

<script type="text/javascript">

$(document).ready(function (){

$('#addtrip').validate();

$("#dobnew").mask("9999-99-99");

$("#d_phnum").mask("(999) 999-9999");

$("#p_phnum").mask("(999) 999-9999");

$("#dobnew").datepicker({ yearRange: "-131:00" });

});

$(document).ready(function (){

//$('#ssn').mask('999-99-9999');		

$('#hidme').hide();

var v=$('#puchoice').val();

if(v =='Time'){ 

//$('#rpTime').show();	

}});

$(document).ready(function(){

	$("#picktime").mask("19:59");

	$("#three_pickup").mask('19:59');

	$("#four_pickup").mask('19:59');

	$("#five_pickup").mask('19:59');

 });

function tValid(val,idv){

var i = val.substr(0,1);

var j = val.substr(1,1);

if(i == '2'){

if(j > 3){ $('#'+idv).val(''); return false; }else{ return true; }

}}

function check_check3(){

	if($('#three_will_call').attr('checked')){

	$('#three_pickup').attr("disabled",true);

	$('#am_pm3').attr("disabled",true);

	$('#three_pickup').removeClass('required');

	$('#am_pm3').removeClass('required'); 

	$('#three_pickup').val('');   }

	else {

	$('#three_pickup').attr("disabled",false);

	$('#am_pm3').attr('disabled',false);

	$('#three_pickup').addClass('required');

	$('#am_pm3').addClass('required'); }

	 }	

function check_check4(){

	if($('#four_will_call').attr('checked')){ 

	$('#four_pickup').attr('disabled',true);

	$('#am_pm4').attr('disabled',true);

	$('#four_pickup').removeClass('required');

	$('#am_pm4').removeClass('required'); 

	$('#four_pickup').val('');    }

	else {

	$('#four_pickup').attr('disabled',false);

	$('#am_pm4').attr('disabled',false);

	$('#four_pickup').addClass('required');

	$('#am_pm4').addClass('required'); }

	 }		

function check_check5(){

	if($('#five_will_call').attr('checked')){ 

	$('#five_pickup').attr('disabled',true);

	$('#am_pm5').attr('disabled',true);

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required'); 

	$('#five_pickup').val('');   }

	else {

	$('#five_pickup').attr('disabled',false);

	$('#am_pm5').attr('disabled',false);

	$('#five_pickup').addClass('required');

	$('#am_pm5').addClass('required'); }

	 }



function chTrip(val){

//$('#waitopt').attr('checked', false);

   	if(val == 'One Way'){

	$('#umb,#umc,#umd').hide();

	

	$('#hideno').hide();

	$("#showno").hide();

	//$('#returnpickup').attr("disabled",true);

	$('#puchoice').removeAttr("class");

	//$('#backto').removeAttr("class");	

	$('#returnpickup').removeAttr("class");	

	$('#rpu').removeAttr("class");			

	$('#rpu').hide();	

	//$('#trBackTo').hide();	

	$('#rpTime').hide();	

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

	$('#legidB,#legidC,#legidD').hide();



    return true;

    }

    else  if(val == 'Round Trip'){

		$('#umc,#umd').hide();

		$('#umb').show();

    var pu=$('#puchoice').val();

	if(pu=='Will Call'){

	$('#returnpickup').removeAttr("class");	

	$('#rpTime').hide();	

    $('#rpu').show();	

 	}else{

	    $('#rpu').show();	

		$('#rpTime').show();	

	}

	$('#b0').show();

	$('#b1').show();	

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

	$('#legidC,#legidD').hide();

	$('#legidB').show();			  

	 return true;

    }

	else if(val == 'Three Way'){

	$('#umd').hide();

	$('#umb,#umc').show();

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

	$('#legidD').hide();

	$('#legidB,#legidC').show();

	

	return true;

    } 

	else if(val == 'Four Way'){

$('#umb,#umc,#umd').show();

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

	//$('#backtocity').addClass('required');

	//$('#backtostate').addClass('required');

	//$('#backtozip').addClass('required');

	

	//$('#four_pickup').addClass('required');

	//$('#am_pm4').addClass('required');

	//$('#four_address').addClass('required');

	//$('#four_city').addClass('required');

	//$('#four_state').addClass('required');

	//$('#four_zip').addClass('required');

	

	//$('#three_pickup').addClass('required');

	//$('#am_pm3').addClass('required');

	//$('#three_address').addClass('required');

	//$('#three_city').addClass('required');

	//$('#three_state').addClass('required');

	//$('#three_zip').addClass('required');

	//hide four attributes

	$('#five0').hide();

	$('#five1').hide();

	$("#five2").hide();

	$('#five3').hide();

	$("#five4").hide();

	$('#five5').hide();

	$("#five6").hide()

	$("#five7").hide();

	//remove required of five

	$('#five_pickup').removeClass('required');

	$('#am_pm5').removeClass('required');

	$('#five_address').removeClass('required');

	$('#five_city').removeClass('required');

	$('#five_state').removeClass('required');

	//$('#legidB,#legidC,#legidD').hide();

	$('#legidB,#legidC,#legidD').show();

	

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

function test(){

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

 }}function pUchoice(val){

if(val == ''){    

return false;

}

if(val == 'Will Call'){ 

$('#returnpickup').removeAttr("class");	

$('#rpTime').hide();	

return true;

}else{

$('#returnpickup').attr("class","txt_box required");	

$('#rpTime').show();

return true; 	

}	}

function chProg(val){

if(val == '0'){

$('#labelid').html('CIS ID');	

$('#cisidsp').show();			     

$('#ssnsp').hide();

$('#ssn').attr("class","txt_box");

$('#cisid').attr("class","txt_box required");	 		 

return true;

}

if(val == '1'){

$('#labelid').html('A.H.C.C.C.S');	

$('#ssnsp').show();	

$('#cisidsp').hide();	 

$('#cisid').attr("class","txt_box");

$('#ssn').attr("class","txt_box required");		  		

return true;

}else{

$('#labelid').html('CIS ID');	

$('#cisidsp').show();			     

$('#ssnsp').hide();

$('#ssn').attr("class","txt_box");

$('#cisid').attr("class","txt_box required");

return true;	 		

}	}

function changelabel(id){

$.post("fetchlabel.php", {id: ""+id}, function(data){

data = data.replace(/(\r\n|\n|\r)/gm,"");

if(data != ''){

$("#changeit").html(data+':');

$('#hidme').show();

}else{

$('#hidme').hide();

}

});

return true;}



/*function initialize() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete')),

      { types: ['geocode'] });

}

function initialize2() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete2')),

      { types: ['geocode'] });

}

function initialize3() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete3')),

      { types: ['geocode'] });

}*/

function googleapihandler(id,data){
	
		/*  $('#'+id).blur(function(){
					   $('#div_'+id).remove();
		 });*/
		  var str1 = document.getElementById(id);
		  var curLeft=0;
		  if (str1.offsetParent){
			  while (str1.offsetParent){
		   curLeft += str1.offsetLeft;
		   str1 = str1.offsetParent;
			  }
		  }
		  var str2 = document.getElementById(id);
		  var curTop=20;
		  if (str2.offsetParent){
			  while (str2.offsetParent){
		   curTop += str2.offsetTop;
		   str2 = str2.offsetParent;
			  }
		  }
		  $('#div_'+id).remove();
		  $('#'+id).parent().append('<div id="div_'+id+'"></div>');
		  var ss = document.getElementById('div_'+id);
		  var str =data
		  if(str.length < 1)
			  document.getElementById('div_'+id).style.visibility = "hidden";
		  else
			  ss.setAttribute('style','position:absolute;top:'+curTop+';left:'+curLeft+';width:250;z-index:1;padding:5px;border: 0px solid #000000; overflow:auto; height:105; background-color:#F5F5FF; z-index:9999;');
		  ss.innerHTML = '';
  
		 // console.log(data);
		$('body').click(function() {
       $('#div_'+id).remove();
});
		  $.each(data,function(index,item){
			  
			   var suggest = '<div  ';
            suggest += ' ';
            suggest += 'onclick="javascript:$(\'#'+id+'\').val(\''+item+'\');$(\'#div_'+id+'\').remove();" ';
            suggest += 'class="small">' + item + '</div>';
            ss.innerHTML += suggest;
			  
			  });
		   $.post("../google_api_log.php", {type: ""+'Address Populate'});
		  
		  
}
function initialize() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete')),
      { types: ['geocode'] });*/
	  
	  $('#autocomplete').keyup(function(e){
		  switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
				
		  var myval = $('#autocomplete').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete',data);
			  
			  });	 
		 
		 }
		 	break;
		  }
	  
	  });
	 
     // 
}
function initialize2() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete2')),
      { types: ['geocode'] });
        $('#autocomplete2').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
		
		 $('#autocomplete2').keyup(function(e){
			 switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete2').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete2',data);
			  
			  });	 
		 
		 }
		 
		 break;
		}
	  
	  });
	  	
}
function initialize3() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete3')),
      { types: ['geocode'] });
        $('#autocomplete3').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
		
		$('#autocomplete3').keyup(function(e){
			switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete3').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete3',data);
			  
			  });	 
		 
		 }
		 	break;
			}
	  
	  });
}
function initialize4() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('ins_billing_address')),
      { types: ['geocode'] });
        $('#ins_billing_address').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});
*/
$('#ins_billing_address').keyup(function(e){
	switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:	
		  var myval = $('#ins_billing_address').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('ins_billing_address',data);
			  
			  });	 
		 
		 }
		 break;
	}
	  
	  });
}
function initialize5() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('pp_billing_address')),
      { types: ['geocode'] });
       $('#pp_billing_address').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
	   
	$('#pp_billing_address').keyup(function(e){
		switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#pp_billing_address').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('pp_billing_address',data);
			  
			  });	 
		 
		 }
		 break;
		}
	  
	  });   
}
function initialize6() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete4')),
      { types: ['geocode'] }); //alert(types);
      $('#autocomplete4').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});*/
	
	$('#autocomplete4').keyup(function(e){
		switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete4').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete4',data);
			  
			  });	 
		 
		 }
		 	break;
		}
	  
	  });     
	  
}
function initialize7() {
 /* autocomplete = new google.maps.places.Autocomplete(
(document.getElementById('autocomplete5')),
      { types: ['geocode'] });


 $('#autocomplete5').keydown(function(){ $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });});
     // $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });*/
	 
	 $('#autocomplete5').keyup(function(e){
		 switch(e.keyCode) {

			case 38: // up
			case 37: // left
			case 39: // right
			case 40: // down	
			case 9:  // tab
			case 13: // return	
			case 17: // return	
			case 18: // return	
			case 27: // return	
			case 20: // return
			case 16: // return				
				break;
			default:
		  var myval = $('#autocomplete5').val(); 
		 if(myval.length > 5){ 
		  $.getJSON('../googleapi.php?input='+myval,function(data){
			  googleapihandler('autocomplete5',data);
			  
			  });	 
		 
		 }
		 	break;
		 }
	  
	  });     
}

/*
function initialize() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete')),

      { types: ['geocode'] });

      $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });

}

function initialize2() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete2')),

      { types: ['geocode'] });

      $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });

}

function initialize3() {

  autocomplete = new google.maps.places.Autocomplete(

(document.getElementById('autocomplete3')),

      { types: ['geocode'] });

      $.post("../google_api_log.php", {type: ""+'Address Populate'}, function(data2){ });

}
*/
function addressla(id){

		if(id != ''){ 

		if(id=='1') { var loc = $('#picklocation').val(); }

		if(id=='2') { var loc = $('#droplocation').val(); }

		if(id=='3') { var loc = $('#droplocation2').val(); }

		if(id=='4') { var loc = $('#droplocation3').val(); }

		if(id=='5') { var loc = $('#backtolocation').val(); }

			$.post("../mercy/addressla.php", {id: ""+id,loc: ""+loc}, function(data){

				if(data.length > 0) { 

				if(id=='1') {  $('#autocomplete').val(data); }

				if(id=='2') {  $('#autocomplete2').val(data); }

				if(id=='3') {  $('#autocomplete4').val(data); }

				if(id=='4') {  $('#autocomplete5').val(data); }

				if(id=='5') {  $('#autocomplete3').val(data); }

			   }   

		   });

	  return true;

	  }

 }	 //addressla

</script>

<style>

.form_heading_1 {

	background:#333;

	color:#fff;

	height:20px;

	font-size:11px;

	font-weight:bold;

	padding-left:8px;

	width:auto;

	padding-top:5px;

}

.grid_content {

	color:#333333;

	padding:2px;

}

.grid_icon {

	color:#333333;

	padding:2px;

}

.txt_boxX {

	width:130px;

	border:#999 1px solid;

	height:15px;

	background:#f4f4f4;

	font-size:10px;

}

.accesslable {

	font-size:10px;

}

.labelX {

	color:#202020;

	font-size:10px;

	font-weight:bold;

	width:155px;

}

.appt_txtbox {

	width:95px;

	height:20px;

	border: #999 1px solid;

}

.btn_2 {

	font-size:12px;

	background-color:#3C3F43;

	text-align:center;

	border:none;

	width:150px;

	height:32px;

	font-weight:bold;

	color:#FFF;

	padding:5px 0 5px 0;

	cursor:pointer;

}

.error {

	font-family:Verdana, Geneva, sans-serif;

	color:#F00;

	font-size:10px;

}

</style>

<body onLoad="initialize(); initialize2(); initialize3();">

{/literal}

{if $error neq ''}

<table width="50%"  align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="14" valign="bottom"><img src="images/error_01.gif" width=14 height=14 ALT=""></td>

    <td colspan=2 style="background-image:url(images/error_02.gif); background-repeat:repeat-x; height:13px; background-position:bottom;">&nbsp;</td>

    <td width="13" valign="bottom"><img src="images/error_03.gif" width=13 height=14 ALT=""></td>

  </tr>

  <tr>

    <td style="background-image:url(images/error_04.gif); background-repeat:repeat-y;">&nbsp;</td>

    <td width="60" bgcolor="#FFFFFF" valign="top"><img src="images/error_05.gif" width=60 height=57 ALT=""></td>

    <td  valign="top" bgcolor="#FFFFFF"><b>{$error}</b></td>

    <td style="background-image:url(images/error_07.gif); background-repeat:repeat-y;">&nbsp;</td>

  </tr>

  <tr>

    <td valign="top"><img src="images/error_08.gif" width=14 height=14 ALT=""></td>

    <td colspan=2 style="background-image:url(images/error_09.gif); background-repeat:repeat-x;height:14px;">&nbsp;</td>

    <td valign="top"><img src="images/error_10.gif" width=13 height=14 ALT=""></td>

  </tr>

</table>

{/if}

{if $msg neq ''}

<table width="50%" align="center" cellpadding="0" cellspacing="0">

  <tr>

    <td width="14" valign="bottom"><img src="images/error_01.gif" width=14 height=14 ALT=""></td>

    <td colspan=2 style="background-image:url(images/error_02.gif); background-repeat:repeat-x; height:13px; background-position:bottom;">&nbsp;</td>

    <td width="13" valign="bottom"><img src="images/error_03.gif" width=13 height=14 ALT=""></td>

  </tr>

  <tr>

    <td style="background-image:url(images/error_04.gif); background-repeat:repeat-y;">&nbsp;</td>

    <td width="60" bgcolor="#FFFFFF" valign="top"><img src="images/okgreen.gif" width=60 height=57 ALT=""></td>

    <td valign="top" bgcolor="#FFFFFF"><b>{$msg}</b></td>

    <td style="background-image:url(images/error_07.gif); background-repeat:repeat-y;">&nbsp;</td>

  </tr>

  <tr>

    <td valign="top"><img src="images/error_08.gif" width=14 height=14 ALT=""></td>

    <td colspan=2 style="background-image:url(images/error_09.gif); background-repeat:repeat-x;height:14px;">&nbsp;</td>

    <td valign="top"><img src="images/error_10.gif" width=13 height=14 ALT=""></td>

  </tr>

</table>

{/if}

<form action="edit2.php" method="post" id="addtrip" >

  <table class="outer_table" border="0" cellspacing="2" cellpadding="2" align="center">

    <tr>

      <td colspan="3" valign="top" class="mainHeadingTxt"><strong>

        <div class="admintopheading">Trip Information</div>

        </strong></td>

    </tr>

    <!---->

    <tr style="display:none---;">

      <td valign="top" class="labelX"><strong>Select Trip type:</strong></td>

      <td valign="top"><select name="triptype"  class="txt_box required" id="triptype" onChange="return chTrip(this.value);" >

          <option value="One Way" 	{if $triptype eq 'One Way'}selected{/if}>One Way--(1 Destination)</option>

          <option value="Round Trip" 	{if $triptype eq 'Round Trip'}selected{/if}>Two Way--(Round Trip)</option>

          <option value="Three Way" {if $triptype eq 'Three Way'}selected{/if}>Three Way--(3 Destinations)</option>

          <option value="Four Way" 	{if $triptype eq 'Four Way'}selected{/if}>Four Way--(4 Destinations)</option>

        </select>

        <input type="hidden" name="pre_triptype" value="{$triptype}" /></td>

      <td valign="top">&nbsp;</td>

    </tr>

    <tr>

      <td valign="top" class="labelX"><strong>Account :</strong></td>

      <td valign="top"><select name="account" class="required">

          <option value="">Select Account</option>

          {section name=q loop=$accounts}

                  

          <option value="{$accounts[q].id}" {if $accounts[q].id eq $tripdata.0.account} selected {/if}>{$accounts[q].account_name}</option>

          {/section}

        </select>

        <span style="SmallnoteTxt"> * </span></td>

      <td valign="top">&nbsp;</td>

    </tr>

    <tr>

      <td valign="top" class="labelX" ><strong>Vehicle Preferences  :</strong></td>

      <td colspan="2" valign="top"><select name="vehtype" class="txt_box" id="vehtype" tabindex="2" >

          <option value="">Select</option>

          

{section name=q loop=$vehiclepref}	



          <option value="{$vehiclepref[q].id}" {if $vehtype eq $vehiclepref[q].id}selected{/if}>{$vehiclepref[q].vehtype}</option>

          

{/section}



        </select></td>

    </tr>

    <tr>

      <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Oxygen Required ?</span></strong></td>

      <td colspan="2" align="left"><select name="oxygen"  class="txt_box required" id="oxygen" >

          <option value="No" {if $tripdata.0.oxygen eq 'No'}selected{/if}> No </option>

          <option value="Yes" {if $tripdata.0.oxygen eq 'Yes'}selected{/if}> Yes </option>

        </select>

        &nbsp;<span class="SmallnoteTxt">*</span></td>

    </tr>

    <tr>

      <td width="30%" align="left" valign="top" class="labels"><strong><span class="label">Do you want to generate text alert?</span></strong></td>

      <td colspan="2" align="left"><select name="cellalertoption" class="txt_box required" id="cellalertoption" onChange="textalerty(this.value)" >

          <option value="No" {if $data.0.cellalertoption eq 'No'}selected{/if}> No </option>

          <option value="Yes" {if $data.0.cellalertoption eq 'Yes'}selected{/if}> Yes </option>

        </select>

        &nbsp;<span class="SmallnoteTxt">*</span></td>

    </tr>

    <!--<tr id="cellalert2" style="display:none;">

                  <td class="labels">Trigger Alert for :</td>

                  <td colspan="2"><select name="trigerfor" class="txt_box required" id="trigerfor" >

                  <option value="drop" {if $data.0.trigerfor eq 'drop'}selected{/if}> Drop off </option>

                  <option value="pick" {if $data.0.trigerfor eq 'pick'}selected{/if}> Pick Up </option>

                  </select></td>

                 </tr>-->

    <tr id="cellalert" style="display:none;">

      <td class="labels">Cell #:</td>

      <td colspan="2"><input type="text" name="cellalert"  value="{$data.0.cellalert}" class="txt_box " maxlength="12"  />

        <span style="color:#F00"> e.g. 1112223456 (Only cell number | Alert for 1st destination)</span></td>

    </tr>

    <tr>

      <td colspan="3" valign="top" ><strong>

        <div class="admintopheading">Patient Information</div>

        </strong></td>

    </tr>

    <tr>

      <td valign="top"  class="labelX" ><strong>Patient Name:</strong></td>

      <td valign="top"><input type="text" name="pname" id="pname" value="{$pname}" class="txt_box required" tabindex="4" />

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td valign="top">&nbsp;</td>

    </tr>

    <tr>

      <td valign="top"   class="labelX" ><strong>Patient Phone #:</strong></td>

      <td colspan="2" valign="top"><input type="text" name="phnum" id="phnum" value="{$tripdata.0.phnum}" class="txt_box " maxlength="14" /></td>

      <td></td>

    </tr>

    <tr>

      <td valign="top"   class="labelX" ><strong>Date of Birth:</strong></td>

      <td colspan="2" valign="top"><input type="text" name="dob" id="dobnew" {if $dob eq '0000-00-00'} value="" {else} value="{$dob}" {/if} class="txt_box" tabindex="6" maxlength="15" />

        <span class="SmallnoteTxt"> e.g. yyyy-mm-dd</span></td>

      <td></td>

    </tr>

    <tr>

      <td valign="top" class="labelX" ><strong>P.O #:</strong></td>

      <td colspan="2"><input type="text" name="po" id="po" value="{$tripdata.0.po}"/>

        &nbsp;<span class="SmallnoteTxt"></span></td>

      <td></td>

    </tr>

     <tr>

                  <td valign="top" class="labelX" ><strong>Claim #: </strong></td>

                  <td colspan="2" align="left"><input type="text" name="claim_no" id="claim_no" value="{$tripdata.0.claim_no}" class="txt_box" maxlength="14" />

                    &nbsp;</td>

                </tr>



    <tr>

      <td valign="top" class="labelX" ><strong>Patient Weight:</strong></td>

      <td colspan="2"><input type="text" name="patient_weight" id="patient_weight" value="{$tripdata.0.patient_weight}"  />

        &nbsp;<span class="SmallnoteTxt">(Lbs)</span></td>

      <td></td>

    </tr>

    <!--<tr>

<td valign="top" class="labelX" ><strong>Insurance Type:</strong></td>

<td colspan="2">

<input type="text" name="insurance_name" id="insurance_name" value="{$tripdata.0.insurance_name}"  readonly="true"/>  &nbsp;<span class="SmallnoteTxt"></span>                                                </td>

<td></td></tr>--> 

    

    <!--<tr>

<td valign="top" class="labelX" ><strong>Insurance ID:</strong></td>

<td colspan="2"> <input type="text" name="cisid" id="cisid" value="{$cisid}" /> </td>

<td></td>

</tr>

<tr id="hidme">

<td  class="label" id="changeit"></td>	

<td colspan="2">

<input tabindex="21" type="text" name="cisid" id="cisid" value="{$cisid}" class="txt_box required" />&nbsp;<span class="SmallnoteTxt">*</span>  

</td>

<input type="hidden" id="progtype" name="progtype" value="{$progtype}">

</tr>

<tr>

<td valign="top"   class="labelX" ><strong>S.S.N #:</strong></td>

<td colspan="2" valign="top"><input type="text" name="ssn" id="ssn" value="{$tripdata.0.ssn}" class="txt_box " maxlength="14" /></td>

<td></td>

</tr>-->

    <tr>

    <tr>

      <td colspan="3" valign="top" class="mainHeadingTxt"><strong>

        <div class="admintopheading">Appointment Information</div>

        </strong></td>

    </tr>

    <!--<tr>

<td valign="top" class="labelX" ><strong>Appointment Type:</strong></td>

<td colspan="2">

<input type="text" name="appt_type" id="appt_type" value="{$tripdata.0.appt_type}"  readonly="true"/>  &nbsp;<span class="SmallnoteTxt"></span>                                                </td>

<td></td></tr>-->

    

    <tr>

      <td valign="top" class="labelX" ><strong>Service Date:</strong></td>

      <td colspan="2"><input type="text" readonly="true" name="appdate" id="appdate" value="{$appdate}" class="txt_box required" tabindex="23"   />

        <span class="SmallnoteTxt">*  e.g. yyyy-mm-dd</span></td>

    </tr>

    {literal}<script>

function time(){

var ptime = document.getElementById("apptime").value;

var hours = ptime.split(':');

var hour = hours[0];

var minut = hours[1];

if(hour >12 || minut >59) 

{

alert('Please enter correct Pick Up Time!');

apptime =document.getElementById("apptime");

apptime.value = "";	

return false }

}

function time1(){

var ptime = document.getElementById("returnpickup").value;

//var mad = document.getElementById("am_pm1").value;

var hours = ptime.split(':');

var hour = hours[0];

var minut = hours[1];

if(hour >23 || minut >59) 

{

alert('Please enter correct Return Pick Up Time!');

returnpickup =document.getElementById("returnpickup");

returnpickup.value = "";	

return false }

}

function textalerty(val){

					if(val=='Yes'){	$('#cellalert,#cellalert2').show();}

					 else{	$('#cellalert,#cellalert2').hide();}

					}	

</script>{/literal}

    <tr>

      <td valign="top" class="labelX" ><strong>Pick up Time: </strong></td>

      <td colspan="2"><input type="text" name="apptime" id="apptime" value="{$apptime}" class="txt_box required" maxlength="5" tabindex="24" onBlur="javascript:time_()" />

        &nbsp;&nbsp; 

        <!--<select class="required" name="p_mad" id="p_mad" tabindex="" >

<option value="{$p_mad}" {if $p_mad eq 'am'} selected {/if} >am</option>

<option value="{$p_mad}" {if $p_mad eq 'pm'} selected {/if} >pm</option>

</select>--><span class="SmallnoteTxt">&nbsp;*</span></td>

    </tr>

    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq 'Three Way' || $triptype eq 'Round Trip'}{/if}

    <tr id="rpu">

      <td valign="top" class="labelX" ><strong>Return Pickup Option:</br>

        <span class="SmallnoteTxt"> (For Last Destination)</span></strong></td>

      <td colspan="2"><select name="puchoice" id="puchoice" class="SelectBox required" onChange="return pUchoice(this.value);" tabindex="25">

          <option value="" {if $pickupchoice eq ''}selected{/if}>Select</option>

          <option value="Will Call" {if $pickupchoice eq 'Will Call'}selected{/if}>Will Call</option>

          <option value="Time" {if $pickupchoice eq 'Time'}selected{/if}>Time</option>

        </select>

        &nbsp;<span class="SmallnoteTxt">*</span></span></td>

    </tr>

    <tr id="rpTime" style="display:none;">

      <td valign="top" class="labelX" ><strong>Return Pickup Time: </strong></td>

      <td colspan="2"><input type="text" name="returnpickup" id="returnpickup" value="{$returnpickup}" tabindex="26" class="txt_box required" maxlength="5" onBlur="javascript:time1()" />

        &nbsp;&nbsp; 

        <!--<select class="required" name="r_mad" id="r_mad" tabindex="" >

<option value="{$r_mad}" {if $r_mad eq 'am'} selected {/if} >am</option>

<option value="{$r_mad}" {if $r_mad eq 'pm'} selected {/if} >pm</option></select>--> 

        <span class="SmallnoteTxt">&nbsp;*</span></td>

    </tr>

    <tr>

      <td valign="top" class="labelX" ><strong>Today Date:</strong></td>

      <td valign="top"><input type="text" name="todaydate" id="todaydate" value='{$smarty.now|date_format}' class="txt_box required" readonly  tabindex="27"  /></td>

      <td valign="top">&nbsp;</td>

    </tr>

    <tr>

      <td valign="top" class="labelX" ><span class="label">Total Passengers:</span></td>

      <td ><input type="text" name="passenger" id="passenger"  class="txt_box required" value="{$tripdata.0.passenger}" /></td>

      <td valign="top">&nbsp;</td>

    </tr>

    <tr>

            <td colspan="3"><div class="admintopheading">Leg IDs</div></td>

          </tr>

          <tr align="left">

            <td colspan="3" valign="top">

            <span id="legidA" class="labels">Leg-A ID: <input name="legaid" value="{$tripdata.0.legaid}" maxlength="15" /></span>

            <span id="legidB" class="labels" style="display:none">Leg-B ID: <input name="legbid" value="{$tripdata.0.legbid}" maxlength="15"/></span>

            <span id="legidC" class="labels" style="display:none">Leg-C ID: <input name="legcid" value="{$tripdata.0.legcid}" maxlength="15"/></span>

            <span id="legidD" class="labels" style="display:none">Leg-D ID: <input name="legdid" value="{$tripdata.0.legdid}" maxlength="15"/></span>

            </td>

                </tr>  

    <tr>

      <td valign="top" class="labelX" ><strong>Comments:</strong></td>

      <td valign="top"><textarea name="comments" cols="60" rows="5" id="comments" tabindex="28" style="width:300px;"  >{$comments}</textarea></td>

      <td valign="top">&nbsp;</td>

    </tr>

    

      <td colspan="3" valign="top"><strong>

        <div class="admintopheading">Pick Address</div>

        </strong></td>

    </tr>

    <tr>

      <td valign="top"   class="labelX" >Pick Up Location:</td>

      <td><input type="text" name="picklocation" id="picklocation"  class="txt_box" value="{$tripdata.0.picklocation}" size="40"  onKeyUp="searchSuggest3();"  autocomplete="off"/>

        <div id="layer3"></div></td>

      <td><a onClick="addressla(1);"><img src="../graphics/arrow.png" ></a></td>

    </tr>

    <tr>

      <td valign="top"   class="labelX" ><strong>Pick up address:</strong></td>

      <td width="47%"><input type="text" name="pickaddress" id="autocomplete" value="{$pickaddress}" class="txt_box required" size="40" />

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td width="16%">&nbsp;</td>

    </tr>

    <tr>

      <td class="labelX">Suite #/Room #:</td>

      <td><input type="text" name="psuiteroom" id="psuiteroom" value="{$psuiteroom}"  class="txt_box"  maxlength="50" /></td>

      <td></td>

    </tr>

    

    <!--<tr>

<td valign="top"   class="labelX" >State:</td>

<td><select name="pckstate" id="pckstate"  class="txt_box required" tabindex="10"> 

<option value="">Select</option>

{section name=n loop=$states}

<option value="{$states[n].abbr}" {if $states[n].abbr eq $pckstate} selected="selected"{/if} >

{$states[n].statename}

</option>

{/section}

</select>

                  <span class="SmallnoteTxt">*</span></td>

<td>&nbsp;</td>

</tr>

<tr>

<td valign="top"  class="labelX" >Zip Code:</td>

<td><input type="text" name="pckzip" id="pckzip" class="txt_box " value="{$pckzip}" maxlength="10"   tabindex="11"/>

                     <span class="SmallnoteTxt"></span></td>

<td>&nbsp;</td>

</tr>-->

    <tr>

      <td valign="top" class="labelX" ><strong>Pick Up Instructions:</strong></td>

      <td valign="top"><textarea name="pickup_instruction" cols="60" rows="5" id="pickup_instruction" tabindex="28" style="width:300px;"  >{$tripdata.0.pickup_instruction}</textarea></td>

      <td valign="top">&nbsp;</td>

    </tr>

    <tr>

      <td class="labelX">Pickup Phone #:</td>

      <td><input type="text" name="p_phnum" id="p_phnum" value="{$data.0.p_phnum}" class="txt_box " maxlength="14" />

        &nbsp;<span class="SmallnoteTxt"></span></td>

      <td></td>

    </tr>

    <tr>

      <td colspan="3" valign="top"><strong>

        <div class="admintopheading">First Destination Address</div>

        </strong></td>

    </tr>

    <tr>

      <td valign="top"   class="labelX" >Drop Location:</td>

      <td><input type="text" name="droplocation" id="droplocation"  class="txt_box" value="{$tripdata.0.droplocation}" size="40"   onKeyUp="searchSuggest4();"  autocomplete="off"/>

        <div id="layer4"></div></td>

      <td><a onClick="addressla(2);"><img src="../graphics/arrow.png" ></a></td>

    </tr>

    <tr>

      <td width="37%" valign="top"  class="labelX" ><strong>Destination Address:<br/>

        <span class="SmallnoteTxt"></span></strong></td>

      <td colspan="2"><input type="text" name="destination" id="autocomplete2" value="{$destination}"  class="txt_box"  size="40" />

        &nbsp;<span class="SmallnoteTxt">*</span></td>

    </tr>

    <tr>

      <td class="labelX">Suite #/Room #:</td>

      <td><input type="text" name="dsuiteroom" id="dsuiteroom" value="{$dsuiteroom}"  class="txt_box"  maxlength="50" /></td>

      <td></td>

    </tr>

    <!-- <tr>

<td valign="top"  class="labelX" >City:</td>

<td colspan="2"><input type="text" name="drpcity" value="{$drpcity}" id="drpcity" class="txt_box required chars" maxlength="20" tabindex="13" />

                    <span class="SmallnoteTxt">*</span></td>

</tr>

<tr>

<td valign="top"  class="labelX" >State:</td>

<td colspan="2"><select name="drpstate" id="drpstate" class="txt_box required" tabindex="14">

<option value="">Select</option>

{section name=n loop=$states}

<option value="{$states[n].abbr}" {if $states[n].abbr eq $drpstate} selected="selected"{/if}>

{$states[n].statename}

</option>

{/section}

</select>

                    <span class="SmallnoteTxt">*</span></td>

</tr>

<tr>

<td valign="top"  class="labelX" >Zip Code:</td>

<td colspan="2"><input maxlength="10" tabindex="15" type="text" name="drpzip" value="{$drpzip}" id="drpzip" class="txt_box  "/>

                   <span class="SmallnoteTxt"></span></td>

</tr>-->

    <tr>

      <td class="labels">Destination Instructions: </td>

      <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction" id="destination_instruction">{$data.0.destination_instruction}</textarea></td>

    </tr>

    <tr>

      <td class="labelX">Destination Phone Number:</td>

      <td><input type="text" name="d_phnum" id="d_phnum" value="{$data.0.d_phnum}" class="txt_box " maxlength="14" tabindex="4"/>

        &nbsp;<span class="SmallnoteTxt"></span></td>

      <td></td>

    </tr>

    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq 'Three Way' || $triptype eq ''} {/if}

    <tr id="three0" style="display:none">

      <td colspan="3"><div class="admintopheading">Second Destination Information</div></td>

    </tr>

    <tr id="three1" style="display:none">

      <td class="labels">2nd Pick Time: </td>

      <td colspan="2"><input type="text" name="three_pickup" id="three_pickup" value="{$data.0.three_pickup}"  class="txt_box " maxlength="5" onBlur="javascript:time(this.id);" />

        <span class="SmallnoteTxt">*</span>&nbsp;Will Call&nbsp;

        <input type="checkbox" name="three_will_call" id="three_will_call" onClick="check_check3();" {if $data.0.three_will_call eq 'on'} checked="checked" {/if} /></td>

    </tr>

    <tr id="three2" style="display:none">

      <td class="labels">2nd Destination Location:</td>

      <td><input  type="text" name="droplocation2" id="droplocation2" value="{$data.0.droplocation2}"  class="txt_box"  size="45"  onKeyUp="searchSuggest5();"  autocomplete="off"/>

        <div id="layer5"></div></td>

      <td><a onClick="addressla(3);"><img src="../graphics/arrow.png" ></a></td>

    </tr>

    <tr  id="three3" style="display:none">

      <td class="labels">2nd Destination Address:</td>

      <td><input  type="text" name="destination2" id="autocomplete4" value="{$destination2}" placeholder="Enter Address"  class="txt_box "  maxlength="150"  size="45" />

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td></td>

    </tr>

    <tr  id="three4" style="display:none">

      <td class="labels">Suite / Apt / Bld:</td>

      <td><input type="text" name="dsuiteroom2" id="dsuiteroom2" value="{$dsuiteroom2}"  class="txt_box"  maxlength="150"  size="45" /></td>

      <td></td>

    </tr>

    <tr  id="three5" style="display:none">

      <td class="labels">2nd Destination Phone Number:</td>

      <td><input type="text" name="d_phnum2" id="d_phnum2" value="{$data.0.d_phnum2}" class="txt_box" maxlength="14"  onChange="use_same(this.id);" />

        &nbsp;<span class="SmallnoteTxt"></span></td>

      <td></td>

    </tr>

    <tr  id="three6" style="display:none">

      <td class="labels">2nd Destination Instructions: </td>

      <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction2" id="destination_instruction2">{$data.0.destination_instruction2}</textarea></td>

    </tr>

    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq ''}{/if}

    <tr id="four0" style="display:none">

      <td colspan="3"><div class="admintopheading">Third Destination Address</div></td>

    </tr>

    <tr id="four1" style="display:none">

      <td class="labels">Pick Time: </td>

      <td colspan="2"><input type="text" name="four_pickup" id="four_pickup" value="{$data.0.four_pickup}"  class="txt_box " maxlength="5" onBlur="javascript: time(this.id);" />

        <span class="SmallnoteTxt">*</span>&nbsp;Will Call&nbsp;

        <input type="checkbox" name="four_will_call" id="four_will_call" onClick="check_check4();" {if $data.0.four_will_call eq 'on'} checked="checked" {/if}/></td>

    </tr>

    <tr id="four2" style="display:none">

      <td class="labels">3rd Destination Location:</td>

      <td><input  type="text" name="droplocation3" id="droplocation3" value="{$data.0.droplocation3}"  class="txt_box"  size="45"  onKeyUp="searchSuggest6();"  autocomplete="off"/>

        <div id="layer6"></div></td>

      <td><a onClick="addressla(4);"><img src="../graphics/arrow.png" ></a></td>

    </tr>

    <tr  id="four3" style="display:none">

      <td class="labels">3rd Destination Address:</td>

      <td><input  type="text" name="destination3" id="autocomplete5" value="{$destination3}" placeholder="Enter Address"  class="txt_box "  maxlength="150"  size="45" />

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td></td>

    </tr>

    <tr  id="four4" style="display:none">

      <td class="labels">Suite / Apt / Bld:</td>

      <td><input type="text" name="dsuiteroom3" id="dsuiteroom3" value="{$dsuiteroom3}"  class="txt_box"  maxlength="150"  size="45" /></td>

      <td></td>

    </tr>

    <tr  id="four5" style="display:none">

      <td class="labels">3rd Destination Phone Number:</td>

      <td><input type="text" name="d_phnum3" id="d_phnum3" value="{$data.0.d_phnum3}" class="txt_box" maxlength="14"  onChange="use_same(this.id);" />

        &nbsp;<span class="SmallnoteTxt"></span></td>

      <td></td>

    </tr>

    <tr  id="four6" style="display:none">

      <td class="labels">3rd Destination Instructions: </td>

      <td colspan="2"><textarea rows="3" cols="40" name="destination_instruction3" id="destination_instruction3">{$data.0.destination_instruction3}</textarea></td>

    </tr>

    {if $triptype eq 'Five Way' || $triptype eq ''} {/if}

    <tr id="five0" style="display:none">

      <td class="admintopheading" colspan="3">Fourth Destination</td>

    </tr>

    <tr id="five1" style="display:none">

      <td class="labelX">Pick Time: </td>

      <td colspan="2"><input type="text" name="five_pickup" id="five_pickup" value="{$five_pickup}"  class="txt_box " maxlength="5" onBlur="javascript:tValid(this.value,this.id)" />

        &nbsp;&nbsp;<!--<select class="" name="am_pm5" id="am_pm5"  >

   <option value="">--</option>

<option value="am" {if $am_pm5 eq 'am'} selected="selected" {/if}>am</option>

<option value="pm" {if $am_pm5 eq 'pm'} selected="selected" {/if}>pm</option>

</select>

<span class="SmallnoteTxt">*</span>&nbsp;-->Will Call&nbsp;

        <input type="checkbox" name="five_will_call" id="five_will_call" onClick="check_check5();" {if $five_will_call eq 'on'} checked="checked" {/if} /></td>

    </tr>

    <!--

<tr id="five6" style="display:none">

           	<td class="labelX" >Destination (Place):<br/></td>

<td><input name="destination_place5" type="text"  class="txt_box " id="destination_place5" value="{$destination_place5}" maxlength="150" />&nbsp;</td>

<td></td></tr>

<tr id="five7" style="display:none">

           	<td class="labelX" >STE/BLDG:<br/></td>

<td><input name="stebldg5" type="text"  class="txt_box " id="stebldg5" value="{$stebldg5}" maxlength="150" />&nbsp;</td>

<td></td></tr>

-->

    <tr id="five2" style="display:none">

      <td class="labelX" >Address:<br/></td>

      <td><input name="five_address" type="text"  class="txt_box " id="five_address" value="{$five_address}" maxlength="150" />

        &nbsp;</td>

      <td></td>

    </tr>

    <tr id="five6" style="display:none">

      <td class="labels">Suite #/Room #:</td>

      <td><input type="text" name="p5suiteroom" id="p5suiteroom" value="{$p5suiteroom}"  class="txt_box"  maxlength="50" /></td>

      <td></td>

    </tr>

    <tr id="five3" style="display:none" >

      <td class="labelX" >City:</td>

      <td><input name="five_city" type="text"  class="txt_box" id="five_city" value="{$five_city}" maxlength="150"/>

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td></td>

    </tr>

    <tr id="five4" style="display:none">

      <td class="labelX" >State:</td>

      <td><select id="five_state" name="five_state"  class="txt_box " />

        

        <option value="">Select</option>

        {section name=n loop=$states}

        <option value="{$states[n].abbr}" {if $states[n].abbr eq $five_state}selected{/if}> {$states[n].statename} </option>

        {/section}

        </select>

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td></td>

    </tr>

    <tr id="five5" style="display:none" >

      <td class="labelX" >Zip Code:</td>

      <td><input name="five_zip" type="text"  class="txt_box " id="five_zip" value="{$five_zip}" maxlength="10" />

        &nbsp;<span class="SmallnoteTxt"> e.g. 12345-6789</span></td>

      <td></td>

    </tr>

    {if $triptype eq 'Four Way' || $triptype eq 'Five Way' || $triptype eq 'Three Way' || $triptype=='' || $triptype eq 'Round Trip'} {/if}

    <tr id="b0" style="display:none">

      <td class="admintopheading" colspan="3">Last Destination </td>

    </tr>

    <!-- <tr id="b3" style="display:none"> <td> Use Same Pickup Information

                    <input type="checkbox" name="sameadd" id="sameadd" onclick="test();"/> <br/></td></tr>

                   -->

    <tr id="b2" style="display:none" >

      <td valign="top"   class="labelX" >Back To Location:</td>

      <td><input type="text" name="backtolocation" id="backtolocation"  class="txt_box" value="{$tripdata.0.backtolocation}" size="40"   onKeyUp="searchSuggest7();"  autocomplete="off"/>

        <div id="layer7"></div></td>

      <td><a onClick="addressla(5);"><img src="../graphics/arrow.png" ></a></td>

    </tr>

    <tr id="b1" style="display:none" >

      <td class="labelX"  > Back To Address:<br/></td>

      <td><input name="backto" type="text"  class="txt_box " id="autocomplete3" value="{$backto}" maxlength="150" size="40" />

        &nbsp;<span class="SmallnoteTxt">*</span></td>

      <td></td>

    </tr>

    <tr id="b5" style="display:none;">

      <td class="labels">Suite #/Room #:</td>

      <td><input type="text" name="bsuiteroom" id="bsuiteroom" value="{$bsuiteroom}"  class="txt_box"  maxlength="50" /></td>

      <td></td>

    </tr>

    <tr id="b3" style="display:none;">

      <td class="labels">Back to Instructions: </td>

      <td colspan="2"><textarea rows="3" cols="40" name="backto_instruction" id="backto_instruction">{$tripdata.0.backto_instruction}</textarea></td>

    </tr>

    <!--<tr id="b2" style="display:none" >    	<td class="labelX" >Back To City:</td>

            <td><input name="backtocity" type="text"  class="txt_box " id="backtocity" value="{$backtocity}" maxlength="150"/>&nbsp;<span class="SmallnoteTxt">*</span></td>

                                                    <td></td></tr>

    <tr id="b3" style="display:none"> 	<td class="labelX" >Back To State:</td>

<td><select id="backtostate" name="backtostate"  class="txt_box" />

   <option value="">Select</option>{section name=n loop=$states}

   <option value="{$states[n].abbr}" {if $states[n].abbr eq $backtostate}selected{/if}>

			   {$states[n].statename} </option>

   

   {/section} </select>

                                                      <span class="SmallnoteTxt" >*</span></td><td></td> </tr>

			<tr id="b4" style="display:none" >

            <td class="labelX" >Back To Zip Code:</td>

     <td><input name="backtozip" type="text"  class="txt_box" id="backtozip" value="{$backtozip}" maxlength="10" />&nbsp;<span class="SmallnoteTxt"> e.g. 12345-6789</span></td>

                                                    <td></td>

                                                </tr>-->

    

    <tr>

      <td colspan="3" valign="top" class="admintopheading"><strong>General Options</strong></td>

    </tr>

    <!--<tr><td valign="top" class="labelX" ><strong>Driver Preference :</strong></td>

<td colspan="2"><input type="radio" name="driver" value="Male" {if $tripdata.0.driver eq 'Male'} checked="checked"  {/if}/>&nbsp;Male

<input type="radio" name="driver" value="Female" {if $tripdata.0.driver eq 'Female'} checked="checked" {/if}/>&nbsp;Female</td><td></td></tr>--> 

    <!--<tr><td valign="top" class="labelX" ><strong>Patient Sex :</strong></td>

<td colspan="2"><input type="radio" name="sex" value="Male" {if $tripdata.0.sex eq 'Male'} checked="checked" {/if}/>&nbsp;Male

<input type="radio" name="sex" value="Female" {if $tripdata.0.sex eq 'Female'} checked="checked" {/if}/>&nbsp;Female</td><td></td></tr>--> 

    <!--<tr><td valign="top" class="labelX" ><strong>Child Seat :</strong></td>

<td colspan="2"><input type="checkbox" name="childseat" value="Yes" {if $tripdata.0.childseat eq 'Yes'} checked="checked" {/if}/>&nbsp;Yes</td><td></td></tr>

<tr><td valign="top" class="labelX" ><strong>Escort :</strong></td>

<td colspan="2"><input type="checkbox" name="escort" value="Yes" {if $tripdata.0.escort eq 'Yes'} checked="checked" {/if}/>&nbsp;Yes</td><td></td></tr>-->

    <tr>

      <td valign="top" class="labelX" ><strong>2 Man Team :</strong></td>

      <td colspan="2"><input type="checkbox" name="dstretcher" value="Yes" {if $tripdata.0.dstretcher eq 'Yes'} checked="checked" {/if}/>

        &nbsp;Yes</td>

      <td></td>

    </tr>

    <!--<tr><td valign="top" class="labelX" ><strong>Bariatric Stretcher :</strong></td>

<td colspan="2"><input type="checkbox" name="bar_stretcher" value="Yes" {if $tripdata.0.bar_stretcher eq 'Yes'} checked="checked" {/if}/>&nbsp;Yes</td><td></td></tr>-->

    <tr>

      <td valign="top" class="labelX" ><strong>Wheel Chair Rental :</strong></td>

      <td colspan="2"><input type="checkbox" name="dwchair" value="Yes" {if $tripdata.0.dwchair eq 'Yes'} checked="checked" {/if}/>

        &nbsp;Yes</td>

      <td></td>

    </tr>

    <!--<tr><td valign="top" class="labelX" ><strong>Oxygen O<sub>2</sub> :</strong></td>

<td colspan="2"><input type="checkbox" name="oxygen" value="Yes" {if $tripdata.0.oxygen eq 'Yes'} checked="checked" {/if}/>&nbsp;Yes</td><td></td></tr>--> 

    

    <!--<tr><td valign="top" class="labelX" ><strong>Stretcher :</strong></td>

<td colspan="2"><input type="checkbox" name="stretcher" value="Yes" {if $tripdata.0.stretcher eq 'Yes'} checked="checked" {/if}/>&nbsp;Yes</td><td></td></tr>

      --> 

    <!--<tr>

<td valign="top"><strong>Services Required:</strong></td>

<td valign="top"><input type="checkbox" name="wcs" id="wcs" value="1" {if $wcs gt '0'} checked="checked" {/if} />&nbsp;Wheel Chair Standard<br /><input type="checkbox" name="sts" id="sts" value="2" {if $sts gt '0'} checked="checked" {/if} />&nbsp;Stretcher Standard<br /><input type="checkbox" name="stp" id="stp" value="3" {if $stp gt '0'} checked="checked" {/if} />&nbsp;Stretcher Special<br /><input type="checkbox" name="oxy" id="oxy" value="4" {if $oxy gt '0'} checked="checked" {/if} />&nbsp;Oxygen<br /><input type="checkbox" name="wcr" id="wcr" value="5" {if $wcr gt '0'} checked="checked" {/if} />&nbsp;Wheel Chair Rental</td>

<td valign="top">&nbsp;</td>

</tr>-->



    <tr>

      <td colspan="3" valign="top">&nbsp;</td>

    </tr>

    <tr>

      <td valign="top">&nbsp;</td>

      <td colspan="2"><input type="submit" name="submit" value='Update' class="btn" tabindex="29"    />

        <input type="reset" name="reset" value="Reset" class="btn"  tabindex="30"   />

        <input type="hidden" name="reqid" value="{$reqid}" />

        <input type="hidden" name="id" value="{$id}" />

        <input type="hidden" name="req" value="{$req}" />

        <input type="hidden" name="date" value="{$date}" /></td>

    </tr>

  </table>

</form>

</body>

{if $triptype neq ''}{/if}

{literal}<script>chTrip('{/literal}{$triptype}{literal}');</script>{/literal}



{literal}<script>textalerty('{/literal}{$data.0.cellalertoption}{literal}');</script>{/literal}

{include file = innerfooter.tpl}ss