// JavaScript Document


function loadurl(dest) { 
try { 
xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP"); 
} 
catch (e) 
{ 
document.getElementById("listing").innerHTML = "There was a problem fetching the search results"; 
} 
xmlhttp.onreadystatechange = triggeredoutput; 

xmlhttp.open("GET", dest, true); 
xmlhttp.send(null); 
} 



function triggeredoutput() { 
if ((xmlhttp.readyState == 1)) { 
document.getElementById("listing").innerHTML = "<font color=000000><b>Fetching.......</b></font>"; 
} 
if ((xmlhttp.readyState == 2)) { 
document.getElementById("listing").innerHTML = "<font color=000000><b>Fetch completed........</b></font>"; 
} 
if ((xmlhttp.readyState == 3)) { 
document.getElementById("listing").innerHTML = "<font color=000000><b>Receiving results......</b></font>"; 
} 
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) { 
	document.getElementById("listing").innerHTML = xmlhttp.responseText; 
} 
}


