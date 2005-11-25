<?php
$past = time() - 100;
//this makes the time in the past to destroy the cookie
setcookie(ID_my_site, $_POST['username'], $past, "/", ".feeditout.com");
setcookie(Key_my_site, $_POST['pass'], $past, "/", ".feeditout.com");
header("Location: http://www.feeditout.com/auth/login.php");





?>