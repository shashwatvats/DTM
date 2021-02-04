<?php
include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];
if(isset($_POST["hod_task_id"]))
{
 $output = array();
 
 $sql = "SELECT * FROM hod_".$hod_department."_".$hod_username."
		 WHERE hod_task_id = '".vi($_POST["hod_task_id"])."' 
         LIMIT 1";
 $result = mysqli_query($connect, $sql);

 while($row = mysqli_fetch_assoc($result))
 {
  $output["hod_task_name"] = $row["hod_task_name"];
  $output["hod_task_description"] = $row["hod_task_description"];
  $output["hod_task_type"] = $row["hod_task_type"];
  $output["hod_task_priority"] = $row["hod_task_priority"];
 }
 echo json_encode($output);
}
 mysqli_close($connect);
?>
   