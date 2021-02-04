<?php
include '../db.php';
include '../validate_input.php';
session_start();
$faculty_username=$_SESSION["faculty_username"];
$faculty_department = $_SESSION["faculty_department"];

$check = 1;

if (empty($_POST["record_table_id"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">ID can not be blank !</div>';
     }
else
     {
      $record_table_id = vi($_POST["record_table_id"]);
     }
if ($check == 1)
{
	$status = 0;
	$query="SELECT * FROM faculty_list WHERE faculty_department='".$faculty_department."' ";
	$result=mysqli_query($connect,$query);
	while($row=mysqli_fetch_assoc($result)){
      $selected=$row["faculty_username"];
      $query1="DELETE FROM faculty_".$faculty_department."_".vi($selected)." WHERE fk_record_table_id='".$record_table_id."' AND faculty_task_assign_by != '9997188960_hod_".$faculty_department."'";
	  if(mysqli_query($connect,$query1)){
		$status = $status + 1;
	}
	else{
		echo mysqli_error($connect);
	}
	  
	}
	
	if($status > 0){
		echo "Data Deleted";
	}
	else{
		echo mysqli_error($connect);
	}
	
}
 mysqli_close($connect);	
?>