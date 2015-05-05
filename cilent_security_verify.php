<?php

session_start();

require "cilent_connection.php";

$post_usrname = mysql_real_escape_string($_POST['username']);
$post_pwrd = mysql_real_escape_string($_POST['password']);

$sql="SELECT * FROM cilent WHERE name='$post_usrname'";

$result = mysql_query($sql, $db) or die(mysql_error());
while($row=mysql_fetch_array($result)){
$username=$row["name"];
$password=$row["password"];
$get_id=$row["cilent_id"];
}

if (isset($_POST["login"])){
	if (isset($_POST["username"])&&($post_usrname==$username) && isset($_POST["password"]) && ($post_pwrd==$password))
	{
		$_SESSION["Secure"] = 1;
		$_SESSION["cilentId"] = $get_id;
	session_write_close();
		header("Location: store.php");
	}
	else {
		$_SESSION["Secure"] = 0;
		session_write_close();
		header("Location: cilent_error_login.php");
	}
		
}
if(isset($_GET["logout"])){
	session_destroy();
header("Location: store.php");
}
