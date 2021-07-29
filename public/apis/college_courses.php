<?php
    
	include 'Connection.php';
$college_id = $_POST["CollegeID"];
//$college_id = "2";

$query = "SELECT id, course_id,  course_name FROM collage_courses WHERE college_id = '" .$college_id. "';";
$result = mysqli_query($con, $query);
 
$json_array = array();

while($row = mysqli_fetch_assoc($result))
{
 	$json_array[] = $row; 
}
echo json_encode($json_array);
?>