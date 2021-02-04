<?php
include '../db.php';
include '../validate_input.php';
if(isset($_POST["faculty_id"]))
{
 $output = array();
 
 $sql = "SELECT * FROM faculty_list
		 WHERE faculty_id = '".vi($_POST["faculty_id"])."' 
         LIMIT 1";
 $result = mysqli_query($connect, $sql);

 while($row = mysqli_fetch_assoc($result))
 {
  $output["faculty_username"] = $row["faculty_username"];
  $output["faculty_password"] = "";
  $output["faculty_name"] = $row["faculty_name"];
  $output["faculty_email"] = $row["faculty_email"];
  $output["faculty_number"] = $row["faculty_number"];
  $output["faculty_department"] = $row["faculty_department"];
 }
 echo json_encode($output);
}
 mysqli_close($connect);
?>
   