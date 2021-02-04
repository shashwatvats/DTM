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
		  $("#hod_forgot_password_form").validate({
           rules: {
			   hod_username_email: {
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
                 <form method="post" id="hod_forgot_password_form" enctype="multipart/form-data" autocomplete = "off">
				 <div class = "row">
				 <div class = "col-sm-12">
                     <label>Username or Email</label>  
                     <input type="text" name="hod_username_email" class="form-control" id = "hod_username_email"/>  
                     <br /> 
					 <input type="submit" name="hod_forgot_password_button" class="btn btn-info" value="Send Email" id="hod_forgot_password_button"/> <br><br>
				</div>	
				 </div>	 <br>
                <div id="hod_forgot_password_error_message"></div>					 
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
  $(document).on('submit', '#hod_forgot_password_form', function(event){
  event.preventDefault();
    $("#hod_forgot_password_button").attr("disabled",false);
      $('#hod_forgot_password_button').val("Send Email");
	  $("#hod_forgot_password_button").removeClass("btn-primary");
	  $("#hod_forgot_password_button").removeClass("btn-warning");
	  $("#hod_forgot_password_button").removeClass("btn-danger");
	  $("#hod_forgot_password_button").removeClass("btn-success");
	  $("#hod_forgot_password_button").addClass("btn-info");
      $('#hod_forgot_password_error_message').html('');	  
  var hod_username_email = $('#hod_username_email').val();
  $.ajax({
   url:"hod_forgot_password_php_code.php",
   method:"POST",
   data:new FormData(this),
    dataType:"json",
	contentType:false,
    processData:false,
   beforeSend:function(){
		 
     $('#hod_forgot_password_button').val("Sending..");
	 $("#hod_forgot_password_button").removeClass("btn-primary");
	 $("#hod_forgot_password_button").removeClass("btn-success");
	 $("#hod_forgot_password_button").removeClass("btn-info");
	 $("#hod_forgot_password_button").addClass("btn-warning");	
	
   },
   success:function(data)
   {
	       
	if(data.number == 100){
		   $('#hod_forgot_password_error_message').html(data.message);
		   $('#hod_forgot_password_form')[0].reset();
	  $("#hod_forgot_password_button").attr("disabled",true);
      $('#hod_forgot_password_button').val("Email Sent");
	  $("#hod_forgot_password_button").removeClass("btn-primary");
	  $("#hod_forgot_password_button").removeClass("btn-warning");
	  $("#hod_forgot_password_button").removeClass("btn-danger");
	  $("#hod_forgot_password_button").removeClass("btn-info");
	  $("#hod_forgot_password_button").addClass("btn-success");	
	}
	if(data.number == 101){
		   $('#hod_forgot_password_error_message').html(data.message);
		   $('#hod_forgot_password_form')[0].reset();
	  $("#hod_forgot_password_button").attr("disabled",false);
      $('#hod_forgot_password_button').val("Try Again");
	  $("#hod_forgot_password_button").removeClass("btn-primary");
	  $("#hod_forgot_password_button").removeClass("btn-warning");
	  $("#hod_forgot_password_button").removeClass("btn-success");
	  $("#hod_forgot_password_button").removeClass("btn-info");
	  $("#hod_forgot_password_button").addClass("btn-danger");	
	}
   }
  });
 });

 
 </script>
 
 <?php
  mysqli_close($connect);
 ?>