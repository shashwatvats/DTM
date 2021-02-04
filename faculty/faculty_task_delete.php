<?php
include '../db.php';
include '../validate_input.php';
session_start();
$faculty_username=$_SESSION["faculty_username"];
$faculty_department = $_SESSION["faculty_department"];

$check = 1;

if (empty($_POST["faculty_task_id"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">ID can not be blank !</div>';
     }
else
     {
      $faculty_task_id = vi($_POST["faculty_task_id"]);
     }
	 
if ($check == 1)
{
	$query = "DELETE FROM faculty_".$faculty_department."_".$faculty_username." WHERE faculty_task_id = '".$faculty_task_id."'";
	if(mysqli_query($connect,$query)){
		echo "Data Deleted";
	}
	else{
		echo mysqli_error($connect);
	}
}
 mysqli_close($connect);	 
?>