<?php  
ob_start(); 
if(!isset($_SESSION))
{
session_start();
}

?>
<html>
<head>
<title>FORTYFIVE STORE</title>
<script type="text/javascript" src="Scripts/jquery-1.10.2.js"></script>
<script type="text/javascript">
	$(function(){
		
	});
		</script>
<style type="text/css">
.page {
	font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
	color: #000;
}
body {
	background-image: url();
	background-repeat: no-repeat;
	color: #000;
}
</style>


<style type="text/css">
body
{
   margin: 0;
   padding: 0;
   background-color: #FFFFFF;
   color: #000000;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style type="text/css">
#TabMenu1
{
   text-align: left;
   float: left;
   margin: 0;
   width: 100%;
   font-family: Arial;
   font-size: 13px;
   font-weight: normal;
  
   list-style-type: none;
   padding: 15px 0px 4px 10px;
   overflow: hidden;
}
#TabMenu1 li
{
   float: left;
}
#TabMenu1 li a.active, #TabMenu1 li a:hover.active
{
   background-color: #FFFFFF;
   color: #666666;
   position: relative;
   font-weight: normal;
   text-decoration: none;
   z-index: 2;
}
#TabMenu1 li a
{
   padding: 5px 14px 8px 14px;
   border: 1px solid #C0C0C0;
   border-top-left-radius: 5px;
   border-top-right-radius: 5px;
   background-color: #224018;
   color: #FFFFFF;
   margin-right: 3px;
   text-decoration: none;
   border-bottom: none;
   position: relative;
   top: 0;
   -webkit-transition: 200ms all linear;
   -moz-transition: 200ms all linear;
   -ms-transition: 200ms all linear;
   transition: 200ms all linear;
}
#TabMenu1 li a:hover
{
   background: #C0C0C0;
   color: #666666;
   font-weight: normal;
   text-decoration: none;
   top: -4px;
}
</style>
<style type="text/css">
#InlineFrame1
{
   border: 1px #C0C0C0 solid;
}
.text_button {
	  border: none;
   background-color: transparent;
   padding: 0;
    margin: 0;
   font-weight: bold;
    font-family: "Arial", Gadget, sans-serif;
	font-size:12px;
}

</style>

<link href="Scripts/nav_buttons.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="306">   <table width="277" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="left"><img src="images/logo.gif" width="331" height="110"></div>                    <div align="center"></div>                    <div align="center" class="logo_font"> </div></td>
                </tr>
                </table></td>
    <td width="270">&nbsp;</td>
    <td width="316"  valign="top">
	  <div align="right"><br>
	    <table width="200" border="0" cellspacing="0" cellpadding="0">
	      <tr>
	        <td width="107" valign="bottom" align="right"><br><form method="post"action="store.php?page=cart">
<button class="text_button" type="submit"><u>check out</u></button>
</form></td>
	        <td width="10" valign="middle"><div align="center">|</div></td>
	        <td width="75" align="right"><br><?php 
require"cilent_connection.php";

	
if(isset($_SESSION['cart'])){
	
	$sql="SELECT * FROM item WHERE id IN (";
	
	foreach($_SESSION['cart'] as $id=>$value){
	
	$sql.=$id.",";
	}
	
	if($_SESSION['cart']==null){
		$sql="SELECT * FROM item WHERE id";
print <<<HERE
<form method="post" action="store.php?page=item_store">
<button class="text_button" type="submit" name="view_cart"><u>cart( <text class="highlight">0</text> )</u></button>
</form>
HERE;
	}else{
	$sql=substr($sql, 0, -1).") ORDER BY name ASC";
	$query=mysql_query($sql) or die(mysql_error());
	

	
	while($row=mysql_fetch_array($query)){
		$name=$row["name"];
		$price=$row["price"];
		$quantity=$_SESSION['cart'][$row['id']]['quantity'];
		$total[]=$_SESSION['cart'][$row['id']]['quantity'];
	}


$total_item=array_sum($total);
print <<<HERE
<form method="post" action="store.php?page=item_store">
<button class="text_button" type="submit" name="view_cart"><u>cart( <text class="highlight">$total_item </text>)</u></button>
</form>
HERE;

	}

}else{

print <<<HERE
<form method="post" action="store.php?page=item_store">
<button class="text_button" type="submit" name="view_cart">cart( <text class="highlight">0 </text> )</button>
</form>
HERE;
	

}

?>
</td>
          </tr>
	      <tr>
	        <td>
<?php

if(isset($_SESSION["cilentId"])){
$check_id=$_SESSION["cilentId"];

	$display="SELECT * FROM cilent WHERE cilent_id=$check_id";
	$dis_query=mysql_query($display) or die(mysql_error());
		
	$usern=mysql_fetch_array($dis_query);
	$usrid=$usern["cilent_id"];
	$usrname=$usern["name"];
	
	if($check_id==$usrid){
$ITEM_sql="SELECT *
FROM cilent
 JOIN purchase ON cilent.cilent_id = purchase.c_id WHERE cilent.cilent_id=$usrid GROUP BY c_id ASC";
$ITEM_result = mysql_query($ITEM_sql, $db) or die(mysql_error());
$purchase=mysql_num_rows($ITEM_result);
print <<<HERE
<table>
<tr>
<td>
<div align="right"><text class="text_button">Welcome : <a href="view_purchase.php?id_u=$usrid">$usrname( $purchase )</a></div></text></td></tr>
</table>
HERE;
		
	}else{
print <<<HERE
<div align="right"><a href="cilent_login.php" class="text_button">Sign in</a></div>	
HERE;
	}
	
}
 ?>
<?php if(!isset($_SESSION["cilentId"])){
print <<<HERE
<div align="right"><a href="cilent_login.php" class="text_button">Sign in</a></div>	
HERE;
}
?>
            </td>
	        <td><div align="center">|</div></td>
<?php

if(isset($_SESSION["cilentId"])){

print <<<HERE
<td><div align="right"><a href="cilent_security_verify.php?logout" class="text_button">Logout</a></div></td>
HERE;
}else{
print <<<HERE
	        <td><div align="right" class="text_button"><a href="sign_up.php" class="text_button">Sign Up</a></div></td>
HERE;
}
?>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr>
    <td><text class="logo"></text></td>
    <td>&nbsp;</td>
      <td valign="bottom"><br><form method="post" action="cilent_search.php?page=cart">
              <div align="right">
                <input name="search" type="text" required>
                &nbsp;<input type="submit" name="submit" value="Search">
        </div>
    </form></td>
  </tr>
  <tr>
    <td colspan="3"><hr>
    <table width="900" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="64" valign="center"><div align="center"><a href="store.php"><img src="images/button/home.png" width="47" height="36"></a></div></td>
    <td width="167"><text class="logo_nav">
      <div align="center"><em>About Us</em></div>
    </text></td>
    <td width="192"><text class="logo_nav">
      <div align="center"><em>Contact Us</em></div>
    </text></td>
    <td width="150"><text class="logo_nav">
      <div align="center"><em>Store</em></div>
    </text></td>
    <td width="237"><text class="logo_nav">
      <div align="center"><em>Payment & Shipping</em></div>
    </text></td>
  </tr>
</table>
</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<table width="900" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<?php
require"cilent_connection.php";

if(isset($_POST['submit']))
{
$user_name = cleanData($_POST['name']);
$user_password = cleanData($_POST['password']);
$user_contact = cleanData($_POST['contact']);
$user_address = cleanData($_POST['address']);
$user_email = cleanData($_POST['email']);

userSignUp($user_name, $user_password, $user_contact, $user_address, $user_email);
 }
 else
 {
	showForm();
 }

 function cleanData($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 $data = strip_tags($data);
 return $data;
}

function userSignUp($user_name, $user_password, $user_contact, $user_address, $user_email)
{
include("cilent_connection.php");

$sql="INSERT INTO cilent VALUES(null, '$user_name', '$user_password', '$user_contact', '$user_address', '$user_email')";
$run_sql=mysql_query($sql) or die(mysql_error());

print <<<HERE
<table width="900">
<tr>
<td width="350">
<strong>
 <text class="logo"><i> Sign Up Complete! </i></text>
 <ul class="text_menu">
 <li>UserName  : <text class="highlight"><strong>$user_name </strong></text></li><br>
 <li>Password: <text class="highlight"><strong>$user_password </strong></text></li><br>
 <li>Contact Number   : <text class="highlight"><strong>$user_contact</strong></text></li><br>
 <li>Address   : <text class="highlight"><strong>$user_address</strong></text></li><br>
 <li>Email   : <text class="highlight"><strong>$user_email</strong></text></li><br>
  </br>
 <text class="logo_font">You may now be able to submit your purchase. <a href="store.php">Start Shopping !</a></text>
 </td>
 </tr>
 </table>

HERE;
}

function showForm(){

print <<<HERE
<form id = "Form" method="POST" enctype="multipart/form-data">
<table border="1" align="center">
<tr>
<td>
<table align="center" width="500" height="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div>
<label for="name" class="text_menu"><br><strong>UserName:</strong></label></td>
    <td><br><input type="text" name="name" id="name" required="required" size="25">
</div></td>
  </tr>
  <tr>
    <td><div>
<label for="password" class="text_menu"><br><strong>Password :</strong></label></td>
    <td><br><input type="password" name="password" id="password" autocomplete="off" required="required" size="25" >
</br></div></td>
  </tr>
    <tr>
    <td><div>
<label for="contact" class="text_menu"><br><strong>Contact Number :</strong></label></td>
    <td><br><input type="text" name="contact" id="contact" required="required" size="25">
</br></div></td>
  </tr>
    <tr>
    <td><div>
<label for="email" class="text_menu"><br><strong>Email :</strong></label></td>
    <td><br><input type="text" name="email" id="email" required="required" size="25">
</br></div></td>
  </tr>
    <tr>
    <td><div>
<label for="address" class="text_menu"><br><strong>Address :</strong></label></td>
    <td><br><input type="text" name="address" id="address" required="required" size="25">
</br></div></td>
  </tr>
  <tr>
  <td colspan="2">
  &nbsp;
  </td>
  </tr>
  <tr>
    <td>
	&nbsp;
	</td>
	<td>
<div id="Submit">
<input type="submit" name="submit" value="Sign Up">
</div>
	</td>
  </tr>
</table>
</td>
</tr>
</table>
</form>

HERE;
}


?>
</td>
</tr>
</table>
</body>
</html>
<? ob_flush(); ?>