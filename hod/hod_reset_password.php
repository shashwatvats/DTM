<?php
include '../db.php';
include '../validate_input.php';
include '../header.php';
if(isset($_GET["email"]) && isset($_GET["token"])){
$hod_email = vi($_GET["email"]);
$hod_token = vi($_GET["token"]);

$hod_email = mysqli_real_escape_string($connect,$hod_email);
$hod_token = mysqli_real_escape_string($connect,$hod_token);

$query = "SELECT hod_id, hod_token, hod_email FROM hod_list WHERE hod_email = ? AND hod_token = ?";  
				$query_prepare_statement = mysqli_prepare($connect, $query);
		        mysqli_stmt_bind_param($query_prepare_statement, "ss", $hod_email, $hod_token);  
                if ( mysqli_stmt_execute($query_prepare_statement)) {  
				
				  mysqli_stmt_store_result($query_prepare_statement);  //single step security
				  
				   /* bind result variables */
                  mysqli_stmt_bind_result($query_prepare_statement, $fetch_hod_id, $fetch_hod_token, $fetch_hod_email);  //two step security

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
               
                 <form method="post" id="hod_reset_password_form" enctype="multipart/form-data">
				 <div class = "row">
				 <div class = "form-group col-sm-12">
                     <label>Enter New Password</label>  
                     <input type="password" name="hod_reset_password" class="form-control" id = "hod_reset_password"/>  
                     <br />  
				 </div>	
				<div class = "form-group col-sm-12">
                     <label>Confirm New Password</label>  
                     <input type="password" name="hod_confirm_reset_password" class="form-control" id = "hod_confirm_reset_password"/>  
                     <br />  
                 <input type="hidden" name="hod_email" id="hod_email" value = "<?php echo $fetch_hod_email; ?>"/>
                     <input type="hidden" name="hod_token" id="hod_token" value = "<?php echo $fetch_hod_token; ?>"/>    
				 <input type="submit" name="hod_reset_password_button" class="btn btn-info" value="Reset Password" id="hod_reset_password_button"/> <br><br>
				 </div>
				 </div>	 
                <div id="hod_reset_password_message"></div>					 
                </form>
            </div>				
           </div>  
           <br />  
      </body>  
	   <?php
         include '../footer.php';
         ?>
 </html>
<script src = "hod_jquery_ajax.js"></script>
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