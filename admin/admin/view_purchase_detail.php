<?php
require"security_lvl_check.php";
require "database_server_admin.php";

$post_id=mysql_real_escape_string($_POST['post_purchase']);


$ITEM_sql="SELECT *
FROM cilent JOIN purchase ON cilent.cilent_id = purchase.c_id WHERE c_id=$post_id";
$ITEM_result = mysql_query($ITEM_sql, $db) or die(mysql_error());

$sql_item="SELECT *
FROM purchase JOIN item ON purchase.id_product = item.id ORDER BY purchase_number ASC";
$result_item=mysql_query($sql_item, $db) or die(mysql_error());

$sql_user_admin="SELECT * FROM admin";
$run_sql= mysql_query($sql_user_admin, $db) or die(mysql_error());
$row_admin=mysql_fetch_array($run_sql);
$username=$row_admin["username"];
?>
<html>
<head>
<title>Admin Index Panel</title>
<style type="text/css">
.text_menu {
	color: black;
	font-family: Arial, Helvetica, sans-serif;
}
.highlight {
	color:#F00;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>

<body  bgcolor="white"><center>
<table width="1010" height="515" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="884"><table width="884">
      <tr>
        <td class="text_menu">&nbsp;</td>
        <td class="text_menu"><b>// USER //&nbsp; <?php echo $username?> &nbsp;// &nbsp;<a href="security_verify.php?logout">Logout</a>  &nbsp;  // &nbsp; <a href="edit_user_admin.php">Edit User <?php echo"$username"?></a>&nbsp;  //</strong>  </b></td>
      </tr>
    <tr>
      <td width="105" class="text_menu"><a href="index_admin.php"><img src="images/logo.gif" alt="" width="198" height="62" align="top"></a></td>
    <td width="700"><?php include"css_menu.php"; ?></td></tr></table></td>
  </tr>
  <tr>
    <td height="19" colspan="2"><table width="982" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="24" colspan="2" valign="middle"><hr></td>
        </tr>
      <tr>
        <td width="758" height="24" valign="middle"></td>
        <td width="224" valign="middle"><form method="post" action="admin_search.php">
<input name="search" type="text" />
<input type="submit" name="submit" value=" Search ">&nbsp;
</form></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" height="329" colspan="2"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="738" colspan="5" class="text_menu"><strong>/ / TRANSACTIONS </strong>
        </td>
        </tr>
      <tr>
        <td width="300">

        
        </td>
        </tr>
      <tr>
        <td colspan="2"><br>
          <table width="900" border="1">  
        <?php  
$data_user=mysql_fetch_array($ITEM_result);
$id=$data_user["cilent_id"];
$username=$data_user["name"];
$contact=$data_user["contact"];
$email=$data_user["email"];
$address=$data_user["address"];

print <<<HERE

<table class="text_menu" width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="4"><strong>User Info:</strong></td>
  </tr>
  <tr>
  <td colspan="4">
  &nbsp;
  </td>
  </tr>
  <tr>
    <td width="113"><strong>Name : </strong></td>
    <td width="246" colspan="3" class="highlight"><strong>$username</strong></td>
  </tr>
  <tr>
    <td><strong>E-Mail :</strong></td>
    <td colspan="3" class="highlight"><strong>$email</strong></td>
  </tr>
  <tr>
    <td><strong>Contact No :</strong></td>
    <td colspan="3" class="highlight"><strong>$contact</strong></td>
  </tr>
  <tr>
    <td><strong>Address :</strong></td>
    <td colspan="3" class="highlight"><strong>$address</strong>
	</td>
  </tr>
  <tr>
  <td>
  &nbsp;
  </td>
  <td>
  <br>
<input type="button" value="Print Transaction" onclick="window.print();" /> || <input type="button" name="back" value="Back"
onClick="location.href='view_purchase.php'" />
</td>
</tr>
  <tr>
    <td colspan="4" valign="middle"> <br /><hr />
   </td>
  </tr>
  <tr>
    <td colspan="4"><strong>Place Order Transaction:</strong></td>
  </tr>
</table>

HERE;
$totalprice=0;
while($data_item=mysql_fetch_array($result_item)){
$id_purchase=$data_item["purchase_number"];
$item_name=$data_item["name"];
$quantity_item=$data_item["quantity"];
$price=$data_item["total"];
$totalprice+=$price;

print<<<HERE
<tr>
<td width="700" class="text_menu"><strong>
<p align="left">[Track Id : <text class="highlight">PN$id_purchase</text> | <text class="highlight">$item_name</text> | Quantity : <text class="highlight">$quantity_item</text> Price : <text class="highlight">$price</text> ]
</td>
<td valign="middle"><br>
</p></td>
</tr>

HERE;
   }
print <<<HERE
<table>
<tr>
<td><strong>
<text class="text_menu">Total: RM </text><text class="highlight">$totalprice</text>
</strong>
</td>
</tr>
</table>
HERE;
 ?>
<table width="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><hr></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

 </table>
        </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="52" colspan="2"><hr></td>
  </tr>
</table>
</center>
</body>
</html>
