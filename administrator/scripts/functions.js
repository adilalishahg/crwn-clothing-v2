// JavaScript Document

function element( id ) {
  return document.getElementById( id );
}

function updateFld( id, val ) {
  element( id ).value = val;
}


function fldValue( id ) {
  return element( id ).value;
}


function showElement( id ) {
  element( id ).style.visibility = 'visible';
}


function hideElement( id ) {
  element( id ).style.visibility = 'hidden';
}

function changestatus( id ){
 
 var status = document.getElementById('ordstatus').value;
  if(status != 'select')
    {
	location.href = 'view_order_details.php?eId='+id+'&status='+status;	
	}
}

function viewstore(){
 var status = document.getElementById('store').value;
  if(status != '')
    {
	location.href = 'index.php?store='+status;	
	}else{
	location.href = 'index.php';		
	}
}

function storeupdate(id){
 var status = document.getElementById('store').value;
  if(status != '')
    {
	location.href = 'storeinfo.php?eId='+id+'&store='+status;	
	}else{
	location.href = 'storeinfo.php?eId='+id;		
	}
}

function price( val ) {
  var num = '';
  num = toNumber( val );
  var strnum = '';
  for( i=num.length-1, j=0; i>-1; i--, j++ ) {
    if( j!=0 && (j%3)==0 && j<num.length ) {
	  strnum = ',' + strnum;
	}
	strnum = num.charAt(i) + strnum;
  }
  return strnum;
}

// Add Picture field
function addPic( tbl, pcount )
{
  if( pcount < 20 ) {
    pcount = pcount + 1;
    code1  = '<input name="file[]" type="file" id="file[]"/> (Image Size: 355px × 168px) <br>';
    code1 += '<input name="Tfile[]" type="file" id="Tfile[]"/> (Image Size: 76px × 65px) <br>';	
    var table = element( tbl );
    var tr = document.createElement( 'tr' );
    table.tBodies[0].appendChild( tr );
    var td1 = document.createElement( 'td' );
    td1.innerHTML = code1;
    tr.appendChild( td1 );
  } else {
    alert( 'You can not add more than 10 fields!' );
  }
  return pcount;
}

function extensionChk( ext, fld ) {
  fld = fldValue( fld );
  if( fld.indexOf( ext ) && fld.length <= fld.indexOf( ext )+4  ) {
    return true;
  }
  alert( 'Warning: Only .' + ext + ' files are allowed.' );
  return false;
}

function CheckAll(chk)
{
var str = '';
for (i = 0; i < chk.length; i++)
  {
	chk[i].checked = true ;
    
	 if(i <= chk.length-2)
	  { str += chk[i].value+','; }
	 else
	 { str += chk[i].value; }
  }
/*
 str2 = array(); 
 str2=location.search.match(/\bPage\= *([^\?]+)/);
 pg=str2[1];  
*/ 
  document.getElementById('ids').value = '';
  document.getElementById('ids').value = str;
/* 
  document.getElementById('pg').value = '';
  document.getElementById('pg').value = pg;  
*/
 
}

function UnCheckAll(chk)
{
for (i = 0; i < chk.length; i++)
{
	chk[i].checked = false ;
}
  document.getElementById('ids').value = '';
  document.getElementById('pg').value = '';  
}


function selectedBox(val)
{  
   var str = document.getElementById('ids').value;
   
  if(str == '')   
  { str += val; }
  else{
	str += ','+val;  
	  }
  document.getElementById('ids').value = '';
  document.getElementById('ids').value = str;

	
}



function callAjax( frmName ) {
  disableForm( frmName );
  var str = '?';
  str += 'nameT='  + fldValue( 'fname' ) + '&fname='  + fldValue( 'fname' ) +
         '&sname=' + fldValue( 'sname' ) + '&postcd=' + fldValue( 'postcode' ) +
         '&email=' + fldValue( 'email' ) + '&ph_hm='  + fldValue( 'ph_home' ) +
         '&ph_mb=' + fldValue( 'ph_mobile' );
												
  var fnDone = function( oXML ) {
    var returned = oXML.responseText;
    if( returned != '' ) {
      element( 'result' ).innerHTML = returned;
      window.scrollBy( 0, -300 );
	  window.location = '#result';
    } else {
      element( 'result' ).innerHTML = '';
    }
    hideElement( 'checking' );
    enableForm( frmName );
  }

  var AJAX = new XHConn( );
  AJAX.connect( 'chkmatch.php', 'POST', str, fnDone );
}


function getRegion( country ) {
  var str = '?';
  str += 'cT=' + country + '&c=' + country;											
  var fnDone = function( oXML ) {
    var returned = oXML.responseText;
	element( 'regionSel' ).innerHTML = returned;
    element( 'region' ).focus( );
  }
  var AJAX = new XHConn( );
  AJAX.connect( 'getregion.php', 'POST', str, fnDone );
}



function editPiece(pid,id,p) {
  var str = '';
  str += 'pId=' + pid + '&pcId=' + id;
  var ps = 'ps'+p;
var fnDone = function( oXML ) {
    var returned = oXML.responseText;
   document.getElementById(ps).innerHTML = returned;
  }
  var AJAX = new XHConn( );
  AJAX.connect('edit_piece.php', 'GET', str, fnDone, ps);
}


function getsubprod(totval)
{
  
var divst = document.getElementById('subprod').style.display;
var bugval= document.getElementById('bugfix').value;

alert(divst);
alert(bugval);

 if(divst == 'block' && bugval>0 && bugval != '')
  { return false; }
 else{
  
 if(document.getElementById('bugfix').value=='0' || document.getElementById('bugfix').value=='')
 {
 document.getElementById('bugfix').value=totval; 
 }
 
 if(document.getElementById('bugfix').value != totval){
   if(document.getElementById('OldnoOfpieces')){
	var val=document.getElementById('OldnoOfpieces').value;
    }
   else { var val=0;}


 if(val > 0)	
  {	
    var dif = totval-val; 
    
	if(dif > 0){	
   
    var cont = '';
    cont += "<table width='100%' cellpadding='2' cellspacing='0' border='0'>";
	cont += "<tr><td>Name</td><td>Large Image</td><td>Thumbnail</td></tr>";
   
  for(i=0; i<totval-val; i++)	
	{
      cont += "<tr><td valign='top'><input type='text' name='subprd[]' value=''></td>";
	  cont += "<td><input type='file' name='file2[]' size='30'><br>(Image Size: 355px × 168px)</td>";	  
	  cont += "<td><input type='file' name='Tfile2[]' size='30'><br>(Image Size: 76px × 65px)</td></tr>";
   }
	cont += "</table>";
	
	if(document.getElementById('subprod')){
	document.getElementById('subprod').innerHTML = '';
	document.getElementById('subprod').innerHTML = cont;	
    document.getElementById('subprod').style.display = 'block';
	}
  }else{
	document.getElementById('subprod').innerHTML = '';	    
   }
 }
 else{
    var cont = '';
    cont += "<table width='100%' cellpadding='2' cellspacing='0' border='0'>";
	cont += "<tr><td>Name</td><td>Image</td><td>Thumbnail</td></tr>";
   
  for(i=0; i<totval; i++)	
	{
      cont += "<tr><td valign='top'><input type='text' name='subprd[]' value=''></td>";
	  cont += "<td><input type='file' name='file2[]' size='30'><br>(Image Size: 355px × 168px)</td>";	  
	  cont += "<td><input type='file' name='Tfile2[]' size='30'><br>(Image Size: 76px × 65px)</td></tr>"; 
	}
	cont += "</table>";
	
	if(document.getElementById('subprod')){
	document.getElementById('subprod').innerHTML = '';
	document.getElementById('subprod').innerHTML = cont;	
    document.getElementById('subprod').style.display = 'block';	  
	 }
 }

}
return true;
}
}


/*function getCategory( pCategory ) {
  var str = '?';
  str += 'cT=' + pCategory + '&c=' + pCategory;												
  var fnDone = function( oXML ) {
    var returned = oXML.responseText;
    element( 'regionSel' ).innerHTML = returned;
    element( 'region' ).focus( );
  }
  
    var AJAX = new XHConn( );
  AJAX.connect( 'getCategory.php', 'POST', str, fnDone );
}*/

function getCateg(categ) {
  var str = '?';
  str += 'cT=' + categ + '&c=' + categ;											

var fnDone = function( oXML ) {
    var returned = oXML.responseText;
   document.getElementById('catSel').innerHTML = returned;
  }
  var AJAX = new XHConn( );
  AJAX.connect('add_product.php', 'GET', str, fnDone, 'catSel');
}

function EditgetCateg(categ,eId) {
  var str = '';
  str += 'eId=' + eId + '&cT=' + categ + '&c=' + categ;											
var fnDone = function( oXML ) {
    var returned = oXML.responseText;
   document.getElementById('catSel').innerHTML = returned;
  }
  var AJAX = new XHConn( );
  AJAX.connect('edit_product.php', 'GET', str, fnDone, 'catSel');
}


function getPageContent(pgId)
{
  if(pgId != 'select')	
   {
    location.href = 'index.php?eId='+pgId	   
   }
	
}


function popup(url)
{
    window.open(url,'_blank','resizable=yes,scrollbars=yes,screenX=100,left=300,screenY=50,top=50,titlebar=no,statusbar=no');   
}

function getRepOrders(repId)
{
  if(repId != '' && repId != 'all')	
   {
    location.href = 'index.php?rep='+repId;	   
   }
   
  if(repId == 'all')	
   {
    location.href = 'index.php';	   
   } 
	
}


function printer1(){

if(document.getElementById('printer1'))
   {
	if(document.getElementById('printer1').style.display == 'block')   
	   {
		document.getElementById('printer1').style.display = 'none';
		document.getElementById('showprinter').style.display = 'block';   
		window.print();
		}
    else if(document.getElementById('showprinter').style.display == 'block')   
	   {
		document.getElementById('printer1').style.display = 'block';
		document.getElementById('showprinter').style.display = 'none';   
		}
	else{
		document.getElementById('printer1').style.display = 'block';
		document.getElementById('showprinter').style.display = 'none';  		
		}	
	}	
}