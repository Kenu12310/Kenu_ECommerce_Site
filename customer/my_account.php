<!DOCTYPE html>
<?php
	session_start();
	include '../functions/functions.php';
?>
<html>
<head>
	<title>Kenu Online Shopping</title>
	<link rel="stylesheet" type="text/css" href="../styles/style.css" media="all">
</head>
<body>
	<div class="main_wrapper_style">
		<div class="header_wrapper_style">
			<a href="../index.php">
				<img id="logo" src="../images/SK_banner.png" height="100%">
				<img id="banner" src="../images/banner.jpg" width="60%" height="90%">
			</a>
		</div>
		<div class="menu_style">
				<ul id="menu">
					<a href="../index.php"><li>Home</li></a>
					<a href="../all_products.php"><li>All Products</li></a>
					<a href="../customer/my_account.php"><li>My Account</li></a>
					<a href="../customer_register.php"><li>Sign Up</li></a>
					<a href="../cart.php"><li>My Cart</li></a>
					<a href="../contact.php"><li>Contact Us</li></a>
				</ul>
				<div id="form">
					<form method="get" action="../search_results.php" enctype="multipart/form-data">
						<input type="text" name="user_query" placeholder="Search a Product">
						<input type="submit" name="search" value="Search">
					</form>
				</div>
		</div>
		<div class="content_wrapper_style">
			<div id="sidebar_customer">
				<div id="sidebar_title">
					Profile Account
				</div>
				<ul id="categories">
					<?php
						if(isset($_SESSION['customer_email'])){
							// echo "Logged In";
							$user = $_SESSION['customer_email'];
							$get_profile = "select * from customers where customer_email='$user'";
							$run_profile = mysqli_query($conn, $get_profile);
							$row_profile = mysqli_fetch_array($run_profile);
							$customerImage = $row_profile['customer_image'];
							$customerName = $row_profile['customer_name'];
							echo "<img src='customer_images/$customerImage' width='125' height='125'>";
							echo "<a href='my_account.php?myorders'><li>Your Orders</li></a>";
							echo "<a href='my_account.php?edit_account'><li>Edit Profile</li></a>";
							echo "<a href='my_account.php?change_pass'><li>Change Password</li></a>";
							echo "<a href='my_account.php?delete_account'><li>Delete Account</li></a>";
							echo "<a href='../logout.php'><li>LogOut</li></a>";
						}
						else{
							// echo "Not Logged In";
							echo "<a href='../checkout.php' style='color:blue;'>Login</a>";
						}
					?>
				</ul>
			</div>
			<div id="content_area_customer">
				<?php
					getCart();
				?>
				<div id="shopping_cart">
					<span style="float: right; font-size: 18px; padding: 5px; line-height: 40px">
						<?php
							if(isset($_SESSION['customer_email'])){
								echo "<b>Welcome </b>" . $_SESSION['customer_email'];
							}
						?>
						<!-- Welcome Kennedy Francis :  -->
						<?php
							if(!isset($_SESSION['customer_email'])){
								echo "<a href='../checkout.php' style='color:red; float:right;'>Login</a>";
							}
							else{
								echo "<a href='../logout.php' style='color:red; float:right;'>LogOut</a>";
							}
						?>
					</span>
				</div>
				<div id="products_box">
					
					<?php
						if(!isset($_GET['myorders'])){
							if(!isset($_GET['edit_account'])){
								if(!isset($_GET['change_pass'])){
									if(!isset($_GET['delete_account'])){
										if(isset($_SESSION['customer_email'])){
											echo "<h2>Welcome : $customerName</h2>";
										}
										echo "<b>Click here to check Orders -><a href='my_account.php?myorders'>My Orders</a></b>";
									}
								}
							}
						}
 					?>
					<?php
						if(isset($_GET['edit_account'])){
							include 'edit_account.php';
						}
						if(isset($_GET['change_pass'])){
							include 'change_pass.php';
						}
						if(isset($_GET['delete_account'])){
							include 'delete_account.php';
						}
					?>
				</div>
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