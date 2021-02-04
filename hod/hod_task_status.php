<?php
include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];
//$hod_task_status_class = vi($_POST["hod_task_status_class"]);  //record_table_hod_task_id
//$hod_task_status_id = vi($_POST["hod_task_status_id"]); // record_table_hod_number_of_time_task_assign
$status_record_table_id = vi($_POST["status_record_table_id"]);
echo '
<div class="table-responsive">          
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Faculty Name</th>
        <th>Task Progress</th>
        <th>Updated On</th>
      </tr>
    </thead>
	<tbody>
';
$query = "SELECT * FROM faculty_list WHERE faculty_department = '".$hod_department."'";
$result = mysqli_query($connect,$query);
while($row = mysqli_fetch_assoc($result)){
	$query1 = "SELECT faculty_task_status,faculty_task_date_of_completed FROM faculty_".$hod_department."_".$row['faculty_username']."  WHERE fk_record_table_id = '".$status_record_table_id."' AND faculty_task_assign_by = '9997188960_hod_".$hod_department."'";
	$result1 = mysqli_query($connect,$query1);
    $row1 = mysqli_fetch_assoc($result1);
	if(!empty($row1))
	{	
		echo '
		<tr>
		<td>'.$row["faculty_name"].' ('.$row["faculty_username"].')</td>
		<td>
		<div class="progress">
    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="'.$row1["faculty_task_status"].'" aria-valuemin="0" aria-valuemax="100" style="width:'.$row1["faculty_task_status"].'%">
      '.$row1["faculty_task_status"].'% Complete
    </div>
  </div>
		</td>
		<td>'.$row1["faculty_task_date_of_completed"].'</td>
		</tr>
		';
	}
}
echo '
</tbody>
</table>
</div>
';
echo mysqli_error($connect);
 mysqli_close($connect);
?>