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
 
 
$admin_username = test_input($_POST["admin_username"]);
$admin_password = test_input($_POST["admin_password"]);
           if(empty($admin_username) || empty($admin_password))  
           {  
                echo "Both fields are required";
           } 
            
           else  
           {  
                $query = "SELECT admin_username FROM admin_login_detail WHERE admin_username = ? AND admin_password = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $admin_username, $admin_password);  
                if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);  //single step security
				  
				   /* bind result variables */
                  mysqli_stmt_bind_result($query_prepare_statement, $fetch_admin_username);  //two step security

                   /* fetch value */
                  mysqli_stmt_fetch($query_prepare_statement);
				  
                $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  
                {  
                     $_SESSION["admin_username"] = $fetch_admin_username;  
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