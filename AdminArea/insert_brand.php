<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<?php
	include 'includes/database.php';
?>
	<form action="index.php?insert_brand" method="POST" enctype="multipart/form-data">
		<table align="center" width="800px" border="2" bgcolor="cyan">
			<tr align="center">
				<td colspan="7">
					<h2>
						Add New Product
					</h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Brand Name : </b>
				</td>
				<td colspan="7">
					<input type="text" name="brand_name" size="50" required="">
				</td>
			</tr>
			<tr align="center">
              	<td colspan="7">
              		<input type="submit" name="insert_brand" value="Add Brand">
              	</td>
			</tr>			
		</table>
	</form>

<?php
	if(isset($_POST['insert_brand'])){
		
		$brand_name = $_POST['brand_name'];
		// TODO Select Cats
		
		$insert_brands = "insert into brands(brand_name) values('$brand_name')";

		$insert_pro = mysqli_query($conn, $insert_brands);
		if($insert_pro){
			echo "<script>alert('Brand has been added')</script>";
			echo "<script>window.open('index.php?disp_brand','_self')</script>";
		}
	}
?>
<?php
	}
?>