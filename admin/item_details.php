<?php
require"security_lvl_check.php";
require "database_server_admin.php";

$sql_user_admin="SELECT * FROM admin";
$run_sql= mysql_query($sql_user_admin, $db) or die(mysql_error());
$row_admin=mysql_fetch_array($run_sql);
$username=$row_admin["username"];
?>
?>
<html>
<head>
<title>Admin Index Panel</title>
<style type="text/css">
.text_menu {
	color: black;
	font-family: Arial, Helvetica, sans-serif;
	font-weight:bold;
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
    <td valign="top" height="329" colspan="2"><table align="center" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="738" colspan="5" class="text_menu" align="center"><strong>/ / ITEM DETAIL //</strong>
        </td>
        </tr>
      <tr>
        <td width="300">
     
        </td>
        </tr>
      <tr>
        <td align="center" colspan="2">
          <table width="750" border="0" align="center">
          <tr>  
        <?php 
		
$get_id=mysql_real_escape_string($_GET['post_item']);
$id_sql="SELECT * FROM item WHERE id='$get_id'";
$id_result=mysql_query($id_sql, $db) or die(mysql_error());

while($row_id=mysql_fetch_array($id_result)){
$item_name=$row_id["name"];
$item_price=$row_id["price"];
$item_detail=$row_id["description"];
$image=$row_id["upload"];
$filename = "images/$image";

$format_price=number_format($item_price, 0, ".", ",");


if (!file_exists($filename)) {
$filename="images/default.png"; 
}
if ($image==null) {
$filename="images/default.png"; 
}


print<<<HERE
<td align="center">
<table width="277" border="0" cellspacing="0" cellpadding="0" class="text_menu">
  <tr>
    <td align="left" colspan="3">
    <text class="text_menu">/ / ID: <text class="highlight">$get_id</text> / /</text>
    <table class="text_menu" width="289" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="95">Item Name :</td>
        <td width="188">$item_name</td>
      </tr>
      <tr>
        <td>Item Price :</td>
        <td>RM $format_price</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="102"><p align="center"><input type="button" name="back" value="Index"
onClick="location.href='index_admin.php'" /></p></td>
    <td width="87" align="center">&nbsp;<form method="post" action="edit_item.php">
<input type="hidden" name="post_edit" value="$get_id">
<input type="submit" value="Edit">
</form></td>
    <td width="96" align="center">&nbsp;<form method="post" action="delete_item.php">
<input type="hidden" name="post_delete" value="$get_id">
<input type="submit" value="Delete">
</form></td>
  </tr>
  
</td></tr></table>
<p align="center"><img src="$filename" ></p>
</td>
<td valign="top" class="text_menu"><br><br><br><br><br><br><br>
<u>Description:</u><br><br>
<textarea class="text_menu" style="width:300px; height:300px; background:transparent;border:0; resize:none" readonly>
 $item_detail
 </textarea>
</td>
<br>
</table>

HERE;

   }
     
 ?>
 </tr>
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
