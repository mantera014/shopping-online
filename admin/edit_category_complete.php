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
	color: #FFF;
	font-family: Arial, Helvetica, sans-serif;
}
.highlight {
	color:#F00;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>

<body  bgcolor="#231f20">
<table width="1000" height="515" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td width="127" height="115"><a href="index_admin.php"><img src="../images/logo.png" width="127" height="115" border="0" align="middle" ></a></td>
    <td width="884"><div align="center" valign="top"></div>
      <table width="884">
      <tr>
        <td class="text_menu"><div align="center"><strong>  .ADMIN INTERFACE. </strong></div></td>
        <td class="text_menu"><b>// USER //&nbsp; <?php echo $username?> &nbsp;// &nbsp;<a href="security_verify.php?logout">Logout</a>  &nbsp;  // &nbsp; <a href="edit_user_admin.php">Edit User <?php echo"$username"?></a>&nbsp;  //</strong>  </b></td>
      </tr>
    <tr>
      <td width="105" class="text_menu"><a href="index_admin.php"><img src="../images/logo-word.png" alt="" width="191" height="48" align="top"></a></td>
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
    <td valign="top" height="329" colspan="2"><table width="1010" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="330" class="text_menu"><div align="left"><strong>/ / Item Updated / /</strong></div></td>
        <td width="674">&nbsp;</td>
      </tr>
      <tr>
        <td>
         <table border="0">   
<?php
require "database_server_admin.php";

$post_id = mysql_real_escape_string($_POST['id']);

if(isset($_POST['submit']))
{
$category_name = cleanData(mysql_real_escape_string($_POST['name']));

editCategory($category_name);
 }
 else
 {
 echo "ERROR : Unable to Edit Category";
 }

 function cleanData($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 $data = strip_tags($data);
 return $data;
}

function editCategory($category_name)
{
include("database_server_admin.php");
$post_id = mysql_real_escape_string($_POST['id']);

$sql="UPDATE category_item SET category_name='$category_name' WHERE category_id='$post_id'";
$sql_result = mysql_query($sql, $db) or die (mysql_error());


print <<<HERE
 <text class="text_menu"><strong>Category Updated:
 <ul class="text_menu">
 <li>New Category Name: <text class="highlight"><strong>$category_name </strong></text></li>
 </br>

 <input type="button" name="back" value="back"
onClick="location.href='index_admin.php'" /></a>
 </ul>
HERE;
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

</body>
</html>
