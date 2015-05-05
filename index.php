<?php
ob_start(); 
if(!isset($_SESSION))
{
session_start();
}

require "cilent_connection.php";

$ITEM_sql="SELECT * FROM item ORDER BY id DESC";
$ITEM_result = mysql_query($ITEM_sql, $db) or die(mysql_error());

?>
<html>
<head>
<script type="text/javascript" src="Scripts/jquery-1.10.2.js"></script>
<script type="text/javascript">
	$(function(){
		
	});
		</script>
<title></title>
<style type="text/css">
.small_text {
	font-family: "Arial", Gadget, sans-serif;
	font-size:12px;
}
.big_text {
	font-family: "Arial", Gadget, sans-serif;
		font-size:40px;
	font-stretch:ultra-condensed;
}
.highlight {
	color:#F00;
	font-family: Arial, Helvetica, sans-serif;
}
.highlight_num {
	color:#F00;
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
}
.logo {
	font-family: Arial, Helvetica, sans-serif;
	font-size:38px;
	font-weight:bold;
}
.logo_font {
	font-family: Arial, Helvetica, sans-serif;
	font-size:14px;
}
.white_text {
	font-family: Arial, Helvetica, sans-serif;
	color:#FFFFFF;
	font-size:10px;
}
.code_text {
	font-family: Arial, Helvetica, sans-serif;
	font-size:10px;
	font-weight:bold;
}
.brand_text {
	font-family: Arial, Helvetica, sans-serif;
	font-size:12px;
	font-weight:bold;
}
.price_text {
	font-family: Arial, Helvetica, sans-serif;
	font-weight:bold;
	font-size:12px;
}
</style>
<link href="Scripts/nav_buttons.css" rel="stylesheet" type="text/css">
</head>

<body>
<div align="center">
  <table width="899" border="0" cellspacing="0" cellpadding="0">
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
          <tr>
            <td><table width="200" border="0" cellspacing="0" cellpadding="0">
              <tr>
              <hr>
                <td class="big_text"><i><b>LATEST</b></i></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>
            <table>
            <text style="font-family:'Arial', Gadget, sans-serif; font-size:13px">Check Out our lastest products to come out!</text>
            <?php  
$i=0;
$items=mysql_num_rows($ITEM_result);
while(($data=mysql_fetch_array($ITEM_result))&&($i<$items)){
$id=$data["id"];
$item_name=$data["name"];
$item_price=$data["price"];
$image=$data["upload"];
$filename = "admin/images/$image";
$format_price=number_format($item_price, 0, ".", ",");


if (!file_exists($filename)) {
$filename="images/default.png"; 
}
if ($image==null) {
$filename="images/default.png"; 
}
if($i<=4){
if($i%6==0){
print "<tr>";	
} 


print<<<HERE
<td>
<table>
<tr>
<td>
<td class="text_menu"><strong>
<p align="center">
<table width="150"><tr><td>
</td></tr></table><div align="center">
<form method="post" action="item_details.php">
<input type="hidden" name="post_item" value="$id">
<input type="image" src="$filename"  height="139" width="136">
</form>
</div>
<p align="left" class="code_text">CODE: <text class="highlight_num">M0$id</text></p>
<text class="price_text">$item_name <br> / /</text>
<text class="price_text">RM $format_price</text></p>
</strong>
</td>
</td>
</tr>
</table>
</td>
HERE;

$i++;
if($i%6==0){
print "</tr>";	

}
}


   }
     
 ?>
 </table>
            </td>
          </tr>
          <tr>
            <td class="small_text">&nbsp;</td>
    </tr>
          <tr>
            <td class="small_text">
<hr>
<table>
<tr >
<td class="big_text"><i><b>PROMO</b></i></td>
</tr>
<tr>
<td>
<text style="font-family:'Arial', Gadget, sans-serif; font-size:13px">We are pround to sponsor local skate talent. Check them out in our promo!</text>
</td>
</tr>
</table>
<table border="0" width="900">
<tr>
<td width="25"><center>
</center>
<br>
<hr></td>
</tr>
</table>

</td>
          </tr>
          <tr>
            <td class="small_text">&nbsp;</td>
          </tr>
          
          <tr>
            <td class="small_text">&nbsp;</td>
          </tr>
          <tr>
            <td class="small_text">&nbsp;</td>
          </tr>
          <tr>
            <td></td>
          </tr>
  </table>
  </td>
    </tr>
    <tr>
      <td></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </table>
</div>
</body>
</html>
<? ob_flush(); ?>