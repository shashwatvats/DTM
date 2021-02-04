<?php  
include '../db.php';

if(isset($_POST["hod_username"]))
{
 $hod_username = mysqli_real_escape_string($connect, $_POST["hod_username"]);
 $query = "SELECT * FROM hod_list WHERE hod_username = '".$hod_username."'";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}

if(isset($_POST["hod_email"]))
{
 $hod_email = mysqli_real_escape_string($connect, $_POST["hod_email"]);
 $query = "SELECT * FROM hod_list WHERE hod_email = '".$hod_email."'";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}

if(isset($_POST["hod_number"]))
{
 $hod_number = mysqli_real_escape_string($connect, $_POST["hod_number"]);
 $query = "SELECT * FROM hod_list WHERE hod_number = '".$hod_number."'";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}

if(isset($_POST["faculty_username"]))
{
 $faculty_username = mysqli_real_escape_string($connect, $_POST["faculty_username"]);
 $query = "SELECT * FROM faculty_list WHERE faculty_username = '".$faculty_username."'";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}

if(isset($_POST["faculty_email"]))
{
 $faculty_email = mysqli_real_escape_string($connect, $_POST["faculty_email"]);
 $query = "SELECT * FROM faculty_list WHERE faculty_email = '".$faculty_email."'";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}

if(isset($_POST["faculty_number"]))
{
 $faculty_number = mysqli_real_escape_string($connect, $_POST["faculty_number"]);
 $query = "SELECT * FROM faculty_list WHERE faculty_number = '".$faculty_number."'";
 $result = mysqli_query($connect, $query);
 echo mysqli_num_rows($result);
}

 mysqli_close($connect);
?>
