<?php
	session_start();
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{

?>

<!DOCTYPE html>

<html>
	<head>
		<title>Admin Ecom Panel</title>

		<link rel="stylesheet" type="text/css" href="styles/style.css" media="all">
	</head>

	<body>
		<div class="main_wrap">
			<div id="header">
				<img id="mainLogo" src="../images/SK_Logo.png">
				<img id="admin_Label" src="../images/adminpanel-icon.png">
			</div>
			
			<div id="subAdmin">
				<h2>Manage Content</h2>
				<a href="index.php?insert_product">Insert Product</a>
				<a href="index.php?disp_product">Display Product</a>
				<a href="index.php?insert_category">New Category</a>
				<a href="index.php?disp_category">Display Category</a>
				<a href="index.php?insert_brand">New Brand</a>
				<a href="index.php?disp_brand">Display Brand</a>
				<a href="index.php?disp_customer">Display Customers</a>
				<a href="index.php?disp_order">Display Orders</a>
				<a href="index.php?disp_payment">Display Payments</a>
				<a href="admin_logout.php">LogOut</a>
			</div>

			<div id="mainAdmin">
				<h2 style="text-align: center">
					<?php
					 	if(isset($_GET['logged_in']))
					 	{
					 		echo $_GET['logged_in']; 
					 	}
					?>
				</h2>
				<?php
					if(isset($_GET['insert_product'])){
						include 'insert_product.php';
					}
					if(isset($_GET['disp_product'])){
						include 'disp_product.php';
					}
					if(isset($_GET['edit_product'])){
						include 'edit_product.php';
					}

					if(isset($_GET['insert_category'])){
						include 'insert_categories.php';
					}
					if(isset($_GET['disp_category'])){
						include 'disp_categories.php';
					}
					if(isset($_GET['edit_category'])){
						include 'edit_categories.php';
					}

					if(isset($_GET['insert_brand'])){
						include 'insert_brand.php';
					}
					if(isset($_GET['disp_brand'])){
						include 'disp_brand.php';
					}
					if(isset($_GET['edit_brand'])){
						include 'edit_brands.php';
					}

					if(isset($_GET['disp_customer'])){
						include 'disp_customers.php';
					}
				?>
			</div>
		</div>
	</body>
</html>

<?php
	}
?>