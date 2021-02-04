<?php
include '../db.php';
include '../validate_input.php';

session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];
if(isset($_POST["delete_assign_record_table_id"])){

$delete_assign_record_table_id = vi($_POST["delete_assign_record_table_id"]);

$query = "DELETE FROM record_table_hod_".$hod_department."_".$hod_username." WHERE record_table_id = '".$delete_assign_record_table_id."' ";
 if(mysqli_query($connect,$query)){
		echo 'Data Deleted'; 
	 }
else{
	echo mysqli_error($connect);
}

}
 mysqli_close($connect);
?>