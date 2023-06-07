

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = 	{"required":{    			// Add your regex rules here, you can take telephone as an example
						"regex":"none",
						"alertText":"* This field is required",
						"alertTextCheckboxMultiple":"* Please select an option",
						"alertTextCheckboxe":"* This checkbox is required"},
					"length":{
						"regex":"none",
						"alertText":"*Between ",
						"alertText2":" and ",
						"alertText3": " characters allowed"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* Checks allowed Exceeded"},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* Please select ",
						"alertText2":" options"},	
					"confirm":{
						"regex":"none",
						"alertText":"* Your field is not matching"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* Invalid phone number"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* Invalid email address"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* Invalid date, must be in YYYY-MM-DD format"},
					"url":{
                         "regex":"/^(http|https|ftp)\://[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\:[a-zA-Z0-9]*)?/?([a-zA-Z0-9\-\.\_\?\,\'\\\+\%\$\#\=\~])*$/",
                         "alertText":"* Invalid URL"},	 
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* Numbers only"},	
					"onlyZip":{
						"regex":"/^[0-9]{5}(\-[0-9]{3})?$/",
						"alertText":"* Invalid Zip Format"},
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z\ \']+$/",
						"alertText":"* No special characters allowed"},	
					"ajaxUser":{
						"file":"validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"* Valid admin user name",	
						"alertTextLoad":"* Loading, please wait",
						"alertText":"* Invalid admin user name"},
					"ajaxName":{
						"file":"validateUser.php",
						"alertText":"* This name is already taken",
						"alertTextOk":"* This name is available",	
						"alertTextLoad":"* Loading, please wait"},		
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* Alphabets Only"}
					}	
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});