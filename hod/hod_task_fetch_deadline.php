<?php
include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];

//$change_deadline_hod_task_id = vi($_POST["change_deadline_hod_task_id"]);
//$change_deadline_hod_number_of_time_task_assign = vi($_POST["change_deadline_hod_number_of_time_task_assign"]);

$change_deadline_record_table_id = vi($_POST["change_deadline_record_table_id"]);

$query = "SELECT hod_task_deadline FROM record_table_hod_".$hod_department."_".$hod_username." WHERE record_table_id = '".$change_deadline_record_table_id."' ";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);

echo $row["hod_task_deadline"];
 mysqli_close($connect);
?>