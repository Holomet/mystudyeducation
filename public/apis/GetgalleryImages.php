<?php
    
	include 'Connection.php';
$college_galleryid = $_POST["GalleryID"];
//$college_galleryid = '1';

$query = "SELECT name FROM collage_gallery_images WHERE college_gallery_id = '" .$college_galleryid. "';";
$result = mysqli_query($con, $query);
 
$json_array = array();

while($row = mysqli_fetch_assoc($result))
{
 	$json_array[] = $row; 
}
echo json_encode($json_array);
?>