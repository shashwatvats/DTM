<?php  
include '../db.php';
include '../header.php';

session_start();  
 if(isset($_SESSION["faculty_username"]))  
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
		  $("#faculty_forgot_password_form").validate({
           rules: {
			   faculty_username_email: {
                required: true,
             }
		   }
		  });
	  });
	  </script>
      <body>  
          <br><br>
		   
           <div class="container">  
               
                <div class="well well-lg col-md-6 col-md-offset-3">
                <h3><img src = "../additional/favicon.png" height = "6%" width = "6%" id="animate1"> <span class="pull-right"><b>Forgot Password </b></span></h3><br /> 
                 <form method="post" id="faculty_forgot_password_form" enctype="multipart/form-data" autocomplete = "off">
				 <div class = "row">
				 <div class = "col-sm-12">
                     <label>Username or Email</label>  
                     <input type="text" name="faculty_username_email" class="form-control" id = "faculty_username_email"/>  
                     <br /> 
					 <input type="submit" name="faculty_forgot_password_button" class="btn btn-info" value="Send Email" id="faculty_forgot_password_button"/> <br><br>
				</div>	
				 </div>	 <br>
                <div id="faculty_forgot_password_error_message"></div>					 
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
  $(document).on('submit', '#faculty_forgot_password_form', function(event){
  event.preventDefault();
    $("#faculty_forgot_password_button").attr("disabled",false);
      $('#faculty_forgot_password_button').val("Send Email");
	  $("#faculty_forgot_password_button").removeClass("btn-primary");
	  $("#faculty_forgot_password_button").removeClass("btn-warning");
	  $("#faculty_forgot_password_button").removeClass("btn-danger");
	  $("#faculty_forgot_password_button").removeClass("btn-success");
	  $("#faculty_forgot_password_button").addClass("btn-info");
      $('#faculty_forgot_password_error_message').html('');	  
  var faculty_username_email = $('#faculty_username_email').val();
  $.ajax({
   url:"faculty_forgot_password_php_code.php",
   method:"POST",
   data:new FormData(this),
    dataType:"json",
	contentType:false,
    processData:false,
   beforeSend:function(){
		 
     $('#faculty_forgot_password_button').val("Sending..");
	 $("#faculty_forgot_password_button").removeClass("btn-primary");
	 $("#faculty_forgot_password_button").removeClass("btn-success");
	 $("#faculty_forgot_password_button").removeClass("btn-info");
	 $("#faculty_forgot_password_button").addClass("btn-warning");	
	
   },
   success:function(data)
   {
	       
	if(data.number == 100){
		   $('#faculty_forgot_password_error_message').html(data.message);
		   $('#faculty_forgot_password_form')[0].reset();
	  $("#faculty_forgot_password_button").attr("disabled",true);
      $('#faculty_forgot_password_button').val("Email Sent");
	  $("#faculty_forgot_password_button").removeClass("btn-primary");
	  $("#faculty_forgot_password_button").removeClass("btn-warning");
	  $("#faculty_forgot_password_button").removeClass("btn-danger");
	  $("#faculty_forgot_password_button").removeClass("btn-info");
	  $("#faculty_forgot_password_button").addClass("btn-success");	
	}
	if(data.number == 101){
		   $('#faculty_forgot_password_error_message').html(data.message);
		   $('#faculty_forgot_password_form')[0].reset();
	  $("#faculty_forgot_password_button").attr("disabled",false);
      $('#faculty_forgot_password_button').val("Try Again");
	  $("#faculty_forgot_password_button").removeClass("btn-primary");
	  $("#faculty_forgot_password_button").removeClass("btn-warning");
	  $("#faculty_forgot_password_button").removeClass("btn-success");
	  $("#faculty_forgot_password_button").removeClass("btn-info");
	  $("#faculty_forgot_password_button").addClass("btn-danger");	
	}
   }
  });
 });

 
 </script>
 
 <?php
  mysqli_close($connect);
 ?>