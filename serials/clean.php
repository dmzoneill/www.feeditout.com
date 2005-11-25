<?php



$_SERVER['DOCUMENT_ROOT']."/auth/";

print "something";

$limit = 0;
$j=0;


while($start<24000){
$start = $start+1000;
$limit = 1000;
$docs = $stream->do_query("SELECT contents FROM `serialz` limit $start,$limit","array");


for($i=0;$i<count($docs);$i++){
if($j>22277){
break;
}

	$tmp = $docs[$i];	
	$conet = htmlspecialchars(rawurldecode($tmp[1]));
	$stream->do_query("insert into serial values('','$conet')","one");
		print $mm . "<br>";
		$j++;

			
}
}


?>