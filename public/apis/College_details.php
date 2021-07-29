<?php
    include 'Connection.php';
	

$query = "SELECT id, name, address, logo,rollup_banner, stall_id, stall_video, about, prospectus FROM collages";
$result = mysqli_query($con, $query);
 
$json_array = array();

while($row = mysqli_fetch_assoc($result))
{
 	$json_array[] = $row; 
}
echo json_encode($json_array);
?>