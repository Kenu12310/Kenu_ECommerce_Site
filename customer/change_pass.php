
<h2 style="text-align: center;">
	Change Account Password
</h2>
<br>
<form action="" method="post">
	<b>Current Password</b>
	<input type="password" name="current_password" required="">
	<br>
	<b>New Password</b>
	<input type="password" name="new_password" required="">
	<br>
	<b>Confirm New Password</b>
	<input type="password" name="new_confirm_password" required="">
	<br>
	<br>
	<input type="submit" name="change_pass" value="Change Password">
</form>
<?php
	include 'includes/database.php';
	if(isset($_POST['change_pass'])){
		$user = $_SESSION['customer_email'];

		$current_pass=$_POST['current_password'];
		$new_pass=$_POST['new_password'];
		$new_confirm_pass=$_POST['new_confirm_password'];

		$sel_pass = "select * from customers where customer_pass='$current_pass' AND customer_email='$user'";
		$run_pass = mysqli_query($conn, $sel_pass);
		$check_pass = mysqli_num_rows($run_pass);
		if($check_pass == 0){
			echo "<script>alert('Password is Wrong')</script>";
			exit();
		}
		if($new_pass!=$new_confirm_pass){
			echo "<script>alert('New Password Not Matching')</script>";
			exit();
		}
		else{
			$update_new_pass = "update customers set customer_pass='$new_pass' where customer_email='$user'";
			$run_new_pass = mysqli_query($conn, $update_new_pass);

			echo "<script>alert('Password changed successfully')</script>";
			echo "<script>window.open('my_account.php','_self')</script>";
		}
	}
?>