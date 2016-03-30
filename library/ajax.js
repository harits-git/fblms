// created by zainal 2008
	
		var XMLHttpRequestObject = false;
		
		if (window.XMLHttpRequest){
			XMLHttpRequestObject = new XMLHttpRequest();
		} else if (window.ActiveXObject){
			XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
		}
	
		function getData(dataSource, divID){
			if(XMLHttpRequestObject){
				var obj = document.getElementById(divID);
				XMLHttpRequestObject.open("GET",dataSource);
				
				XMLHttpRequestObject.onreadystatechange = function()
				{
				
					if(XMLHttpRequestObject.readyState == 4 &&
						XMLHttpRequestObject.status == 200){
							obj.innerHTML = XMLHttpRequestObject.responseText;
					}
					else
						obj.innerHTML = '<br><br><br><table align="center"><tr bgcolor="#FFFF00"><td><b>Please wait, Still Working..</b></td></tr></table>';
				}
			XMLHttpRequestObject.send(null);
			}		
		}
	
