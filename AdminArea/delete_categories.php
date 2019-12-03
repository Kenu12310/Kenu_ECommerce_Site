<?php

	include 'includes/database.php';
	if(isset($_GET['delete_category'])){
		$CatID = $_GET['delete_category'];
		$del_Cat = "delete from categories where categories_id='$CatID'";
		$run_del = mysqli_query($conn, $del_Cat);
		if($run_del){
			echo "<script>alert('Category has been Deleted')</script>";
			echo "<script>window.open('index.php?disp_category','_self')</script>";
		}
	}
?>