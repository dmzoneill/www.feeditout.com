<?php

include("connect.php");



$dirss = array("Practice-Exams","Previous-Exams","Addison-Wesley","Microsoft-books","Oreilly","Sams","Linux","Uncatagorized","public-submitted");

		
for($i=0;$i<count($dirss);$i++){
	print "<h4>$dirss[$i]</h4>";
	$mk = "/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]";
	if ($handle = opendir($mk)) {
	  	while (false !== ($file = readdir($handle))) {
			if(!is_dir($file)){
				$new = trim(preg_replace("/[^.a-zA-Z0-9s]/", " ", $file));		
	
	rename("/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$file", "/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$new");
	
				
			}	
		}
	   	closedir($handle);
	}
		
}

		
for($i=0;$i<count($dirss);$i++){
	$mk = "/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]";
	if ($handle = opendir($mk)) {
	  	while (false !== ($file = readdir($handle))) {
			if(!is_dir($file)){
				$new = trim(preg_replace("/[^.a-zA-Z0-9s]/", " ", $file));
				
				
	
	//if(preg_match("/microsoft/i", "$file")){
	//	shell_exec("mv \"/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$file\" //\"/home/.ornice/proxykillah/feeditout.com/books/Microsoft-books/$file\" ");
//		print " moved $file<br>";
//	}
	
	if(preg_match("/reilly/i", "$file")){
		shell_exec("mv \"/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$file\" \"/home/.ornice/proxykillah/feeditout.com/books/Oreilly/$file\" ");
		print " moved $file<br>";
	}
	
	if(preg_match("/Sams/i", "$file")){
		shell_exec("mv \"/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$file\" \"/home/.ornice/proxykillah/feeditout.com/books/Sams/$file\" ");
		print " moved $file<br>";
	}
	
	if(preg_match("/linux/i", "$file")){
		shell_exec("mv \"/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$file\" \"/home/.ornice/proxykillah/feeditout.com/books/Linux/$file\"");
		print " moved $file<br>";
	}
	
		if(preg_match("/unix/i", "$file")){
		shell_exec("mv \"/home/.ornice/proxykillah/feeditout.com/books/$dirss[$i]/$file\" \"/home/.ornice/proxykillah/feeditout.com/books/Linux/$file\"");
		print " moved $file<br>";
	}
					
			}	
		}
	   	closedir($handle);
	}
		
}


?>