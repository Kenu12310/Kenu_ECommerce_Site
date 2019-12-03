<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<?php
	include 'includes/database.php';
?>
	<form action="index.php?insert_category" method="POST" enctype="multipart/form-data">
		<table align="center" width="800px" border="2" bgcolor="cyan">
			<tr align="center">
				<td colspan="7">
					<h2>
						Add New Category
					</h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Category Name : </b>
				</td>
				<td colspan="7">
					<input type="text" name="categories_name" size="50" required="">
				</td>
			</tr>
			<tr align="center">
				<td colspan="7">
              		<input type="submit" name="insert_cat" value="Add Category">
              	</td>
			</tr>			
		</table>
	</form>

<?php
	if(isset($_POST['insert_cat'])){
		
		$cat_name = $_POST['categories_name'];
		// TODO Select Cats
		
		$insert_cat = "insert into categories(categories_name) values('$cat_name')";

		$insert_pro = mysqli_query($conn, $insert_cat);
		if($insert_pro){
			echo "<script>alert('Category has been added')</script>";
			echo "<script>window.open('index.php?disp_category','_self')</script>";
		}
	}
?>
<?php
	}
?>