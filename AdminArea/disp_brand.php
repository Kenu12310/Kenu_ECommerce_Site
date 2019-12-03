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
				Display Brands
			</h2>
		</td>
	</tr>
	<tr align="center" bgcolor="gray">
		<th>Brand ID</th>
		<th>Name</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>
	<?php
		include 'includes/database.php';
		$getBrands = "select * from brands";
		$runBrands= mysqli_query($conn, $getBrands);
		$ind = 0;
		while($row = mysqli_fetch_array($runBrands))
		{
			$BrandID = $row['brand_id'];
			$BrandName = $row['brand_name'];
			
			$ind++;
	?>
	<tr align="center" bgcolor="cyan">
		<td><?php echo $ind; ?></td>
		<td><?php echo $BrandName; ?></td>
		
		<td><a href="index.php?edit_brand=<?php echo $BrandID; ?>">Edit</a></td>
		<td><a href="delete_brand.php?delete_brand=<?php echo $BrandID; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table>
<?php
	}
?>