<?php

include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];


$columns = array('hod_message_id','hod_message','hod_message_sent_to','hod_message_sent_on');

//$query = "SELECT * FROM hod_".$hod_department."_".$hod_username."";
$query = 'SELECT * FROM hod_message_to_faculty WHERE hod_department = "'.$hod_department.'"';

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (
 hod_message LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_message_sent_to LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_message_sent_on LIKE "%'.vi($_POST["search"]["value"]).'%"
 
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
 $query .= 'ORDER BY hod_message_sent_on DESC ';
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
 $sub_array[] = '<div id="'.$row["hod_message_id"].'" data-column="hod_message_id">' . $i . '</div>';
 $sub_array[] = '<div id="'.$row["hod_message_id"].'" data-column="hod_message">' . $row["hod_message"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_message_id"].'" data-column="hod_message_sent_to">' . $row["hod_message_sent_to"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_message_id"].'" data-column="hod_message_sent_on">' . date("h:i:s A, d/M/Y",strtotime($row["hod_message_sent_on"])) . '</div>';
 
 $sub_array[] = '<button type="button" name="hod_message_delete" class="btn btn-danger btn-xs hod_message_delete" id="'.$row["hod_message_id"].'">Delete</button>';
 
 $data[] = $sub_array;
 $i = $i+1;
}



function get_all_data($connect)
{
$hod_username=$_SESSION["hod_username"];   // REMEMBER session variable declared again
$hod_department = $_SESSION["hod_department"]; //outside variable do not work inside the functions
 $query = "SELECT * FROM hod_message_to_faculty WHERE hod_department = '".$hod_department."'";
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
