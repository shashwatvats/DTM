<?php

include '../db.php';
include '../validate_input.php';
$columns = array('faculty_id','faculty_username','faculty_password','faculty_name','faculty_email','faculty_number', 'faculty_department');

$query = "SELECT * FROM faculty_list ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE faculty_id LIKE "%'.vi($_POST["search"]["value"]).'%" 
 OR faculty_username LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR faculty_password LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR faculty_name LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR faculty_email LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR faculty_number LIKE "%'.vi($_POST["search"]["value"]).'%"
 OR faculty_department LIKE "%'.vi($_POST["search"]["value"]).'%"
 ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' 
 ';
}
else
{
 $query .= 'ORDER BY faculty_id ';
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
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_id">' . $i . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_username">' . $row["faculty_username"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_password">' . $row["faculty_password"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_name">' . $row["faculty_name"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_email">' . $row["faculty_email"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_number">' . $row["faculty_number"] . '</div>';
 $sub_array[] = '<div id="'.$row["faculty_id"].'" data-column="faculty_department">' . strtoupper($row["faculty_department"]) . '</div>';

 
  $sub_array[] = '<button type="button" name="faculty_update" id="'.$row["faculty_id"].'" class="btn btn-warning btn-xs faculty_update">Update</button>';
 $sub_array[] = '<button type="button" name="faculty_delete" class="btn btn-danger btn-xs faculty_delete" id="'.$row["faculty_id"].'">Delete</button>';
 
 $data[] = $sub_array;
 $i=$i+1;
}

function get_all_data($connect)
{
 $query = "SELECT * FROM faculty_list";
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
