<?php
include '../db.php';
include '../validate_input.php';
include '../email_config.php';
session_Start();
$hod_department = $_SESSION["hod_department"];
$hod_username = $_SESSION["hod_username"];
//$send_reminder_hod_task_id = vi($_POST["send_reminder_hod_task_id"]);
//$send_reminder_hod_number_of_time_task_assign = vi($_POST["send_reminder_hod_number_of_time_task_assign"]);
$status_record_table_id = vi($_POST["status_record_table_id"]);


$query = "SELECT * FROM hod_".$hod_department."_".$hod_username." , record_table_hod_".$hod_department."_".$hod_username." WHERE hod_".$hod_department."_".$hod_username.".hod_task_id = record_table_hod_".$hod_department."_".$hod_username.".record_table_fk_hod_task_id AND record_table_hod_".$hod_department."_".$hod_username.".record_table_id = '".$status_record_table_id."'";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc ($result);

$hod_task_name = $row["hod_task_name"];
$hod_task_description = $row["hod_task_description"];
$hod_task_type = $row["hod_task_type"];
$hod_task_priority = $row["hod_task_priority"];
$hod_task_assign_on = $row["hod_task_assign_on"];
$hod_task_deadline = $row["hod_task_deadline"];

$hod_department_in_capital_letters = strtoupper($hod_department);
$email_subject = "Task Reminder from HoD ".$hod_department_in_capital_letters."";
$email_body = "

<h4>A Reminder has been sent for the following task. Complete it before the Deadline ! <br> <br></h4>
<b>Task Name : </b>".$hod_task_name." <br>
<b>Task Description : </b>".$hod_task_description." <br>
<b>Task Type : </b>".$hod_task_type." <br>
<b>Task Priority : </b>".$hod_task_priority." <br><br>
<b>Task Deadline : </b>".$hod_task_deadline." <br>
<b>Task Assign on : </b>".$hod_task_assign_on." <br>


";
$mail->Subject = $email_subject;
$mail->Body    = $email_body;

$query = "SELECT * FROM faculty_list WHERE faculty_department = '".$hod_department."' ";
$result = mysqli_query($connect,$query);
while($row = mysqli_fetch_assoc($result)){
	$selected = $row["faculty_username"];
	$query1 = "SELECT * FROM faculty_".$hod_department."_".$selected." WHERE fk_record_table_id = '".$status_record_table_id."' AND faculty_task_status != '100' AND faculty_task_assign_by='9997188960_hod_".$hod_department."'";
	$result1 = mysqli_query($connect,$query1);
	$row1 = mysqli_fetch_assoc($result1);
	if(!empty($row1)){
		$faculty_email = $row["faculty_email"];
	    $mail->addBCC($faculty_email);	
	}
}
  if($mail->send())
  {
	  echo 103;
  }
  else {
	  echo 104;
  }
 mysqli_close($connect);

?>