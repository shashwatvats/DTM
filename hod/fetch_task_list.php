<?php

include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];


$columns = array('hod_task_id','hod_task_name','hod_task_description','hod_task_type','hod_task_priority', 'hod_task_date_of_creation');

//$query = "SELECT * FROM hod_".$hod_department."_".$hod_username."";
$query = "SELECT * FROM hod_".$hod_department."_".$hod_username."";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE hod_task_id LIKE "%'.vi($_POST["search"]["value"]).'%" 
 OR hod_task_name LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_description LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_type LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_priority LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_task_date_of_creation LIKE "%'.vi($_POST["search"]["value"]).'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY hod_task_id DESC ';
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
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_task_id">' . $i . '</div>';
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_task_name">' . $row["hod_task_name"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_task_description">' . nl2br($row["hod_task_description"]) . '</div>';
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_task_type">' . $row["hod_task_type"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_task_priority">' . $row["hod_task_priority"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_task_date_of_creation">' . date("h:i:s A, d/M/Y",strtotime($row["hod_task_date_of_creation"])) . '</div>';
 
 if($row["hod_image_path"]!=""){
 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_image_path"><a href = "'.$row["hod_image_path"].'" class="btn btn-success btn-xs" target="_blank">Click Here</a></div>';
 }
 else{
	 $sub_array[] = '<div id="'.$row["hod_task_id"].'" data-column="hod_image_path">Not Available</div>';
 }
 
  $sub_array[] = '<button type="button" name="hod_task_assign" id="'.$row["hod_task_id"].'" class="btn btn-primary btn-xs hod_task_assign" data-backdrop="static" data-toggle="modal" data-target="#hod_task_assign_modal">Assign</button>';
  $sub_array[] = '<button type="button" name="hod_task_update" id="'.$row["hod_task_id"].'" class="btn btn-warning btn-xs hod_task_update">Update</button>';
 $sub_array[] = '<button type="button" name="hod_task_delete" class="btn btn-danger btn-xs hod_task_delete" id="'.$row["hod_task_id"].'">Delete</button>';
 
 $data[] = $sub_array;
 $i=$i+1;
}



function get_all_data($connect)
{
$hod_username=$_SESSION["hod_username"];   // REMEMBER session variable declared again
$hod_department = $_SESSION["hod_department"]; //outside variable do not work inside the functions
 $query = "SELECT * FROM hod_".$hod_department."_".$hod_username."";
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
