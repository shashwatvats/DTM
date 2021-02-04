<?php
include '../db.php';
session_start();
$faculty_username=$_SESSION["faculty_username"];
$faculty_department = $_SESSION["faculty_department"];
date_default_timezone_set("Asia/Kolkata");
$current_timestamp = date("Y-m-d H:i:s");
function test_input($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
 
$check = 1;

if (empty($_POST["select_task_status"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Select at least one option !</div>';
     }
else
     {
      $select_task_status = test_input($_POST["select_task_status"]);
     }

if (empty($_POST["hod_status_faculty_task_id"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">ID can not be blank !</div>';
     }
else
     {
      $faculty_task_id = test_input($_POST["hod_status_faculty_task_id"]);
     } 	 
	 
if ($check == 1)
{        $faculty_task_notification = '0';
		 $query = "UPDATE faculty_".$faculty_department."_".$faculty_username."
         SET faculty_task_status = ?, faculty_task_notification = ?, faculty_task_date_of_completed = ?
         WHERE faculty_task_id = '".$faculty_task_id."'";
        $query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "sis", $select_task_status , $faculty_task_notification, $current_timestamp);
      if(mysqli_stmt_execute($query_prepare_statement)){
	   echo '<div class="alert alert-success">Data Updated</div>';
	  }
	  else {
		  echo '<div class="alert alert-danger">'.mysqli_error($connect).'</div>';
	  }
}
mysqli_close($connect);	 
?>