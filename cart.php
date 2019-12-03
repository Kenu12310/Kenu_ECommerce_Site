<!DOCTYPE html>
<?php
	session_start();
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
					<li><a href="customer_register.php">Sign Up</li>
					<li><a href="cart.php">My Cart</li>
					<li><a href="contact.php">Contact Us</li>
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
					<span style="float: right; font-size: 16px; padding: 5px; line-height: 40px;">
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
								<a href="index.php" style="color: red;">
									Back to Home
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
				<!-- <div>
					<a href="cart.php" style="color: red;">
						Go to Cart
					</a>
				</div> -->
				<div id="products_box">
					<form action="" method="post" enctype="multipart/form-data">
						<table align="center" width="700" bgcolor="skyblue">
							<!-- <tr>
								<td colspan="5">
									<h2>
										Manage Cart Here
									</h2>
								</td>
							</tr> -->
							<tr align="center">
								<th>Remove</th>
								<th>Cart Item</th>
								<th>Quantity</th>
								<th>Total Price</th>
							</tr>
							<?php
								$Total = 0;
								global $conn;
								$ip = getIpAddress();
								$selPrice = "select * from cart where ip_add='$ip'";
								$runPrice = mysqli_query($conn, $selPrice);
								while ($p_Pros = mysqli_fetch_array($runPrice)) {
									$prodId = $p_Pros['p_id'];		
									$quan = $p_Pros['qty'];
									$prodPrice = "select * from products where product_id='$prodId'";
									$runprodPrice = mysqli_query($conn, $prodPrice);	
									while ($p_prodPrice = mysqli_fetch_array($runprodPrice)) {
										$product_Price = array($p_prodPrice['product_cost']);
										$product_Name = $p_prodPrice['product_name'];
										$product_Image = $p_prodPrice['product_image'];
										$product_Cost = $p_prodPrice['product_cost'];
										$values = array_sum($product_Price);
										$Total += $values;
								
							?>
							<tr align="center">
								<td>
									<input type="checkbox" name="remove[]" value="<?php echo $prodId; ?>">
								</td>
								<td>
									<?php
										echo "$product_Name";
										// echo "$quan";
										// echo $_SESSION['qty'];
										// echo "$qty";
									?>
									<br>
									<img src="AdminArea/product_images/<?php echo $product_Image;?>" width="60" height="60">
								</td>
								<td>
									<!-- <input type="text" name="qty" size="4" value="<?php echo $_SESSION['qty']; ?>"> -->
									<input type="text" name="qty" size="4" value="<?php echo $quan;?>">
								</td>
								<!-- <?php
									if(isset($_POST['update_cart'])){
										$qty = $_POST['qty'];
										// $qty = $quan;
										echo "<script>alert($qty)</script>";
										$update_qty = "update cart set qty='$qty' where p_id='$prodId' and ip_add='$ip'";
										$run_qty = mysqli_query($conn, $update_qty);
										// $_SESSION['qty'] = $qty; 
										$Total = $Total * $qty; 
									}
								?> -->
								<td>
									<?php
										echo "&#8377 $product_Cost";
									?>
								</td>
							</tr>
							<?php
									}
								}
							?>
							<tr align="right">
								<td colspan="4">
									<b>Grand Total : </b>
								</td>
								<td colspan="4">
									<?php
										echo "&#8377 $Total"
									?>
								</td>
							</tr>
							<tr align="center">
								<td colspan="2">
									<input type="submit" name="update_cart" value="Update Cart">
								</td>
								<td>
									<input type="submit" name="continue" value="Continue Shopping">
								</td>
								<td>
									<button>
										<a href="checkout.php" style="text-decoration: none; color: black">
											CheckOut											
										</a>
									</button>
								</td>
							</tr>
						</table>
					</form>
					<?php
						function update_cart(){
							global $conn;
							$ip = getIpAddress();

							if(isset($_POST['update_cart'])){
								foreach ($_POST['remove'] as $remove_id) {	
									$delete_prodId = "delete from cart where p_id='$remove_id' AND ip_add='$ip'";
									$run_delete = mysqli_query($conn, $delete_prodId);
									if($run_delete){
										echo "<script>window.open('cart.php','_self')</script>";
									}
								}
							}
							if(isset($_POST['continue'])){
								echo "<script>window.open('index.php','_self')</script>";
							}
						}
						echo @$up_cart = update_cart();
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