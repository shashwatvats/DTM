<?php
include '../db.php';

function test_input($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }

if(isset($_POST["faculty_operation"]))
{

 if($_POST["faculty_operation"] == "Add")
 {
	 $check = 1;
// Validation of input starts	
	
    if (empty($_POST["faculty_username"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Username is required</div>';
     }
    else
     {
      $faculty_username = test_input($_POST["faculty_username"]);
      if (!preg_match("/^[a-z0-9_]*$/", $faculty_username) || strlen($faculty_username)<3)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Username must be of minimum 4 Characters and Small letters, numbers, and underscores only please !</div>';
       }
     }
	 
	  if (empty($_POST["faculty_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_password = test_input($_POST["faculty_password"]);
      if (strlen($faculty_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	  $faculty_password=md5($faculty_password);
     }
	 
	  if (empty($_POST["faculty_name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Name is required !</div>';
     }
    else
     {
      $faculty_name = test_input($_POST["faculty_name"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $faculty_name))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Only Letters are accepted in name !</div>';
       }
     }
	 
	  if (empty($_POST["faculty_email"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Email is required</div>';
     }
    else
     {
      $faculty_email = test_input($_POST["faculty_email"]);
      if (!filter_var($faculty_email, FILTER_VALIDATE_EMAIL)) 
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Email</div>';
       }
     }
	 
	  if (empty($_POST["faculty_number"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Mobile number is required</div>';
     }
    else
     {
      $faculty_number = test_input($_POST["faculty_number"]);
      if (!preg_match("/^[0-9]*$/", $faculty_number) || strlen($faculty_number)!=10)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Mobile Number</div>';
       }
     }
	 
	  if (empty($_POST["faculty_department"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Department is required</div>';
     }
    else
     {
      $faculty_department = test_input($_POST["faculty_department"]);
      if (!preg_match("/^[a-zA-Z]*$/", $faculty_department))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Letters only !</div>';
       }
     }
//validation of input ends
 if($check==1){
 $query = "SELECT DISTINCT hod_username FROM hod_list WHERE hod_department = '$faculty_department'";
 $result = mysqli_query($connect, $query);
 $row = mysqli_fetch_assoc($result);
 $table_name="hod_".$faculty_department."_".$row["hod_username"];
 $record_table_name="record_table_hod_".$faculty_department."_".$row["hod_username"];
 
 $query="CREATE TABLE faculty_".$faculty_department."_".$faculty_username."(
faculty_task_id INT(11) AUTO_INCREMENT PRIMARY KEY,
faculty_task_status VARCHAR(255) NOT NULL DEFAULT 0,
faculty_task_date_of_completed TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
faculty_task_notification INT(11) DEFAULT 0,
fk_hod_task_id INT(11) NOT NULL,
fk_record_table_id INT(11) NOT NULL,
faculty_task_assign_by VARCHAR(255) NOT NULL,
FOREIGN KEY (fk_hod_task_id) REFERENCES $table_name(hod_task_id) ON DELETE CASCADE ON UPDATE RESTRICT,
FOREIGN KEY (fk_record_table_id) REFERENCES $record_table_name(record_table_id) ON DELETE CASCADE ON UPDATE RESTRICT
)";
 if(mysqli_query($connect, $query)){
 $query = "INSERT INTO faculty_list(faculty_username, faculty_password, faculty_name, faculty_email, faculty_number, faculty_department) VALUES(?,?,?,?,?,?)";
        $query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "ssssis", $faculty_username, $faculty_password, $faculty_name, $faculty_email, $faculty_number, $faculty_department);
 if( mysqli_stmt_execute($query_prepare_statement))
 {
  echo '<div class="alert alert-success">Data Inserted</div>';
 }
 else{
	
	echo '<div class="alert alert-danger"> Error : '.mysqli_error($connect).'</div>';
	$query="DROP TABLE faculty_".$faculty_department."_".$faculty_username."";
	    mysqli_query($connect, $query);
}
 }
 else{
	
	echo '<div class="alert alert-danger">'.mysqli_error($connect).'</div>';
	 echo '<div class="alert alert-danger">Refresh The Page and try again. </div>';
 }}
 }
 else{
	echo mysqli_error($connect);
}
 
 if($_POST["faculty_operation"] == "Edit")
 {
	  $check = 1;
// Validation of input starts	
	
    if (empty($_POST["faculty_username"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Username is required</div>';
     }
    else
     {
      $faculty_username = test_input($_POST["faculty_username"]);
      if (!preg_match("/^[a-z0-9_]*$/", $faculty_username) || strlen($faculty_username)<3)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Username must be of minimum 4 Characters and Small letters, numbers, and underscores only please !</div>';
       }
     }
	 
	  if (empty($_POST["faculty_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_password = test_input($_POST["faculty_password"]);
      if (strlen($faculty_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $faculty_password=md5($faculty_password);
     }
	 
	  if (empty($_POST["faculty_name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Name is required !</div>';
     }
    else
     {
      $faculty_name = test_input($_POST["faculty_name"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $faculty_name))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Only Letters are accepted in name !</div>';
       }
     }
	 
	  if (empty($_POST["faculty_email"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Email is required</div>';
     }
    else
     {
      $faculty_email = test_input($_POST["faculty_email"]);
      if (!filter_var($faculty_email, FILTER_VALIDATE_EMAIL)) 
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Email</div>';
       }
     }
	 
	  if (empty($_POST["faculty_number"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Mobile number is required</div>';
     }
    else
     {
      $faculty_number = test_input($_POST["faculty_number"]);
      if (!preg_match("/^[0-9]*$/", $faculty_number) || strlen($faculty_number)!=10)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Mobile Number</div>';
       }
     }
	 
	  if (empty($_POST["faculty_department"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Department is required</div>';
     }
    else
     {
      $faculty_department = test_input($_POST["faculty_department"]);
      if (!preg_match("/^[a-zA-Z]*$/", $faculty_department))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Letters only !</div>';
       }
     }
//validation of input ends
 $faculty_id=test_input($_POST["faculty_id"]);
 if($check == 1){
 $query = "SELECT faculty_username,faculty_department FROM faculty_list WHERE faculty_id = '$faculty_id'";
 $result = mysqli_query($connect, $query);
 $row = mysqli_fetch_array($result);
 
$query = "ALTER TABLE faculty_".$row['faculty_department']."_" . $row['faculty_username'] . " RENAME TO faculty_".$faculty_department."_".$faculty_username."";
 if(mysqli_query($connect, $query)){
 $query = "UPDATE faculty_list
 SET faculty_username = ?, faculty_password=? , faculty_name=? , faculty_email=? , faculty_number=? , faculty_department=?
 WHERE faculty_id = '$faculty_id'";
  $query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "ssssis", $faculty_username, $faculty_password, $faculty_name, $faculty_email, $faculty_number, $faculty_department);
 if(mysqli_stmt_execute($query_prepare_statement))
 {
  echo '<div class="alert alert-success">Data Updated</div>' ;
 }
 else{
	 echo '<div class="alert alert-danger">'.mysqli_error($connect).'</div>';
	 //Rollback Starts
	$query = "ALTER TABLE faculty_".$faculty_department."_".$faculty_username." RENAME TO faculty_".$row['faculty_department']."_".$row['faculty_username']."";
     mysqli_query($connect, $query);
	 //Rollback Ends
	 
	
 }
 }else{
	echo '<div class="alert alert-danger">'.mysqli_error($connect).'</div>';
 }}
 }
 else{
	echo mysqli_error($connect);
}
}
else{
	echo mysqli_error($connect);
}
 mysqli_close($connect);
?>
   