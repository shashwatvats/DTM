 $(document).ready(function(){
   	
     $('#add_hod_button').click(function(){
     $('#hod_form')[0].reset();
     $('.modal-title').text("Add HoD");
     $('#hod_action').val("Add");
     $('#hod_operation').val("Add");
    });
    
    $('#add_faculty_button').click(function(){
     $('#faculty_form')[0].reset();
     $('.modal-title').text("Add Faculty");
     $('#faculty_action').val("Add");
     $('#faculty_operation').val("Add");
    });
     
     fetch_faculty_data();													//Fetch data
    
     function fetch_faculty_data()
     {
   	  
      var dataTable = $('#faculty_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_faculty.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[0,7,8],
          "orderable":false,
         },
        ],	
      });
     }
     
     
     fetch_hod_data();
    
     function fetch_hod_data()
     {
   	  
      var dataTable = $('#hod_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_hod.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[0,7,8],
          "orderable":false,
         },
        ],	
      });
     }
	 
	 
	 $(document).on('submit', '#hod_form', function(event){						//insert data
  event.preventDefault();
  var hod_username = $('#hod_username').val();
  var hod_password = $('#hod_password').val();
  var hod_name = $('#hod_name').val();
  var hod_email = $('#hod_email').val();
  var hod_number = $('#hod_number').val();
  var hod_department = $('#hod_department').val();
  var hod_operation = $('#hod_operation').val();
  if(hod_username != '' && hod_password != ''  && hod_name != ''  && hod_email != ''  && hod_number != '' && hod_department != '')
  {
   $.ajax({
    url:"insert_hod.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     $('#alert_hod_message').html(data);
     $('#hod_form')[0].reset();
     $('#hod_modal').modal('hide');
     $('#hod_data').DataTable().destroy();
      fetch_hod_data();
	   $('#faculty_data').DataTable().destroy();
      fetch_faculty_data();
	  $(".form-group").removeClass("has-success has-error");
	  
	  		$('label[id*=hod_username-error').html('');
		$('label[id*=hod_password-error').html('');
		$('label[id*=hod_name-error').html('');
		$('label[id*=hod_email-error').html('');
		$('label[id*=hod_number-error').html('');
		
	    $('label[id*=faculty_username-error').html('');
		$('label[id*=faculty_password-error').html('');
		$('label[id*=faculty_name-error').html('');
		$('label[id*=faculty_email-error').html('');
		$('label[id*=faculty_number-error').html('');
    }
   });
   setInterval(function(){
     $('#alert_hod_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 
 	 $(document).on('submit', '#faculty_form', function(event){
  event.preventDefault();
  var faculty_username = $('#faculty_username').val();
  var faculty_password = $('#faculty_password').val();
  var faculty_name = $('#faculty_name').val();
  var faculty_email = $('#faculty_email').val();
  var faculty_number = $('#faculty_number').val();
  var faculty_department = $('#faculty_department').val();
  
  if(faculty_username != '' && faculty_password != ''  && faculty_name != ''  && faculty_email != ''  && faculty_number != '' && faculty_department != '')
  {
   $.ajax({
    url:"insert_faculty.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     $('#alert_faculty_message').html(data);
     $('#faculty_form')[0].reset();
     $('#faculty_modal').modal('hide');
     $('#faculty_data').DataTable().destroy();
      fetch_faculty_data();
	  $('#hod_data').DataTable().destroy();
      fetch_hod_data();
	  $(".form-group").removeClass("has-success has-error");
	  
	  		$('label[id*=hod_username-error').html('');
		$('label[id*=hod_password-error').html('');
		$('label[id*=hod_name-error').html('');
		$('label[id*=hod_email-error').html('');
		$('label[id*=hod_number-error').html('');
		
	    $('label[id*=faculty_username-error').html('');
		$('label[id*=faculty_password-error').html('');
		$('label[id*=faculty_name-error').html('');
		$('label[id*=faculty_email-error').html('');
		$('label[id*=faculty_number-error').html('');
    }
   });
   setInterval(function(){
     $('#alert_faculty_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });
	 
     
      $(document).on('click', '.hod_update', function(){						//fetch single entry
  var hod_id = $(this).attr("id");
  $.ajax({
   url:"fetch_hod_single.php",
   method:"POST",
   data:{hod_id:hod_id},
   dataType:"json",
   success:function(data)
   {
    $('#hod_modal').modal('show');
    $('#hod_username').val(data.hod_username);
    $('#hod_password').val(data.hod_password);
    $('#hod_name').val(data.hod_name);
    $('#hod_email').val(data.hod_email);
    $('#hod_number').val(data.hod_number);
    $('#hod_department').val(data.hod_department);
    $('.modal-title').html('Edit HoD <span class="text-danger"><b>(Kindly re-enter your Password)</b></span>');
    $('#hod_id').val(hod_id);
   
    $('#hod_action').val("Edit");
    $('#hod_operation').val("Edit");
   }
  })
 });

 
       $(document).on('click', '.faculty_update', function(){
  var faculty_id = $(this).attr("id");
  $.ajax({
   url:"fetch_faculty_single.php",
   method:"POST",
   data:{faculty_id:faculty_id},
   dataType:"json",
   success:function(data)
   {
    $('#faculty_modal').modal('show');
    $('#faculty_username').val(data.faculty_username);
    $('#faculty_password').val(data.faculty_password);
    $('#faculty_name').val(data.faculty_name);
    $('#faculty_email').val(data.faculty_email);
    $('#faculty_number').val(data.faculty_number);
    $('#faculty_department').val(data.faculty_department);
    $('.modal-title').html('Edit Faculty <span class="text-danger"><b>(Kindly re-enter your Password)</b></span>');
    $('#faculty_id').val(faculty_id);
   
    $('#faculty_action').val("Edit");
    $('#faculty_operation').val("Edit");
   }
  })
 });

 
   $(document).on('click', '.hod_delete', function(){									//delete data
   var hod_id = $(this).attr("id");
   $('#deleteModal').modal('show');
    $('.modal-title').text("Are you sure you want to delete?");
	$('.notdelbtn').click(function(){
		hod_id = null;
	});
   $(document).on('submit', '#delete_form', function(event){
  event.preventDefault();
   
    $.ajax({
     url:"hod_delete.php",
     method:"POST",
     data:{hod_id:hod_id},
     success:function(data){
	  $('#deleteModal').modal('hide');
      $('#alert_hod_message').html('<div class="alert alert-danger">'+data+'</div>');
      $('#hod_data').DataTable().destroy();
      fetch_hod_data();
	  $('#faculty_data').DataTable().destroy();
      fetch_faculty_data();
     }
    });
    setInterval(function(){
     $('#alert_hod_message').html('');
    }, 10000);
   
  });
  });
 
    $(document).on('click', '.faculty_delete', function(){
   var faculty_id = $(this).attr("id");
   $('#deleteModal').modal('show');
    $('.modal-title').text("Are you sure you want to delete?");
	$('.notdelbtn').click(function(){
		faculty_id = null;
	});
   $(document).on('submit', '#delete_form', function(event){
  event.preventDefault();
   
    $.ajax({
     url:"faculty_delete.php",
     method:"POST",
     data:{faculty_id:faculty_id},
     success:function(data){
	  $('#deleteModal').modal('hide');
      $('#alert_faculty_message').html('<div class="alert alert-danger">'+data+'</div>');
      $('#faculty_data').DataTable().destroy();
      fetch_faculty_data();
	  $('#hod_data').DataTable().destroy();
      fetch_hod_data();
     }
    });
    setInterval(function(){
     $('#alert_faculty_message').html('');
    }, 10000);
   
  });
  });
  
  
   $('#hod_username').blur(function(){									//checking username availability

     var hod_username = $(this).val();
	 var hod_operation = $('#hod_operation').val();
     if(hod_operation == 'Add'){
     $.ajax({
      url:'check_username.php',
      method:"POST",
      data:{hod_username:hod_username},
      success:function(data)
      {
       if(data != '0')
       {
        $('#hod_username_availability_message').html('<span class="text-danger"><b>Username not available</b></span>');
        $('#hod_action').attr("disabled", true);
		$("#hod_username_field").removeClass("has-success");
        $("#hod_username_field").addClass("has-error");
       }
       else
       {
       
        $('#hod_username_availability_message').html('');
        $('#hod_action').attr("disabled", false);
       }
      }
     })
   }
  });
     
	  $("#hod_username").focus(function(){
     $('#hod_username_availability_message').html('');
        $('#hod_action').attr("disabled", false);
		$("#hod_username_field").removeClass("has-error");
}); 


   $('#hod_email').blur(function(){									//checking username availability

     var hod_email = $(this).val();
	 var hod_operation = $('#hod_operation').val();
     if(hod_operation == 'Add'){
     $.ajax({
      url:'check_username.php',
      method:"POST",
      data:{hod_email:hod_email},
      success:function(data)
      {
       if(data != '0')
       {
        $('#hod_email_availability_message').html('<span class="text-danger"><b>Email not available</b></span>');
        $('#hod_action').attr("disabled", true);
		$("#hod_email_field").removeClass("has-success");
        $("#hod_email_field").addClass("has-error");
       }
       else
       {
       
        $('#hod_email_availability_message').html('');
        $('#hod_action').attr("disabled", false);
       }
      }
     })
   }
  });
     
	  $("#hod_email").focus(function(){
     $('#hod_email_availability_message').html('');
        $('#hod_action').attr("disabled", false);
		$("#hod_email_field").removeClass("has-error");
}); 


   $('#hod_number').blur(function(){									//checking username availability

     var hod_number = $(this).val();
	 var hod_operation = $('#hod_operation').val();
     if(hod_operation == 'Add'){
     $.ajax({
      url:'check_username.php',
      method:"POST",
      data:{hod_number:hod_number},
      success:function(data)
      {
       if(data != '0')
       {
        $('#hod_number_availability_message').html('<span class="text-danger"><b>Number not available</b></span>');
        $('#hod_action').attr("disabled", true);
		$("#hod_number_field").removeClass("has-success");
        $("#hod_number_field").addClass("has-error");
       }
       else
       {
       
        $('#hod_number_availability_message').html('');
        $('#hod_action').attr("disabled", false);
       }
      }
     })
   }
  });
     
	  $("#hod_number").focus(function(){
     $('#hod_number_availability_message').html('');
        $('#hod_action').attr("disabled", false);
		$("#hod_number_field").removeClass("has-error");
}); 


	  
   $('#faculty_username').blur(function(){

     var faculty_username = $(this).val();
	 var faculty_operation = $('#faculty_operation').val();
     if(faculty_operation == 'Add'){

     $.ajax({
      url:'check_username.php',
      method:"POST",
      data:{faculty_username:faculty_username},
      success:function(data)
      {
       if(data != '0')
       {
        $('#faculty_username_availability_message').html('<span class="text-danger"><b>Username not available</b></span>');
        $('#faculty_action').attr("disabled", true);
		$("#faculty_username_field").removeClass("has-success");
        $("#faculty_username_field").addClass("has-error");
       }
       else
       {
        $('#faculty_username_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
       }
      }
     })
   }

  });
  
    $("#faculty_username").focus(function(){
     $('#faculty_username_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
		$("#faculty_username_field").removeClass("has-error");
}); 

   $('#faculty_email').blur(function(){

     var faculty_email = $(this).val();
	 var faculty_operation = $('#faculty_operation').val();
     if(faculty_operation == 'Add'){

     $.ajax({
      url:'check_username.php',
      method:"POST",
      data:{faculty_email:faculty_email},
      success:function(data)
      {
       if(data != '0')
       {
        $('#faculty_email_availability_message').html('<span class="text-danger"><b>Email not available</b></span>');
        $('#faculty_action').attr("disabled", true);
		$("#faculty_email_field").removeClass("has-success");
        $("#faculty_email_field").addClass("has-error");
       }
       else
       {
        $('#faculty_email_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
       }
      }
     })
   }

  });
  
    $("#faculty_email").focus(function(){
     $('#faculty_email_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
		$("#faculty_email_field").removeClass("has-error");
}); 

   $('#faculty_number').blur(function(){

     var faculty_number = $(this).val();
	 var faculty_operation = $('#faculty_operation').val();
     if(faculty_operation == 'Add'){

     $.ajax({
      url:'check_username.php',
      method:"POST",
      data:{faculty_number:faculty_number},
      success:function(data)
      {
       if(data != '0')
       {
        $('#faculty_number_availability_message').html('<span class="text-danger"><b>Number not available</b></span>');
        $('#faculty_action').attr("disabled", true);
		$("#faculty_number_field").removeClass("has-success");
        $("#faculty_number_field").addClass("has-error");
       }
       else
       {
        $('#faculty_number_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
       }
      }
     })
   }

  });
  
    $("#faculty_number").focus(function(){
     $('#faculty_number_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
		$("#faculty_number_field").removeClass("has-error");
}); 
  
	 $('.modal_close').click(function(){
		$('#hod_username_availability_message').html('');
        $('#hod_action').attr("disabled", false);
		$("#hod_username_field").removeClass("has-success has-error");
		
	    $('#faculty_username_availability_message').html('');
        $('#faculty_action').attr("disabled", false);
		$("#faculty_username_field").removeClass("has-success has-error");
		
		
		$('label[id*=hod_username-error').html('');
		$('label[id*=hod_password-error').html('');
		$('label[id*=hod_name-error').html('');
		$('label[id*=hod_email-error').html('');
		$('label[id*=hod_number-error').html('');
		
	    $('label[id*=faculty_username-error').html('');
		$('label[id*=faculty_password-error').html('');
		$('label[id*=faculty_name-error').html('');
		$('label[id*=faculty_email-error').html('');
		$('label[id*=faculty_number-error').html('');
		
		$(".form-group").removeClass("has-success has-error");
	 });
	 
  $(document).on('submit', '#admin_change_password_form', function(event){				//change password
  event.preventDefault();
  var admin_old_change_password = $('#admin_old_change_password').val();
  var admin_new_change_password = $('#admin_new_change_password').val();
  var admin_confirm_change_password = $('#admin_confirm_change_password').val();
  if(admin_old_change_password != '' && admin_new_change_password != ''  && admin_confirm_change_password != '')
  {
   $.ajax({
    url:"admin_change_password.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
	 $('#admin_change_password_form')[0].reset();
     $('#admin_change_password_modal').modal('hide');
     $('#alert_hod_message').html(data);
    }
   });
   setInterval(function(){
     $('#alert_hod_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 $(document).on('click', '#my_info_button', function(){
	 $('.modal-title').text("My Information");
 });
 $(document).on('click', '#change_password_button', function(){
	 $('.modal-title').text("Change Password");
 });
    
   });