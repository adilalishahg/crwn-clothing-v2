{include file = headerinner1.tpl}
{literal}
<script type="text/javascript">
$(document).ready(function(){
   $('#searchReport').validate();
	$('#prol').validate();
  });


  function getlist(val){
   
	 if(val != ''){ 
		$.post("getlist.php", {plist: ""+val}, function(data){
      	if(data.length > 0) {
                 if(data == 'invalid'){
				    return false;
				  }else{
				  $('#list').html(data);
				  return true;
				  }
			   }   

		   });
	     return true;
     }else{
	   return false;
	 }
  }	 
  function verify(){
	
    scode = $('#emplist').val(); 
    etype = $('#category').val();	
	
	 if(scode != ''){ 
		$.post("verify_code.php", {id: ""+scode, emp: ""+etype}, function(data){
      if(data.length > 0) {
          if(data == 'invalid'){
		    return false;
		  }else{
		 $('#hrate').html(data);
		 $('#payrate').val(data); 
		  return true;
				  }
			   }   

		   });
	     return true;
     }else{
	   return false;
	 }
  }	 
  function clear(id){ 
	  if(id == '1'){ 
	  $('#category').val(''); $('#emplist').val(''); 
		  $('#timein').attr('href', 'timein.php?timein=1&scode='+scode);
		  $('#timeout').attr('href', 'timeout.php?timeout=1&scode='+scode); 
	  return true; }
	  else if(id == '2'){ 
	  $('#scode').val(''); $('#vstatus').html('');   
	  return true; }
	  else { return false; }	  
	  } 
  function pick(id){
  	  cur = $('#cur').val();
	  dhalf = $('#dhalf').val();
	  dte = $('#date').val(dhalf+cur);
	  $('#cur').val(id);
	  $('#pre').val(cur);	 
	  pre = $('#pre').val();
	  $('#d-'+pre).removeAttr('style');	   
	  $('#d-'+id).attr('style', 'border:2px solid #ff0000;');
	
	  getCal();	
	  }   
  function getCal(){
    if ($("input[name='wchoice']:checked").val() == 'weekly') {
	  var wchoice = 'weekly';
	}
	
    if ($("input[name='wchoice']:checked").val() == 'bi-weekly') {
	  var wchoice = 'bi-weekly';
	}
	
    if ($("input[name='wchoice']:checked").val() == 'monthly') {
	  var wchoice = 'monthly';
	}
    emp   = $('#category').val();
	empid =  $('#emplist').val();
    cur   =  $('#cur').val();
	prate =  $('#payrate').val();  

   if(empid != ''){	  
	$.post("payroll.php", {wc:""+wchoice,type: ""+emp,id: ""+empid,dte:""+cur,payrate: ""+prate},       function(data){
         if(data.length > 0) {
          if(data == 'invalid'){
		    return false;
		  }else{
		     var fdata = data;
			 vdata =  new Array();
			 vdata = fdata.split('^');
		    $('#tblcal').html(vdata[0]);
			$('#thours').html(vdata[1]);
			$('#totalhours').val(vdata[1]);			
		  return true;
				  }
			   }   
		   });  
     }
  }
  function calc(){   
   var hrate = $('#payrate').val();
   var thours = $('#totalhours').val();
   var tot = parseInt(hrate*thours);
   if(tot == ''){
   	$('#samount').html('0');
   }else{
    $('#samount').html(tot);		  
   }
}
</script>

{/literal}

<table width="1010" border="0" cellspacing="0" cellpadding="0" class="outer_table" align="center" bgcolor="#FFFFFF">

  <tr>

    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

        <tr>

          <td></td>

        </tr>

        <tr>

          <td height="19" align="left" >&nbsp;</td>

        </tr>

        <tr>

          <td height="19" align="center" class="admintopheading">PAYROLL MANAGEMENT</td>

        </tr>

        <tr>

          <td height="44" align="center"  valign="top" style="padding-bottom:50px;"><form name="prol" id="prol" action="details.php" method="post" target="_blank">
          <div class="payroll_main">
	  <table width="960" border="0" cellspacing="3" cellpadding="3">
        <tr valign="top">
          <td><div class="payroll_view_main">
		  	<div class="payroll_view_inner"></div>
			<div class="payroll_tbl">
			<table width="100%" border="0" cellspacing="4" cellpadding="0">
				  <tr>
					<td colspan="4"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td>&nbsp;</td>
                        <td>Select Category: </td>
                        <td>
        <select name="category" id="category" class="required payroll_fields" onchange="return getlist(this.value);" style="width:200px;">
		   <option value="">-- Select --</option>
		   <option value="1">Drivers</option>
		   <!--<option value="2">Office Staff</option> -->
		</select>                        </td>
                      </tr>
                      <tr>
                        <td width="8%">&nbsp;</td>
                        <td width="24%">Select Staff: </td>
                        <td width="68%"> 
						    <span id="list">		
		<select name="emplist" class="required payroll_fields" id="emplist" onchange="return clear('2');" style="width:200px;">
		   <option value="">-- Select --</option>
		</select></span></td>
                      </tr>
                    </table></td>
				  </tr>
				  <tr>
					<td>&nbsp;</td>
				    <td width="16%" align="left" valign="middle"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                      <tr>
                        <td width="62%">&nbsp;</td>
                        <td width="38%">&nbsp;</td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">W</td>
                        <td align="center">
                            <input type="radio" name="wchoice" id="weekly" value="weekly" checked="checked" onchange="return getCal();" />                        </td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">B/W</td>
                        <td align="center"><input type="radio" name="wchoice" id="bweekly" value="bi-weekly" onchange="return getCal();" /></td>
                      </tr>
                      <tr>
                        <td align="right" valign="middle">M</td>
                        <td align="center"><input type="radio" name="wchoice" id="monthly" value="monthly" onchange="return getCal();" /></td>
                      </tr>
                    </table></td>
				    <td width="68%" align="right"><input type="hidden" name="dhalf" id="dhalf" value="{$sdate[0]}-{$sdate[1]}-" />
                    <input type="hidden" name="cur" id="cur" value="{$sdate[2]}" /><input type="hidden" name="pre" id="pre" />
                    {include_php file = calendar.php}</td>
				    <td width="7%">&nbsp;</td>
				  </tr>
				  
				  <tr>
					<td>&nbsp;</td>
				    <td colspan="2" style="padding-left:75px;"><input type="hidden" name="payrate" id="payrate" />Pay per Rates $ <span id="hrate">---</span> / Hrs </td>
				    <td>&nbsp;</td>
				  </tr>
				  <tr>
					<td colspan="4">&nbsp;</td>
				  </tr>
			  </table>
			</div> 
		  </div></td>
          
		  <td><div class="calculator_view_main">
		  <div class="calculator_view_inner"></div>	
		  <div class="payroll_tbl">
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="31%" >
				<div class="days">DAYS</div>				</td>
                <td width="69%" >
				<div class="hours">HOURS</div>				</td>
              </tr>
              <tr>
			  	<td width="31%" >
					<!--<div class="days_inner"></div> 
					</td>
					<td width="69%" >
					<div class="hours_inner"></div>-->				</td>
			  
             
              </tr>
              <tr>
                <td colspan="2"><div class="days_inner">
				    <div style="overflow:auto; height:153px; border:1px solid #FFf" id="tblcal">
                  <table width="90%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="2" class="tbl_row_height">No Record Found</td>
                    </tr>
                   </table></div>
				  <div style="float:left; border:1px solid #e4e4e4; border-right:none; height:24px; padding-top:8px; font-weight:bold; width:129px;">Total Hours </div>
				   <div style="float:left; border:1px solid #e4e4e4; padding-left:14px; height:24px; padding-top:8px; font-weight:bold; width:143px;">
                   <input type="hidden" name="totalhours" id="totalhours" />
                   <span id="thours">---</span> Hrs </div>
                </div> </td>
              </tr>
            </table>
		  </div> 	  
		  </div></td>
        </tr>
		
      </table>
	  <table width="100%" border="0" cellspacing="4" cellpadding="0">
			 <tr> 
			  <td width="3%">&nbsp;</td> 
	          <td width="50%"><a href="javascript:calc();"><img src="../images/calculate.png" alt="" width="119" height="31" border="0" /></a></td>
	          <td width="31%">Salary Amount $ <span id="samount" style="color:#ff0000; font-size:13px;">---</span></td>
	          <td width="10%"><input type="image" src="../images/printbtn.png" name="printprol" id="printprol" alt="Print" width="80" style="border:none;" /></td>
	          <td width="6%">&nbsp;</td>
	    </tr>
	  </table>
	</div>
    </form>
    </td>

        </tr>

      </table></td>

  </tr>

</table>

{ include file = innerfooter.tpl} 