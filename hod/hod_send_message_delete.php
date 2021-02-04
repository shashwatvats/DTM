<?php
include '../db.php';
include '../validate_input.php';

session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];
if(isset($_POST["hod_message_id"])){
	
	 $query = "DELETE FROM hod_message_to_faculty WHERE hod_message_id = '".vi($_POST["hod_message_id"])."'";
	 if(mysqli_query($connect, $query)){
		  echo 'Data Deleted'; 
	 }
     else{
       echo mysqli_error($connect);
     }
}
 mysqli_close($connect);
?>