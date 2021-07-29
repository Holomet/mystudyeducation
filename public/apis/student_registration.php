<?php
    
	include 'Connection.php';
    $firstname = $_POST["Firstname"];
    $lastname = $_POST["Lastname"];
    $email = $_POST["Email"];
    $phone = $_POST["Phone"];
	$status = $_POST["status"];
   $expo_zone_state_id = $_POST["expo_zone_state_id"];
	$expo_zone_id = $_POST["expo_zone_id"];
	date_default_timezone_set('Asia/Kolkata');
	$created_at = date('y-m-d h:i:s');
    

    $namecheckquery = "SELECT email,mobile FROM students WHERE email='" . $email . "' OR mobile = '" .$phone ."';";

    $namecheck = mysqli_query($con, $namecheckquery) or die("2: Email check query failed");

    if(mysqli_num_rows($namecheck) > 0)
    {
        echo ("1");
        exit();
    }
    //$insertstudent = "INSERT INTO students(first_name, last_name, email, mobile, status, expo_zone_id, 	expo_zone_state_id, created_at) VALUES ('fname', 'lname', 'email@gmail.com', '9876543210', 1, 1, 1,  '" .$created_at."');";
   
	$insertstudent = "INSERT INTO students(first_name, last_name, email, mobile, status, expo_zone_id, expo_zone_state_id, created_at) VALUES ('" .$firstname. "', '".$lastname."', '".$email."', '".$phone."', '" .$status."', '" .$expo_zone_id."', '" .$expo_zone_state_id."', '" .$created_at."');";
    mysqli_query($con, $insertstudent) or die("4:Insert player query failed ");

    echo ("0");
	
?>