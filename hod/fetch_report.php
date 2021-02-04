<?php
include '../db.php';
include '../validate_input.php';
session_Start();
$hod_department = $_SESSION["hod_department"];
$hod_username = $_SESSION["hod_username"];

$columns = array('hod_task_assign_on','hod_task_name','hod_task_description','hod_task_type','hod_task_priority', 'hod_task_deadline','hod_task_assign_to');

$query = "SELECT * FROM hod_".$hod_department."_".$hod_username." , record_table_hod_".$hod_department."_".$hod_username."
 WHERE hod_".$hod_department."_".$hod_username.".hod_task_id = record_table_hod_".$hod_department."_".$hod_username.".record_table_fk_hod_task_id AND record_table_hod_".$hod_department."_".$hod_username.".record_table_id BETWEEN '".$_SESSION["date_timepicker_start"]."' AND '".$_SESSION["date_timepicker_end"]."'";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (record_table_hod_'.$hod_department.'_'.$hod_username.'.hod_task_assign_on LIKE "%'.vi($_POST["search"]["value"]).'%" 
 OR hod_'.$hod_department.'_'.$hod_username.'.hod_task_name LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_'.$hod_department.'_'.$hod_username.'.hod_task_description LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_'.$hod_department.'_'.$hod_username.'.hod_task_type LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_'.$hod_department.'_'.$hod_username.'.hod_task_priority LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR record_table_hod_'.$hod_department.'_'.$hod_username.'.hod_task_deadline LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR record_table_hod_'.$hod_department.'_'.$hod_username.'.hod_task_assign_to LIKE "%'.vi($_POST["search"]["value"]).'%")
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= "ORDER BY record_table_hod_".$hod_department."_".$hod_username.".hod_task_assign_on DESC ";
}


$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$number_filter_row = mysqli_num_rows(mysqli_query($connect, $query));

$result = mysqli_query($connect, $query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{

 $sub_array = array();
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_assign_on">' .date("h:i:s A, d/M/Y",strtotime($row["hod_task_assign_on"]))  . '</div>';
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_name">' . $row["hod_task_name"] . '</div>';
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_description">' . nl2br($row["hod_task_description"]) . '</div>';
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_type">' . $row["hod_task_type"] . '</div>';
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_priority">' . $row["hod_task_priority"] . '</div>';
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_deadline">' . date("h:i:s A, d/M/Y",strtotime($row["hod_task_deadline"])) . '</div>';
 $sub_array[] = '<div id="'.$row["record_table_id"].'" data-column="hod_task_assign_to">' . $row["hod_task_assign_to"] . '</div>';

 if($row["hod_image_path"]!=""){
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_image_path"><a href = "'.$row["hod_image_path"].'" class="btn btn-success btn-xs" target="_blank">Click Here</a></div>';
 }
 else{
	 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_image_path">Not Available</div>';
 }
 
  $sub_array[] = '<button type="button" name="hod_task_status" id="'.$row["record_table_id"].'" class="btn btn-primary btn-xs hod_task_status" data-backdrop="static" data-toggle="modal" data-target="#hod_task_status_modal">Status</button>';
  $sub_array[] = '<button type="button" name="hod_task_change_deadline" id="'.$row["record_table_id"].'" class="btn btn-warning btn-xs hod_task_change_deadline" data-backdrop="static" data-toggle="modal" data-target="#hod_task_change_deadline_modal">Change</button>';
 $sub_array[] = '<button type="button" name="hod_task_assign_delete" class="btn btn-danger btn-xs hod_task_assign_delete" id="'.$row["record_table_id"].'" data-backdrop="static" data-toggle="modal" data-target="#hod_task_assign_delete_modal">Delete</button>';
 
 $data[] = $sub_array;
}



function get_all_data($connect)
{
$hod_username=$_SESSION["hod_username"];   // REMEMBER session variable declared again
$hod_department = $_SESSION["hod_department"]; //outside variable do not work inside the functions
 $query = "SELECT * FROM record_table_hod_".$hod_department."_".$hod_username."";
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