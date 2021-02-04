<?php

include '../db.php';
include '../validate_input.php';
session_start();
$faculty_username=$_SESSION["faculty_username"];
$faculty_department = $_SESSION["faculty_department"];
$query = "SELECT hod_username FROM hod_list WHERE hod_department = '".$faculty_department."'";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$hod_username = $row["hod_username"];


$columns = array('faculty_task_id','hod_task_name','hod_task_description','hod_task_type','hod_task_priority', 'hod_task_assign_on','hod_task_deadline','hod_image_path','hod_task_assign_to','faculty_task_status');

$query = "
SELECT DISTINCT * 
FROM hod_".$faculty_department."_".$hod_username." , record_table_hod_".$faculty_department."_".$hod_username." , faculty_".$faculty_department."_".$faculty_username."
WHERE hod_".$faculty_department."_".$hod_username.".hod_task_id = record_table_hod_".$faculty_department."_".$hod_username.".record_table_fk_hod_task_id
AND hod_".$faculty_department."_".$hod_username.".hod_task_id = faculty_".$faculty_department."_".$faculty_username.".fk_hod_task_id
AND record_table_hod_".$faculty_department."_".$hod_username.".record_table_id = faculty_".$faculty_department."_".$faculty_username.".fk_record_table_id
AND record_table_hod_".$faculty_department."_".$hod_username.".record_table_fk_hod_task_id = faculty_".$faculty_department."_".$faculty_username.".fk_hod_task_id
AND faculty_".$faculty_department."_".$faculty_username.".faculty_task_assign_by='9997188960_hod_".$faculty_department."'
";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (faculty_task_id LIKE "%'.vi($_POST["search"]["value"]).'%" 
 OR hod_task_name LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_description LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_type LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_priority LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_assign_on LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_deadline LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR faculty_task_status LIKE "%'.vi($_POST["search"]["value"]).'%"
 )
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY faculty_task_id DESC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();
$i=1;
while($row = mysqli_fetch_array($result))
{

 $sub_array = array();
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="faculty_task_id">' . $i . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_name">' . $row["hod_task_name"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_description">' . nl2br($row["hod_task_description"]) . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_type">' . $row["hod_task_type"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_priority">' . $row["hod_task_priority"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_assign_on">' . date("h:i:s A, d/M/Y",strtotime($row["hod_task_assign_on"])) . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_deadline">' . date("h:i:s A, d/M/Y",strtotime($row["hod_task_deadline"])) . '</div>';
 
  if($row["hod_image_path"]!=""){
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_image_path"><a href = "'.$row["hod_image_path"].'" class="btn btn-success btn-xs" target="_blank">Click Here</a></div>';
 }
 else{
	 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_image_path">Not Available</div>';
 }
 
 $sub_array[] = '<div id="'.$row["faculty_task_id"].'" data-column="hod_task_assign_to">' . $row["hod_task_assign_to"] . '</div>';
   //$sub_array[] = '<button type="button" name="faculty_task_by_hod_status" id="'.$row["faculty_task_id"].'" class="btn btn-warning btn-xs faculty_task_by_hod_status">Status</button>';
   
   
 if($row["faculty_task_status"] == 100){
  $sub_array[] = '<button type="button" name="faculty_task_status" id="'.$row["faculty_task_id"].'" class="btn btn-success btn-xs faculty_task_status" data-backdrop="static" data-toggle="modal" data-target="#faculty_task_status_modal">Status ('.$row["faculty_task_status"].'%)</button>';
 }
 else if($row["faculty_task_status"] >= 60 && $row["faculty_task_status"] < 100){
	   $sub_array[] = '<button type="button" name="faculty_task_status" id="'.$row["faculty_task_id"].'" class="btn btn-primary btn-xs faculty_task_status" data-backdrop="static" data-toggle="modal" data-target="#faculty_task_status_modal">Status ('.$row["faculty_task_status"].'%)</button>';
 }
 else if($row["faculty_task_status"] >= 20 && $row["faculty_task_status"] < 60){
	 $sub_array[] = '<button type="button" name="faculty_task_status" id="'.$row["faculty_task_id"].'" class="btn btn-warning btn-xs faculty_task_status" data-backdrop="static" data-toggle="modal" data-target="#faculty_task_status_modal">Status ('.$row["faculty_task_status"].'%)</button>';
 }
 
 else {
	 $sub_array[] = '<button type="button" name="faculty_task_status" id="'.$row["faculty_task_id"].'" class="btn btn-danger btn-xs faculty_task_status" data-backdrop="static" data-toggle="modal" data-target="#faculty_task_status_modal">Status ('.$row["faculty_task_status"].'%)</button>';
 }
   
   
  $sub_array[] = '<button type="button" name="faculty_task_assign" id="'.$row["faculty_task_id"].'" class="btn btn-primary btn-xs faculty_task_assign" data-backdrop="static" data-toggle="modal" data-target="#faculty_task_assign_modal">Assign</button>';
  
  $sub_array[] = '<button type="button" name="report" id="'.$row["record_table_id"].'" class="btn btn-info btn-xs report" data-backdrop="static" data-toggle="modal" data-target="#report_modal">Report</button>';

 
 
 $data[] = $sub_array;
 $i=$i+1;
}



function get_all_data($connect)
{
$faculty_username=$_SESSION["faculty_username"];   // REMEMBER session variable declared again
$faculty_department = $_SESSION["faculty_department"]; //outside variable do not work inside the functions
 $query = "SELECT * FROM faculty_".$faculty_department."_".$faculty_username." WHERE faculty_task_assign_by = '9997188960_hod_".$faculty_department."'";
 $result = mysqli_query($connect, $query);
 return mysqli_num_rows($result);
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($connect),
 "recordsFiltered" => $number_filter_row,
 "data"    => $data
);
echo json_encode($output);
 mysqli_close($connect);
?>
