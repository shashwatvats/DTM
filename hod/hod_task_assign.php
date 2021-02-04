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

$assign_hod_task_id = vi($_POST["assign_hod_task_id"]);
 /*$query = "SELECT hod_number_of_time_task_assign FROM hod_".$hod_department."_".$hod_username." WHERE hod_task_id = $hod_task_assign_id";
 $result = mysqli_query($connect,$query);
 $row = mysqli_fetch_assoc($result);
 $hod_task_assign_count = $row["hod_number_of_time_task_assign"];*/
 
$check = 1;
if (empty($_POST["datetimepicker"]))
 {
  $check = 0;
  $output["message"] = '<div class="alert alert-danger">Date is required !</div>';
 }
else
 {
  $datetimepicker = test_input($_POST["datetimepicker"]);
 }

if ($check == 1)
 {
	 
	 
	 
  if (!empty($_POST['multiple_select_faculty_task_assign'])) //multiple select faculties
   {
	$implode_array = array();	
	foreach($_POST['multiple_select_faculty_task_assign'] as $selected) //code for array of assigned to
	{
		$query = "SELECT faculty_username, faculty_name FROM faculty_list WHERE faculty_username = '".vi($selected)."'";
		$result = mysqli_query($connect,$query);
		$row = mysqli_fetch_assoc($result);
		$implode_array[] = $row["faculty_name"] . " (" . $row["faculty_username"] .")";
	}
	$hod_task_assign_to=implode(", ",$implode_array); //string var stores assigned to info
	$query = "INSERT INTO record_table_hod_".$hod_department."_".$hod_username."(record_table_fk_hod_task_id, hod_task_assign_to, hod_task_deadline) VALUES(?,?,?)";
		 $query_prepare_statement = mysqli_prepare($connect, $query);
		 mysqli_stmt_bind_param($query_prepare_statement, "iss", $assign_hod_task_id, $hod_task_assign_to,$datetimepicker);
		 if ( mysqli_stmt_execute($query_prepare_statement)){
			 $assign_status=0;
			 $faculty_task_assign_by="9997188960_hod_".$hod_department;
			 $assign_record_table_id = mysqli_stmt_insert_id ($query_prepare_statement); //store last record table id
			 foreach($_POST['multiple_select_faculty_task_assign'] as $selected)
                 {
                 $query = "INSERT INTO faculty_".$hod_department."_".vi($selected)."(fk_hod_task_id, fk_record_table_id,faculty_task_assign_by) VALUES(?,?,?)";
		         $query_prepare_statement = mysqli_prepare($connect, $query);
		         mysqli_stmt_bind_param($query_prepare_statement, "iis", $assign_hod_task_id, $assign_record_table_id,$faculty_task_assign_by);
                 if ( mysqli_stmt_execute($query_prepare_statement))
			       {             
			         $assign_status=$assign_status + 1;
                   }	 
                 }
				 if($assign_status!=0){
		          $output["message"] = '<div class="alert alert-success">Task Assigned</div>';
				  $output["assign_record_table_id"] = $assign_record_table_id; 
	             }
				 else {
					  
					  $query = "DELETE FROM record_table_hod_".$hod_department."_".$hod_username." WHERE record_table_id = '".$assign_record_table_id."' AND record_table_fk_hod_task_id = '".$assign_hod_task_id."' ";
					  mysqli_query($connect,$query);
					 	
					  $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
				 }
		 }
		 else {
		 $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
	}	 
 }
   
   
   
   
  elseif (!empty($_POST['select_all_faculty_task_assign']))
   {
	$implode_array = array();
	$query = "SELECT faculty_username, faculty_name FROM faculty_list WHERE faculty_department = '".$hod_department."'";
	$result = mysqli_query($connect,$query);
	while($row = mysqli_fetch_assoc($result)){
	$implode_array[] = $row["faculty_name"] . " (" . $row["faculty_username"] .")";
    }
	$hod_task_assign_to=implode(", ",$implode_array);
    $faculty_task_assign_by="9997188960_hod_".$hod_department;
	$query = "INSERT INTO record_table_hod_".$hod_department."_".$hod_username."(record_table_fk_hod_task_id, hod_task_assign_to, hod_task_deadline) VALUES(?,?,?)";
		 $query_prepare_statement = mysqli_prepare($connect, $query);
		 mysqli_stmt_bind_param($query_prepare_statement, "iss", $assign_hod_task_id, $hod_task_assign_to,$datetimepicker);
		 if ( mysqli_stmt_execute($query_prepare_statement)){
			 $assign_status=0;
			 $assign_record_table_id = mysqli_stmt_insert_id ($query_prepare_statement);
			 $query = "SELECT faculty_username FROM faculty_list WHERE faculty_department = '".$_SESSION['hod_department']."'";
	         $result = mysqli_query($connect,$query);
			 while($row = mysqli_fetch_assoc($result)){
		        $selected = $row["faculty_username"];
		        $query = "INSERT INTO faculty_".$hod_department."_".vi($selected)."(fk_hod_task_id, fk_record_table_id, faculty_task_assign_by) VALUES(?,?,?)";
		         $query_prepare_statement = mysqli_prepare($connect, $query);
		         mysqli_stmt_bind_param($query_prepare_statement, "iis", $assign_hod_task_id, $assign_record_table_id, $faculty_task_assign_by);
                 if ( mysqli_stmt_execute($query_prepare_statement))
			       {             
			         $assign_status=$assign_status + 1;
                   }
	         }
				 if($assign_status!=0){
		          $output["message"] = '<div class="alert alert-success">Task Assigned</div>';
				  $output["assign_record_table_id"] = $assign_record_table_id; 
	             }
				 else {
					  
					  $query = "DELETE FROM record_table_hod_".$hod_department."_".$hod_username." WHERE record_table_id = '".$assign_record_table_id."' AND record_table_fk_hod_task_id = '".$assign_hod_task_id."' ";
					  mysqli_query($connect,$query);
					 	
					  $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
				 }
		 }
	/*$new_hod_task_assign_count = $hod_task_assign_count + 1;
	$query = "UPDATE hod_".$hod_department."_".$hod_username."
              SET hod_number_of_time_task_assign = $new_hod_task_assign_count 
			  WHERE hod_task_id = $hod_task_assign_id";
	if(mysqli_query($connect,$query)){
		$query = "INSERT INTO hod_assign_task_record_table(hod_username, record_table_hod_task_id, record_table_hod_number_of_time_task_assign, hod_task_assign_to, hod_task_deadline) VALUES(?,?,?,?,?)";
		 $query_prepare_statement = mysqli_prepare($connect, $query);
		 mysqli_stmt_bind_param($query_prepare_statement, "siiss", $hod_username, $hod_task_assign_id, $new_hod_task_assign_count,$hod_task_assign_to,$datetimepicker);
		 if ( mysqli_stmt_execute($query_prepare_statement)){
			 $assign_status=0;
             $query = "SELECT faculty_username FROM faculty_list WHERE faculty_department = '".$_SESSION['hod_department']."'";
	         $result = mysqli_query($connect,$query);
			 while($row = mysqli_fetch_assoc($result)){
		        $selected = $row["faculty_username"];
		        $query = "INSERT INTO faculty_".$hod_department."_".$selected."(fk_hod_task_id, link_hod_number_of_time_task_assign) VALUES(?,?)";
		        $query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ii", $hod_task_assign_id, $new_hod_task_assign_count);
				if ( mysqli_stmt_execute($query_prepare_statement))
			      {             
			        $assign_status=$assign_status + 1;
                  }
	         }
		     if($assign_status!=0){
		       $output["message"] = '<div class="alert alert-success">Task Assigned</div>';
	         }
	         else {
				
			    $query = "DELETE FROM hod_assign_task_record_table WHERE hod_username = '".$hod_username."' AND record_table_hod_task_id = '".$hod_task_assign_id."' AND record_table_hod_number_of_time_task_assign = '".$new_hod_task_assign_count."' ";
			    mysqli_query($connect,$query);
					 
					  $new_hod_task_assign_count = $hod_task_assign_count - 1;
	                  $query = "UPDATE hod_".$hod_department."_".$hod_username."
                      SET hod_number_of_time_task_assign = $new_hod_task_assign_count 
			          WHERE hod_task_id = $hod_task_assign_id"; 
                      mysqli_query($connect,$query);
				 
		       $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
	         }
		 }
		 else{
			  $new_hod_task_assign_count = $hod_task_assign_count - 1;
	          $query = "UPDATE hod_".$hod_department."_".$hod_username."
              SET hod_number_of_time_task_assign = $new_hod_task_assign_count 
			  WHERE hod_task_id = $hod_task_assign_id"; 
              mysqli_query($connect,$query);	
			  $output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
		 }
	}*/
	else{
		$output["message"] = '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
	}
   }
   
   
   
   
  else
   {
    $output["message"] = '<div class="alert alert-danger">Please Select at least one option.</div></span>';
   }
   
   $output["assign_hod_task_id"] = $assign_hod_task_id; 
   
   
   echo json_encode($output);
 }
 mysqli_close($connect);
?>