<?php
include '../db.php';
include '../validate_input.php';
session_start();
$hod_username=$_SESSION["hod_username"];
$hod_department = $_SESSION["hod_department"];
function test_input($data)
 {
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }

if (isset($_POST["hod_task_operation"]))
 {
  if ($_POST["hod_task_operation"] == "Add")
   {
    $check = 1;
// Validation of input starts	
	
    if (empty($_POST["hod_task_name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Name field is required !</div>';
     }
    else
     {
      $hod_task_name = vi($_POST["hod_task_name"]);
     }
	 
	  if (empty($_POST["hod_task_description"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Description field is required !</div>';
     }
    else
     {
      $hod_task_description = test_input($_POST["hod_task_description"]);
     }
	 
	  if (empty($_POST["hod_task_type"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Type field is required !</div>';
     }
    else
     {
      $hod_task_type = test_input($_POST["hod_task_type"]);

     }
	 
	  
	 
	  
	 
	  if (empty($_POST["hod_task_priority"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Priority field is required !</div>';
     }
    else
     {
      $hod_task_priority = test_input($_POST["hod_task_priority"]);
      
     }
//validation of input ends

   
    if ($check == 1)
     {
      //file upload code starts
	  $check_file=1;
		   if(isset($_FILES['hod_image_path'])){
      $errors= array();
      $file_name = $_FILES['hod_image_path']['name'];
      $file_size =$_FILES['hod_image_path']['size'];
      $file_tmp =$_FILES['hod_image_path']['tmp_name'];
      $file_type=$_FILES['hod_image_path']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['hod_image_path']['name'])));
	  
      $random = mt_rand(0,99999999);
	  $new_name = sha1($file_name.$random);
	  $new_file_name = $new_name.".".$file_ext;
	  
      $expensions= array("jpeg","jpg","png","gif","pdf","docx","doc","xls","xlsx","ppt","pptx","odt","txt","");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="Extension not allowed, please choose a JPEG, PNG, GIF, PDF, DOC, XLS, PPT File.";
		 $check_file = 0;
      }
      
      if($file_size > 10097152){
         $errors[]='File size must be less than 10 MB';
		 $check_file = 0;
      }
      
      if($check_file == 1){
		 $hod_image_path = "../uploads/".$hod_department."_documents/".$new_file_name;
         if(!move_uploaded_file($file_tmp,"../uploads/".$hod_department."_documents/".$new_file_name)){
			 $new_file_name = "";
			 $hod_image_path = "";
		 }
			 
		 
		 //insert data code starts
		 
		 $query = "INSERT INTO hod_".$hod_department."_".$hod_username."(hod_task_name, hod_task_description, hod_task_type, hod_task_priority,hod_image_path) VALUES(?,?,?,?,?)";
		$query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "sssss", $hod_task_name, $hod_task_description, $hod_task_type, $hod_task_priority, $hod_image_path);
        if ( mysqli_stmt_execute($query_prepare_statement))
         {
          echo '<div class="alert alert-success">Data Inserted</div>';
         }
        else
         {
          echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
         }
		 
		 //insert data code ends
		 
      }else{
         print_r($errors);
      }
   }
	  //file upload code end
        
       
     }
   }
  else
   {
    echo mysqli_error($connect);
   }

  if ($_POST["hod_task_operation"] == "Edit")
   {
    $check = 1;
    // Validation of input starts	
	
    
    if (empty($_POST["hod_task_name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Name field is required !</div>';
     }
    else
     {
      $hod_task_name = vi($_POST["hod_task_name"]);
     }
	 
	  if (empty($_POST["hod_task_description"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Description field is required !</div>';
     }
    else
     {
      $hod_task_description = test_input($_POST["hod_task_description"]);
     }
	 
	  if (empty($_POST["hod_task_type"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Type field is required !</div>';
     }
    else
     {
      $hod_task_type = test_input($_POST["hod_task_type"]);

     }
	 
	  if (empty($_POST["hod_task_priority"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Task Priority field is required !</div>';
     }
    else
     {
      $hod_task_priority = test_input($_POST["hod_task_priority"]);
      
     }
	 
//validation of input ends
    $hod_task_id = test_input($_POST["hod_task_id"]);
    if ($check == 1)
     {
	
	//getting old file name
	$query = "SELECT hod_image_path FROM hod_".$hod_department."_".$hod_username." WHERE hod_task_id = '$hod_task_id'";
	 $result = mysqli_query($connect, $query);
	 $row = mysqli_fetch_assoc($result);
	 $old_hod_image_path = $row["hod_image_path"];
	 
	//code end
	
//file update code starts
		$check_file=1;
		   if(isset($_FILES['hod_image_path'])){
      $errors= array();
      $file_name = $_FILES['hod_image_path']['name'];
      $file_size =$_FILES['hod_image_path']['size'];
      $file_tmp =$_FILES['hod_image_path']['tmp_name'];
      $file_type=$_FILES['hod_image_path']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['hod_image_path']['name'])));
	  
      $random = mt_rand(0,99999999);
	  $new_name = sha1($file_name.$random);
	  $new_file_name = $new_name.".".$file_ext;
	  
      $expensions= array("jpeg","jpg","png","gif","pdf","docx","doc","xls","xlsx","ppt","pptx","odt","txt","");
      
      if(in_array($file_ext,$expensions)=== false){
      $errors[]="Extension not allowed, please choose a JPEG, PNG, GIF, PDF, DOC, XLS, PPT File.";
	  $check_file=0;
      }
      
      if($file_size > 10097152){
         $errors[]='File size must be less than 10 MB';
		 $check_file=0;
      }
      
      if($check_file==1){
		 $hod_image_path = "../uploads/".$hod_department."_documents/".$new_file_name;
         if(!move_uploaded_file($file_tmp,"../uploads/".$hod_department."_documents/".$new_file_name)){
			 $new_file_name = "";
			 $hod_image_path = $old_hod_image_path;
		 }
		 else{
			 if($old_hod_image_path != ""){
			   unlink($old_hod_image_path);
		   }
		 }
			 
		 
		 //update data code starts
		 
		        $query = "UPDATE hod_".$hod_department."_".$hod_username."
   SET hod_task_name = ? , hod_task_description= ? , hod_task_type= ? , hod_task_priority= ? , hod_image_path = ?
   WHERE hod_task_id = '$hod_task_id'";
        $query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "sssss", $hod_task_name, $hod_task_description, $hod_task_type, $hod_task_priority, $hod_image_path);
      mysqli_stmt_execute($query_prepare_statement);
	  echo '<div class="alert alert-success">Data Updated</div>';
	  
		 //update data code ends
		 
      }else{
         print_r($errors);
      }
   }
	  //file update code end
	

     }
   }
  else
   {
    echo mysqli_error($connect);
   }
 }
else
 {
  echo mysqli_error($connect);
 }
 mysqli_close($connect);
?>
