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
 
 
$hod_username = test_input($_POST["hod_username"]);
$hod_password = test_input($_POST["hod_password"]);
$hod_password = md5($hod_password);
           if(empty($hod_username) || empty($hod_password))  
           {  
                echo "Both fields are required";
           } 
            
           else  
           {  
                $query = "SELECT hod_username,hod_department FROM hod_list WHERE hod_username = ? AND hod_password = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $hod_username, $hod_password);  
                if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);  //single step security
				  
				   /* bind result variables */
                  mysqli_stmt_bind_result($query_prepare_statement, $fetch_hod_username, $fetch_hod_department);  //two step security

                   /* fetch value */
                  mysqli_stmt_fetch($query_prepare_statement);
				  
                $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  
                {  
                     $_SESSION["hod_username"] = $fetch_hod_username;  
                     $_SESSION["hod_department"] = $fetch_hod_department;  
                     echo "100";  
                }  
                else  
                {  
                     echo "Wrong Username and Password";  
                } 
		   }				
           }  
        
    mysqli_close($connect);
 
 
 ?>