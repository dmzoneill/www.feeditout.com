<?php
// phpcs:ignoreFile
// jscpd:ignore-start

/** @psalm-suppress UnresolvableInclude, PossiblyUndefinedArrayOffset */ /** @psalm-suppress UnresolvableInclude, PossiblyUndefinedArrayOffset */ include($_SERVER['DOCUMENT_ROOT']."/auth/connect.php");
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

</head>
<body>

<?php

$view = $_GET['view'];
$term = $_GET['term'];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $file = $_GET['file'];
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $url = $_GET['url']; 


switch($view){

default:
/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ print $menu;
print "<fieldset>";
print "<div id=\"wrapper\"><legend>Serial Search</legend><hr></a>
<div id=\"search\"  style=\"padding-left:30\">";
?>
<table cellpadding=10 border=0 width=800><tr><td>
<form name=fest onSubmit='loadurl("index.php?view=search&term=" + document.fest.term.value)'>
<input type=text name=term> <input type="button" onclick='javascript:loadurl("index.php?view=search&term=" + document.fest.term.value)' value="Search" />
</form></td></tr></table>
<?php
print "</div></blockquote></div></fieldset>";	



break;

case "search":

?>
<table cellpadding=10 border=0 width=800><tr><td>
<form name=fest onSubmit='loadurl("index.php?view=search&term=" + document.fest.term.value)'>
<input type=text name=term> <input type="button" onclick='javascript:loadurl("index.php?view=search&term=" + document.fest.term.value)' value="Search" />
</form></td></tr></table>
<?php

/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $limit = 0;
/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $j=0;

/** @psalm-suppress PossiblyInvalidCast */ /** @psalm-suppress PossiblyInvalidCast */ print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr><td colspan=3><h3>Search results for $term </h3></td></tr></table>\n";
print "<table width=650 cellpadding=0 cellspacing=0 border=0><tr>";
$t = 0;

/* @phpstan-ignore-line */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ /** @psalm-suppress PossiblyUndefinedGlobalVariable */ while($start<24000){
	$start = $start + 1000;
	$limit = 1000;
	/* @phpstan-ignore-line */ /** @psalm-suppress UndefinedGlobalVariable */ /** @psalm-suppress UndefinedGlobalVariable */ $docs = $stream->do_query("SELECT * FROM `serial` LIMIT $start , $limit","array");

	for($i=0;$i<count($docs);$i++){

		$tmp = $docs[$i];
		/** @psalm-suppress UnusedVariable */ /** @psalm-suppress UnusedVariable */ $id = $tmp[0];
		$conet = rawurldecode($tmp[1]); // codespell:ignore conet
		/** @psalm-suppress PossiblyInvalidCast */ /** @psalm-suppress PossiblyInvalidCast */ $pattern = "/$term/i";
		if(preg_match($pattern,$conet)){ // codespell:ignore conet
		$t++;
		print "<tr><td colspan=2 align=left width=650><hr></td></tr>";
			print "<tr><td width=100>$t </td><td align=left width=650>$conet</td></tr>"; // codespell:ignore conet
			
		}
			
	}

}
print "<tr><td colspan=2><hr>Total of $t results </td></tr></table>";

break;

}

?>
<?php // jscpd:ignore-end ?>
