<?php

	include 'includes/database.php';
	if(isset($_GET['delete_product'])){
		$ProdID = $_GET['delete_product'];
		$del_Prod = "delete from products where product_id='$ProdID'";
		$run_del = mysqli_query($conn, $del_Prod);
		if($run_del){
			echo "<script>alert('Product has been Deleted')</script>";
			echo "<script>window.open('index.php?disp_product','_self')</script>";
		}
	}
?>