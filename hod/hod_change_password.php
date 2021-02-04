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
 $hod_username = $_SESSION["hod_username"];
 if (empty($_POST["hod_old_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_old_change_password = test_input($_POST["hod_old_change_password"]);
      if (strlen($hod_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $hod_old_change_password=md5($hod_old_change_password);
     }
	 
	  if (empty($_POST["hod_new_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_new_change_password = test_input($_POST["hod_new_change_password"]);
      if (strlen($hod_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $hod_new_change_password=md5($hod_new_change_password);
     }
	 
	  if (empty($_POST["hod_confirm_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_confirm_change_password = test_input($_POST["hod_confirm_change_password"]);
      if (strlen($hod_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	  $hod_confirm_change_password=md5($hod_confirm_change_password);
     }
	 
	 // Logic of Change Password Begin
	 if($check==1 && $hod_new_change_password==$hod_confirm_change_password){
		 
		  $query = "SELECT * FROM hod_list WHERE hod_username = ? AND hod_password = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $hod_username, $hod_old_change_password); 
				if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);
				  $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  {
					
					     $query = "UPDATE hod_list
                        SET  hod_password= ? 
                        WHERE hod_username = '$hod_username'";
                        $query_prepare_statement = mysqli_prepare($connect, $query);
		                mysqli_stmt_bind_param($query_prepare_statement, "s", $hod_new_change_password);
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