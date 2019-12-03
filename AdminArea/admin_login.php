<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Login</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css" media="all"> 
</head>
<body>
	<h2>
		<?php
			if(isset($_GET['not_logged']))
			{
				echo $_GET['not_logged'];
			}
			if(isset($_GET['logged_out']))
			{
				echo $_GET['logged_out'];
			}
			// echo @$_GET['not_logged'];
		?>
	</h2>
	<form method="post" action="admin_login.php">
		<table align="center" width="800px" border="2" bgcolor="orange">
			<tr align="center" bgcolor="blue">
				<td colspan="2">
					<h1>
						Admin Login
					</h1>
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>User Email : </b>
				</td>
				<td>
					<input type="text" name="uemail" placeholder="UserEmail" size="50" required="">
				</td>
			</tr>
			<tr>
				<td align="center">
					<b>User Password : </b>
				</td>
				<td>
					<input type="password" name="upass" placeholder="Password" size="50" required="">
				</td>
			</tr>
			<tr align="center">
				<td colspan="4">
					<button type="submit" name="admin_login">
						Login
					</button>
				</td>
			</tr>
		</table>
	
    </form>

</body>
</html>
<?php
	
	include 'includes/database.php';
	if(isset($_POST['admin_login']))
	{
		$email = mysqli_real_escape_string($conn, $_POST['uemail']);
		$pass = mysqli_real_escape_string($conn, $_POST['upass']);

		$check_user = "select * from admin where user_email='$email' and user_pass='$pass'";
		$run_user = mysqli_query($conn, $check_user);
		$cnt_user = mysqli_num_rows($run_user);
		if($cnt_user==0){
			echo "<script>alert('Invalid Email or Password')</script>";
		}
		else{
			$_SESSION['user_email']=$email;
			echo "<script>alert('Logged in as $email')</script>";
			echo "<script>window.open('index.php?logged_in=Successfully_logged_in','_self')</script>";
		}
	}
?>