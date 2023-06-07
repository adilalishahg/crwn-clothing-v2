     var Dom = {
        get: function(el) {
          if (typeof el === 'string') {
            return document.getElementById(el);
          } else {
            return el;
          }
        },
        add: function(el, dest) {
          var el = this.get(el);
          var dest = this.get(dest);
          dest.appendChild(el);
        },
        remove: function(el,e2) {
          var el = this.get(el);
          var e2 = this.get(e2);		  
          el.parentNode.removeChild(el);
          e2.parentNode.removeChild(e2);		  
        }
      };
      var Event = {
        add: function() {
          if (window.addEventListener) {
            return function(el, type, fn) {
             // alert(el);
              //alert(type);
              //alert(fn);
			 // return false;
			  Dom.get(el).addEventListener(type, fn, false);
            };
           } else if (window.attachEvent) {
            return function(el, type, fn) {
              var f = function() {
                fn.call(Dom.get(el), window.event);
              };
              Dom.get(el).attachEvent('on' + type, f);
            };
          }
        }()
      };
      Event.add(window, 'load', function() {
		var i = 0;
        Event.add('add-element', 'click', function() {

         var el = document.createElement('span');
         var e2 = document.createElement('a');	
 
          e2.innerHTML = 'Remove';

		  el.innerHTML += "<br>Name:&nbsp;&nbsp; <input type='text' name='subprd[]' value=''><br>";
		  el.innerHTML += "Large:&nbsp;&nbsp; <td><input type='file' name='file2[]' size='30'>(Image Size: 355px × 158px)<br>";
		  el.innerHTML += "Create Thumb :&nbsp;&nbsp;&nbsp;<input type='checkbox' name='createThumb2[]' value='on'/>Yes&nbsp;<input type='checkbox' name='createThumb2[]' value='off'/>No<br />";
          el.innerHTML += "Thumb:  <input type='file' name='Tfile2[]' size='30'>(Image Size: 113px × 54px)<br>";
		  //el.innerHTML += e2.innerHTML;
          el.innerHTML +=  "<hr>";
		  
		  Dom.add(e2, 'content');
          Dom.add(el, 'content');

          Event.add(e2, 'click', function(e) {
			//var tempId = 'remId'+ ++i;							  
			Dom.remove(el,e2);
          });
        });
      });