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

while ($row=mysql_fetch_array($update_admin)) {
$id=$row["admin_id"];
$username=$row["username"];
$password=$row["password"];


{
print <<<HERE

<form id = "admin_update" method="POST" enctype="multipart/form-data" action = "admin_confirm_edit.php">
<input type="hidden" name="admin_id" value="$id">
<table width="300" height="300" border="0" cellspacing="0" cellpadding="0">
	  <td colspan="2"><table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" class="text_menu"><b>User Name :</b></td>
        <td width="227"> <div>
<input type="text" name="username" id="username" value="$username">
</div>
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" class="text_menu"><b>Password :</b></td>
        <td width="227"><div>
<input type="password" name="password" id="password" value="$password">
</div></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="400" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300" class="text_menu"><b>/ /Username & Password are both Case Sensitive.</b><br>
		<table width="120" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="60"><div>
<input type="submit" name="submit" value=" Edit ">
</div>
</form></td>
        <td width="60"><input type="button" name="back" value=" Back "
onClick="location.href='index_admin.php'" /></td>
    <p class="text_menu"><b>Click the "Edit" button to Confirm Edit Admin Information.</b></p>  </tr>
    </table><br>
	</td>
      </tr>
	  <tr>
        <td width="300" class="text_menu">  </td>
      </tr>
    </table></td>
  </tr>
    <td colspan="2"></td>
  </tr>
</table>



HERE;
}
}
?>
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
