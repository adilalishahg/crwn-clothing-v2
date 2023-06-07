// JavaScript Document
function validate(all_ids){

	var str,sp_str,flag,err_str,sub_str;
	str = all_ids;
	
	err_str = "";
	
	sp_str = str.split("|");
	
	flag = true;

	for(var i=0;i<sp_str.length; i++){
		sub_str = sp_str[i].split(":");
		if(document.getElementById(sub_str[0]).value == ""){
			err_str = err_str + "Can Not Submit Empty "+sub_str[1] + "\n";
			flag = false;
		}
	}
	if(flag){
		return true;
	}else{
		alert(err_str);
	}
	return false;
}


function numberchk(no){
	alert(no);
	alert(document.getElementById(no).value);
	return false;
	if(isNaN(no)){
		
		alert("not a number");
		return false;
	}else{
		alert("Its a number");
	}
}
