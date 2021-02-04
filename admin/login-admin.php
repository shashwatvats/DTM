<?php  
include '../db.php';
include '../header.php';

session_start();  
 if(isset($_SESSION["admin_username"]))  
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
		  $("#admin_login_form").validate({
           rules: {
			   admin_username: {
                required: true,
				alphanumeric : true
             
            },
			admin_password: {
				required:true,
				
			}
		   },
		   messages : {
			   admin_username:{
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
                <h3><img src = "../additional/favicon.png" height = "6%" width = "6%" id="animate1"> <span class="pull-right"><b>Admin Login</b></span></h3><br />
                 <form method="post" id="admin_login_form" enctype="multipart/form-data">
                     <label>Username</label>  
                     <input type="text" name="admin_username" class="form-control" id = "admin_username"/>  
                     <br />  
                     <label>Password</label>  
                     <input type="password" name="admin_password" class="form-control" id = "admin_password"/>  
                     <br />  
                     <input type="submit" name="admin_login_button" class="btn btn-info" value="Login" id="admin_login_button"/> <br><br>
                <div id="admin_login_error_message"></div>					 
                </form>  
				</div>
           </div>  
           <br />  
      </body>  
	   <?php
         include '../footer.php';
         ?>
 </html>  
 
 <script>
  $(document).on('submit', '#admin_login_form', function(event){
  event.preventDefault();
  var admin_username = $('#admin_username').val();
  var admin_password = $('#admin_password').val();
  $.ajax({
   url:"login_admin_php_code.php",
   method:"POST",
   data:{
	   admin_username:admin_username,
	   admin_password:admin_password
	    },
   success:function(data)
   {
	   if(data==100){
		   window.location.href="./";
	   } 
	   else{
		   $('#admin_login_error_message').html('<span class="text-danger"><b>'+data+'</b></span>');
		   setTimeout('$("#admin_login_error_message").html("")',3000);
	   }

   }
  });
 });

 
 </script>
 
 <?php
  mysqli_close($connect);
 ?>