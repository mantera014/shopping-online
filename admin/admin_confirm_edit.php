<?php
require"security_lvl_check.php";
require "database_server_admin.php";


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
</style>
</head>

<body  bgcolor="white"><center>
<table width="1000" height="515" border="0" cellspacing="0" cellpadding="0">
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
    <td valign="top" height="329" colspan="2"><table width="991" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="329" class="text_menu"><strong>EDIT ADMIN USERNAME // PASSWORD</strong></td>
        <td width="675">&nbsp;</td>
      </tr>
      <tr>
        <td>
            <table>   
<?php

require "database_server_admin.php";

$sql="SELECT * FROM admin ";
$update_admin=mysql_query($sql, $db) or die (mysql_error());

$id_admin = mysql_real_escape_string($_POST['admin_id']);
$new_username = isset($_POST['username']) ? $_POST['username'] : null;
$new_password = isset($_POST['password']) ? $_POST['password'] : null;
$username=mysql_real_escape_string($_POST['username']);
$password = mysql_real_escape_string($_POST['password']);

$sql="UPDATE admin SET username='$username', password='$password' WHERE admin_id='$id_admin'";
$result=mysql_query($sql) or die (mysql_error());

?>
<table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" class="text_menu"><b><p>Admin Username // Password Changed.</p></b></td>
        </tr>
        <tr>
        <td width="150" class="text_menu"><b>Return to Index :</b><input type="button" name="back" value="Index"
onClick="location.href='index_admin.php'" /></a></td>
      </tr>
    </table>
</table>
         </td>
        <td>&nbsp;</td>
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
