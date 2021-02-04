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
 $admin_username = $_SESSION["admin_username"];
 if (empty($_POST["admin_old_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $admin_old_change_password = test_input($_POST["admin_old_change_password"]);
      if (strlen($admin_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   //$admin_old_change_password=md5($admin_old_change_password);
     }
	 
	  if (empty($_POST["admin_new_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $admin_new_change_password = test_input($_POST["admin_new_change_password"]);
      if (strlen($admin_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   //$admin_new_change_password=md5($admin_new_change_password);
     }
	 
	  if (empty($_POST["admin_confirm_change_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $admin_confirm_change_password = test_input($_POST["admin_confirm_change_password"]);
      if (strlen($admin_old_change_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	  // $admin_confirm_change_password=md5($admin_confirm_change_password);
     }
	 
	 if($check==1 && $admin_new_change_password==$admin_confirm_change_password){
		 
		        $query = "SELECT * FROM admin_login_detail WHERE admin_username = ? AND admin_password = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $admin_username, $admin_old_change_password); 
				if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);
				  $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  {
					
					    $query = "UPDATE admin_login_detail
                        SET  admin_password= ? 
                        WHERE admin_username = '$admin_username'";
                        $query_prepare_statement = mysqli_prepare($connect, $query);
		                mysqli_stmt_bind_param($query_prepare_statement, "s", $admin_new_change_password);
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