<?php
require"security_lvl_check.php";
require "database_server_admin.php";

$ITEM_sql="SELECT * FROM item ORDER BY id ASC";
$ITEM_result = mysql_query($ITEM_sql, $db) or die(mysql_error());

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
      <tr><?php $num_items=mysql_num_rows($ITEM_result);?>
        <td width="738" colspan="5" class="text_menu">
        </td>
        </tr>
      <tr>
        <td width="300">
        </td>
        </tr>
      <tr>
        <td colspan="2">
          <table width="1000">  
       <?php
require"security_lvl_check.php";
require "database_server_admin.php";

$get_id=mysql_real_escape_string($_POST['post_id']);
$sql="SELECT * FROM item WHERE category_id = '$get_id'";

$run=mysql_query($sql) or die (mysql_error());
while ($row=mysql_fetch_array($run)){
$item_id=$row["id"];
$item_name=$row["name"];
$item_price=$row["price"];
$image=$row["upload"];

print <<<HERE
<p class="text_menu"><b> The data has been Deleted : <text class="highlight">$item_id</text> / / <text class="highlight">$item_name</text> / / <text class="highlight">$item_price</text> </b></p>
HERE;

}



$del="DELETE FROM item WHERE category_id = $get_id";
$delete_result=mysql_query($del) or die (mysql_error());


?>
 <input type="button" name="index" value="Index"
onClick="location.href='index_admin.php'" />
 </table>
        </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="52" colspan="5"><hr></td>
  </tr>
</table>
</center>
</body>
</html>
