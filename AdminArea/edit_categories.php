<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<?php
	include 'includes/database.php';

	if(isset($_GET['edit_category'])){
		$getID = $_GET['edit_category'];

		$getCat = "select * from categories where categories_id='$getID'";
		$runCat = mysqli_query($conn, $getCat);
		$row = mysqli_fetch_array($runCat);

		$CatID = $row['categories_id'];
		$CatName = $row['categories_name'];
		
	}
?>
<form action="" method="POST" enctype="multipart/form-data">
		<table align="center" width="800px" border="2" bgcolor="cyan">
			<tr align="center">
				<td colspan="7">
					<h2>
						Edit Category
					</h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Category Name : </b>
				</td>
				<td>
					<input type="text" name="category_name" required="" size="50" value="<?php echo $CatName; ?>">
				</td>
			</tr>
			<tr align="center">
				<td colspan="7">
					<input type="submit" name="update_category" value="Update Category">
				</td>
			</tr>
		</table>
</form>
	<?php
	if(isset($_POST['update_category'])){

		$cat_id = $getID;
		$cat_name = $_POST['category_name'];
		

		$update_cat = "update categories set categories_name = '$cat_name' where categories_id=".$cat_id;

		$update_cats_run= mysqli_query($conn, $update_cat);
		if($update_cats_run){
			echo "<script>alert('Category has been Updated')</script>";
			echo "<script>window.open('index.php?disp_category','_self')</script>";
		}
	}
	?>
<?php
	}
?>