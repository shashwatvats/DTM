<?php
include '../db.php';
include '../validate_input.php';
session_Start();
$faculty_department = $_SESSION["faculty_department"];
$faculty_username = $_SESSION["faculty_username"];
$faculty_task_id = vi($_POST["faculty_task_id"]);
$query="SELECT faculty_name FROM faculty_list WHERE faculty_username='".$faculty_username."'"; 
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$faculty_name=$row["faculty_name"];

if (!empty($_POST['multiple_select_faculty_task_assign'])) //multiple select faculties
   {
			 $assign_status=0;
			 $query = "SELECT * FROM faculty_".$faculty_department."_".$faculty_username." WHERE faculty_task_id = '".$faculty_task_id."'";
			 $result = mysqli_query($connect,$query);
			 $row = mysqli_fetch_assoc($result);
			 $fk_hod_task_id = $row["fk_hod_task_id"];
			 $fk_record_table_id = $row["fk_record_table_id"];
			// $output["message"] = '<div class="alert alert-danger">' . $fk_hod_task_id . '</div>';
			 
			  foreach($_POST['multiple_select_faculty_task_assign'] as $selected)
                 {
				  $query = "SELECT * FROM faculty_".$faculty_department."_".$selected." WHERE fk_hod_task_id = '".$fk_hod_task_id."' AND fk_record_table_id = '".$fk_record_table_id."'";
			      $result = mysqli_query($connect,$query);
				  if(mysqli_num_rows($result)==0){
				  
				
				  $query = "INSERT INTO faculty_".$faculty_department."_".vi($selected)."(fk_hod_task_id, fk_record_table_id,faculty_task_assign_by) VALUES(?,?,?)";
				  $query_prepare_statement = mysqli_prepare($connect, $query);
		          mysqli_stmt_bind_param($query_prepare_statement, "iis", $fk_hod_task_id, $fk_record_table_id, $faculty_name);
				  if ( mysqli_stmt_execute($query_prepare_statement))
			             {             
			              $assign_status=$assign_status + 1;
                         }
						
				  }else{
					 $output["message"] = '<div class="alert alert-danger">'.mysqli_error($connect).'</div>';
				  }
               	 
                 }
				  if($assign_status!=0){
		          $output["message"] = '<div class="alert alert-success">Task Assigned</div>';
				  $output["fk_hod_task_id"] = $fk_hod_task_id; 
				  $output["fk_record_table_id"] = $fk_record_table_id; 
	             }
				 else {
					  	 $output["error"]="100"; 	
					  $output["message"] = '<div class="alert alert-danger">Task is already assigned!</div>';
				 }
		 
   }
   
   
elseif (!empty($_POST['select_all_faculty_task_assign']))
   {

			 $assign_status=0;
			 $query = "SELECT * FROM faculty_".$faculty_department."_".$faculty_username." WHERE faculty_task_id = '".$faculty_task_id."'";
			 $result = mysqli_query($connect,$query);
			 $row = mysqli_fetch_assoc($result);
			 $fk_hod_task_id = $row["fk_hod_task_id"];
			 $fk_record_table_id = $row["fk_record_table_id"];
			 
			 $query = "SELECT faculty_username FROM faculty_list WHERE faculty_department = '".$faculty_department."' AND faculty_username != '".$faculty_username."'";
			 $result = mysqli_query($connect,$query);
			 while($row = mysqli_fetch_assoc($result)){
				 $selected = $row["faculty_username"];
				 $query1 = "SELECT * FROM faculty_".$faculty_department."_".$selected." WHERE fk_hod_task_id = '".$fk_hod_task_id."' AND fk_record_table_id = '".$fk_record_table_id."'";
			     $result1 = mysqli_query($connect,$query1);
				 if(mysqli_num_rows($result1)==0){
					 
					 $query2 = "INSERT INTO faculty_".$faculty_department."_".vi($selected)."(fk_hod_task_id, fk_record_table_id,faculty_task_assign_by) VALUES(?,?,?)";
				  $query_prepare_statement = mysqli_prepare($connect, $query2);
		          mysqli_stmt_bind_param($query_prepare_statement, "iis", $fk_hod_task_id, $fk_record_table_id, $faculty_name);
				  if ( mysqli_stmt_execute($query_prepare_statement))
			             {             
			              $assign_status=$assign_status + 1;
                         }
						 
				 }
				 else{
					 $output["message"] = '<div class="alert alert-danger">'.mysqli_error($connect).'</div>';
				  }
			 }
			 if($assign_status!=0){
		          $output["message"] = '<div class="alert alert-success">Task Assigned</div>';
				  $output["fk_hod_task_id"] = $fk_hod_task_id; 
				  $output["fk_record_table_id"] = $fk_record_table_id; 
	             }
				 else {
					  $output["error"]="100"; 	
					  $output["message"] = '<div class="alert alert-danger">Task is already assigned!</div>';
				 }
		 

	}
	
   else
   {
    $output["message"] = '<div class="alert alert-danger">Please Select at least one option.</div></span>';
   }
   
   
echo json_encode($output);
mysqli_close($connect);
?>