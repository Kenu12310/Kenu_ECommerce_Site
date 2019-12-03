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
				Display Categories
			</h2>
		</td>
	</tr>
	<tr align="center" bgcolor="gray">
		<th>Categories ID</th>
		<th>Name</th>
		<th>Delete</th>
		<th>Edit</th>
	</tr>
	<?php
		include 'includes/database.php';
		$getCategories = "select * from categories";
		$runCategories= mysqli_query($conn, $getCategories);
		$ind = 0;
		while($row = mysqli_fetch_array($runCategories))
		{
			$CategoriesID = $row['categories_id'];
			$CategoriesName = $row['categories_name'];
			
			$ind++;
	?>
	<tr align="center" bgcolor="cyan">
		<td><?php echo $ind; ?></td>
		<td><?php echo $CategoriesName; ?></td>
		
		<td><a href="index.php?edit_category=<?php echo $CategoriesID; ?>">Edit</a></td>
		<td><a href="delete_categories.php?delete_category=<?php echo $CategoriesID; ?>">Delete</a></td>
	</tr>
	<?php
		}
	?>
</table>
<?php
	}
?>