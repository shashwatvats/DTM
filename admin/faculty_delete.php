<?php
include '../db.php';
include '../validate_input.php';
if(isset($_POST["faculty_id"]))
{
 
 $query = "SELECT faculty_username,faculty_department FROM faculty_list WHERE faculty_id = '".vi($_POST['faculty_id'])."'";
 $result = mysqli_query($connect, $query);
 $row = mysqli_fetch_array($result);
 $table_name="faculty_".$row['faculty_department']."_".$row['faculty_username'];
 
 $query = "DROP TABLE $table_name";	
 if(mysqli_query($connect, $query))	{
 $query = "DELETE FROM faculty_list WHERE faculty_id = '".vi($_POST["faculty_id"])."'";
 if(mysqli_query($connect, $query))
 {
  echo 'Data Deleted';
 }
 else{
  echo mysqli_error($connect);
 }
}
else{
  echo mysqli_error($connect);
 }
}
 mysqli_close($connect);
?>
