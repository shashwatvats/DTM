<?php

include '../db.php';
include '../validate_input.php';
$columns = array('hod_id','hod_username','hod_password','hod_name','hod_email','hod_number', 'hod_department');

$query = "SELECT * FROM hod_list ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE hod_id LIKE "%'.vi($_POST["search"]["value"]).'%" 
 OR hod_username LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_password LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_name LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_email LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_number LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR hod_department LIKE "%'.vi($_POST["search"]["value"]).'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY hod_id ';
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
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_id">' . $i . '</div>';
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_username">' . $row["hod_username"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_password">' . $row["hod_password"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_name">' . $row["hod_name"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_email">' . $row["hod_email"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_number">' . $row["hod_number"] . '</div>';
 $sub_array[] = '<div id="'.$row["hod_id"].'" data-column="hod_department">' . strtoupper($row["hod_department"]) . '</div>';

 
  $sub_array[] = '<button type="button" name="hod_update" id="'.$row["hod_id"].'" class="btn btn-warning btn-xs hod_update">Update</button>';
 $sub_array[] = '<button type="button" name="hod_delete" class="btn btn-danger btn-xs hod_delete" id="'.$row["hod_id"].'">Delete</button>';
 
 $data[] = $sub_array;
 $i=$i+1;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM hod_list";
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
