<html>
<head>
      <title>DTM</title>
	  <link rel="shortcut icon" href="additional/favicon.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	  
	  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	  	<!--Jquery Validation Links-->
      <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/jquery.validate.min.js"></script>
      <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.17.0/additional-methods.min.js"></script>
<style>

a:link {
    color: white;
}
a:visited {
    color: white;
}
a:hover {
    color: grey;
}
a:active {
    color: white;
}
.form-control{
	background-color:transparent;
	color:white;
}
body{
	
	margin:0;
	padding:0;
	width : 97%;
	height : 100vh;
	
	background : linear-gradient(
	    rgba(0, 0, 0, 0.8),
        rgba(0, 0, 0, 0.8)
		),url(additional/bg.jpg) 50% 50% no-repeat;
	background-size: cover;
	display:table;
	 
}


.first{
	color:white;
	font-size:2.5vw;
	font-weight:550;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:3px;
	font-family:Courier;
	
}
.first_small{
	color:white;
	font-weight:550;
	font-size:6vw;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:3px;
	font-family:Courier;
	
}
.second{
	color:white;
	font-size : 2.2vw;
	font-weight:550;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:3px;
	font-family:"Courier New", Courier, monospace;
	
}

.second_small{
	color:white;
	font-size : 4.4vw;
	font-weight:650;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:1px;
	font-family:"Courier New", Courier, monospace;
	
}

.third{
	color:white;
	font-weight:550;
	letter-spacing:5px;
	font-size:2.5vw;
	text-align:center;
	text-transform : uppercase;
	font-family:"Courier New", Courier, monospace;
}

.third_small{
	color:white;
	font-weight:650;
	letter-spacing:5px;
	font-size:5.5vw;
	text-align:center;
	text-transform : uppercase;
	font-family:"Courier New", Courier, monospace;
}
.fourth{
	color:white;
	font-weight:550;
	letter-spacing:7px;
	font-size:4vw;
	text-align:center;
	margin-top:10px;
	text-transform : uppercase;
	font-family:"times new roman";
}
.footer {
   position: fixed;
   left: 0;
   bottom: 50;
   width: 100%;
   color: white;
   text-align: center;
}
.chip {
    display: inline-block;
    padding: 0 25px;
    height: 35px;
    font-size: 14px;
    line-height: 35px;
    border-radius: 25px;
    background-color: #f1f1f1;
	
}
.chip_small {
    display: inline-block;
    padding: 0 10px;
    height: 25px;
    font-size: 10px;
    line-height: 25px;
    border-radius: 25px;
    background-color: #f1f1f1;
	color:white;
}
.input_field{
	color: white;
}
.contact{
	color:white;
	letter-spacing:2px;
	font-size:1.5em;
	font-family:"Courier New", Courier, monospace;
}
.contact_small{
	color:white;
	letter-spacing:0px;
	font-size:1em;
	font-family:"Courier New", Courier, monospace;
}
</style>
<script>
$(function(){
	$.validator.addMethod( "lettersonly", function( value, element ) {
	return this.optional( element ) || /^[a-z ]+$/i.test( value );
    }, "Letters only please !" );
	
	$.validator.addMethod( "invalid_characters", function( value, element ) {
	return this.optional( element ) || /^[^&<>'"]+$/i.test( value );
    }, "single quots double quots & < > Not Allowed !" );
	
	$.validator.addMethod( "email_2", function( value, element ) {
	return this.optional( element ) || /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)$/i.test( value );
    }, "Not a valid Email" );
	
	$.validator.setDefaults({
    errorClass: 'text-danger',
	
	 highlight: function(element) {
      $(element)
        .closest('.form-group')
        .addClass('has-error')
		.removeClass('has-success');
    },
    unhighlight: function(element) {
      $(element)
        .closest('.form-group')
        .removeClass('has-error')
		.addClass('has-success');
    },
	
    });
	
    $("#feedback_form").validate({
        rules: {
            
			name: {
                required: true,
				lettersonly : true
             
            },
			email: {
                required: true,
                email: true,
				email_2:true
            },
			message: {
				required:true,
				invalid_characters:true
			},
			
			
        },
    });
});
</script>
</head>

<body>
<main>
<div class = "hidden-xs hidden-sm hidden-md ">
<br><div class="pull-right chip ">
<a href = "./"><b><span style = "color:#337ab7;">Home</span></b></a>
</div><br><br>
</div>
<div class = "hidden-lg">
<br><div class="pull-right chip_small ">
<a href = "./"><b><span style = "color:#337ab7;">Home</span></b></a>
</div><br><br>
</div>

<div id="" class = "hidden-xs hidden-sm first">Contacts</div><br>
<div id="" class = "hidden-md hidden-lg first_small">Contacts<br></div><br>
<br>

<div class="row">
<div class = "col-sm-5 col-sm-offset-1 col-xs-10 col-xs-offset-1">

               <form method="post" id="feedback_form" enctype="multipart/form-data">
                   <div class= "row">
                        <div class="form-group col-sm-12">
                          <!-- <label class = "input_field">Enter Name</label>-->
                           <input type="text" name="name" id="name" class="form-control" placeholder="Your Name"/>
                        </div>
				   </div>
				   <div class= "row">
                        <div class="form-group col-sm-12">
                           <!--<label class = "input_field">Enter Email</label>-->
                           <input type="email" name="email" id="email" class="form-control" placeholder="Email"/>
                        </div>
				   </div>
				   <div class= "row">
                        <div class="form-group col-md-12">
                           <!--<label for="description" class = "input_field">Enter Description</label>-->
                           <textarea name="message" id="message" class="form-control" rows="5" placeholder="Message"></textarea>
                          
                        </div>
				   </div>
				   <div class = "text-center">
				   <input type="submit" name="action" id="action" class="" value="Send" style = "padding: 0 60px;font-size:1.3em;background-color: Transparent;color:white;"/>
				   </div>      
            </form>
			<div id = "alert_message"></div>
<br></div>
<div class = "col-sm-5 col-sm-offset-1 col-xs-8 col-xs-offset-2">

<div class = "row contact hidden-xs hidden-sm">
<i class="fas fa-user fa-lg"></i> Shivam Jain<br><br>
<i class="fas fa-phone fa-lg"></i> 9997188960<br><br>
<a href="mailto:shivamjain248@gmail.com"><i class="fas fa-envelope fa-lg"></i></a> shivamjain248@gmail.com<br>

<div class= "row">
<div class= "col-xs-6">
<hr>
</div>
</div>

<a href = "https://www.facebook.com/shivam248" target="_blank"><i class="fab fa-facebook-square fa-lg"></i></a>
<a href = "https://www.linkedin.com/in/shivam-jain-227a87149/" target="_blank"><i class="fab fa-linkedin fa-lg"></i></a>
<a href = "https://github.com/shivam-jain" target="_blank"><i class="fab fa-github fa-lg"></i></a>
<a href = "https://www.instagram.com/shivam_jain___/" target="_blank"><i class="fab fa-instagram fa-lg"></i></a>

</div>

<div class = "row contact_small hidden-md hidden-lg">
<i class="fas fa-user fa-sm"></i> Shivam Jain<br><br>
<i class="fas fa-phone fa-sm"></i> 9997188960<br><br>
<a href="mailto:shivamjain248@gmail.com"><i class="fas fa-envelope fa-sm"></i></a> shivamjain248@gmail.com<br>

<div class= "row">
<div class= "col-xs-6">
<hr>
</div>
</div>

<a href = "https://www.facebook.com/shivam248" target="_blank"><i class="fab fa-facebook-square fa-sm"></i></a>
<a href = "https://www.linkedin.com/in/shivam-jain-227a87149/" target="_blank"><i class="fab fa-linkedin fa-sm"></i></a>
<a href = "https://github.com/shivam-jain" target="_blank"><i class="fab fa-github fa-sm"></i></a>
<a href = "https://www.instagram.com/shivam_jain___/" target="_blank"><i class="fab fa-instagram fa-sm"></i></a>

</div>

</div>

</div>


</main>
<!--
<footer>
<div id="" class = "footer hidden-xs hidden-sm second"><span style = "font-size : 1.5vw;">Powered By</span> Team CSI</div>
</footer>
-->
<br>
</body>
</html>
<script>
 $(document).ready(function(){
	 $('#action').val("Send");
	 $("#action").attr("disabled",false);
  $(document).on('submit', '#feedback_form', function(event){						//insert data
  event.preventDefault();
  var name = $('#name').val();
  var email = $('#email').val();
  var message = $('#message').val();
  if(name != '' && email != ''  && message != ''  )
  {
   $.ajax({
    url:"additional/src/feedback.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
	beforeSend:function(){
		 
     $('#action').val("Sending..");
	 $("#action").attr("disabled",true);
	
   },
    success:function(data)
    {
     $('#alert_message').html(data);
     $('#feedback_form')[0].reset();
	 $('#action').val("Send");
	 $("#action").attr("disabled",false);
	 $(".form-group").removeClass("has-success has-error");
	  
	    $('label[id*=name-error').html('');
		$('label[id*=email-error').html('');
		$('label[id*=message_name-error').html('');
		
    }
   });
   setInterval(function(){
     $('#alert_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 }); 
});
</script>