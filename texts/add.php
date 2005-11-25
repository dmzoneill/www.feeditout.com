<?php

die();

include("connect.php");


	$mk = "/home/.ornice/proxykillah/feeditout.com/texts/Archives - TEXTS";
	if ($handle = opendir($mk)) {
		while (false !== ($file = readdir($handle))) {
			if(!is_dir($file)){
				if($fp = fopen("$mk/$file",'r')){
					$size = filesize("$mk/$file");
					$stuff = rawurlencode(htmlspecialchars(fread($fp,999999)));
					$downs = @$stream->do_query("insert into texts values('','$file','$stuff','$size','0','0')","one");
					print "$file added<br>";
				}
				else {
					print "$file error detected<br>";
				}
			}	
		}
    	closedir($handle);
	}
	
?>	