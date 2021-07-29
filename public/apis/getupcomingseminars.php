<?php
    
	include 'Connection.php';

	date_default_timezone_set('Asia/Kolkata');
	$date_now = date('y-m-d');
	//$date_now = new DateTime("Y-m-d");

//echo $date_now;
$query = "SELECT name, description, url FROM seminars WHERE start_date >'" .$date_now. "';";
$result = mysqli_query($con, $query);
 
$json_array = array();

while($row = mysqli_fetch_assoc($result))
{
 	$json_array[] = $row; 
}
echo json_encode($json_array);
?>