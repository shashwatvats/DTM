<?php
include '../db.php';
include '../validate_input.php';

$hod_email = vi($_POST["hod_email"]);
$hod_email = mysqli_real_escape_string($connect,$hod_email);
$hod_token = vi($_POST["hod_token"]);
$hod_token = mysqli_real_escape_string($connect,$hod_token);

//echo $hod_reset_password ."<br>". $hod_confirm_reset_password ."<br>". $hod_email ."<br>". $hod_token;


$check = 1;
   if (empty($_POST["hod_reset_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_reset_password = vi($_POST["hod_reset_password"]);
      $hod_reset_password = mysqli_real_escape_string($connect,$hod_reset_password);
      if (strlen($hod_reset_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $hod_reset_password=md5($hod_reset_password);
     }
	 
   if (empty($_POST["hod_confirm_reset_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_confirm_reset_password = vi($_POST["hod_confirm_reset_password"]);
      $hod_confirm_reset_password = mysqli_real_escape_string($connect,$hod_confirm_reset_password);
      if (strlen($hod_confirm_reset_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $hod_confirm_reset_password=md5($hod_confirm_reset_password);
     }
	 
	   if (empty($_POST["hod_token"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Link Expired !</div>';
     }

if($check==1 && $hod_reset_password==$hod_confirm_reset_password){
	
			  $query = "SELECT * FROM hod_list WHERE hod_email = ? AND hod_token = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $hod_email, $hod_token); 
				if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);
				  $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  {
					
					     $query = "UPDATE hod_list
                        SET  hod_password= ? 
                        WHERE hod_email = '$hod_email' AND hod_token = '$hod_token'";
                        $query_prepare_statement = mysqli_prepare($connect, $query);
		                mysqli_stmt_bind_param($query_prepare_statement, "s", $hod_reset_password);
                        if (mysqli_stmt_execute($query_prepare_statement)){
							$query = "UPDATE hod_list SET hod_token = '' WHERE hod_email = '$hod_email'";
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

