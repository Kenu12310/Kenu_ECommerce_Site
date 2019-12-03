<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<table align="center" width="800px" border="2" bgcolor="orange">
	<tr align="center" bgcolor="blue">
		<td colspan="8">
			<h2>
				Display Customers
			</h2>
		</td>
	</tr>
	<tr align="center" bgcolor="gray">
		<th>Cust_ID</th>
	    <th>Name</th>
	    <th>Email</th>
	    <th>Phone</th>
		<th>Address</th>
		<th>Location</th>
		<th>Profile</th>
		<th>Options</th>
	</tr>
	<?php
		include 'includes/database.php';
		$getCust = "select * from customers";
		$runCust= mysqli_query($conn, $getCust);
		$ind = 0;
		while($row = mysqli_fetch_array($runCust))
		{
			$customer_id = $row['customer_id'];
			$customer_name = $row['customer_name'];
			$customer_email = $row['customer_email'];
			$customer_contact = $row['customer_contact'];
			$customer_address=$row['customer_address'];
			$customer_city=$row['customer_city'];
			$customer_country=$row['customer_country'];
			$customer_image=$row['customer_image'];
			$ind++;
	?>
	<tr align="center" bgcolor="cyan">
		<td><?php echo $customer_id; ?></td>
		<td><?php echo $customer_name; ?></td>
		<td><?php echo $customer_email; ?></td>
		<td><?php echo $customer_contact; ?></td>
		<td><?php echo $customer_address; ?></td>
		<td><?php echo $customer_city.' , '.$customer_country; ?></td>
		<td>
			<img src="../customer/customer_images/<?php echo $customer_image; ?>" height="50">
		</td>
		<td>
			<a href="delete_customer.php?delete_cust=<?php echo $customer_id; ?>">Delete</a>
		</td>
		<!--
		<td><a href="index.php?edit_category=<?php echo $CategoriesID; ?>">Edit</a></td>
		<td><a href="delete_brand.php?delete_category=<?php echo $CategoriesID; ?>">Delete</a></td>-->
	</tr>
	<?php
		}
	?>
</table>
<?php
	}
?>