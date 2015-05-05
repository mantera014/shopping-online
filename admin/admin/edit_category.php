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

$post_edit=mysql_real_escape_string($_POST['id_category']);

$edit_id="SELECT * FROM category_item WHERE category_id=$post_edit";
$id_result = mysql_query($edit_id, $db) or die (mysql_error());
 
while($data=mysql_fetch_array($id_result)){
$id=$data["category_id"];
$category_name=$data["category_name"];

print <<<HERE

<form method="POST" enctype="multipart/form-data" action = "edit_item_complete.php">
<input type="hidden" name="id" value="$id">
<table width="300" height="100" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="183" class="text_menu"><strong>/ / Category ID : [[<text class="highlight"> $id</text> ]]</strong> </td>
    <td width="165">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" class="text_menu"><strong>Item Name:</strong></td>
        <td width="227"><div>
<input type="text" name="name" id="name" value="$category_name">
</div>
</td>
      </tr>
    </table></td>
  </tr>
    </table></td>
  </tr>
    <td colspan="2"><table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150"><div id="submit">
<input type="submit" name="submit" value="Update">
</div>
</form></td>
        <td width="200"><input type="button" name="back" value="Index"
onClick="location.href='index_admin.php'" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<p class="text_menu"><i><strong>Click the "Update" button to edit the category information<br> or Click the "Index" button to return to Index</strong></i></p>


HERE;

   }
     
 ?>
 </table>
        </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="52" colspan="5"><hr></td>
  </tr>
</table>

</body>
</html>
