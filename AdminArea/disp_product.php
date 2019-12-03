<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<table align="center" width="800px" border="2" bgcolor="orange">
	<tr align="center" bgcolor="blue">
		<td colspan="7">
			<h2>
				Display Products
			</h2>
		</td>
	</tr>
	<tr align="center" bgcolor="gray">
		<th>Product ID</th>
		<th>Name</th>
		<th>Image</th>
		<th>Price</th>
		<th>Description</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>
	<?php
		include 'includes/database.php';
		$getProds = "select * from products";
		$runProds= mysqli_query($conn, $getProds);
		$ind = 0;
		while($row = mysqli_fetch_array($runProds))
		{
			$ProdID = $row['product_id'];
			$ProdName = $row['product_name'];
			$ProdImage = $row['product_image'];
			$ProdCost = $row['product_cost'];
			$ProdDesc = $row['product_desc'];
			$ind++;
	?>
	<tr align="center" bgcolor="cyan">
		<td><?php echo $ind; ?></td>
		<td><?php echo $ProdName; ?></td>
		<td>
			<img src="product_images/<?php echo $ProdImage; ?>" width="50">
		</td>
		<td><?php echo $ProdCost; ?></td>
		<td><?php echo $ProdDesc; ?></td>
		<td><a href="index.php?edit_product=<?php echo $ProdID; ?>">Edit</a></td>
		<td><a href="delete_product.php?delete_product=<?php echo $ProdID; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table>
<?php
	}
?>