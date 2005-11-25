<?php
// Connects to your Database
mysql_connect("mysql.feeditout.com", "books", "") or die(mysql_error());
mysql_select_db("elearning") or die(mysql_error());

//Checks if there is a login cookie
if(isset($_COOKIE['ID_my_site']))

//if there is, it logs you in and directes you to the members page
{
$username = $_COOKIE['ID_my_site'];
$pass = $_COOKIE['Key_my_site'];
$check = mysql_query("SELECT * FROM users WHERE username = '$username'")or die(mysql_error());
while($info = mysql_fetch_array( $check ))
{
if ($pass != $info['password'])
{
}
else
{
header("Location: http://www.feeditout.com/books/");

}
}
}

//if the login form is submitted
if (isset($_POST['submit'])) { // if form has been submitted

// makes sure they filled it in
if(!$_POST['username'] | !$_POST['pass']) {
die('You did not fill in a required field.');
}
// checks it against the database

if (!get_magic_quotes_gpc()) {
$_POST['email'] = addslashes($_POST['email']);
}
$check = mysql_query("SELECT * FROM users WHERE username = '".$_POST['username']."'")or die(mysql_error());

//Gives error if user dosen't exist
$check2 = mysql_num_rows($check);
if ($check2 == 0) {
die('That user does not exist in our database.');
}
while($info = mysql_fetch_array( $check ))
{
$_POST['pass'] = stripslashes($_POST['pass']);
$info['password'] = stripslashes($info['password']);
$_POST['pass'] = md5($_POST['pass']);

//gives error if the password is wrong
if ($_POST['pass'] != $info['password']) {
die('Incorrect password, please try again.');
}

else
{

// if login is ok then we add a cookie
$_POST['username'] = stripslashes($_POST['username']);
$hour = time() + 3600;
setcookie(ID_my_site, $_POST['username'], $hour, "/", ".feeditout.com");
setcookie(Key_my_site, $_POST['pass'], $hour, "/", ".feeditout.com");

//then redirect them to the members area
header("Location: http://www.feeditout.com/books/");
}
}
}
else
{

// if they are not logged in
?>
<html>
<head>
<style>

body {
background-color:#ffffff;
margin-left: 15px;
font-family:Georgia, "Times New Roman", Times, serif;
color:#eFeFeF;
font-size:12px;
margin:0;
margin-left:0;
margin-right:0;
}

h3 {
font-weight:bolder;
color:#660000;
font-size:16px;
padding-left:0;
}

h5 {
padding-left:0;
font-weight:500;
font-size:14px;
color:#003366;
}

blockquote {
padding-left:0;
}

a {
text-decoration:none;
font-family:Georgia, "Times New Roman", Times, serif;
color:#990000;
}

a:hover {
text-decoration:none;
font-family:Georgia, "Times New Roman", Times, serif;
color:#0000ff;
}

a:visited {
text-decoration:none;
font-family:Georgia, "Times New Roman", Times, serif;
color:#ccaaaa;
}

table,td,tr {
font-family:Georgia, "Times New Roman", Times, serif;
color:#000000;
font-size:11px;
}

#wrapper {
text-align:left;
padding:0px;
}

#myvar {
background:#f2f2f2;
padding:0px;
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

<center>
<table width="100%" height=100% cellpadding="0" cellspacing="0" border=0><tr><td valign="middle">
<table width="100%" border="0" cellspacing=0 cellpadding="0">
<tr><td height=1 width=220 bgcolor=#440000> </td><td width=1 bgcolor=#440000>&nbsp;</td><td width=330> </td></tr>	
  <tr>
    <td width=50% align=right>
	
	<form action="http://www.feeditout.com/auth/login.php" method="post">
<table border="0" cellpadding="5">
<tr><td valign=top colspan=2 align="right"><h3>Login</h3></td></tr>
<tr><td valign=top align="right">Username</td><td align="right">
<input type="text" name="username" maxlength="40">
</td></tr>
<tr><td valign=top align="right">Password</td><td valign=top align="right">
<input type="password" name="pass" maxlength="50">
</td></tr>
<tr><td valign=top colspan="2" align="right">
<input type="submit" name="submit" value="Login">
</td></tr>
</table>
</form>

</td><td width=1 bgcolor=#440000></td>
    <td width=50% align=left><?php include("reg.php"); ?></td>
  </tr>
 <tr><td height=1 width=220> </td><td width=1 bgcolor=#440000>&nbsp;</td><td width=330 bgcolor=#440000> </td></tr> 
  <tr><td valign=top colspan=3><br /><br /><center>In order to access the  Books / Documents / Serials / Proxy features of this site,<br> you must register first. 
</td></tr>
	
</table>
</td></tr></table>





<?php
}

?>