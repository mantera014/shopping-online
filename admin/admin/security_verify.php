<?php

session_start();

require "database_server_admin.php";

$post_usrnamex = mysql_real_escape_string($_POST['username']);
$post_pwrdx = mysql_real_escape_string($_POST['password']);

$post_usrname = trim($post_usrnamex);
$post_pwrd = trim($post_pwrdx);

$sql="SELECT * FROM admin WHERE username='$post_usrname'";

$result = mysql_query($sql, $db) or die(mysql_error());
while($row=mysql_fetch_array($result)){

$username=$row["username"];
$password=$row["password"];

}

if (isset($_POST["login"])){
	if (isset($_POST["username"])&&($post_usrname==$username) && isset($_POST["password"]) && ($post_pwrd==$password))
	{
		$_SESSION["Secure"] = 1;
	}
	else {
		$_SESSION["Secure"] = 0;
	}
		session_write_close();
		header("Location: index_admin.php");
}
if(isset($_GET["logout"])){
	session_destroy();
header("Location: logout_admin.php");
}
