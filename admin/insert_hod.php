<?php
include '../db.php';

function test_input($data)
 {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }

if (isset($_POST["hod_operation"]))
 {
  if ($_POST["hod_operation"] == "Add")
   {
    $check = 1;
// Validation of input starts	
	
    if (empty($_POST["hod_username"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Username is required</div>';
     }
    else
     {
      $hod_username = test_input($_POST["hod_username"]);
      if (!preg_match("/^[a-z0-9_]*$/", $hod_username) || strlen($hod_username)<3)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Username must be of minimum 4 Characters and Small letters, numbers, and underscores only please !</div>';
       }
     }
	 
	  if (empty($_POST["hod_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_password = test_input($_POST["hod_password"]);
      if (strlen($hod_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $hod_password=md5($hod_password);
     }
	 
	  if (empty($_POST["hod_name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Name is required !</div>';
     }
    else
     {
      $hod_name = test_input($_POST["hod_name"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $hod_name))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Only Letters are accepted in name !</div>';
       }
     }
	 
	  if (empty($_POST["hod_email"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Email is required</div>';
     }
    else
     {
      $hod_email = test_input($_POST["hod_email"]);
      if (!filter_var($hod_email, FILTER_VALIDATE_EMAIL)) 
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Email</div>';
       }
     }
	 
	  if (empty($_POST["hod_number"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Mobile number is required</div>';
     }
    else
     {
      $hod_number = test_input($_POST["hod_number"]);
      if (!preg_match("/^[0-9]*$/", $hod_number) || strlen($hod_number)!=10)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Mobile Number</div>';
       }
     }
	 
	  if (empty($_POST["hod_department"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Department is required</div>';
     }
    else
     {
      $hod_department = test_input($_POST["hod_department"]);
      if (!preg_match("/^[a-zA-Z]*$/", $hod_department))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Letters only !</div>';
       }
     }
//validation of input ends

   
    if ($check == 1)
     {
      $query = "CREATE TABLE hod_".$hod_department."_" . $hod_username . "(
hod_task_id INT(11) AUTO_INCREMENT PRIMARY KEY,
hod_task_name TEXT NOT NULL,
hod_task_description TEXT NOT NULL,
hod_task_type VARCHAR(255),
hod_task_priority VARCHAR(255),
hod_task_date_of_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
hod_image_path LONGTEXT
)";
   if(mysqli_query($connect, $query)){
	   $hod_table = "hod_".$hod_department."_".$hod_username."";
	       $query = "CREATE TABLE record_table_hod_".$hod_department."_" . $hod_username . "(
record_table_id INT(11) AUTO_INCREMENT PRIMARY KEY,
record_table_fk_hod_task_id INT(11) NOT NULL,
hod_task_assign_to TEXT NOT NULL,
hod_task_assign_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
hod_task_deadline DATETIME NOT NULL,
FOREIGN KEY (record_table_fk_hod_task_id) REFERENCES hod_".$hod_department."_".$hod_username."(hod_task_id) ON DELETE CASCADE ON UPDATE RESTRICT
)";
      if (mysqli_query($connect, $query))
       {
        $query = "INSERT INTO hod_list(hod_username, hod_password, hod_name, hod_email, hod_number, hod_department) VALUES(?,?,?,?,?,?)";
		$query_prepare_statement = mysqli_prepare($connect, $query);
		mysqli_stmt_bind_param($query_prepare_statement, "ssssis", $hod_username, $hod_password, $hod_name, $hod_email, $hod_number, $hod_department);
        if ( mysqli_stmt_execute($query_prepare_statement))
         {
	      $folder_name = "../uploads/".$hod_department."_documents";
          mkdir($folder_name);
		  copy("../additional/src/index.php","../uploads/".$hod_department."_documents/index.php");
          echo '<div class="alert alert-success">Data Inserted</div>';
         }
        else
         {
          echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
          $query = "DROP TABLE record_table_hod_".$hod_department."_" . $hod_username . "";
          mysqli_query($connect, $query);
		  $query = "DROP TABLE hod_".$hod_department."_" . $hod_username . "";
          mysqli_query($connect, $query);
         }
       }
      else
       {
        echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
		$query = "DROP TABLE hod_".$hod_department."_" . $hod_username . "";
          mysqli_query($connect, $query);
       }
	 }
	 else{
		  echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
	 }
     }
   }
  else
   {
    echo mysqli_error($connect);
   }

   
   
   
   
  if ($_POST["hod_operation"] == "Edit")
   {
    $check = 1;
    // Validation of input starts	
	
    if (empty($_POST["hod_username"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Username is required</div>';
     }
    else
     {
      $hod_username = test_input($_POST["hod_username"]);
      if (!preg_match("/^[a-z0-9_]*$/", $hod_username) || strlen($hod_username)<3)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Username must be of minimum 4 Characters and Small letters, numbers, and underscores only please !</div>';
       }
     }
	 
	  if (empty($_POST["hod_password"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Password is required</div>';
     }
    else
     {
      $hod_password = test_input($_POST["hod_password"]);
      if (strlen($hod_password)<5)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Password must be of minimum 6 Characters !</div>';
       }
	   $hod_password=md5($hod_password);
     }
	 
	  if (empty($_POST["hod_name"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Name is required !</div>';
     }
    else
     {
      $hod_name = test_input($_POST["hod_name"]);
      if (!preg_match("/^[a-zA-Z ]*$/", $hod_name))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Only Letters are accepted in name !</div>';
       }
     }
	 
	  if (empty($_POST["hod_email"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Email is required</div>';
     }
    else
     {
      $hod_email = test_input($_POST["hod_email"]);
      if (!filter_var($hod_email, FILTER_VALIDATE_EMAIL)) 
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Email</div>';
       }
     }
	 
	  if (empty($_POST["hod_number"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Mobile number is required</div>';
     }
    else
     {
      $hod_number = test_input($_POST["hod_number"]);
      if (!preg_match("/^[0-9]*$/", $hod_number) || strlen($hod_number)!=10)
       {
        $check = 0;
        echo '<div class="alert alert-danger">Invalid Mobile Number</div>';
       }
     }
	 
	  if (empty($_POST["hod_department"]))
     {
      $check = 0;
      echo '<div class="alert alert-danger">Department is required</div>';
     }
    else
     {
      $hod_department = test_input($_POST["hod_department"]);
      if (!preg_match("/^[a-zA-Z]*$/", $hod_department))
       {
        $check = 0;
        echo '<div class="alert alert-danger">Letters only !</div>';
       }
     }
//validation of input ends
    $hod_id = test_input($_POST["hod_id"]);
   if ($check == 1)
     {
      $query = "SELECT * FROM hod_list WHERE hod_id = '$hod_id'";
      $result = mysqli_query($connect, $query);
      $row = mysqli_fetch_array($result);
      $query = "UPDATE hod_list
      SET hod_username = ? , hod_password= ? , hod_name= ? , hod_email= ? , hod_number= ? , hod_department= ?
      WHERE hod_id = '$hod_id'";
      $query_prepare_statement = mysqli_prepare($connect, $query);
      mysqli_stmt_bind_param($query_prepare_statement, "ssssis", $hod_username, $hod_password, $hod_name, $hod_email, $hod_number, $hod_department);
      if (mysqli_stmt_execute($query_prepare_statement))
       {
       $query1 = "ALTER TABLE record_table_hod_".$row['hod_department']."_" . $row['hod_username'] . " RENAME TO record_table_hod_".$hod_department."_".$hod_username."";
       
        if(mysqli_query($connect, $query1)){
        $query1 = "ALTER TABLE hod_".$row['hod_department']."_" . $row['hod_username'] . " RENAME TO hod_".$hod_department."_".$hod_username."";
           if (mysqli_query($connect, $query1))
            {
             echo '<div class="alert alert-success">Data Updated</div>';
            }
           else
            {
				$query1 = "ALTER TABLE record_table_hod_".$hod_department."_".$hod_username." RENAME TO record_table_hod_".$row['hod_department']."_" . $row['hod_username'] . "";
				mysqli_query($connect, $query1);
                //Rollback starts
                mysqli_stmt_bind_param($query_prepare_statement, "ssssis", $row['hod_username'], $row['hod_password'], $row['hod_name'], $row['hod_email'], $row['hod_number'], $row[   'hod_department']);
                mysqli_stmt_execute($query_prepare_statement);
                
                //Rollback ends
                echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
				
            }
       }else{
           //Rollback starts
                mysqli_stmt_bind_param($query_prepare_statement, "ssssis", $row['hod_username'], $row['hod_password'], $row['hod_name'], $row['hod_email'], $row['hod_number'], $row[   'hod_department']);
                mysqli_stmt_execute($query_prepare_statement);
                
                //Rollback ends
                echo '<div class="alert alert-danger">' . mysqli_error($connect) . '</div>';
       }
         
       }
      else
       {
        echo '<div class="alert alert-danger">DUPLICATE ENTRY ! ' . mysqli_error($connect) . '</div>';
       }
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
