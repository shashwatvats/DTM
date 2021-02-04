<?php
include '../db.php';
include '../validate_input.php';
if(isset($_POST["hod_id"]))
{
 $output = array();
 
 $sql = "SELECT * FROM hod_list
		 WHERE hod_id = '".vi($_POST["hod_id"])."' 
         LIMIT 1";
 $result = mysqli_query($connect, $sql);

 while($row = mysqli_fetch_assoc($result))
 {
  $output["hod_username"] = $row["hod_username"];
  $output["hod_password"] = "";
  $output["hod_name"] = $row["hod_name"];
  $output["hod_email"] = $row["hod_email"];
  $output["hod_number"] = $row["hod_number"];
  $output["hod_department"] = $row["hod_department"];
 }
 echo json_encode($output);
}
 mysqli_close($connect);
?>
   