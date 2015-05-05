<html>
<head>
	<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	<meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1' />
	<link rel='stylesheet' type='text/css' href='../Scripts/styles.css'/>
	<script src='../Scripts/jquery-1.9.1.min.js'></script>
	<script type='text/javascript' src='../Scripts/menu_jquery.js'></script>
    
     <style type="text/css">
.text_button {
	  border: none;
   background-color: transparent;
   padding: 0;
    margin: 0;
	width:150;
	height:25;
	vertical-align:bottom;
	alignment:left;
	  font-size: 15px;
   font-weight: bold;
    font-family: Helvetica, sans-serif;
}
</style>
</head>
<body>
<div id='cssmenu'>
<ul>
   <li class='active'><a href='index_admin.php'><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Products</span></a>
      <ul valign="bottom">
        
<?php
require"security_lvl_check.php";
require "database_server_admin.php";

$item_sql="SELECT * FROM item";
$item_result = mysql_query($item_sql, $db) or die(mysql_error());

while($row_item=mysql_fetch_array($item_result)){
$id_item=$row_item["id"];
$name=$row_item["name"];

print <<<HERE
 <li><a href="item_details.php?post_item=$id_item"><span>$name</span></a></li>
HERE;
}
print <<<HERE
 <li  class='last'></li>
 </ul>
 </li>
HERE;

   
  
  

?>                      
   </li>
   <li><a href='add_item.php'><span>Add Product</span></a></li>
   <li><a href='view_purchase.php'><span>View Purchase</span></a></li>
       <li class='last'><a href='../index.php' target="_new"><span>[ View Store ]</span></a></li>
   
</ul>
</div>
</body>
</html>