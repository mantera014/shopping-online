<?php

if(!isset($_SESSION))
{
session_start();
}

if(!isset($_SESSION["Secure"])||($_SESSION["Secure"] !=1)){
header("Location: error_login_admin.php");
exit();
}

?>