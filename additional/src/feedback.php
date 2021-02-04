<?php
include '../../db.php';
include '../../email_config.php';

function test_input($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }
 $check = 1;
	if (empty($_POST["name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Name is required !</div>';
     }
    else
     {
      $name = test_input($_POST["name"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $name))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Only Letters are accepted in name !</div>';
       }
     }
	 
	if (empty($_POST["email"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Email is required</div>';
     }
    else
     {
      $email = test_input($_POST["email"]);
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Email</div>';
       }
     }
	 
	if (empty($_POST["message"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Message field is required !</div>';
     }
    else
     {
      $message = test_input($_POST["message"]);
     }
	 
	 
	if ($check == 1){
		$email_subject = "DTM Message";
		$email_body = "
<h4>You have received a new message from DTM<br> <br></h4>
<b>Name : </b>".$name." <br>
<b>Email : </b>".$email." <br>
<b>Message : </b>".$message." <br>
";

$mail->Subject = $email_subject;
$mail->Body    = $email_body;
$mail->addBCC("csi@outlook.in");
	$query = "INSERT INTO feedback(name, email, message) VALUES(?,?,?)";
		$query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "sss", $name, $email, $message);
        if ( mysqli_stmt_execute($query_prepare_statement)){
			if($mail->send()){
				echo '<div class="alert alert-info">Your response has been recorded.</div><br>';
			}else{
				echo '<div class="alert alert-danger">Something went wrong, kindly contact Team CSI.</div><br>';
			}			
		}else{
			echo '<div class="alert alert-danger">Something went wrong, kindly contact Team CSI.</div><br>';
		}		
	}
 mysqli_close($connect);
?>