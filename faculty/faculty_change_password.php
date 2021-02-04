<?php
include '../db.php';
session_start();
function test_input($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
 
if (isset($_POST["change_password_operation"]))
 { 
 $check = 1;
 $faculty_username = $_SESSION["faculty_username"];
 if (empty($_POST["faculty_old_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_old_change_password = test_input($_POST["faculty_old_change_password"]);
      if (strlen($faculty_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $faculty_old_change_password=md5($faculty_old_change_password);
     }
	 
	  if (empty($_POST["faculty_new_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_new_change_password = test_input($_POST["faculty_new_change_password"]);
      if (strlen($faculty_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $faculty_new_change_password=md5($faculty_new_change_password);
     }
	 
	  if (empty($_POST["faculty_confirm_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_confirm_change_password = test_input($_POST["faculty_confirm_change_password"]);
      if (strlen($faculty_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	  $faculty_confirm_change_password=md5($faculty_confirm_change_password);
     }
	 
	 // Logic of Change Password Begin
	 if($check==1 && $faculty_new_change_password==$faculty_confirm_change_password){
		 
		  $query = "SELECT * FROM faculty_list WHERE faculty_username = ? AND faculty_password = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $faculty_username, $faculty_old_change_password); 
				if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);
				  $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  {
					
					     $query = "UPDATE faculty_list
                        SET  faculty_password= ? 
                        WHERE faculty_username = '$faculty_username'";
                        $query_prepare_statement = mysqli_prepare($connect, $query);
		                mysqli_stmt_bind_param($query_prepare_statement, "s", $faculty_new_change_password);
                        if (mysqli_stmt_execute($query_prepare_statement)){
							echo '<div class="alert alert-success">Password Changed</div>';
		                }
		                else{
							echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
		                }
					
				}
				else{
					echo '<div class="alert alert-danger">Wrong Password !</div>'; 
				}
	         }
		       
	 }

 }
  mysqli_close($connect);
?>