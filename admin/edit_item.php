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
        <td width="300">
        </td>
        </tr>
      <tr>
        <td colspan="2">
          <table width="1000">  
        <?php 
		
require"security_lvl_check.php";
require "database_server_admin.php";

$post_edit=mysql_real_escape_string($_POST['post_edit']);

$edit_id="SELECT * FROM item WHERE id=$post_edit";
$id_result = mysql_query($edit_id, $db) or die (mysql_error());
 
while($data=mysql_fetch_array($id_result)){
$id=$data["id"];
$item_name=$data["name"];
$item_price=$data["price"];
$item_description=$data["description"];
$image=$data["upload"];
$filename = "images/$image";
$format_price=number_format($item_price, 0, ".", ",");

if (!file_exists($filename)) {
$filename="images/default.png"; 
}
if ($image==null) {
$filename="images/default.png"; 
}

print <<<HERE

<form method="POST" enctype="multipart/form-data" action = "edit_item_complete.php">
<input type="hidden" name="id" value="$id">
<table width="500" height="400" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="183" class="text_menu"><strong>/ / ITEM ID : [[<text class="highlight"> $id</text> ]]</strong> </td>
    <td width="165">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"></br><center><img src="$filename" height="139" width="136"></center></td>
  </tr>
  <tr>
    <td colspan="2" class="text_menu"><br><center>/ / Image Source : $filename</center></br></td>
  </tr>
  <tr>
    <td colspan="2"><table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200" class="text_menu"><strong>Item Name:</strong></td>
        <td width="227"><div>
<input type="text" name="name" id="name" value="$item_name">
</div>
</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><table width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="200"  class="text_menu"><br><strong>Item Price :</strong></td>
        <td width="227"><div><br>
<input type="text" name="price" id="price" value="$item_price">
</div></td>
      </tr>
	  
    </table></td>
  </tr>
  <tr>
  <td>
  </td>
  </tr>
  <tr>
    <td colspan="2"><table width="400" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="230"  class="text_menu"><br><strong>New Image :</strong></td>
        <td width="180"><div><br>
<input type="file" name="upload" size="30" id="$image"  class="text_menu">
</div></td>
      </tr>
   <tr>
  <td>
</br>
<div>
<label for="item_detail" class="text_menu"><br><strong>Item Description :</strong></label>
</td><td><br><textarea style="width:300px; height:300px; resize:none" name="item_detail" id="item_detail">$item_description</textarea>
</br></div
  </td>
  </tr>
    <td colspan="2"><br><table align="right" width="330" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="150" align="center"><div id="submit">
<input type="submit" name="submit" value="Confirm Edit">
</div>
</form></td>
        <td width="200" align="center"><input type="button" name="back" value="Index"
onClick="location.href='index_admin.php'" /></td>
      </tr>
    </table></td>
  </tr>
</table>
<p class="text_menu"><i><strong>Click the "Confirm Update" button to edit the product information or Click the "Index" button to return to Index</strong></i></p>


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
</center>
</body>
</html>
