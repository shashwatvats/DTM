<?php
//fetch.php;

if(isset($_POST["view"])) {
 include("../db.php");
 session_start();
 $hod_username=$_SESSION["hod_username"];
 $hod_department = $_SESSION["hod_department"];


 
 $output = '';
 $query = "SELECT faculty_username,faculty_name FROM faculty_list WHERE faculty_department = '".$hod_department."'";
 $result = mysqli_query($connect,$query);
 $temp = 0;
 while($row = mysqli_fetch_assoc($result)){
	   $fetch_query = "
	   
	   SELECT DISTINCT * FROM hod_".$hod_department."_".$hod_username.",record_table_hod_".$hod_department."_".$hod_username.",faculty_".$hod_department."_".$row["faculty_username"]." 
	   WHERE hod_".$hod_department."_".$hod_username.".hod_task_id = faculty_".$hod_department."_".$row["faculty_username"].".fk_hod_task_id
	   AND hod_".$hod_department."_".$hod_username.".hod_task_id = record_table_hod_".$hod_department."_".$hod_username.".record_table_fk_hod_task_id
	   AND record_table_hod_".$hod_department."_".$hod_username.".record_table_id = faculty_".$hod_department."_".$row["faculty_username"].".fk_record_table_id
	   AND record_table_hod_".$hod_department."_".$hod_username.".record_table_fk_hod_task_id = faculty_".$hod_department."_".$row["faculty_username"].".fk_hod_task_id
	   AND faculty_task_status = '100' 
	   AND faculty_task_notification = '0' 
	   AND faculty_task_assign_by = '9997188960_hod_".$hod_department."'
	 ";
	 $fetch_result = mysqli_query($connect, $fetch_query);
	  if(mysqli_num_rows($fetch_result) > 0)
       {
        while($fetch_row = mysqli_fetch_assoc($fetch_result))
         {
		   $temp = $temp + 1;
           $output .= '
		   <h4><b><span class = "text-danger">'.$row["faculty_name"].' ('.$row["faculty_username"].')</span> </b> has completed the following task. </h4>
           <b><span>Task Name : </span></b>
           <b><span class = "text-primary">'.$fetch_row["hod_task_name"].'</span></b> <br>
           <b><span>Task Description : </span></b>
		   <b><span class = "text-primary">'.$fetch_row["hod_task_description"].'</span></b>
           <hr>
           ';
         }
       }
 }
if($temp == 0){
	$output .= '<b><h4><span class = "text-danger">No New Notification Found !</span></h4></b>';
}
  if($_POST["view"] != '')
 {
  $query = "SELECT faculty_username FROM faculty_list WHERE faculty_department = '".$hod_department."'";
  $result = mysqli_query($connect,$query);
  while($row = mysqli_fetch_assoc($result)){  
  $update_query = "UPDATE faculty_".$hod_department."_".$row["faculty_username"]." SET faculty_task_notification = '1' WHERE faculty_task_notification = '0' AND faculty_task_status = '100' AND faculty_task_assign_by = '9997188960_hod_".$hod_department."'";
   mysqli_query($connect, $update_query);
 } 
 }

  $count = 0;
  $query = "SELECT faculty_username FROM faculty_list WHERE faculty_department = '".$hod_department."'";
  $result = mysqli_query($connect,$query);
  while($row = mysqli_fetch_assoc($result)){ 
	$query1 = "SELECT * FROM faculty_".$hod_department."_".$row["faculty_username"]." WHERE faculty_task_notification = '0' AND faculty_task_status = '100' AND faculty_task_assign_by = '9997188960_hod_".$hod_department."'";
	$result1=mysqli_query($connect,$query1);
	$count = $count + mysqli_num_rows($result1);
  }
  
 $data = array(
  'notification'   => $output,
  'unseen_notification' => $count
 );
 echo json_encode($data);
  mysqli_close($connect);
}

?>
