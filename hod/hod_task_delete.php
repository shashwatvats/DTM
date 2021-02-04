<?php
include '../db.php';
include '../validate_input.php';

session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];

if(isset($_POST["hod_task_id"]))
{
	
   //getting old file name
	$query = "SELECT hod_image_path FROM hod_".$hod_department."_".$hod_username." WHERE hod_task_id = '".vi($_POST["hod_task_id"])."'";
	 $result = mysqli_query($connect, $query);
	$row = mysqli_fetch_assoc($result);
    $old_hod_image_path = $row["hod_image_path"];
	 
	//code end
	//deleteing file
		 if($old_hod_image_path != ""){
			   unlink($old_hod_image_path);
			  
		   } 
	//file deleted
	
 $query = "DELETE FROM hod_".$hod_department."_".$hod_username." WHERE hod_task_id = '".vi($_POST["hod_task_id"])."'";
 if(mysqli_query($connect, $query))
 {
	 echo 'Data Deleted'; 
 }
 else{
  echo mysqli_error($connect);
 }

}


mysqli_close($connect);
?>
