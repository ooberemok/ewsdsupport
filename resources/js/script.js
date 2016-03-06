//determine a browser type
$(document).ready(function(){
    (function(){
	    var nAgt = navigator.userAgent;
		var currentPageArr = window.location.href.split("/");
		var currentPage = currentPageArr[currentPageArr.length - 1];
		//browser
		var verOffset;
		var browser;
		if((verOffset = nAgt.indexOf("MSIE")) != -1){
		    browser = "MSIE";
		}
		else if((verOffset = nAgt.indexOf("Firefox")) != -1){
		    browser = "Firefox";
		}
		else if((verOffset = nAgt.indexOf("Opera")) != -1){
		    browser = "Opera";
		}
		else if((verOffset = nAgt.indexOf("OPR")) != -1){
		    browser = "Opera";
		}
		else if((verOffset = nAgt.indexOf("Chrome")) != -1){
		    browser = "Chrome";
		}
		
		window.jscd = {
		    browser:browser,
			currentPage:currentPage
		};
        
		
    })();
    
    	
	//set date and time
	    // options - contains parameters to format date
        var options = {
            //era: '',
		    year: 'numeric',
			month: 'long',
			day: 'numeric',
			weekday: 'long',
			timezone: 'UTC',
			hour: 'numeric',
			minute: 'numeric',
			second: 'numeric'
        };
	if(jscd.browser !== "MSIE" && jscd.currentPage.indexOf("dailyalarmcp")!=-1){

		var dateTime = new Date();
        document.getElementById("time").textContent = dateTime.toLocaleString("ua",options);
	    function updateTime(){
            document.getElementById("time").textContent = new Date().toLocaleString("ua",options);
	    }
		setInterval(updateTime,1000);
	}
	else if(jscd.browser === "MSIE"&& jscd.currentPage.indexOf("dailyalarmcp")!=-1){
	    document.getElementById("time").innerText = new Date().toLocaleString("ua",options); 
	    function updateTime(){
		    document.getElementById("time").innerText = new Date().toLocaleString("ua",options); 
        }
		setInterval(updateTime,1000);
	}
    
    //load table by default
        var day = new Date().getDay();
    switch(day){
        case 0: day = "su";
		break;
		case 1: day = "mo";
		break;
		case 2: day = "tu";
		break;
		case 3: day = "we";
		break;
		case 4: day = "th";
		break;
		case 5: day = "fr";
		break;
		case 6: day = "sa";
		break;
		
	}
	
   if(jscd.currentPage.indexOf("dailyalarmcp")!=-1){
       var btn = document.getElementById(day);
	   btn.click();
   }

    
    
	
	//hover .class li a
	$('.options li a').hover(function(){$(this).addClass('selectoptions');},function(){$(this).removeClass('selectoptions')});
	
    
    /*** NAV SELECT CURRENT PAGE  ***/
	$('#nav li > a').each(function(){
        var hr = $(this).attr('href');
	    if(hr.indexOf(jscd.currentPage)!=-1 &&jscd.currentPage.indexOf(".php")!=-1){
	        $(this).addClass('selected');
                    
	    }
        else if(jscd.currentPage.indexOf(".php")==-1){
            $('#nav a[href*="index.php"]').addClass('selected');
        }
        
        
	}
	);
	$('#footer a').each(function(){
	    if($(this).attr('href').indexOf(jscd.currentPage)!=-1&&jscd.currentPage.indexOf(".php")!=-1 ){
	        $(this).addClass('selected');
	    }
        else if(jscd.currentPage.indexOf(".php")==-1){
            $('a[href*="index.php"]').addClass('selected');
            
        }
	}
	);
    

});//end ready

//ajax part for pages: dailyalarmcp, dailyalarmmp, tgrpstat.

   var mo = document.getElementById('mo');
   var tu = document.getElementById('tu');
   var we = document.getElementById('we');
   var th = document.getElementById('th');
   var fr = document.getElementById('fr');
   var sa = document.getElementById('sa');
   var su = document.getElementById('su');
   
   //add additional events on buttons to change color
   var buttons = document.getElementsByTagName('input');
   addMyEvent('click',mo,function(){this.className = 'btn-color';  removeHighlight(buttons,this);});
									
   addMyEvent('click',tu,function(){this.className = 'btn-color'; removeHighlight(buttons,this);});
   addMyEvent('click',we,function(){this.className = 'btn-color'; removeHighlight(buttons,this);});
   addMyEvent('click',th,function(){this.className = 'btn-color'; removeHighlight(buttons,this);});
   addMyEvent('click',fr,function(){this.className = 'btn-color'; removeHighlight(buttons,this);});
   addMyEvent('click',sa,function(){this.className = 'btn-color'; removeHighlight(buttons,this);});
   addMyEvent('click',su,function(){this.className = 'btn-color'; removeHighlight(buttons,this);});
   //add events on 
   
   
//remove highlight from buttons
function removeHighlight(elements,current){
    for(i=0;i<elements.length;i++){
		if(elements[i]!=current){
		    elements[i].className='';
		}
	}
}

   addMyEvent('click',mo,function(){getCpAlarms("sys/functions/cpalarm.php","mo");});
   addMyEvent('click',tu,function(){getCpAlarms("sys/functions/cpalarm.php","tu");});
   addMyEvent('click',we,function(){getCpAlarms("sys/functions/cpalarm.php","we");});
   addMyEvent('click',th,function(){getCpAlarms("sys/functions/cpalarm.php","th");});
   addMyEvent('click',fr,function(){getCpAlarms("sys/functions/cpalarm.php","fr");});
   addMyEvent('click',sa,function(){getCpAlarms("sys/functions/cpalarm.php","sa");});
   addMyEvent('click',su,function(){getCpAlarms("sys/functions/cpalarm.php","su");});	
	
//)();
	var asyncRequest;
	function getCpAlarms(url,day){
	    try{
		    
		    clearContent();
			asyncRequest = getXMLHttpRequest(); // create request object
			// register event handler
			addMyEvent('readystatechange',asyncRequest,stateChange);
			//asyncRequest.addEventListener('readystatechange',stateChange);
			asyncRequest.open( 'POST', url,true); // prepare the request
			asyncRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
           // asyncRequest.setRequestHeader("Content-length", 1);
           // asyncRequest.setRequestHeader("Connection", "close");
			asyncRequest.send( "day="+day ); // send the request
		}
		catch(exception){
		    alert("XMLHttpRequest failed." + exception.message);
		}
	}
	function stateChange(){
	if(asyncRequest.readyState !== 4){
	    document.getElementById( 'view' ).innerHTML = '<img src="resources/images/loading1.gif" width="50%" height="50%"/>';
	}
      else if ( asyncRequest.readyState == 4 && asyncRequest.status == 200 ){
	    var responseText = asyncRequest.responseText;
		var htmlPart, textPart;
		var pos = responseText.indexOf("</table>") + 8;
		htmlPart = responseText.substring(0,pos);
		textPart = responseText.substring(pos);
        
        //insert TABLE into the view div
		document.getElementById( 'view' ).innerHTML = htmlPart; // places text in contentArea
        var re = /^[1-9]+/;

        $('td').filter(function ()
        {   
           if($(this).text().match(re)){
              $(this).css({"cursor":"pointer","border-radius":"50px"});
           }
       });
       
       
       $('tr:nth-child(odd)').addClass('tbody-even');
		//document.getElementById( 'alarms' ).innerHTML = textPart;
		//process click on td
		$('td').bind('click',function(){
		  var exchange = $(this).attr('id').split("-")[0];
		  var alarm = $(this).attr('id').split("-")[1];
		  //alert(selectEvents());
		  
		  (function(){
			  var w = window.open('', '', 'width=400,height=400,resizeable,scrollbars');
			  w.document.write("<style>*{background: #34495E;color: #dd5;}</style>");
               w.document.write(selectEvents());
               w.document.close(); // needed for chrome and safari
		  })();
		  //select event for current td (exchange-alarm) from textPart
		  function selectEvents(){
		    //split string with all events by "HEADER:" value
		    var events = textPart.split("HEADER:");
			//variable to store alarms for this exchange and this alarm type
			var out="";
			//iterate over events array
			
			for(var i = 0; i < events.length; i++){
			    var val = events[i];
							   val = val.replace(/#/gi,'<br>');
			   //perform actions for this (current) exchange only (that was clicked)
			   if(val.indexOf(exchange) > -1){
			     //save only clicked type alarms
				 var end_text = '<br>END TEXT:<br><br>';
				 switch(alarm){
				   case "CRIT": if(val.indexOf('_CRIT_') > -1){ out += '<br>HEADER:' + val + end_text; }
				   break;
				   case "MAJ": if(val.indexOf("_MAJ_") > -1){ out += '\nHEADER:\n' + val + end_text; }
				   break;
				   case "CU": if(val.indexOf('_CU_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "SN": if(val.indexOf('_SN_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "MB": if(val.indexOf('_MB_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "CCNC": if(val.indexOf('_CCNC_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "CLOCK": if(val.indexOf('_CLOCK_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "DLU": if(val.indexOf('_DLU_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "EALEXCH": if(val.indexOf('_EALEXCH_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "EALDLU": if(val.indexOf('_EALDLU_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "RECOV": if(val.indexOf('_RECOV_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "OVRLD": if(val.indexOf('_OVRLD_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "SWSG": if(val.indexOf('_SWSG_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   case "AUDIT": if(val.indexOf('_AUDIT_') > -1){ out += '\n\nHEADER:' + val + end_text; }
				   break;
				   default:
				   break;
				 }
				 
			   }
			}
			
			
		    return out;
		}
		});
			
	  } // end if 
   } // end function stateChange

   // clear the content of the box
   function clearContent(){
       document.getElementById( 'view' ).innerHTML = '';
   } // end function clearContent
   
   //get XMLHttpRequest in different browsers
   function getXMLHttpRequest(){
    
	if(typeof XMLHttpRequest === "undefined"){
	   try{
	       
	       return new ActiveXObject("Msxml2.XMLHTTP.6.0");  
	   }
	   catch(e){
	       alert(e.message);
	   }
	   try{
	       
	       return new ActiveXObject("Msxml2.XMLHTTP.3.0");
	   }
	   catch(e){
	       alert(e.message);
	   }
	   try{
	       
	       return new ActiveXObject("Microsoft.XMLHTTP");
	   }
	   catch(e){
	       alert(e.message);
	   }
	   throw new Error("This browser doen't support XMLHttpRequest");
	}
	else if(XMLHttpRequest){
	   
	    return new XMLHttpRequest();
	}
  } 
   //document.getElementById('mo').addEventListener('click',function(){$('body').toggleClass('body-color');});
   
   
   //function to add event listeners in different browsers (addEventListener or attachEvent)
   function addMyEvent(event, element, func) {
     
        if (element.addEventListener){  // W3C DOM
          element.addEventListener(event,func,false);
      // }
	   }
	   else{
	      element['on'+event] = func;
	   }
      
      
	 
   }



//document.getElementById('AMTSKCRIT').addEventListener('click',function(){alert("TD CLICKED");},false);