<?php

include($_SERVER['DOCUMENT_ROOT']."/auth/connect.php");

if($_GET['download']){
$file = md5($_GET['download']);
$do = $stream->do_query("select * from downloads where md='$file'","array");

	if(count($do)>1){
		$upd = @$stream->do_query("select dw from downloads where md='$file'","one");
		$dws = $upd + 1;
		$upd = @$stream->do_query("update downloads set dw='$dws' where md='$file'","one");
		$file = rawurldecode($_GET['download']);
		if(stristr($file,"..")){
			die("hacking attempt detected");
		}
		header("Location: http://www.feeditout.com/books/" .$file);
	}

	else {
		$insert = @$stream->do_query("insert into downloads values('','$file','1')","one");
		$file = rawurldecode($_GET['download']);
		if(stristr($file,"..")){
			die("hacking attempt detected");
		}
		header("Location: http://www.feeditout.com/books/" . $file);
	}
}

if(($_GET['email']) && ($_GET['file'])){

include("mail_attachment.php");



$file = md5($_GET['file']);
$do = $stream->do_query("select * from downloads where md='$file'","array");

	if(count($do)>1){
		$upd = @$stream->do_query("select dw from downloads where md='$file'","one");
		$dws = $upd + 1;
		$upd = @$stream->do_query("update downloads set dw='$dws' where md='$file'","one");
	}

	else {
		$insert = @$stream->do_query("insert into downloads values('','$file','1')","one");
	}

$file = $_GET['file'];	
if(stristr($file,"..")){
		die("hacking attempt detected");
		}

mail_attachment("billgates@microsoft.com", $_GET['email'],"Your Requested book", "Please see the attached file you requested",
"/home/.ornice/proxykillah/feeditout.com/books/$file");

print "<script language=javascript>\n";
print "alert(\"You should receive an email shortly with the requested book attached!\");";
print "</script>\n";

}


if($_FILES['uploadedfile']){
// Where the file is going to be placed 
$name = basename($_FILES['uploadedfile']['name']);
$ext = substr($name,strlen($name) -3, strlen($name));

if(($ext=="pdf") || ($ext=="rar") || ($ext=="chm")){
$fpath = "/home/.ornice/proxykillah/feeditout.com/books/public-submitted/".basename($_FILES['uploadedfile']['name']);
$tpath = $_FILES['uploadedfile']['tmp_name'];
	if(move_uploaded_file($tpath, $fpath)) {
    	echo "<h5>The file ".  basename( $_FILES['uploadedfile']['name']). " has been received successfully</h5>";
	} else{
    	echo "<h5>There was an error uploading the file, please try again!<br>". $fpath ."</h5>".$tpath;
		print_r($_FILES);
	}
}
else {
	print "<h5>We only accept pdf, rar, or chm</h5>";
}

}

ob_start();

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

<script language=javascript>
function senmail(file){

var email = prompt("Please enter your email address","");

document.location.href="index.php?email="+email+"&file="+file;

}

function switchMenu(obj) {
var el = document.getElementById(obj);
if ( el.style.display != 'none' ) {
el.style.display = 'none';
}
else {
el.style.display = '';
}
}

function $() {
var elements = new Array();
for (var i = 0; i < arguments.length; i++) {
var element = arguments[i];
if (typeof element == 'string')
element = document.getElementById(element);
if (arguments.length == 1)
return element;
elements.push(element);
}
return elements;
}

function collapseAll(objs) {
var i;
for (i=0;i<objs.length;i++ ) {
objs[i].style.display = 'none';
}
}
function pageLoad() {
collapseAll($('Practice-Exams','Previous-Exams','Addison-Wesley','Microsoft-books','Oreilly','Sams','Linux','Uncatagorized','public-submitted','upload','icons','search'));
}




</script>
<script language="javascript" src="ajax.js" type="text/javascript"></script>

</head>
<body onLoad="pageLoad()">
<?php 

print $menu;
print "<fieldset><legend>Books</legend><hr><br><br>";
$totalsize = 0;
$totalbooks = 0;

$dirss = array("Practice-Exams","Previous-Exams","Addison-Wesley","Microsoft-books","Oreilly","Sams","Linux","Uncatagorized","public-submitted");

for($i=0;$i<count($dirss);$i++){
	if($i==0){
		print "<h3>Microsoft Certified Professional Related</h3>";
	}
	if($i==2){
		print "<h3>MISC Reading Materials</h3>";
	}

	print "<div id=\"wrapper\"><blockquote><a onclick=\"switchMenu('$dirss[$i]');\" title=\"Switch the Menu\" href='#'>>> <b>$dirss[$i]</b> </a><div id=\"$dirss[$i]\"  style=\"padding-left:30\">";
	
	$mk = "/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]";
	if ($handle = opendir($mk)) {
		print "<table width=900 cellpadding=0 cellspacing=0 border=0>";
		print "<tr><td width=560><b>Filename</td><td width=40 align=right><b>downloads</td><td width=60 align=right><b>Size</td><td width=150 align=right><b>Email DOC</b></td></tr>";
		$p=0;
		$r = 0;
		  	while (false !== ($file = readdir($handle))) {
			if($file=="index.php"){
				continue;
			}
			if(!is_dir($file)){
				$size = round(filesize("$mk/$file") / 1024);
				$r = $r+$size;
				$eta = round($size / 50); 
				$sz = "kb";
				if($size>1024){
					$size = round($size / 1024);
					$sz = "mb";
				}
				$tm = "secs";
				if($eta>60){
					$eta = round($eta / 60);
					$tm = "mins";
				}
				if(($p>0) && ($p%10<1)){
					print "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				}
				$dsd = md5("$dirss[$i]/$file");
				$downs = @$stream->do_query("select dw from downloads where md='$dsd'","one");
				if($downs==""){
					$downs=0;
				}
				$filext = strtolower(substr($file,strlen($file)-3,strlen($file)));
       	 		echo "<tr><td width=560> <img src='images/$filext.gif'> <a href='index.php?download=$dirss[$i]/$file' title=\"$file\"><b>".substr($file,0,70) ."... </b></a> </td><td width=40 align=right>$downs</td><td width=60 align=right>$size $sz</td><td width=150 align=right>";
				if($sz=="mb" && $size>11){
					print "too big!";
				}
				else {				
					
				print " <a href='javascript:senmail(\"$dirss[$i]/$file\")'> [ Email me this ] </a>";
				}
			
				print " </td></tr>";
				$p++;
			}	
    	}
		$totalbooks = $totalbooks + $p;
		$totalsize = $totalsize + $r;
		print "<tr><td colspan=4>&nbsp;</td><tr></tr><tr><td colspan=4>" .$r/1024 ." megabytes in $p files</td></tr>";
		print "</table>";
    	closedir($handle);
	}
	
	print "</div></blockquote></div>";	
}

print "<h3>Help & Options</h3>";
print "<div id=\"wrapper\"><blockquote><a onclick=\"switchMenu('upload');\" title=\"Switch the Menu\" href='#'>>> <b>Upload a book</b> </a><div id=\"upload\"  style=\"padding-left:30\">";
?> 

<table cellpadding=10 border=0 width=900><tr><td>
<h5>Submit a Book</h5> 
<form enctype="multipart/form-data" action="index.php" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
<input name="uploadedfile" type="file" /> <input type="submit" value="Upload Book" />
</form></td></tr></table>

<?php

print "</div></blockquote></div>";

print "<div id=\"wrapper\"><blockquote><a onclick=\"switchMenu('icons');\" title=\"Switch the Menu\" href='#'>>> <b>Iconography</b></a><div id=\"icons\"  style=\"padding-left:30\">";
?> 
<table width=900 cellpadding=0 border=0><tr><td>
<img src='images/rar.gif'> <a href='http://www.rarlab.com'>Winrar</a> - Compressed Archive of files<br>
<img src='images/iso.gif'> <a href='http://www.daemon-tools.cc/dtcc/download.php'>Daemon Tools</a> - CD Image<br>
<img src='images/pdf.gif'> <a href='http://www.foxitsoftware.com/downloads/'>Foxit Reader</a> - PDF document format<br>
<img src='images/chm.gif'> (95 / 98 , 2000, XP, Vista) - Microsoft Compiled HTML Help files<br>
</td></tr></table>
<?php

print "</div></blockquote></div>";

print "<div id=\"wrapper\"><blockquote><a onclick=\"switchMenu('search');\" title=\"Switch the Menu\" href='#'>>> <b>Search</b></a>
<div id=\"search\"  style=\"padding-left:30\">";
?>
<table cellpadding=10 border=0 width=800><tr><td>
<form name=fest onSubmit='loadurl("search.php?term=" + document.fest.term.value)'>
<input type=text name=term> <input type="button" onclick='javascript:loadurl("search.php?term=" + document.fest.term.value)' value="Search" />
</form></td></tr></table>
<?php
print "</div></blockquote></div>";	


ob_end_flush();


print "Total of " .round((($totalsize/1024)/1024),2) ." gigs in $totalbooks books";
?>


</fieldset>
<br>
</body>
</html>