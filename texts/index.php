<?php

include($_SERVER['DOCUMENT_ROOT']."/auth/connect.php");
?>
<html>
<head>
<style>

body {
background-color:#000000;
margin-left: 5px;
font-family:Georgia, "Times New Roman", Times, serif;
color:#cccccc;
font-size:12px;
margin-top:40px;
margin-left:40px;

}


h3 {
font-weight:bolder;
color:#66CC33;
font-size:16px;
padding-left:10;
}

h5 {
padding-left:0;
font-weight:500;
font-size:14px;
color:#66CC33;
}

blockquote {
padding-left:5;
}

a {
text-decoration:none;
font-family:Georgia, "Times New Roman", Times, serif;
color:#66CC00;
}

a:hover {
text-decoration:none;
font-family:Georgia, "Times New Roman", Times, serif;
color:#ffffff;
}

a:visited {
text-decoration:none;
font-family:Georgia, "Times New Roman", Times, serif;
color:#337700;
}

table,td,tr {
font-family:Georgia, "Times New Roman", Times, serif;
color:#ffffff;
font-size:12px;
}


fieldset {
  padding: 1em;
width:1000px;
border: 0px solid #000000;
  }
label {
  float:left;
  width:25%;
  margin-right:0.5em;
  padding-top:0.2em;
  text-align:right;
  font-weight:bold;
  
  }
 legend{
 
 font-weight:bolder;
color:#CCCCCC;
font-size:26px;

} 

</style>
<script language="javascript" src="ajax.js" type="text/javascript"></script>
<script language="javascript">

	function search(){
		var term = prompt("Please enter your search query","");
		loadurl("index.php?view=search&term="+term);
	}

</script>
</head>
<body>

<?php

$view = $_GET['view'];
$letter = strtolower($_GET['letter']);
$term = htmlspecialchars(strtolower($_GET['term']));
$file = $_GET['file'];
$url = $_GET['url']; 

function undo_htmlspecialchars($string)
{
	$string = preg_replace("/&amp;/i",'&',$string);
	$string = preg_replace("/&#039;/i","'",$string);
	$string = preg_replace("/&quot;/i",'"',$string);
	$string = preg_replace("/&lt;/i",'<',$string);
	$string = preg_replace("/&gt;/i",'>',$string);

	return $string;

}


switch($view){

default:
print $menu;
print "<fieldset>";
print "<legend>Texts / Documents listings </legend><hr> ";

$docs = $stream->do_query("select id,named,sized,viewsd from documents order by named asc","array");

for($i=0;$i<count($docs);$i++){

	$tmp = $docs[$i];
	$id = $tmp[0];
	$name = $tmp[1];
	$size = $tmp[2];
	$views = $tmp[3];
	$first = strtolower(substr($name,0,1));
	if("$first"!=="$pass"){
		print "<a href=\"javascript:loadurl('index.php?view=letter&letter=" .strtoupper($first) ."')\">" . strtoupper($first) . "</a> | ";
	}
	$pass = strtolower(substr($name,0,1));
}

print "<a href='javascript:search();'>Search</a><br><br><div id=\"listing\"></div></fieldset>";



break;

case "letter":

$docs = $stream->do_query("select id,named,sized,viewsd from documents order by named asc","array");

print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr><td><h3>Listing for $letter </h3><hr></td></tr></table>\n";
print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr>
<td align=left width=400><b> Name </td>
<td align=right width=150><b> Size </td>
<td align=right width=100><b> Views </td>
</tr>";

for($i=0;$i<count($docs);$i++){

	$tmp = $docs[$i];
	$id = $tmp[0];
	$name = $tmp[1];
	$size = $tmp[2];
	$views = $tmp[3];

	$first = strtolower(substr($name,0,1));
	
	if("$first"!=="$letter"){
		continue;
	}

$mkurl = rawurlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING']);
$kb = round($size /1024);
print "<tr>
<td align=left width=400><b> 
<a href=\"javascript:loadurl('index.php?view=viewfile&file=$id&url=$mkurl');\">$name</a></td>
<td align=right width=150><b> $size ($kb kb)</td>
<td align=right width=100><b> $views </td>
</tr>";
			
}
print "</table>";

break;


case "search":

$docs = $stream->do_query("SELECT id,named,sized,viewsd FROM `documents` WHERE `contentd` LIKE '%$term%'","array");

print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr><td colspan=3><h3>Search results for $term </h3><hr></td></tr></table>\n";
print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr>
<td align=left width=400><b> Name </td>
<td align=right width=150><b> Size </td>
<td align=right width=100><b> Views </td>
</tr>";

for($i=0;$i<count($docs);$i++){

	$tmp = $docs[$i];
	$id = $tmp[0];
	$name = $tmp[1];
	$size = $tmp[2];
	$views = $tmp[3];

$mkurl = rawurlencode("http://".$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME']."?".$_SERVER['QUERY_STRING']);

$kb = round($size /1024);

print "<tr>
<td align=left width=400><b> 
<a href=\"javascript:loadurl('index.php?view=viewfile&file=$id&url=$mkurl');\">$name</a></td>
<td align=right width=150><b> $size ($kb kb)</td>
<td align=right width=100><b> $views </td>
</tr>";
			
}
print "</table>";

break;


case "viewfile";

$docs = $stream->do_query("SELECT named,contentd FROM `documents` WHERE `id` = '$file'","array");

if($_GET['letter']){
	$url = $url . "&letter=" .$_GET['letter'];
}

if($_GET['term']){
	$url = $url . "&term=" .$_GET['term'];
}

$term = $_GET['term'];

for($i=0;$i<count($docs);$i++){

	$tmp = $docs[$i];
	$name = $tmp[0];
	if($_GET['term']){
		$content = preg_replace("/$term/i","<font style='background-color:#cc3333'>$term</font>",rawurldecode($tmp[1]));
	}
	else {
		$content = rawurldecode($tmp[1]);
	}
	
	
print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr><td colspan=3><h3>Viewing file $name</h3><hr></td></tr></table>\n";	
	
print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr>
<td align=left width=650><a href=\"javascript:loadurl('$url')\"> << Back</a></td></tr></table><br><br>";	
	
print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr>
<td align=left width=650>".nl2br($content)."</td></tr></table><br><br>";

print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr>
<td align=left width=650><a href=\"javascript:loadurl('$url')\"> << Back</a></td></tr></table>";	
			
}


break;

}

?>