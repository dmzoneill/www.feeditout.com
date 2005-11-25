<?php



$fcwhost = "mysql.feeditout.com"; //216.26.131.80 
$fcwusername = "books"; 
$fcwpassword2 = ""; 
$fcwdb_name = "elearning";
$fcwdb_type = "mysql";
$path = $_SERVER['DOCUMENT_ROOT']."/auth/";


include($path."db_".$fcwdb_type.".php");
$stream = new db;
$stream->connect();

include($_SERVER['DOCUMENT_ROOT']."/auth/header.php");

ob_start();