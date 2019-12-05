<!DOCTYPE html>
<?php
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
					<a href="index.php"><li>Home</li></a>
					<a href="all_products.php"><li>All Products</li></a>
					<a href="customer/my_account.php"><li>My Account</li></a>
					<a href="customer_register.php"><li>Sign Up</li></a>
					<a href="cart.php"><li>My Cart</li></a>
					<a href="contact.php"><li>Contact Us</li></a>
				</ul>
				<div id="form">
					<form method="get" action="res.php" enctype="multipart/form-data">
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
						<?php
							if(isset($_SESSION['customer_email'])){
								echo "<b>Welcome </b>" . $_SESSION['customer_email'] . "<b style='color:yellow;'> :-  Your</b>";
							}
							else{
								echo "<b>Wecome to Kennedy Store : </b>";
							}
						?>
						<!-- Welcome Kennedy Francis :  -->
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
								<?php
									if(!isset($_SESSION['customer_email'])){
										echo "<a href='checkout.php' style='color:red; float:right;'>Login</a>";
									}
									else{
										echo "<a href='logout.php' style='color:red; float:right;'>LogOut</a>";
									}
								?>
							</b>
						</b>
					</span>
				</div>
				<div id="products_box">
					<?php
						$getPro = "select * from products";
						$runPro = mysqli_query($conn, $getPro);
						while ($rowPros = mysqli_fetch_array($runPro)) {
							$prodId = $rowPros['product_id'];		
							$prodName = $rowPros['product_name'];		
							$prodCategory = $rowPros['product_category'];		
							$prodBrand = $rowPros['product_brand'];		
							$prodCost = $rowPros['product_cost'];		
							// $prodDesc = $rowPros['product_desc'];		
							$prodImage = $rowPros['product_image'];	

							echo "
								<div id='single_product'>
									<h3>$prodName</h3>
									<img src='AdminArea/product_images/$prodImage' width='180' height='180'>
									<p><b>Price : &#8377 $prodCost</b><p>
									<a href='details.php?prod_Id=$prodId' style='float:left';>More Info</a>
									<a href='index.php?prod_Id=$prodId'><button style='float:right'>Add to Cart</button></a>
								</div>
							";
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