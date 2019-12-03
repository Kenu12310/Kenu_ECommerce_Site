<?php
	include 'includes/database.php';
?>
<div>
	<form method="post" action="">
		<table width="500" align="center" bgcolor="skyblue">
			<tr align="center">
				<td colspan="4">
					<h2>
						Login or Register to Continue
					</h2>
				</td>
			</tr>
			<tr>
				<td align="center">
					Email ID :
				</td>
				<td>
					<input type="text" name="email" placeholder="Enter Email ID" required="">
				</td>
			</tr>
			<tr>
				<td align="center">
					Password : 
				</td>
				<td>
					<input type="password" name="pass" placeholder="Enter Password" required="">
				</td>
			</tr>
			<tr align="center">
				<td colspan="3">
					<a href="checkout.php?forgot_pass">Forgot Password?</a>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<input type="submit" name="login" value="Login">
				</td>
			</tr>
		</table>
		<h2 style="float: left; padding: 10px;">
			<a href="customer_register.php">Register -> New Customer?</a>
		</h2>
	</form>
	<?php
		if(isset($_POST['login'])){
			$CEmail = $_POST['email'];
			$CPass = $_POST['pass'];

			$sel_cust = "select * from customers where customer_pass='$CPass' AND customer_email='$CEmail'";
			$run_cust = mysqli_query($conn, $sel_cust);
			$check_cust = mysqli_num_rows($run_cust);

			if($check_cust == 0){
				echo "<script>alert('Incorrect Password or Email ID')</script>";
				exit();
			}

			$ip = getIPAddress();
			$sel_cart = "select * from cart where ip_add='$ip'";
			$run_cart = mysqli_query($conn, $sel_cart);
			$check_cart = mysqli_num_rows($run_cart);
			if($check_cust > 0 AND $check_cart == 0){
				$_SESSION['customer_email'] = $CEmail;
				echo "<script>alert('Logged In Succesfully')</script>";
				echo "<script>window.open('customer/my_account.php','_self')</script>";
			}
			else{
				$_SESSION['customer_email'] = $CEmail;
				echo "<script>alert('Logged In Succesfully')</script>";
				echo "<script>window.open('checkout.php','_self')</script>";
			}
		}
	?>
</div>