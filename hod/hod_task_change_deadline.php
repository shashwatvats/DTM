<?php
include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];
function test_input($data) {
  $data = htmlspecialchars($data);
  return $data;
}

//$change_deadline_hod_task_id = vi($_POST["change_deadline_hod_task_id"]);
//$change_deadline_hod_number_of_time_task_assign = vi($_POST["change_deadline_hod_number_of_time_task_assign"]);
$change_deadline_record_table_id = vi($_POST["change_deadline_record_table_id"]);

$check = 1;
if (empty($_POST["change_deadline"]))
 {
  $check = 0;
  echo '<div class="alert alert-danger">Date is required !</div>';
 }
else
 {
  $change_deadline = test_input($_POST["change_deadline"]);
 }

if ($check == 1) {

$query = "UPDATE record_table_hod_".$hod_department."_".$hod_username."
          SET hod_task_deadline = '".$change_deadline."' 
		  WHERE record_table_id = '".$change_deadline_record_table_id."' ";
		  
if(mysqli_query($connect,$query)){
  echo '<div class="alert alert-success">Deadline Changed</div>';
}
else {
  echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';	
}

}
 mysqli_close($connect);
?>