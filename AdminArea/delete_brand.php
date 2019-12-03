<?php

	include 'includes/database.php';
	if(isset($_GET['delete_brand'])){
		$BrandID = $_GET['delete_brand'];
		$del_Brand = "delete from brands where brand_id='$BrandID'";
		$run_del = mysqli_query($conn, $del_Brand);
		if($run_del){
			echo "<script>alert('Brand has been Deleted')</script>";
			echo "<script>window.open('index.php?disp_brand','_self')</script>";
		}
	}
?>