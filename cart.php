<?php


	if(isset($_POST['submit'])){
		
	
		if(isset($_POST['quantity'])){
		foreach($_POST['quantity'] as $key=>$val){
			
		if($val==0){
			
			unset($_SESSION['cart'][$key]);	
			
		}else{
			
			$_SESSION['cart'][$key]['quantity']=$val;
		}
		
		}
		}
			header("Refresh:1"); 	
		}
	
?>
<link href="Scripts/nav_buttons.css" rel="stylesheet" type="text/css" />


<text class="logo"><i>View Chart</i></text><br />

<br />
<?php
if(isset($_POST['del_purchase'])){
					echo "<h3>Item Deleted</h3>";		
	
	}
?>
<form method="post" action="store.php?page=cart">

	<table>
    <tr>
    	<th>Name</th>
        <th>Quantity</th>
        <th>Price</th>
        <th>Item Price</th>
    </tr>
    
    <?php

				$sql="SELECT * FROM item WHERE id IN (";
				foreach($_SESSION['cart'] as $id=>$value){
				$sql.=$id.",";	
				}
				
				if($_SESSION['cart']==null){
		$sql="SELECT * FROM item WHERE id";
		echo "Your Cart is Empty";
		$totalprice="";
	}else{
	$sql=substr($sql, 0, -1).") ORDER BY name ASC";
	$query=mysql_query($sql) or die(mysql_error());
				$totalprice=0;
				while($row=mysql_fetch_array($query)){
					$subtotal=$_SESSION['cart'][$row['id']]['quantity']*$row['price'];
					$name=$row['name'];
					$price=$row['price'];
					$row_id=$row['id'];
					$id=$_SESSION['cart'][$row['id']];
					$quantity=$_SESSION['cart'][$row['id']]['quantity'];
					$totalprice+=$subtotal;
						
								if(isset($_POST['del_purchase'])){
						
$check_id=mysql_real_escape_string($_POST['row_id']);
						if($check_id==$row_id){
					header("Refresh:1"); 
						}	

	}
				
					if(isset($_POST['purchase'])){
						
						if(!isset($_SESSION["Secure"])||($_SESSION["Secure"] !=1)){
						require"check_cilent_purchase.php";
}else{
		$id_get=$_SESSION["cilentId"];
	$insert=" INSERT INTO purchase VALUES(null,'$id_get','$row_id','$quantity','$totalprice')";
				$q_z=mysql_query($insert) or die(mysql_error());
		header("Location: index.php");	

}
}
	

					
print <<<HERE
                
                <tr>
                	<td>$name</td>
                    <td><input type="text" name="quantity[$row_id]" size="5" value="$quantity"></td>
                    <td>RM $price</td>
                    <td>RM $subtotal</td>
</form>
					<td valign="bottom">&nbsp;
<form method="post" action="store.php?page=cart">
<input type="hidden" name="row_id" value="$row_id">
<input type="hidden" name="quantity[$row_id]"  value="0">
<input type="hidden" name="submit">
<button type="submit" name="del_purchase"><b>X</b></button>
</form></td>
                 </tr>
                                
HERE;
				
print <<<HERE

HERE;
				}	
				

	
				
	}

				
	?>
    			<tr>
					<td>Total Price: <?php echo $totalprice; ?></td>
                    	
				</tr>
	
    </table>	
<br />

<?php
if($_SESSION['cart']==null){
print <<<HERE
<p>
<input type="button" name="cancel" value="Back"
onClick="location.href='store.php'" /></a>
</p>
HERE;
}else{

print <<<HERE

 <button type="submit" name="submit">Update Cart</button>
 
 <button type="submit" name="purchase">Confirm Purchase</button>

HERE;
	
}


		if(isset($_POST['purchase'])){
			unset($_SESSION['cart']);
			header("Location:complete.php");	
			
	
	
	}
	
				

?>

</form>
<br/><br />
<p class="text_button">Press the X button to delete item. To edit the quantity.change the quantity item and press Update cart. <a href="store.php?page=item_store">Back to Store</a> </p> 