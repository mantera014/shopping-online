<?php

if(!isset($_SESSION))
{
session_start();
}

if(isset($_GET['action']) && $_GET['action']=="add"){

	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		
	$sql_s="SELECT * FROM item WHERE id={$id}";
			$query_s=mysql_query($sql_s, $db) or die(mysql_error());
			
			if(mysql_num_rows($query_s)!=0){
				$row_s=mysql_fetch_array($query_s);
				
				$_SESSION['cart'][$row_s['id']]=array("quantity" => 1,
				"price" => $row_s['price'] 
				);
				
		 
		}else{
			$message="Invalid Id";
		}
		
	}
	header("Location: store.php");
}


require "cilent_connection.php";
?>
<html>
<head>
<title>FORTYFIVE STORE</title>
<script type="text/javascript" src="jquery-1.10.2.js"></script>
<script type="text/javascript">
	$(function(){
		
	});
		</script>
</head>
<body>
<table align="center">
<?php

$ITEM_sql="SELECT * FROM item ORDER BY id DESC";
$ITEM_result = mysql_query($ITEM_sql, $db) or die(mysql_error());

$i=0;
$items=mysql_num_rows($ITEM_result);
while(($data=mysql_fetch_array($ITEM_result))&&($i<$items)){
$id=$data["id"];
$item_name=$data["name"];
$item_price=$data["price"];
$image=$data["upload"];
$filename = "admin/images/$image";
$format_price=number_format($item_price, 0, ".", ",");

if (!file_exists($filename)) {
$filename="images/default.png"; 
}
if ($image==null) {
$filename="images/default.png"; 
}

if($i%5==0){
print "<tr>";	
} 


print<<<HERE
<td>
<table>
<tr>
<td>
<td class="text_menu"><strong>
<p align="center">
<table width="150"><tr><td>
</td></tr></table><div align="center">
<form method="post" action="item_details.php">
<input type="hidden" name="post_item" value="$id">
<input type="image" src="$filename"  height="139" width="136">
</form>
</div>
<p align="left" class="code_text">CODE: <text class="highlight_num">M0$id</text></p>
<text class="price_text">$item_name <br> / /</text>
<text class="price_text">RM $format_price</text></p>
<a href="store.php?page=products&action=add&id=$id">/ / Add to Cart</a>
</strong>
</td>
</td>
</tr>
</table>
</td>
HERE;

$i++;
if($i%5==0){
print "</tr>";	

}
}

if(isset($message)){
echo "<h2>$message</h2>";	
}



?>
</table>
</body>
</html>
