<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<?php
	include 'includes/database.php';
?>
	<form action="index.php?insert_product" method="POST" enctype="multipart/form-data">
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
					<b>Product Name : </b>
				</td>
				<td>
					<input type="text" name="product_name" size="50" required="">
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Product Category : </b>
				</td>
				<td>
					<select name="product_category">
						<option>
							Select a Category
						</option>
						<?php
							$getCats = "select * from categories";
							$runCats = mysqli_query($conn, $getCats);
							while ($rowCats = mysqli_fetch_array($runCats)) {
								$catId = $rowCats['categories_id'];			
								$catName = $rowCats['categories_name'];	
								echo "<option value='$catId'>$catName</option>";		
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Product Brand : </b>
				</td>
				<td>
					<select name="product_brand">
						<option>
							Select a Brand
						</option>
						<?php
							$getBrands = "select * from brands";
							$runBrands = mysqli_query($conn, $getBrands);
							while ($rowCats = mysqli_fetch_array($runBrands)) {
								$brandId = $rowCats['brand_id'];			
								$brandName = $rowCats['brand_name'];	
								echo "<option value='$brandId'>$brandName</option>";		
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<b>Product Description : </b>
				</td>
				<td>
					<textarea name="product_desc" cols="30" rows="10" value=""></textarea>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Product Price: &#8377 </b>
				</td>
				<td>
					<input type="text" name="product_price" required="">
				</td>
			</tr>
			<tr>
				<td align="center">	
					<b>Product Keywords : </b>
				</td>
				<td>
					<input type="text" name="product_keywords" size="40" required="">
				</td>
			</tr>
			<tr>
				<td align="center">	
					<b>Product Image : </b>
				</td>
				<td>
					<input type="file" name="product_image" required="">
				</td>
			</tr>
			<tr align="center">
				<td colspan="7">
					<input type="submit" name="insert_post" value="Add Product">
				</td>
			</tr>
		</table>
	</form>

<?php
	if(isset($_POST['insert_post'])){
		$product_name = $_POST['product_name'];
		// TODO Select Cats
		$product_category = $_POST['product_category'];
		$product_brand = $_POST['product_brand'];
		$product_desc = $_POST['product_desc'];
		$product_cost = $_POST['product_price'];
		$products_keywords = $_POST['product_keywords'];

		$product_image = $_FILES['product_image']['name'];
		$product_image_temp = $_FILES['product_image']['tmp_name'];

		move_uploaded_file($product_image_temp, "product_images/$product_image");

		$insert_product = "insert into products(product_name, product_category, product_brand, product_desc, product_cost, products_keywords, product_image) values('$product_name','$product_category','$product_brand','$product_desc','$product_cost','$products_keywords','$product_image')";

		$insert_pro = mysqli_query($conn, $insert_product);
		if($insert_pro){
			echo "<script>alert('Product has been added')</script>";
			echo "<script>window.open('index.php?insert_product','_self')</script>";
		}
	}
?>
<?php
	}
?>