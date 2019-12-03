<?php
	session_start();
	session_destroy();
	echo "<script>window.open('admin_login.php?logged_out=Succesfully Logged Out.php','_self')</script>";
?>