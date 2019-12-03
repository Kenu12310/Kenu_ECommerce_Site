<?php
	if(!isset($_SESSION['user_email'])){
		echo "<script>window.open('admin_login.php?not_logged=Not_Logged_in','_self')</script>";
	}
	else{
?>
<?php
	include 'includes/database.php';

	if(isset($_GET['edit_product'])){
		$getID = $_GET['edit_product'];

		$getProd = "select * from products where product_id='$getID'";
		$runProd = mysqli_query($conn, $getProd);
		$row = mysqli_fetch_array($runProd);
		$ProdID = $row['product_id'];
		$ProdName = $row['product_name'];
		$ProdImage = $row['product_image'];
		// echo $ProdImage;
		$ProdCost = $row['product_cost'];
		$ProdDesc = $row['product_desc'];
		$ProdKeyword = $row['products_keywords'];
		$ProdCat = $row['product_category'];
		$ProdBrand = $row['product_brand'];

		$getCat = "select categories_name from categories where categories_id='$ProdCat'";
		$runCat = mysqli_query($conn, $getCat);
		$rowCat = mysqli_fetch_array($runCat);
		$catName = $rowCat['categories_name'];
		$getBrand = "select brand_name from brands where brand_id='$ProdBrand'";
		$runBrand = mysqli_query($conn, $getBrand);
		$rowBrand = mysqli_fetch_array($runBrand);
		$brandName = $rowBrand['brand_name'];
		// echo $ProdBrand;
	}
?>
	<form action="" method="POST" enctype="multipart/form-data">
		<table align="center" width="800px" border="2" bgcolor="cyan">
			<tr align="center">
				<td colspan="7">
					<h2>
						Update Product
					</h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Product Name : </b>
				</td>
				<td>
					<input type="text" name="product_name" size="50" value="<?php echo $ProdName; ?>">
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Product Category : </b>
				</td>
				<td>
					<select name="product_category">
						<option value='<?php echo "$ProdCat"; ?>'>
							<?php
								echo $catName; 
							?>
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
						<option value='<?php echo "$ProdBrand"; ?>'>
							<?php
								echo $brandName; 
							?>
						</option>
						<?php
							$getBrands = "select * from brands";
							$runBrands = mysqli_query($conn, $getBrands);
							while ($row = mysqli_fetch_array($runBrands)) {
								$brandId = $row['brand_id'];			
								$brandName = $row['brand_name'];	
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
					<textarea name="product_desc" cols="30" rows="10" value=""><?php echo $ProdDesc; ?></textarea>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>Product Price: &#8377 </b>
				</td>
				<td>
					<input type="text" name="product_price" value="<?php echo $ProdCost; ?>">
				</td>
			</tr>
			<tr>
				<td align="center">	
					<b>Product Keywords : </b>
				</td>
				<td>
					<input type="text" name="product_keywords" size="40" value="<?php echo $ProdKeyword; ?>">
				</td>
			</tr>
			<tr>
				<td align="center">	
					<b>Product Image : </b>
				</td>
				<td>
					<input type="file" name="product_image">
					<img src="product_images/<?php echo $ProdImage; ?>" width="60">
				</td>
			</tr>
			<tr align="center">
				<td colspan="7">
					<input type="submit" name="update_prod" value="Update Product">
				</td>
			</tr>
		</table>
	</form>

<?php
	if(isset($_POST['update_prod'])){
		$product_name = $_POST['product_name'];
		$product_id = $getID;
		
		$product_category = $_POST['product_category'];

		// if(isset($_POST['product_category']))
		// 	$product_category = $_POST['product_category'];
		// else
		// 	$product_category = $ProdCat;
		// echo $product_category;
		$product_brand = $_POST['product_brand'];
		$product_desc = $_POST['product_desc'];
		$product_cost = $_POST['product_price'];
		$products_keywords = $_POST['product_keywords'];

		// if(!isset($_FILES['file_upload']) || $_FILES['file_upload']['error'] == UPLOAD_ERR_NO_FILE)
		if(empty($_FILES["product_image"]["name"]))
		{
			$product_image = $ProdImage;
			// echo "NO File";
		}
		else
		{
			$product_image = $_FILES['product_image']['name'];
			$product_image_temp = $_FILES['product_image']['tmp_name'];
			move_uploaded_file($product_image_temp, "product_images/$product_image");
			// echo "YES File";
		}
		// echo $product_image;

		$update_product = "update products set product_name = '$product_name', product_category='$product_category', product_brand='$product_brand', product_desc='$product_desc', product_image='$product_image', product_cost='$product_cost', products_keywords='$products_keywords' where product_id=".$product_id;
		// echo $update_product;
		// , product_category, product_brand, product_desc, product_cost, products_keywords, product_image) values(,'$product_category','$product_brand','$product_desc','$product_cost','$products_keywords','$product_image')";

		$update_pro = mysqli_query($conn, $update_product);
		if($update_pro){
			echo "<script>alert('Product has been Updated')</script>";
			echo "<script>window.open('index.php?disp_product','_self')</script>";
		}
	}
?>
<?php
	}
?>