<?php
	include 'includes/database.php';
	$user = $_SESSION['customer_email'];
	$get_cust = "select * from customers where customer_email='$user'";
	$run_cust = mysqli_query($conn, $get_cust);
	$row_cust = mysqli_fetch_array($run_cust);
	$name = $row_cust['customer_name'];
	$email = $row_cust['customer_email'];
	$pass = $row_cust['customer_pass'];
	$country = $row_cust['customer_country'];
	$city = $row_cust['customer_city'];
	$address = $row_cust['customer_address'];
	$contact = $row_cust['customer_contact'];
	$image = $row_cust['customer_image'];
	$custId = $row_cust['customer_id'];
?>
<form method="post" action="" enctype="multipart/form-data">
	<table align="center" width="750">
		<tr align="center">
			<td align="center" colspan="6">
				<h2>
					Edit your Account Here
				</h2>
			</td>
		</tr>
		<tr>
			<td align="center">
				Customer Name : 
			</td>
			<td>
				<input type="text" name="CName" value="<?php echo $name;?>" required="">
			</td>
		</tr>
		<tr>
			<td align="center">
				Customer Email ID : 
			</td>
			<td>
				<input type="text" name="CEmail" value="<?php echo $email;?>" required="">
			</td>
		</tr>
		<tr>
			<td align="center">
				Password : 
			</td>
			<td>
				<input type="password" name="CPass" value="<?php echo $pass;?>" required="">
			</td>
		</tr>
		<tr>
			<td align="center">
				Customer Image : 
			</td>
			<td>
				<input type="file" name="CImage">
				<img src="customer_images/<?php echo $image;?>" width='50' height='50'>
			</td>
		</tr>
		<tr>
			<td align="center">
				Country : 
			</td>
			<td>
				<select name="CCountry" disabled="">
					<option><?php echo $country;?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="center">
				City : 
			</td>
			<td>
				<input type="text" name="CCity" value="<?php echo $city;?>" required="">
			</td>
		</tr>
		<tr>
			<td align="center">
				Contact Number : 
			</td>
			<td>
				<input type="text" name="CContact" value="<?php echo $contact;?>" required="">
			</td>
		</tr>
		<tr>
			<td align="center">
				Contact Address : 
			</td>
			<td>
				<!-- <textarea name="CAddress" rows="5" cols="25"></textarea> -->
				<input type="text" name="CAddress" value="<?php echo $address;?>" required="">
			</td>
		</tr>
		<tr align="center">
			<td colspan="6">
				<input type="submit" name="update" value="Update Account">
			</td>
		</tr>
	</table>
</form>
			
<?php
	if(isset($_POST['update'])){
		$ip = getIPAddress();

		$CID = $custId;
		$CName = $_POST['CName'];
		$CAddress = $_POST['CAddress'];
		$CEmail = $_POST['CEmail'];
		$CPass = $_POST['CPass'];
		// $CCountry = $_POST['CCountry'];
		$CContact = $_POST['CContact'];
		$CCity = $_POST['CCity'];

		$CImage = $_FILES['CImage']['name'];

		if($CImage){
			$CImageTemp = $_FILES['CImage']['tmp_name'];
			
			move_uploaded_file($CImageTemp, "customer_images/$CImage");
			$update_customer = "update customers set customer_name='$CName', customer_email='$CEmail', customer_pass='$CPass', customer_city='$CCity', customer_contact='$CContact', customer_address='$CAddress', customer_image='$CImage' where customer_id='$CID'";
			$run_customer = mysqli_query($conn, $update_customer);
		}
		else{
			$update_customer = "update customers set customer_name='$CName', customer_email='$CEmail', customer_pass='$CPass', customer_city='$CCity', customer_contact='$CContact', customer_address='$CAddress' where customer_id='$CID'";
			$run_customer = mysqli_query($conn, $update_customer);
		}
		
		if($run_customer){
			echo "<script>alert('Your Account has been Updated')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		}		
	}
?>