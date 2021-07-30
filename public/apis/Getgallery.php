<?php
    mysqli_fetch_array();
	include 'Connection.php';
$college_id = $_POST["CollegeID"];
//$college_id = '2';

$query = "SELECT id FROM collage_galleries WHERE college_id = '" .$college_id. "';";
$result = mysqli_query($con, $query);

$valid = mysqli_num_rows($result); 
if($valid == 0)
{
 echo "-1"; 
}
else
{
$json_array = array();
 $galleryid =  mysqli_fetch_array($result);
while($row = mysqli_fetch_assoc($result))
{
 	
 	$json_array[] = $row; 
}
echo $galleryid['id'];
  //echo json_encode($json_array);
}

?>