<?php

include '../db.php';
session_start();
$faculty_username=$_SESSION["faculty_username"];
$faculty_department = $_SESSION["faculty_department"];
$query = "SELECT faculty_id FROM faculty_list WHERE faculty_username = '".$faculty_username."'";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$faculty_id= $row["faculty_id"];
$faculty_department_in_capital_letters = strtoupper($faculty_department);

$faculty = array();
$message_id = array();
$query = "SELECT hod_message_sent_to_faculty_id,hod_message_id FROM hod_message_to_faculty WHERE hod_department = '".$faculty_department."' ORDER BY hod_message_sent_on DESC";
$result = mysqli_query($connect,$query);

while($row = mysqli_fetch_assoc($result)){
$faculty_sub_array = array();
$faculty_sub_array = explode(", ",$row["hod_message_sent_to_faculty_id"])	;
$faculty[] = $faculty_sub_array;
$message_id[] = $row["hod_message_id"];
}
$j=1;
$i=0;
foreach($faculty as $selected){
	
	foreach($selected as $temp){
		
	if($temp == $faculty_id){
	$query= "SELECT * FROM hod_message_to_faculty WHERE hod_message_id = '".$message_id[$i]."' ";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    echo '
	
	  <tr>
        <td>'.$j.'</td>
        <td>'.$row["hod_message"].'</td>
        <td>'.date("h:i:s A, d/M/Y",strtotime($row["hod_message_sent_on"])).'</td>
        <td>HoD '.$faculty_department_in_capital_letters.'</td>
      </tr>
	
	';
	$j = $j+1;
	}
	
	}
	
	$i = $i+1;
}

echo mysqli_error($connect);
mysqli_close($connect);
?>
