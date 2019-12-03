<h2 style="text-align: center;">
	DELETE Account Permenantly
</h2>
<br>
<form method="post" action="">
	<input type="submit" name="yes" value="Yes Delete Account">
	<input type="submit" name="no" value="No keep Account">
</form>
<?php
	include 'includes/database.php';

	$user=$_SESSION['customer_email'];

	if(isset($_POST['yes'])){
		$delete_cust = "delete from customers where customer_email='$user'";
		// echo "$delete_cust";
		$run_cust = mysqli_query($conn, $delete_cust);
		echo "<script>alert('Account Deleted')</script>";
		echo "<script>window.open('../index.php','_self')</script>";
	}
	if(isset($_POST['no'])){
		// echo "<script>alert('No Account Deleted')</script>";
		echo "<script>window.open('../index.php','_self')</script>";
	}
?>