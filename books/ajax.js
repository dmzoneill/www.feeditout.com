// JavaScript Document


function loadurl(dest) { 
try { 
xmlhttp = window.XMLHttpRequest?new XMLHttpRequest(): new ActiveXObject("Microsoft.XMLHTTP"); 
} 
catch (e) 
{ 
document.getElementById("search").innerHTML = "There was a problem fetching the search results"; 
} 
xmlhttp.onreadystatechange = triggeredoutput; 

xmlhttp.open("GET", dest, true); 
xmlhttp.send(null); 
} 



function triggeredoutput() { 
if ((xmlhttp.readyState == 1)) { 
document.getElementById("search").innerHTML = "<b>Searching.......</b>"; 
} 
if ((xmlhttp.readyState == 2)) { 
document.getElementById("search").innerHTML = "<b>Search completed........</b>"; 
} 
if ((xmlhttp.readyState == 3)) { 
document.getElementById("search").innerHTML = "<b>Receiving results......</b>"; 
} 
if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) { 
	document.getElementById("search").innerHTML = xmlhttp.responseText; 
} 
}


