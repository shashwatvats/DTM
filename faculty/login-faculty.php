<?php  
include '../db.php';
include '../header.php';

session_start();  
 if(isset($_SESSION["faculty_username"]))  
 {  
     header('Location: ./');
 }  

 ?>  
 <!--<style>
 body {
    background-image: url("../additional/well_bg6.jpg");
    background-repeat: no-repeat;
	background-attachment: fixed;
	 background-size: cover;
}
</style>-->
 </head> 
	  <script>
	  $(function() {
		  $.validator.setDefaults({
		  errorClass: 'text-danger'
		  });
		  $("#faculty_login_form").validate({
           rules: {
			   faculty_username: {
                required: true,
				alphanumeric : true
             
            },
			faculty_password: {
				required:true,
				
			}
		   },
		   messages : {
			   faculty_username:{
				alphanumeric:''
			    },
		   },
		  });
	  });
	  </script>
      <body>  
          <br><br>
		   
           <div class="container">  
               <div class="well well-lg col-md-6 col-md-offset-3">
                <h3><img src = "../additional/favicon.png" height = "6%" width = "6%" id="animate1"> <span class="pull-right"><b>Faculty Login</b></span></h3><br />
                 <form method="post" id="faculty_login_form" enctype="multipart/form-data">
                     <label>Username</label>  
                     <input type="text" name="faculty_username" class="form-control" id = "faculty_username"/>  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="faculty_password" class="form-control" id = "faculty_password"/>  
                     <br />  
                     <input type="submit" name="faculty_login_button" class="btn btn-info" value="Login" id="faculty_login_button"/> <br><br>
                <div id="faculty_login_error_message"></div>					 
                </form>  
				<div class = "pull-right text-primary" id = "faculty_forgot_password"><b><a href="faculty-forgot-password.php">Forgot Password ?</a></b></div>	
				</div>
           </div>  
           <br />  
      </body>  
	   <?php
         include '../footer.php';
         ?>
 </html>  
 
 <script>
  $(document).on('submit', '#faculty_login_form', function(event){
  event.preventDefault();
  var faculty_username = $('#faculty_username').val();
  var faculty_password = $('#faculty_password').val();
  $.ajax({
   url:"login_faculty_php_code.php",
   method:"POST",
   data:{
	   faculty_username:faculty_username,
	   faculty_password:faculty_password
	    },
   success:function(data)
   {
	   if(data==100){
		   window.location.href="./";
	   } 
	   else{
		   $('#faculty_login_error_message').html('<span class="text-danger"><b>'+data+'</b></span>');
		   setTimeout('$("#faculty_login_error_message").html("")',3000);
	   }

   }
  });
 });

 
 </script>
 <?php
 mysqli_close($connect);
 ?>