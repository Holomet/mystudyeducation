<?php
$con = new mysqli("10.0.1.240","mystudyexpouser","aD$8eBe3FA","mystudy_expo");
	
  if ($con -> connect_errno) {
  		echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  		exit();
	}
?>