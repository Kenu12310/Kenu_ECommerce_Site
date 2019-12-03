<?php
	$conn = mysqli_connect("localhost", "root", "", "kenuecom");

	if(mysqli_connect_errno()){
		echo "Unable to connect to MySQL : " . mysqli_connect_errno();
	}
?>