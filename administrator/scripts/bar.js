

function yhWriteBar(TargetID,SIZE,DATA)
{
  if(document.getElementById==null || TargetID==null){return;};
  var TargetObj = document.getElementById(TargetID);
  TargetObj.style.cssText="-moz-border-radius:6px;background:purple;color:yellow;font-size:10px;font-family:Verdana;border-right:solid 1px #aaaaaa;border-bottom:solid 1px #aaaaaa;";
  TargetObj.cellSpacing=1;
  TargetObj.border=0;
  if(TargetObj==null || TargetObj.tagName ==null || DATA==null){return;};
   
   var thd = TargetObj.getElementsByTagName("thead")[0]; 
        thd.getElementsByTagName("th")[1].setAttribute("colspan",2);
		var ths = thd.getElementsByTagName("th");
		for(var h=0;h<(ths.length);h++)
	    {
		   ths[h].vAlign="middle";
		  if(h < (ths.length-1)){	 ths[h].style.cssText = "border-right:solid 1px #aaaaaa;";}
		}

		thd.style.cssText="font-size:12px;font-family:Verdana;border:solid 1px #aaaaaa;";
   var tbd = TargetObj.getElementsByTagName("tbody")[0];
  
 
   var SUM  = 0;
  
   var MaxHeight = 12 ; 

   function sortNumbers(a, b) { return parseFloat(a.cells[1].innerHTML) - parseFloat(b.cells[1].innerHTML) } 
   
  
  
   var SortRows = new Array();
   for(var r=0;r<tbd.rows.length;r++)
   {SUM += parseFloat(tbd.rows[r].cells[1].innerHTML);
    MaxHeight = Math.max(MaxHeight,tbd.rows[r].offsetHeight);
    SortRows[r] = tbd.rows[r];
   }

   SortRows = SortRows.sort(sortNumbers); 
   for(var r=0;r<SortRows.length;r++)
   {
    tbd.insertBefore(SortRows[r],tbd.rows[0])
   }

   
   if(isNaN( SUM) ){return;};
   TargetObj.Bars = new Array();
   for(var r=0;r<tbd.rows.length;r++)
   {
     var P  = Math.ceil(parseFloat(tbd.rows[r].cells[1].innerHTML) /  SUM *100) ;
	 var TD = document.createElement("TD");
	 TD.width="40%";
	 TD.style.height= MaxHeight +"px";
	 var BarID = TargetID +"_BarWow_" + r ;
	 if(ColorScheme[r] == null){ColorScheme[r] = "#cccccc" ; }
	 TD.innerHTML =  "<div id='"+BarID+"'    style='-moz-border-radius-topright:4px;-moz-border-radius-bottomright:4px; background-color:"+ColorScheme[r]+";width:0px;display:block;height:12px;font-size:12px;font-family:Verdana;padding-top:4px;'>&nbsp;</div>";
     tbd.rows[r].insertBefore(TD,tbd.rows[r].cells[1]);
	 var BarObj = document.getElementById(BarID) ; 
     TargetObj.Bars[ TargetObj.Bars.length ] = BarObj;
	 BarObj.Begin = 0; 
	 BarObj.End = P ;
	 BarObj.Go = BarGo;
	 BarObj.parentNode.parentNode.style.backgroundColor="white";
	 BarObj.parentNode.parentNode.style.color="black";
	 //BarObj.parentNode.parentNode.style.color="white";
	 tbd.rows[r].cells[2].innerHTML = "<span style='color:blue;'>" + parseFloat(tbd.rows[r].cells[2].innerHTML) +"</span>/<span style='color:red;'>" + P  + "%</span>"; 
	 tbd.rows[r].cells[2].align="right";
	 tbd.rows[r].cells[2].style.cssText="font-size:10px;font-family:Verdana;"
   }
    for(var i=0;i<TargetObj.Bars.length;i++)
	{setTimeout("document.getElementById('"+TargetObj.Bars[i].id+"').Go()",( 100 * i ))}
     
	function BarGo()
	{ 
	 
      if(this.Begin <this.End){
	   this.Begin++;
	   this.style.width = Math.max(2,this.Begin) +"%";
	   var rc = Math.floor(255 - (255 * (this.Begin/this.End)));
	   var op = ( 100 * (this.Begin/this.End))/100 + 0.25;
	   op = Math.min(1,op);
	  
	   this.parentNode.parentNode.style.opacity = op;
	   //this.parentNode.parentNode.style.color = "rgb(" + rc + "," + rc +"," + rc +")";
	   setTimeout("document.getElementById('"+this.id+"').Go()",10)

	  }
	   else{   this.style.width = Math.max(2,this.End) +"%";}
	}
}