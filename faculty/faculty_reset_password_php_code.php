<?php
include '../db.php';
include '../validate_input.php';

$faculty_email = vi($_POST["faculty_email"]);
$faculty_email = mysqli_real_escape_string($connect,$faculty_email);
$faculty_token = vi($_POST["faculty_token"]);
$faculty_token = mysqli_real_escape_string($connect,$faculty_token);

//echo $hod_reset_password ."<br>". $hod_confirm_reset_password ."<br>". $hod_email ."<br>". $hod_token;


$check = 1;
   if (empty($_POST["faculty_reset_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_reset_password = vi($_POST["faculty_reset_password"]);
      $faculty_reset_password = mysqli_real_escape_string($connect,$faculty_reset_password);
      if (strlen($faculty_reset_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $faculty_reset_password=md5($faculty_reset_password);
     }
	 
   if (empty($_POST["faculty_confirm_reset_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $faculty_confirm_reset_password = vi($_POST["faculty_confirm_reset_password"]);
      $faculty_confirm_reset_password = mysqli_real_escape_string($connect,$faculty_confirm_reset_password);
      if (strlen($faculty_confirm_reset_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $faculty_confirm_reset_password=md5($faculty_confirm_reset_password);
     }
	 
	   if (empty($_POST["faculty_token"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Link Expired !</div>';
     }

if($check==1 && $faculty_reset_password==$faculty_confirm_reset_password){
	
			  $query = "SELECT * FROM faculty_list WHERE faculty_email = ? AND faculty_token = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $faculty_email, $faculty_token); 
				if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);
				  $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  {
					
					     $query = "UPDATE faculty_list
                        SET  faculty_password= ? 
                        WHERE faculty_email = '$faculty_email' AND faculty_token = '$faculty_token'";
                        $query_prepare_statement = mysqli_prepare($connect, $query);
		                mysqli_stmt_bind_param($query_prepare_statement, "s", $faculty_reset_password);
                        if (mysqli_stmt_execute($query_prepare_statement)){
							$query = "UPDATE faculty_list SET faculty_token = '' WHERE faculty_email = '$faculty_email'";
							mysqli_query($connect,$query);
							echo '<div class="alert alert-success">Password Reset successfully, <a href = "./">Click Here</a> to login.</div>';
		                }
		                else{
							echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
		                }
					
				}
				else{
					echo '<div class="alert alert-danger">Link Expired !</div>'; 
				}
	         }
	
}
  mysqli_close($connect);	 

?>

