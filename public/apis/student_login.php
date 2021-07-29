<?php
    
	include 'Connection.php';

	//echo "1: Connection success";
    $email = $_POST["Email"];
    $phone = $_POST["Phone"];
    
    $emailcheckquery = "SELECT email,mobile FROM students WHERE email ='" . $email . "' OR mobile ='" .$phone. "';";

	//$emailcheckquery = "SELECT Email,Phone FROM student_details WHERE Email = 'email@gmail.com' OR Phone = '9876543210';";
	
   	$emailcheck = mysqli_query($con, $namecheckquery) or die("2: Email exists or phone number");
	
   $result = mysqli_num_rows($emailcheck);
	

    if($result != 0)
    {      
      //email exists
       echo ("1");
       exit();      
    }
	else
    {  
     //email not exist
   		echo ("0");
    }
?>