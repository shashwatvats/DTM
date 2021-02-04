<?php
include '../db.php';
include '../validate_input.php';
include '../email_config.php';
if(isset($_POST["hod_username_email"])){
	$hod_username_email = vi($_POST["hod_username_email"]);
	$hod_username_email = mysqli_real_escape_string($connect,$hod_username_email);
	//echo '<span class="text-success"><b>'.$hod_username_email.'</b></span>';
	$query = "SELECT hod_id,hod_email FROM hod_list WHERE hod_username = ? OR hod_email = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $hod_username_email, $hod_username_email);  
                if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);  //single step security
				  
				   /* bind result variables */
                  mysqli_stmt_bind_result($query_prepare_statement, $fetch_hod_id, $fetch_hod_email);  //two step security

                   /* fetch value */
                  mysqli_stmt_fetch($query_prepare_statement);
				  
                $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  
                {  
                    $str= "123456789qwertyuiopasdfghjklzxcvbnm";
					$str = str_shuffle($str);
					$str = substr($str,0,10);
					$url = "http://13.127.21.167/newdtm/hod/hod_reset_password.php?token=$str&email=$fetch_hod_email";
					$email_subject = "Password Reset Link for DTM";
                    $email_body = "
                    Click on the link below to reset your password !<br><br>
                    ".$url." 
					 ";

                    $mail->Subject = $email_subject;
                    $mail->Body    = $email_body;
                    $mail->addBCC($fetch_hod_email);	
					 if($mail->send())
                       {
                     	  $query = "Update hod_list SET hod_token = '".$str."' WHERE hod_id = '".$fetch_hod_id."'";
					mysqli_query($connect,$query);
					
					$output["message"] = '<span class="text-success"><b> Kindly check your email sent to '.$fetch_hod_email.' !</b></span>';
					$output["number"] = "100";
                       }
                       else {
	                     $output["message"] = '<span class="text-danger"><b>Kindly refresh the page and Try Again !</b></span>';  
						 $output["number"] = "101";
                       }
					
					
                }  
                else  
                {  
                     $output["message"] = '<span class="text-danger"><b>Wrong Username or Email !</b></span>';  
					 $output["number"] = "101";
                } 
		        }
}else{
	$output["message"] = '<span class="text-danger"><b>This field is required !</b></span>';
	$output["number"] = "101";
}
echo json_encode($output);	
mysqli_close($connect);
?>