<?php

	$conn = mysqli_connect("localhost", "root", "", "kenuecom");
	if(mysqli_connect_errno()){
		echo "Unable to connect to MySQL : " . mysqli_connect_errno();
	}

	function getCategories(){
		global $conn;
		$getCats = "select * from categories";
		$runCats = mysqli_query($conn, $getCats);
		while ($rowCats = mysqli_fetch_array($runCats)) {
			// echo 'Category';
			$catId = $rowCats['categories_id'];			
			$catName = $rowCats['categories_name'];	
			// echo "<li><a href='index.php?cat=$catId'>$catName</li>";		
			echo "<a href='index.php?cat=$catId'><li>$catName</li></a>";		
		}
	}

	function getBrands(){
		global $conn;
		$getBrands = "select * from brands";
		$runBrands = mysqli_query($conn, $getBrands);
		while ($rowCats = mysqli_fetch_array($runBrands)) {
			$brandId = $rowCats['brand_id'];			
			$brandName = $rowCats['brand_name'];	
			echo "<a href='index.php?brand=$brandId'><li>$brandName</li></a>";		
		}
	}

	function getProducts(){
		if(!isset($_GET['cat']))
		{
			if(!isset($_GET['brand']))
			{
				global $conn;
				$getPro = "select * from products order by RAND() LIMIT 0,100";
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
							<a href='index.php?add_cart=$prodId'><button style='float:right'>Add to Cart</button></a>
						</div>
					";
				}	
			}
		}

	}

	function getCatProducts(){
		if(isset($_GET['cat']))
		{
			$catId = $_GET['cat'];

			global $conn;
			$getCatPro = "select * from products where product_category=$catId";
			$runCatPro = mysqli_query($conn, $getCatPro);

			$count = mysqli_num_rows($runCatPro);
			if($count == 0){
					echo "<h2>No Product in this Category<h2>";
			}

			while ($rowPros = mysqli_fetch_array($runCatPro)) {
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
						<a href='index.php?add_cart=$prodId'><button style='float:right'>Add to Cart</button></a>
					</div>
				";
			}	
		}

	}
	function getBrandProducts(){
		if(isset($_GET['brand']))
		{
			$bramdId = $_GET['brand'];

			global $conn;
			$getbrandPro = "select * from products where product_brand=$bramdId";
			$runbrandPro = mysqli_query($conn, $getbrandPro);

			$count = mysqli_num_rows($runbrandPro);
			if($count == 0){
					echo "<h2>No Product in this Brand<h2>";
			}

			while ($rowPros = mysqli_fetch_array($runbrandPro)) {
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
						<a href='index.php?add_cart=$prodId'><button style='float:right'>Add to Cart</button></a>
					</div>
				";
			}	
		}

	}

	function getIPAddress() {
	    $ip = $_SERVER['REMOTE_ADDR'];
	    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	        $ip = $_SERVER['HTTP_CLIENT_IP'];
	    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    return $ip;
	}

	function getCart(){
		if(isset($_GET['add_cart'])){
			global $conn;
			$ip = getIPAddress();
			$prodId = $_GET['add_cart'];
			$check_prod = "select * from cart where ip_add='$ip' AND p_id='$prodId'";
			$run_check = mysqli_query($conn, $check_prod);
			if(mysqli_num_rows($run_check) > 0){
				echo "Item Aldready Exists in Cart";
			}
			else{
				$insert_prod = "insert into cart(p_id, ip_add, qty) values ('$prodId', '$ip', '1')";
				$run_prod = mysqli_query($conn, $insert_prod);
				echo "<script>alert('Added to Cart')</script>";
				echo "<script>window.open('index.php','_self')</script>";
			}
		}
	}

	function getTotalProducts(){
		if(isset($_GET['add_cart'])){
			global $conn;
			$ip = getIpAddress();
			$getProd = "select * from cart where ip_add='$ip'";
			$runProd = mysqli_query($conn, $getProd);
			$countProd = mysqli_num_rows($runProd);
		}
		else{
			global $conn;
			$ip = getIpAddress();
			$getProd = "select * from cart where ip_add='$ip'";
			$runProd = mysqli_query($conn, $getProd);
			$countProd = mysqli_num_rows($runProd);
		}
		echo "$countProd";
	}

	function getTotalPrice(){
		$Total = 0;
		global $conn;
		$ip = getIpAddress();
		$selPrice = "select * from cart where ip_add='$ip'";
		$runPrice = mysqli_query($conn, $selPrice);
		while ($p_Pros = mysqli_fetch_array($runPrice)) {
			$prodId = $p_Pros['p_id'];		
			$prodPrice = "select * from products where product_id='$prodId'";
			$runprodPrice = mysqli_query($conn, $prodPrice);	
			while ($p_prodPrice = mysqli_fetch_array($runprodPrice)) {
				$product_Price = array($p_prodPrice['product_cost']);
				$values = array_sum($product_Price);
				$Total += $values;
			}
		}
		echo "$Total";
	}

?>