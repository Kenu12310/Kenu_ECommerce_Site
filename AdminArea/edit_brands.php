<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<?php
	include 'includes/database.php';

	if(isset($_GET['edit_brand'])){
		$getID = $_GET['edit_brand'];

		$getBrand = "select * from brands where brand_id='$getID'";
		$runBrand = mysqli_query($conn, $getBrand);
		$row = mysqli_fetch_array($runBrand);

		$BrandID = $row['brand_id'];
		$BrandName = $row['brand_name'];
		
	}
?>
<form action="" method="POST" enctype="multipart/form-data">
		<table align="center" width="800px" border="2" bgcolor="cyan">
			<tr align="center">
				<td colspan="7">
					<h2>
						Edit Brand
					</h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Brand Name : </b>
				</td>
				<td>
					<input type="text" name="brand_name" required="" size="50" value="<?php echo $BrandName; ?>">
				</td>
			</tr>
			<tr align="center">
				<td colspan="7">
					<input type="submit" name="update_brand" value="Update Brand">
				</td>
			</tr>
		</table>
</form>
	<?php
	if(isset($_POST['update_brand'])){

		$brand_id = $getID;
		$brand_name = $_POST['brand_name'];
		

		$update_brand = "update brands set brand_name = '$brand_name' where brand_id=".$brand_id;

		$update_brand_run= mysqli_query($conn, $update_brand);
		if($update_brand_run){
			echo "<script>alert('Brand has been Updated')</script>";
			echo "<script>window.open('index.php?disp_brand','_self')</script>";
		}
	}
	?>
<?php
	}
?>