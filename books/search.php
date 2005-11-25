<?php

include($_SERVER['DOCUMENT_ROOT']."/auth/connect.php");
?>
<table cellpadding=10 border=0 width=800><tr><td>
<form name=fest onSubmit='loadurl("search.php?term=" + document.fest.term.value)'>
<input type=text name=term> <input type="button" onclick='javascript:loadurl("search.php?term=" + document.fest.term.value)' value="Search" />
</form></td></tr></table><br>
<?php
if($_GET['term']){
$term = $_GET['term'];
print "<font color=000000>Search results for <b>$term</b></font><br><br>";
$dirss = array("Practice-Exams","Previous-Exams","Addison-Wesley","Microsoft-books","Oreilly","Sams","Linux","Uncatagorized","public-submitted");

print "<table width=800 cellpadding=0 cellspacing=0 border=0>";
		print "<tr><td width=560><b>Filename</td><td width=40 align=right><b>downloads</td><td width=60 align=right><b>Size</td><td width=100 align=right><b>Email DOC</b></td></tr>";
		
for($i=0;$i<count($dirss);$i++){
	
	$mk = "/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]";
	if ($handle = opendir($mk)) {
		
		$p=0;
		$r = 0;
		  	while (false !== ($file = readdir($handle))) {

			if((!is_dir($file)) && (preg_match("/$term/i", "$file"))){
			//&& (!preg_match("/$term/i", "$file"))
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
					print "<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>";
				}
				$dsd = md5("$dirss[$i]/$file");
				$downs = @$stream->do_query("select dw from downloads where md='$dsd'","one");
				if($downs==""){
					$downs=0;
				}
				$filext = strtolower(substr($file,strlen($file)-3,strlen($file)));
       	 		echo "<tr><td width=560> <img src='images/$filext.JPG'> <a href='index.php?download=$dirss[$i]/$file'><b>".substr($file,0,70) ."... </b></a> </td><td width=40 align=right>$downs</td><td width=60 align=right>$size $sz</td><td width=100 align=right>";
				
				
				if($sz=="mb" && $size>11){
					print "too big!";
				}
				else {				
					
				print " <a href='javascript:senmail(\"$dirss[$i]/$file\")'> [ Email me this ] </a>";
				}
			
				
				print "</td></tr>";
				
			}	
			$p++;
    	}
	
    	closedir($handle);
	}
		
}
print "</table>";
}
else {
print "What, no search term?";
}
?>