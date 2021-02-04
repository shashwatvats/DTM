<?php
include '../db.php';
include '../validate_input.php';
session_Start();
$hod_department = $_SESSION["hod_department"];
$hod_username = $_SESSION["hod_username"];
$_SESSION["date_timepicker_start"] = 0;
$_SESSION["date_timepicker_end"] = 0;
    if (empty($_POST["date_timepicker_start"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Start Date is required !</div>';
     }
    else
     {
     $date_timepicker_start = vi($_POST["date_timepicker_start"])." 00:00:00";
     //$_SESSION["date_timepicker_start"] = vi($_POST["date_timepicker_start"]);
     }
 
if (empty($_POST["date_timepicker_end"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">End Date is required !</div>';
     }
    else
     {
     $date_timepicker_end = vi($_POST["date_timepicker_end"])." 23:59:59";
     //$_SESSION["date_timepicker_end"] = vi($_POST["date_timepicker_end"]);
     }

$query = "SELECT record_table_id 
FROM record_table_hod_".$hod_department."_".$hod_username." 
WHERE hod_task_assign_on >= '".$date_timepicker_start."'
ORDER BY hod_task_assign_on ASC
LIMIT 1
";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$record_table_start_id = $row["record_table_id"];
//$_SESSION["date_timepicker_start"] = $row["record_table_id"];

$query = "SELECT record_table_id 
FROM record_table_hod_".$hod_department."_".$hod_username." 
WHERE hod_task_assign_on <= '".$date_timepicker_end."'
ORDER BY hod_task_assign_on DESC
LIMIT 1
";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$record_table_end_id = $row["record_table_id"];
//$_SESSION["date_timepicker_end"] = $row["record_table_id"];

if(!empty($record_table_start_id) && !empty($record_table_end_id)){
	$_SESSION["date_timepicker_start"] = $record_table_start_id;
	$_SESSION["date_timepicker_end"] = $record_table_end_id;
}else{
	
}

//echo $date_timepicker_start . "<br>";
//echo $date_timepicker_end . "<br>";
//echo $_SESSION["date_timepicker_start"] . "<br>";
//echo $_SESSION["date_timepicker_end"] . "<br>";
echo mysqli_error($connect);

mysqli_close($connect);
?>