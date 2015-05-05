<?php
ob_start(); 
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
	font-weight:bold;
}
.highlight {
	color:#F00;
	font-family: Arial, Helvetica, sans-serif;
}
</style>
</head>

<body  bgcolor="white"><center>
<table class="text_menu" width="1000" height="515" border="0" cellspacing="0" cellpadding="0">
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
    <td valign="top" height="329" colspan="2"><table width="1010" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="330" class="text_menu"><div align="left"><strong> Add New Item</strong></div></td>
        <td width="674">&nbsp;</td>
      </tr>
      <tr>
        <td>
         <table border="0">   
<?php
require "database_server_admin.php";

if(isset($_POST['submit']))
{
$category_nme = cleanData($_POST['post_category']);
include("admin_dbserver_info.php");
$sql="INSERT INTO category_item VALUES(null,'$category_nme')";
$result=mysql_query($sql) or die(mysql_error());
header("Location: add_category.php");
 }
 else
 {
	
print <<<HERE
<form id = "Form" method="POST" enctype="multipart/form-data">
<table width="500" height="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="middle" class="text_menu"><div>
<label for="category"><strong>Category Item Name:</strong></label></td>
    <td><input type="text" name="post_category" required="required" size="25">
</div><br></br>
<div id="Submit">
<input type="submit" name="submit" value="Submit">
</div></td>
  </tr>
</table>
</form>
HERE;

 }

 function cleanData($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 $data = strip_tags($data);
 return $data;
}

$view_category="SELECT * FROM category_item";
$category_result= mysql_query($view_category, $db) or die(mysql_error());
$num_category=mysql_num_rows($category_result);	
print <<<HERE
<center>
<table>
<tr>
<td width="450" class="text_menu" >
<p><u>Category Name</u> (<text class="hightlight"> $num_category </text>)</p>
</td>
</tr>
</table>
</center>
HERE;
while($row=mysql_fetch_array($category_result)){
	$id_category=$row["category_id"];
	$name_category=$row["category_name"];

	
	
print <<<HERE
<tr>
<td>
<table class="text_menu" align="center" border="1" width="800">
<tr>
 <td width="400"><b>$name_category</b><td>
 <td width="400">
 <table class="text_menu"width="400" border="0" cellspacing="0" cellpadding="0">
  <tr><br>
    <td valign="middle">
	<form method="post" action="add_category.php">
<input type="hidden" name="id_category" value="$id_category">
 || <button type="submit" name="category_delete">Delete Category</button>  ||</form></td>
    <td valign="middle"><form method="post" action="edit_category.php">||
<input type="hidden" name="id_category" value="$id_category"> 
<button type="submit" name="category_edit">Edit Category</button> ||
</form></td>
  </tr>
</table>
 </td>
 </tr>
 </table>
</td>
</tr>

HERE;
}


if(isset($_POST['category_delete'])){

$id_post=mysql_real_escape_string($_POST['id_category']);

$x_id="SELECT * FROM item WHERE category_id='$id_post'";
$x_result= mysql_query($x_id, $db) or die(mysql_error());
$row_x=mysql_fetch_array($x_result);

$id_post_y="SELECT * FROM category_item WHERE category_id='$id_post'";
$y_result= mysql_query($id_post_y, $db) or die(mysql_error());
$row_y=mysql_fetch_array($y_result);

$menu_id=$row_x["category_id"];
$menu_name=$row_y["category_name"];


if($menu_id==NULL){
$delete_id="DELETE FROM category_item WHERE category_id = '$id_post'";
$delete_id_result=mysql_query($delete_id) or die (mysql_error());

header("Location: add_category.php");

}elseif(isset($menu_id)==$id_post){

print <<<HERE
<table align="center">
<tr>
<td class="text_menu"><b>
Error: \n
Cannot delete category: <text class="highlight"><i>$menu_name</i></text>  , item(s) link to category.
<br>Delete or change item category to proceed to delete category
<br>
<br>
Do you wish delete all item in category?
<form method="post" action="delete_category_item.php"><br>
<input type="hidden" name="id_category" value="$menu_id">
<button type="submit" name="delete_all">Delete All Item</button>
</form>
</b>
</td>
</tr>
</table>
HERE;
}else{
$delete_id="DELETE FROM category_item WHERE category_id = '$id_post'";
$delete_id_result=mysql_query($delete_id) or die (mysql_error());

header("Location: add_category.php");	
}

}
print <<<HERE
<table align="center">
<tr>
<td>
<br><text class="highlight"><strong>Press Delete Category Button to delete category,<br> Note: Category cannot be deleted if category contains item, <br>delete item(s) first before deleting categeory.</strong></text><br></td>
</tr>
</table>

HERE;


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
<? ob_flush(); ?>