<!DOCTYPE html>
<?php
	session_start();
	include 'includes/database.php';
	include 'functions/functions.php';
?>
<html>
<head>
	<title>Kenu Online Shopping</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
</head>
<body>
	<div class="main_wrapper_style">
		<div class="header_wrapper_style">
			<a href="index.php">
				<img id="logo" src="images/SK_banner.png" height="100%">
				<img id="banner" src="images/banner.jpg" width="60%" height="90%">
			</a>
		</div>
		<div class="menu_style">
				<ul id="menu">
					<li><a href="index.php">Home</li>
					<li><a href="all_products.php">All Products</li>
					<li><a href="customer/my_account.php">My Account</li>
					<li><a href="#">Sign Up</li>
					<li><a href="cart.php">My Cart</li>
					<li><a href="#">Contact Us</li>
				</ul>
				<div id="form">
					<form method="get" action="search_results.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Search a Product">
						<input type="submit" name="search" value="Search">
					</form>
				</div>
		</div>
		<div class="content_wrapper_style">
			<div id="sidebar">
				<div id="sidebar_title">
					Categories
				</div>
				<ul id="categories">
					<?php
						getCategories();
					?>
					<!-- <li><a href="#">Men Fashion</li>
					<li><a href="#">Women Fashion</li>
					<li><a href="#">Mobiles</li>
					<li><a href="#">Laptops</li>
					<li><a href="#">Camera</li>
					<li><a href="#">Home Furnitures</li>
					<li><a href="#">TV and Appliances</li>
					<li><a href="#">Accessories</li> -->
				</ul>
				<div id="sidebar_title">
					Brands
				</div>
				<ul id="categories">
					<?php
						getBrands();
					?>
					<!-- <li><a href="#">Apple</li>
					<li><a href="#">Samsung</li>
					<li><a href="#">Huawei</li>
					<li><a href="#">Dell</li>
					<li><a href="#">HP</li>
					<li><a href="#">Lenovo</li>
					<li><a href="#">LG</li> -->
				</ul>
			</div>
			<div id="content_area">
				<?php
					getCart();
				?>
				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 40px">
						Welcome Kennedy Francis : 
						<b style="color: yellow">
							Shopping Cart - 
							<b>
								Total Products : 
								<?php
									getTotalProducts();
								?>
								Total Price : &#8377
								<?php
									getTotalPrice();
								?>
								<a href="cart.php" style="color: red">
									Go to Cart
								</a>
							</b>
						</b>
					</span>
				</div>
				<form method="post" action="customer_register.php" enctype="multipart/form-data">
					<table align="center" width="750">
						<tr align="center">
							<td align="center" colspan="6">
								<h2>
									Create an Account Here
								</h2>
							</td>
						</tr>
						<tr>
							<td align="center">
								Customer Name : 
							</td>
							<td>
								<input type="text" name="CName" required="">
							</td>
						</tr>
						<tr>
							<td align="center">
								Customer Email ID : 
							</td>
							<td>
								<input type="text" name="CEmail" required="">
							</td>
						</tr>
						<tr>
							<td align="center">
								Password : 
							</td>
							<td>
								<input type="password" name="CPass" required="">
							</td>
						</tr>
						<tr>
							<td align="center">
								Profile Image : 
							</td>
							<td>
								<input type="file" name="CImage" required="">
							</td>
						</tr>
						<tr>
							<td align="center">
								Country : 
							</td>
							<td>
								<select name="CCountry" required="">
									<option>Select a Country</option>
									<option>India</option>
									<option>USA</option>
									<option>Paris</option>
									<option>Japan</option>
									<option>Nepal</option>
									<option>UAE</option>
									<option>UK</option>
									<option>Israel</option>
								</select>
							</td>
						</tr>
						<tr>
							<td align="center">
								City : 
							</td>
							<td>
								<input type="text" name="CCity" required="">
							</td>
						</tr>
						<tr>
							<td align="center">
								Contact Number : 
							</td>
							<td>
								<input type="text" name="CContact" required="">
							</td>
						</tr>
						<tr>
							<td align="center">
								Contact Address : 
							</td>
							<td>
								<!-- <textarea name="CAddress" rows="5" cols="25"></textarea> -->
								<input type="text" name="CAddress" required="">
							</td>
						</tr>
						<tr align="center">
							<td colspan="6">
								<input type="submit" name="register" value="Create New Account">
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
		<div id="footer">
			<h3 style="text-align: center; padding-top: 30px;">
				&copy; Copyright 2019 Kennedy Francis
			</h3>
		</div>
	</div>
</body>
</html>
<?php
	if(isset($_POST['register'])){
		$ip = getIPAddress();

		$CName = $_POST['CName'];
		$CAddress = $_POST['CAddress'];
		$CEmail = $_POST['CEmail'];
		$CPass = $_POST['CPass'];
		$CImage = $_FILES['CImage']['name'];
		$CImageTemp = $_FILES['CImage']['tmp_name'];
		$CCountry = $_POST['CCountry'];
		$CContact = $_POST['CContact'];
		$CCity = $_POST['CCity'];

		move_uploaded_file($CImageTemp, "customer/customer_images/$CImage");
		$insert_customer = "insert into customers(customer_ip, customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image) values('$ip', '$CName', '$CEmail', '$CPass', '$CCountry', '$CCity', '$CContact', '$CAddress', '$CImage')";
		$run_customer = mysqli_query($conn, $insert_customer);
		// if($run_customer){
		// 	echo "<script>alert('Registration Success')</script>";
		// }
		$sel_cart = "select * from cart where ip_add='$ip'";
		$run_cart = mysqli_query($conn, $sel_cart);
		$check_cart = mysqli_num_rows($run_cart);
		if($check_cart==0){
			$_SESSION['customer_email'] = $CEmail;
			echo "<script>alert('Account has created Succesfully')</script>";
			echo "<script>window.open('customer/my_account.php','_self')</script>";
		}
		else{
			$_SESSION['customer_email'] = $CEmail;
			echo "<script>alert('Account has created Succesfully')</script>";
			echo "<script>window.open('checkout.php','_self')</script>";
		}
	}
?>