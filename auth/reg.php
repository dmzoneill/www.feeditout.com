<?php
// Connects to your Database
mysql_connect("mysql.feeditout.com", "books", "") or die(mysql_error());
mysql_select_db("elearning") or die(mysql_error());

//This code runs if the form has been submitted
if (isset($_POST['submit'])) {

//This makes sure they did not leave any fields blank
if (!$_POST['username'] | !$_POST['pass'] | !$_POST['pass2'] ) {
die('You did not complete all of the required fields');
}

// checks if the username is in use
if (!get_magic_quotes_gpc()) {
$_POST['username'] = addslashes($_POST['username']);
}
$usercheck = $_POST['username'];
$check = mysql_query("SELECT username FROM users WHERE username = '$usercheck'")
or die(mysql_error());
$check2 = mysql_num_rows($check);

//if the name exists it gives an error
if ($check2 != 0) {
die('Sorry, the username '.$_POST['username'].' is already in use.');
}

// this makes sure both passwords entered match
if ($_POST['pass'] != $_POST['pass2']) {
die('Your passwords did not match.');
}

// here we encrypt the password and add slashes if needed
$_POST['pass'] = md5($_POST['pass']);
if (!get_magic_quotes_gpc()) {
$_POST['pass'] = addslashes($_POST['pass']);
$_POST['username'] = addslashes($_POST['username']);
}

// now we insert it into the database
$insert = "INSERT INTO users (username, password)
VALUES ('".$_POST['username']."', '".$_POST['pass']."')";
$add_member = mysql_query($insert);
?>


<h1>Registered</h1>
<p>Thank you, you have registered - you may now login</a>.</p>

<?php
}
else
{
?>


<form action="http://www.feeditout.com/auth/reg.php" method="post">
<table border="0"  cellpadding="5">
<tr><td valign=top colspan=2 align="left"><h3>Register</h3></td></tr>
<tr><td valign=top><input type="text" name="username" maxlength="60"></td><td valign=top>Username
</td></tr>
<tr><td valign=top><input type="password" name="pass" maxlength="10"></td><td valign=top>Password
</td></tr>
<tr><td valign=top><input type="password" name="pass2" maxlength="10"></td><td valign=top>Confirm Password
</td></tr>
<tr><td colspan=2 valign=top><input type="submit" name="submit" value="Register"></td></tr> </table>
</form>

<?php
}
?>