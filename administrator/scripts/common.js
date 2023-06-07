
 var ColorScheme = "#6633FF,#FFFF00,#FF6600,#FF0000,#99CC66,#66CC00,#6600FF,#FFCCCC,#CCFF66,#FFFF99,#66CCFF,#CC0000,#669900,#FF9900,#333399";
 ColorScheme = ColorScheme.split(",")

 function RenderTable(ID)
 {
  if(document.getElementById(ID))
  {
   var DataString= new Array();
   var tbd = document.getElementById(ID).getElementsByTagName("tbody")[0];
   for(var r=0;r<tbd.rows.length;r++)
   {
    DataString[r] = new Array();
   	DataString[r][0] =  tbd.rows[r].cells[0].innerHTML;
	DataString[r][1] =  tbd.rows[r].cells[1].innerHTML;
	DataString[r] = DataString[r].join(":");
   }
   DataString = DataString.join(",");
   if(document.body.getBoundingClientRect){ yhWriteChart(ID,document.getElementById(ID).offsetWidth,DataString);}
   else if(document.getBoxObjectFor){yhWriteBar(ID,document.getElementById(ID).offsetWidth,DataString);}
	
  }

 }
