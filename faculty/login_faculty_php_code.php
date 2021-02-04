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
 
 
$faculty_username = test_input($_POST["faculty_username"]);
$faculty_password = test_input($_POST["faculty_password"]);
$faculty_password = md5($faculty_password);
           if(empty($faculty_username) || empty($faculty_password))  
           {  
                echo "Both fields are required";
           } 
            
           else  
           {  
                $query = "SELECT faculty_username,faculty_department FROM faculty_list WHERE faculty_username = ? AND faculty_password = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $faculty_username, $faculty_password);  
                if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);  //single step security
				  
				   /* bind result variables */
                  mysqli_stmt_bind_result($query_prepare_statement, $fetch_faculty_username, $fetch_faculty_department);  //two step security

                   /* fetch value */
                  mysqli_stmt_fetch($query_prepare_statement);
				  
                $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  
                {  
                     $_SESSION["faculty_username"] = $fetch_faculty_username;  
                     $_SESSION["faculty_department"] = $fetch_faculty_department;  
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