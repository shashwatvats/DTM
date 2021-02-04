<?php  
include '../db.php';
include '../header.php';

session_start();  
 if(isset($_SESSION["hod_username"]))  
 {  
     header('Location: ./');
 }  

 ?>  
</head> 
	  <script>
	  $(function() {
		  $.validator.setDefaults({
		  errorClass: 'text-danger'
		  });
		  $("#hod_login_form").validate({
           rules: {
			   hod_username: {
                required: true,
				alphanumeric : true
             
            },
			hod_password: {
				required:true,
				
			}
		   },
		   messages : {
			   hod_username:{
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
                <h3><img src = "../additional/favicon.png" height = "6%" width = "6%" id="animate1"> <span class="pull-right"><b>HoD Login </b></span></h3><br />
                 <form method="post" id="hod_login_form" enctype="multipart/form-data">
				 <div class = "row">
				 <div class = "col-sm-12">
                     <label>Username</label>  
                     <input type="text" name="hod_username" class="form-control" id = "hod_username"/>  
                     <br />  
				</div>	
				<div class = "col-sm-12">
                     <label>Password</label>  
                     <input type="password" name="hod_password" class="form-control" id = "hod_password"/>  
                     <br />  
                     <input type="submit" name="hod_login_button" class="btn btn-info" value="Login" id="hod_login_button"/> <br><br>
				 </div>
				 </div>	 
                <div id="hod_login_error_message"></div>					 
                </form> 
				<div class = "pull-right text-primary" id = "hod_forgot_password"><b><a href="hod-forgot-password.php">Forgot Password ?</a></b></div>	
				</div>
           </div>  
           <br />  
      </body>  
	   <?php
         include '../footer.php';
         ?>
 </html>  
 
 <script>
  $(document).on('submit', '#hod_login_form', function(event){
  event.preventDefault();
  var hod_username = $('#hod_username').val();
  var hod_password = $('#hod_password').val();
  $.ajax({
   url:"login_hod_php_code.php",
   method:"POST",
   data:{
	   hod_username:hod_username,
	   hod_password:hod_password
	    },
   success:function(data)
   {
	   if(data==100){
		   window.location.href="./";
	   } 
	   else{
		   $('#hod_login_error_message').html('<span class="text-danger"><b>'+data+'</b></span>');
		   setTimeout('$("#hod_login_error_message").html("")',3000);
	   }

   }
  });
 });

 
 </script>
 
 <?php
  mysqli_close($connect);
 ?>