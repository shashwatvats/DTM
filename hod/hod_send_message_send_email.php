<?php
include '../db.php';
include '../validate_input.php';
include '../email_config.php';
session_Start();
$hod_department = $_SESSION["hod_department"];
$hod_username = $_SESSION["hod_username"];

$hod_message_id = vi($_POST["hod_message_id"]);
$hod_message_sent_to_faculty_id = vi($_POST["hod_message_sent_to_faculty_id"]);

$faculty_id = array();
$faculty_id = explode(", ",$hod_message_sent_to_faculty_id);
$faculty_email_array = array();
foreach($faculty_id as $selected){
	$query = "SELECT faculty_email FROM faculty_list WHERE faculty_id = '".$selected."'";
	$result = mysqli_query($connect,$query);
	$row = mysqli_fetch_assoc($result);
	$faculty_email_array[] = $row["faculty_email"];
}
    $query = "SELECT hod_message FROM hod_message_to_faculty WHERE hod_message_id = '".$hod_message_id."'";
	$result = mysqli_query($connect,$query);
	$row = mysqli_fetch_assoc($result);
	$hod_message = $row["hod_message"];
	
	
$hod_department_in_capital_letters = strtoupper($hod_department);

$email_subject = "New Message from HoD ".$hod_department_in_capital_letters."";
$email_body = "
<h4>You have received a new message from HoD ".$hod_department_in_capital_letters.". <br> <br></h4>
<b>Message : </b>".$hod_message." <br>
";

$mail->Subject = $email_subject;
$mail->Body    = $email_body;
	
	
foreach($faculty_email_array as $faculty_email){
	$mail->addBCC($faculty_email);	
}

  if($mail->send())
  {
	  echo 105;
  }
  else {
	  echo 106;
  }
 mysqli_close($connect);

?>