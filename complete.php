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
      <td width="899" height="138"><div align="left">
        <table width="819" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="298" rowspan="3" align="center" valign="middle">
                 <table width="277" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><div align="left"><img src="images/logo.gif" width="331" height="110"></div>                    
                  <div align="center"></div>                    <div align="center" class="logo_font"> </div></td>
                </tr>
                </table>
            </td>
            <td width="215" rowspan="3">&nbsp;</td>
            <td width="306"><div align="right"><table width="200" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="146"><div align="right"><strong><span class="small_text">
                <br><form method="post"action="store.php?page=cart">
<button class="text_button" type="submit"><u>check out</u></button>
</form></span></strong></div></td>
                <td width="8"><div align="right"><strong><span class="small_text">|</span></strong></div></td>
                <td width="78"><div align="right"><strong><span class="small_text">
                <br><?php 
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
                </span></strong></div></td>
              </tr>
              <tr>
                <td><div align="right"><strong><span class="small_text">
                
<?php

if(isset($_SESSION["cilentId"])){
$check_id=$_SESSION["cilentId"];

	$display="SELECT * FROM cilent WHERE cilent_id=$check_id";
	$dis_query=mysql_query($display) or die(mysql_error());
		
	$usern=mysql_fetch_array($dis_query);
	$usrid=$usern["cilent_id"];
	$usrname=$usern["name"];
	
	if($check_id==$usrid){
$ITEM_sql3="SELECT *
FROM cilent
 JOIN purchase ON cilent.cilent_id = purchase.c_id WHERE cilent.cilent_id=$usrid GROUP BY c_id ASC";
$ITEM_result3 = mysql_query($ITEM_sql3, $db) or die(mysql_error());
$purchase=mysql_num_rows($ITEM_result3);
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
                </span></strong></div></td>
                <td><div align="right"><strong><span class="small_text">|</span></strong></div></td>
                <td><div align="right"><strong><span class="small_text">
                <?php

if(isset($_SESSION["cilentId"])){

print <<<HERE
<div align="right"><a href="cilent_security_verify.php?logout" class="text_button">Logout</a></div>
HERE;
}else{
print <<<HERE
	        <div align="right" class="text_button"><a href="sign_up.php" class="text_button">Sign Up</a></div>
HERE;
}
?>

                </span></strong></div></td>
              </tr>
            </table> </div></td>
          </tr>
          <tr>
            <td height="38" colspan="4"><form method="post" action="cilent_search.php">
              <div align="right">
                <input name="search" type="text"/>
                &nbsp;<input type="submit" name="submit" value="Search">
                </div>
            </form></td>
          </tr>
          <tr>
            <td height="19" colspan="4">&nbsp;</td>
            </tr>
        </table>
      </div></td>
    </tr>
    <tr>
      <td><hr></td>
    </tr>
    <tr>
      <td>
        <div align="center"><br>
        </div>
        <div align="left">
          <table width="834" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="64" valign="center"><div align="center"><a href="index.php"><img src="images/button/home.png" width="47" height="36"></a></div></td>
    <td width="167"><text class="logo_nav">
      <div align="center"><em><a href="about_us.php" style="text-decoration: none">About Us</a></em></div>
    </text></td>
    <td width="192"><text class="logo_nav">
      <div align="center"><em><a href="size_chart.php" style="text-decoration: none">Contact Us</a></em></div>
    </text></td>
    <td width="150"><text class="logo_nav">
      <div align="center"><em><a href="store.php" style="text-decoration: none">Store</a></em></div>
    </text></td>
    <td width="237"><text class="logo_nav">
      <div align="center"><em><a href="payment.php" style="text-decoration: none">Payment & Shipping</a></em></div>
    </text></td>
  </tr>
</table>
        </div>
              <div align="center"><br>
        </div>
      </p></td>
    </tr>
</table>
<table align="center">
<tr><td>&nbsp;

</td>
</tr>
</table>

<table border="0" align="center" width="900">
<tr>
<td>
<table border="1">
<tr>
<td>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="41%" valign="top"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="34%">&nbsp;</td>
        <td width="24%">&nbsp;</td>
        <td width="42%">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3"><div>
          <div>
            <div>
              <h4></h4>
            </div>
          </div>
        </div>
          <div>
            <div class="page">Thank You! your order has been placed. We will process your order within (3) working days.</div>
          </div></td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" class="page">Please view Payment &amp; Shipping Details to know how to make payment / ship product to you.</td>
        </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="page"><em>Find Us On</em></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><a href="https://www.facebook.com/fourtyfive.skateshop" target="_new"><img src="images/fb_icon_325x325.png" width="50" height="50"></a></td>
        <td align="center" class="page"><img src="images/Instagram_Icon_Large.png" width="50" height="50">
          <text style="font-size:14px">@COMPANY</text></td>
        <td align="center"><img src="images/twitter_logo.png" width="50" height="50"></td>
      </tr>
    </table>
      <div align="center"></div></td>
    <td width="4%">&nbsp;</td>
    <td width="55%"><div align="center"><img src="images/bg-sign-up.gif" width="420" height="195"></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</td>
</tr>
</table>
<?php

if(isset($_SESSION['cart'])){
	
	$sql="SELECT * FROM item WHERE id IN (";
	
	foreach($_SESSION['cart'] as $id=>$value){
	
	$sql.=$id.",";
	}
	
	if($_SESSION['cart']==null){
		$sql="SELECT * FROM item WHERE id";
	
	}else{
	$sql=substr($sql, 0, -1).") ORDER BY name ASC";
	$query=mysql_query($sql) or die(mysql_error());
		
	while($row=mysql_fetch_array($query)){
		$name=$row["name"];
		$price=$row["price"];
		$quantity=$_SESSION['cart'][$row['id']]['quantity'];
		$total[]=$_SESSION['cart'][$row['id']]['quantity'];
	}

	}

}else{

	

}


if(isset($_POST['view_cart'])){
print <<<HERE

</td>
</tr>
</table>

<table border="1" bgcolor="#FFFFFF" style="position:absolute;left:163px;top:166px;width:600px;height:203px;z-index:0;" cellpadding="0" cellspacing="0" id="Table1">
<tr >

<td style="background-color:transparent;border:0px #C0C0C0 solid;text-align:left;vertical-align:top;width:166px;height:43px;"><span class="logo"><i><strong>Cart</strong></i></span></td>
<td style="background-color:transparent;border:0px #C0C0C0 solid;text-align:left;vertical-align:top;height:43px;" ><div align="right"><a href="store.php">Close [X]</a></div></td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:149px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;">

HERE;

if(isset($_SESSION['cart'])){
	
	$sql="SELECT * FROM item WHERE id IN (";
	
	foreach($_SESSION['cart'] as $id=>$value){
	
	$sql.=$id.",";
	}
	
	if($_SESSION['cart']==null){
		$sql="SELECT * FROM item WHERE id";
		echo "Your Cart is Empty";
	}else{
	$sql=substr($sql, 0, -1).") ORDER BY name ASC";
	$query=mysql_query($sql) or die(mysql_error());
	

	
	while($row=mysql_fetch_array($query)){
		$name=$row["name"];
		$price=$row["price"];
		$quantity=$_SESSION['cart'][$row['id']]['quantity'];
		
print <<<HERE


<p>&nbsp;&nbsp;&nbsp; <text style="font-size:20px"> $name   RM $price X  $quantity</text></p>


HERE;
	}

print <<<HERE
<hr />
&nbsp;&nbsp;&nbsp;<a href="store.php?page=cart">Check Out</a>

HERE;
	}

print <<<HERE

</span></div>
</td>
</tr>
</table>

HERE;

}
}

?>
<hr>
</td>
</tr>
</table>

</body>
</html>
<? ob_flush(); ?>