<?php

	include 'includes/database.php';
	if(isset($_GET['delete_cust'])){
		$CustID = $_GET['delete_cust'];
		$del_Cust = "delete from customers where customer_id='$CustID'";
		$run_del = mysqli_query($conn, $del_Cust);
		if($run_del){
			echo "<script>alert('Customer has been Deleted')</script>";
			echo "<script>window.open('index.php?disp_customer','_self')</script>";
		}
	}
?>