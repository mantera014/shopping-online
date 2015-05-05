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
.highlight {
	color:#F00;
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
    <td valign="top" height="329" colspan="2"><table width="1010" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="330" class="text_menu"><div align="left"><strong>/ / Add New Item / /</strong></div></td>
        <td width="674">&nbsp;</td>
      </tr>
      <tr>
        <td>
         <table border="0">   
<?php
require "database_server_admin.php";

if(isset($_POST['submit']))
{
$item_name = cleanData($_POST['name']);
$item_price = cleanData($_POST['price']);
$item_description = cleanData($_POST['item_description']);
$upload = isset($_POST['upload']) ? $_POST['upload'] : null;

addItem($item_name,$item_price, $item_description, $upload);
 }
 else
 {
	showForm();
 }

function inspectUpload(){
if (isset($_FILES['upload'])) {
$upload = isset($_POST['upload']) ? $_POST['upload'] : null;
$allowed = array ('image/gif','image/jpeg','image/jpg','image/JPG','image/pjpeg','image/X-PNG','image/PNG', 'image/png', 'image/x-png');
if (in_array($_FILES['upload']['type'], $allowed)) {
echo '<text class="text_menu"><strong><i>Uploading Data...</i></strong></text>';

if ($_FILES['upload']['error'] > 0) {
		echo '<p class="error"><strong>Error // The file could not be uploaded: </strong>';

		switch ($_FILES['upload']['error']){
			case 1:
				print ' <p class="highlight"><strong>Error : The file exceeds the upload_max_filesize setting in php.ini.</strong></p>';
				break;
			case 2:
				print ' <p class="highlight"><strong>Error : The file exceeds the MAX_FILE_SIZE setting in the HTML form.</strong></p>';
				break;
			case 3:
				print ' <p class="highlight"><strong>Error : No file was uploaded.</strong></p> ';
				break;
			case 4:
				print ' <p class="highlight"><strong>Error : No file was uploaded.</strong></p>';
				break;
			case 6:
				print ' <p class="highlight"><strong>Error : No temporary folder was available.</strong></p>';
				break;
			case 7:
				print '<p class="highlight"><strong>Error : Unable to write to the disk.</strong></p>';
				break;
			case 8:
				print ' <p class="highlight"><strong>Error : File upload stopped.</strong></p>';
				break;
			default:
				print ' <p class="highlight"><strong>Error : A system error occurred.</strong></p>';
				break;
		}
	}


	if (move_uploaded_file ($_FILES['upload']['tmp_name'], "images/{$_FILES['upload']['name']}")){
	echo '<p class="text_menu"><em>The file has been uploaded! </em></p>';
  $upload="{$_FILES['upload']['name']}";
  echo "<p class='highlight'><i><strong>$upload</strong></i></p>";
	    }

	    } else { 
		    echo '<p class="highlight"><strong>Error : Wrong Format Image Type.</strong></p>';

			print '</strong></p>';
	}
	if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name']) ) {
		echo '<p class="highlight"><strong>Item Uploaded.</strong><br><br>';
		unlink ($_FILES['upload']['tmp_name']);
	}
return $upload;
}
}

 function cleanData($data){
 $data = trim($data);
 $data = stripslashes($data);
 $data = htmlspecialchars($data);
 $data = strip_tags($data);
 return $data;
}

function addItem($item_name,$item_price,$item_description)
{
include("database_server_admin.php");
$upload=inspectUpload();
$sql="INSERT INTO item VALUES(null,'$item_name', '$item_price','$item_description','$upload')";
$result=mysql_query($sql) or die(mysql_error());
$filename = "images/$upload";


if ($upload==null) {
$filename="images/default.png"; 
}
print <<<HERE
<table width="900">
<tr>
<td width="350">
<strong>
 <text class="text_menu">/ / Item $item_name added to Database:</text>
 <ul class="text_menu">
 <li>Item Name: <text class="highlight"><strong>$item_name </strong></text></li>
 <li>Item Price (RM)        : <text class="highlight"><strong>$item_price</strong></text></li>
  </br>
 <img src="$filename" height="139" width="136"> </br></br><text class="text_menu">Image File   : </text><strong>$upload</strong>
 </strong>
 </br>
 </td>
 <td width="50">
 <div style="border-left:1px solid #fff;height:300px"></div>
 </td>
 <td width="500" valign="top"><br><br>
 <strong><text class="text_menu">Item Description        :</tex> </strong><text class="highlight"><strong><br>$item_description</strong></text><br><br>
 <input type="button" name="back" value="back"
onClick="location.href='index_admin.php'" /></a>
 </ul>
 </td>
 </tr>
 </table>

HERE;
}

function showForm(){

print <<<HERE
<form id = "Form" method="POST" enctype="multipart/form-data">
<table width="500" height="200" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div>
<label for="name" class="text_menu"><br><strong>Item Name:</strong></label></td>
    <td><br><input type="text" name="name" id="name" required="required" size="25">
</div></td>
  </tr>
  <tr>
    <td><div>
<label for="price" class="text_menu"><br><strong>Item Price (RM) :</strong></label></td>
    <td><br><input type="text" name="price" id="price" required="required" size="25">
</br></div></td>
  </tr>
  <tr>
  <tr>
    <td><div>
<label for="upload" class="text_menu"><br><strong>Item Image: </strong></label></td>
    <td><br><input type="file" name="upload" size="30" id="upload" class="text_menu">
<br>
</div></td>
  </tr>
  <tr>
    <td colspan="2" class="highlight">&nbsp;</td>
  </tr>
     <tr>
    <td><div>
<label for="item_description" class="text_menu"><br><strong>Item Description :</strong></label>
</td><td><br><textarea style="width:300px; height:300px" name="item_description" id="item_description" required="required"></textarea>
</br></div></td>
  </tr>
    <td>&nbsp;</td>
    <td></br><div id="Submit">
<input type="submit" name="submit" value="Submit">
</div></td>
  </tr>
</table>
</form>

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
</center>
</body>
</html>
