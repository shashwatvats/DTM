<?php
include '../db.php';
include '../validate_input.php';
include '../header.php';
if(isset($_GET["email"]) && isset($_GET["token"])){
$faculty_email = vi($_GET["email"]);
$faculty_token = vi($_GET["token"]);

$faculty_email = mysqli_real_escape_string($connect,$faculty_email);
$faculty_token = mysqli_real_escape_string($connect,$faculty_token);

$query = "SELECT faculty_id, faculty_token, faculty_email FROM faculty_list WHERE faculty_email = ? AND faculty_token = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $faculty_email, $faculty_token);  
                if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);  //single step security
				  
				   /* bind result variables */
                  mysqli_stmt_bind_result($query_prepare_statement, $fetch_faculty_id, $fetch_faculty_token, $fetch_faculty_email);  //two step security

                   /* fetch value */
                  mysqli_stmt_fetch($query_prepare_statement);
				  
                $count = mysqli_stmt_num_rows($query_prepare_statement); 
                if($count > 0)  
                {  
?> 
  </head>
		      <body>  
			  <script src="jquery_validation.js"></script>    <!--Jquery validation Rules-->
          <br><br>
		   
           <div class="container">  
               
                <div class="well well-lg col-md-6 col-md-offset-3">
                <h3><img src = "../additional/favicon.png" height = "6%" width = "6%" id="animate1"> <span class="pull-right"><b>Reset Password </b></span></h3><br /> 
                 <form method="post" id="faculty_reset_password_form" enctype="multipart/form-data">
				 <div class = "row">
				 <div class = "form-group col-sm-12">
                     <label>Enter New Password</label>  
                     <input type="password" name="faculty_reset_password" class="form-control" id = "faculty_reset_password"/>  
                     <br />  
				 </div>	
				<div class = "form-group col-sm-12">
                     <label>Confirm New Password</label>  
                     <input type="password" name="faculty_confirm_reset_password" class="form-control" id = "faculty_confirm_reset_password"/>  
                     <br />  
                 <input type="hidden" name="faculty_email" id="faculty_email" value = "<?php echo $fetch_faculty_email; ?>"/>
                     <input type="hidden" name="faculty_token" id="faculty_token" value = "<?php echo $fetch_faculty_token; ?>"/>    
				 <input type="submit" name="faculty_reset_password_button" class="btn btn-info" value="Reset Password" id="faculty_reset_password_button"/> <br><br>
				 </div>
				 </div>	 
                <div id="faculty_reset_password_message"></div>					 
                </form> 
			</div>	
           </div>  
           <br />  
      </body>  
	   <?php
         include '../footer.php';
         ?>
 </html>
<script src = "faculty_jquery_ajax.js"></script>
<?php  
                }  
                else  
                {  
                     echo "Link Expired !";  
                } 
		   }

//echo $hod_email . $hod_token;
}else{
	echo "Not Allowed";
}
  mysqli_close($connect);
?>