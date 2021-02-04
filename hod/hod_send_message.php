<?php
include '../db.php';
include '../validate_input.php';
session_Start();
$hod_department = $_SESSION["hod_department"];
$hod_username = $_SESSION["hod_username"];
function test_input($data) {
  $data = htmlspecialchars($data);
  return $data;
}

$check = 1;
if (empty($_POST["send_message_field"]))
 {
  $check = 0;
  $output["message"] = '<div class="alert alert-danger">Message field is required !</div>';
 }
else
 {
  $hod_message = test_input($_POST["send_message_field"]);
 }

 if ($check == 1){
	

	if (!empty($_POST['multiple_select_faculty_send_message'])){
		
		$implode_array_sent_to = array();	
		$implode_array_sent_to_faculty_id = array();	
	   foreach($_POST['multiple_select_faculty_send_message'] as $selected)
	   {
		$query = "SELECT faculty_username, faculty_name, faculty_id FROM faculty_list WHERE faculty_username = '".vi($selected)."'";
		$result = mysqli_query($connect,$query);
		$row = mysqli_fetch_assoc($result);
		$implode_array_sent_to[] = $row["faculty_name"] . " (" . $row["faculty_username"] .")";
		$implode_array_sent_to_faculty_id[] = $row["faculty_id"];
		
	   }
	   $hod_message_sent_to=implode(", ",$implode_array_sent_to);
	   $hod_message_sent_to_faculty_id=implode(", ",$implode_array_sent_to_faculty_id);
	  
	   $query = "INSERT INTO hod_message_to_faculty(hod_department, hod_message, hod_message_sent_to, hod_message_sent_to_faculty_id) VALUES(?,?,?,?)";
		 $query_prepare_statement = mysqli_prepare($connect, $query);
		 mysqli_stmt_bind_param($query_prepare_statement, "ssss", $hod_department, $hod_message, $hod_message_sent_to,$hod_message_sent_to_faculty_id);
		 if ( mysqli_stmt_execute($query_prepare_statement)){
			 $output["message"] = '<div class="alert alert-success">Message Sent</div>';
		 }
		 else{
			 $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
		 }
	
	   
	}

	elseif (!empty($_POST['select_all_faculty_send_message'])){
		$implode_array_sent_to = array();	
		$implode_array_sent_to_faculty_id = array();
	    $query = "SELECT faculty_username, faculty_name, faculty_id FROM faculty_list WHERE faculty_department = '".$hod_department."'";
	    $result = mysqli_query($connect,$query);
		
	    while($row = mysqli_fetch_assoc($result)){
	    $implode_array_sent_to[] = $row["faculty_name"] . " (" . $row["faculty_username"] .")";
	    $implode_array_sent_to_faculty_id[] = $row["faculty_id"];
        }
		$hod_message_sent_to=implode(", ",$implode_array_sent_to);
	    $hod_message_sent_to_faculty_id=implode(", ",$implode_array_sent_to_faculty_id);
		
		 $query = "INSERT INTO hod_message_to_faculty(hod_department, hod_message, hod_message_sent_to, hod_message_sent_to_faculty_id) VALUES(?,?,?,?)";
		 $query_prepare_statement = mysqli_prepare($connect, $query);
		 mysqli_stmt_bind_param($query_prepare_statement, "ssss", $hod_department, $hod_message, $hod_message_sent_to,$hod_message_sent_to_faculty_id);
		 if ( mysqli_stmt_execute($query_prepare_statement)){
			 $output["message"] = '<div class="alert alert-success">Message Sent</div>';
		 }
		 else{
			 $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
		 }
}

   else
   {
    $output["message"] = '<div class="alert alert-danger">Please Select at least one option.</div></span>';
   }
   
   $output["hod_message_sent_to_faculty_id"] = $hod_message_sent_to_faculty_id; 
   $output["hod_message_id"] = mysqli_insert_id($connect); 
   
   echo json_encode($output);	
 }
 mysqli_close($connect);

?>