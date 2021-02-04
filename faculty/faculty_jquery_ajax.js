$(document).ready(function(){
	
	     fetch_task_assign_by_hod_data();  					//fetch data 
    
     function fetch_task_assign_by_hod_data()
     {
   	  
      var dataTable = $('#task_assign_by_hod_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_task_assign_by_hod_data.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[0,7,8,10,11],
          "orderable":false,
         },
        ],	
      });
     }
	 
	 
	 
	 
	fetch_receive_message_data();  					//fetch send message data
    
     function fetch_receive_message_data()
     {
   	$.ajax({
    url:"fetch_faculty_receive_message.php",
    success:function(data)
    {
      $('#receive_message_table_body').html(data);
    }
   });
	  
     }
	
	
	  fetch_task_list_data();  					//fetch data
    
     function fetch_task_list_data()
     {
   	  
      var dataTable = $('#task_list_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_task_list.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[0,10], // For delete add ,9
          "orderable":false,
         },
        ],	
      });
     }
/*	 
	 $(document).ready(function(){
    $('#receive_message_data').DataTable();
});
*/	
 //faculty task assign start
	
$(document).on('click', '.faculty_task_assign', function(){						//faculty Assign task MODAL Open
 var faculty_task_id = $(this).attr("id");
 $('#faculty_task_assign_send_email_button').hide();
  $.ajax({
   success:function()
   {
    $('#faculty_task_assign_modal').modal('show');
    $('.modal-title').html('Assign Task');
	$('#faculty_task_assign_operation').val("Assign");
	$('#faculty_task_assign_form')[0].reset();
	 $('#faculty_task_id').val(faculty_task_id);
	 $("#faculty_task_assign_action").attr("disabled",false);
	 $('#faculty_task_assign_action').val("Assign");
	 $("#faculty_task_assign_action").removeClass("btn-success");
	 $("#faculty_task_assign_action").addClass("btn-primary");
	 $("#faculty_task_assign_send_email_button").attr("disabled",false);
	     $('#faculty_task_assign_send_email_button').text("Send Email");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-success");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-warning");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-danger");
	     $("#faculty_task_assign_send_email_button").addClass("btn-primary");	
    }
  });
 });
 
 
   $(document).on('submit', '#faculty_task_assign_form', function(event){						//Assign Task
  event.preventDefault();
   $.ajax({
    url:"faculty_task_assign.php",
    method:'POST',
	data:new FormData(this),
    dataType:"json",
	contentType:false,
    processData:false,
    success:function(data)
    {
	if(data.error == 100){
		$('#alert_task_assign_by_hod_message').html(data.message);
		$('#faculty_task_assign_modal').modal('hide');
		$("input.multiple_select_faculty_task_assign").attr("disabled",true);
	}
	else{
	 $('#alert_task_assign_by_hod_message').html(data.message);     
     $('#assign_record_table_id').val(data.fk_record_table_id); 
     $('#assign_hod_task_id').val(data.fk_hod_task_id); 
	 $('#faculty_task_assign_action').val("Assigned");
	 $("#faculty_task_assign_action").removeClass("btn-primary");
	 $("#faculty_task_assign_action").addClass("btn-success");
     $('#faculty_task_assign_send_email_button').show();
	 $("#faculty_task_assign_action").attr("disabled",true);
	 $("input.multiple_select_faculty_task_assign").removeAttr("disabled");
     $(".form-group").removeClass("has-success has-error");
	$('#task_assign_by_hod_data').DataTable().destroy();
     fetch_task_assign_by_hod_data();	
	}
    
	 
    }
   });
   setInterval(function(){
     $('#alert_task_assign_by_hod_message').html('');
    }, 10000);
  
 });
 
 //faculty task assign end
 
 // Send email after assigning task
	
  $(document).on('click', '#faculty_task_assign_send_email_button', function(){				
	 var assign_hod_task_id = $('#assign_hod_task_id').val();
	 var assign_record_table_id = $('#assign_record_table_id').val();
	 if(assign_hod_task_id != '' && assign_record_table_id != ''){
	 $.ajax({
	 url:"faculty_task_assign_send_email.php",
     method:"POST",
     data:{
		 assign_hod_task_id:assign_hod_task_id,
		 assign_record_table_id:assign_record_table_id
		 },
	 beforeSend:function(){
		 
     $('#faculty_task_assign_send_email_button').text("Sending..");
	 $("#faculty_task_assign_send_email_button").removeClass("btn-primary");
	 $("#faculty_task_assign_send_email_button").removeClass("btn-success");
	 $("#faculty_task_assign_send_email_button").addClass("btn-warning");	
	
   },
	 success:function(data){
		 if(data == 101){
		 $('#alert_task_assign_by_hod_message').html('<div class="alert alert-success">Email Sent</div>');
	     $("#faculty_task_assign_send_email_button").attr("disabled",true);
		 $('#faculty_task_assign_send_email_button').text("Email Sent");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-primary");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-warning");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-danger");
	     $("#faculty_task_assign_send_email_button").addClass("btn-success");	
	     }
		 if(data == 102){
		 $('#alert_task_assign_by_hod_message').html('<div class="alert alert-danger">Task Assigned but Email not Sent !</div>');
	     $("#faculty_task_assign_send_email_button").attr("disabled",false);
		 $('#faculty_task_assign_send_email_button').text("Try Again");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-primary");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-warning");
	     $("#faculty_task_assign_send_email_button").removeClass("btn-success");
	     $("#faculty_task_assign_send_email_button").addClass("btn-danger");	 
		 }
	 }
	 });
	 setInterval(function(){
     $('#alert_task_assign_by_hod_message').html('');
    }, 10000);
  }
  else {
	  alert("First Assign The Task");
  }
 });
	 
	 //// Send email after assigning task ends
	 
	  // Send reminder
	
  $(document).on('click', '#faculty_task_assign_send_reminder_button_id', function(){				
	 var reminder_record_table_id = $('#status_record_table_id').val();
	 if(reminder_record_table_id != ''){
	 $.ajax({
	 url:"faculty_task_reminder_send_email.php",
     method:"POST",
     data:{
		 reminder_record_table_id:reminder_record_table_id
		 },
	 beforeSend:function(){
		 
     $('#faculty_task_assign_send_reminder_button_id').text("Sending..");
	 $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-primary");
	 $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-success");
	 $("#faculty_task_assign_send_reminder_button_id").addClass("btn-warning");	
	
   },
	 success:function(data){
		 if(data == 101){
		 $('#alert_task_assign_by_hod_message').html('<div class="alert alert-success">Email Sent</div>');
	     $("#faculty_task_assign_send_reminder_button_id").attr("disabled",true);
		 $('#faculty_task_assign_send_reminder_button_id').text("Email Sent");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-primary");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-warning");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-danger");
	     $("#faculty_task_assign_send_reminder_button_id").addClass("btn-success");	
	     }
		 if(data == 102){
		 $('#alert_task_assign_by_hod_message').html('<div class="alert alert-danger">Email not Sent !</div>');
	     $("#faculty_task_assign_send_reminder_button_id").attr("disabled",false);
		 $('#faculty_task_assign_send_reminder_button_id').text("Try Again");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-primary");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-warning");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-success");
	     $("#faculty_task_assign_send_reminder_button_id").addClass("btn-danger");	 
		 }
	 }
	 });
	 setInterval(function(){
     $('#alert_task_assign_by_hod_message').html('');
    }, 10000);
  }
  else {
	  alert("First Assign The Task");
  }
 });
	 
	 //// Send Reminder ends
	 
	 
	   $(document).on('submit', '#faculty_change_password_form', function(event){    //Change Password
  event.preventDefault();
  var faculty_old_change_password = $('#faculty_old_change_password').val();
  var faculty_new_change_password = $('#faculty_new_change_password').val();
  var faculty_confirm_change_password = $('#faculty_confirm_change_password').val();
  if(faculty_old_change_password != '' && faculty_new_change_password != ''  && faculty_confirm_change_password != '')
  {
   $.ajax({
    url:"faculty_change_password.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
	 $('#faculty_change_password_form')[0].reset();
     $('#faculty_change_password_modal').modal('hide');
     $('#alert_task_list_message').html(data);
    }
   });
   setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 5000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 
 
$(document).on('click', '.faculty_task_status', function(){	
//Task Status MODAL Open for update hod task status 					
 var faculty_task_id = $(this).attr("id");
  $.ajax({
   success:function()
   {
	$('#faculty_task_status_modal').modal('show');
    $('.modal-title').text('Task Status');
	$('#hod_status_faculty_task_id').val(faculty_task_id);
    }
  });
 });
 
  $(document).on('submit', '#faculty_task_status_form', function(event){						//hod status
  event.preventDefault();
   $.ajax({
    url:"faculty_task_status_update.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
     $('#faculty_task_status_form')[0].reset();
     $('#faculty_task_status_modal').modal('hide');
	 $('#alert_task_list_message').html(data);
	 $('#task_list_data').DataTable().destroy();
     fetch_task_list_data();
	 $('#task_assign_by_hod_data').DataTable().destroy();
     fetch_task_assign_by_hod_data();
	 $(".form-group").removeClass("has-success has-error");
	 $('label[id*=select_task_status-error').html('');
    }
   });
   setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 5000);
  
 
 });
	 
	 
	 
	 $(document).on('click', '.report', function(){						//Report MODAL Open

 var status_record_table_id = $(this).attr("id");
 
  $.ajax({
   url:"report.php",
   method:"POST",
   data:{
	   status_record_table_id:status_record_table_id
   },
   success:function(data)
   {
	
	$('#report_modal').modal('show');
    $('.modal-title').html('Report');
    $('#report_modal_body').html(data);
	var faculty_task_assign_count = $('#faculty_task_assign_count').val();
	$('#status_record_table_id').val(status_record_table_id);
	if(faculty_task_assign_count == 0){
		$("#faculty_task_assign_send_reminder_button_id").attr("disabled",true);
		$("#faculty_task_assign_delete_button_id").attr("disabled",true);
	}else{

	     $("#faculty_task_assign_send_reminder_button_id").attr("disabled",false);
		 $("#faculty_task_assign_delete_button_id").attr("disabled",false);
	     $('#faculty_task_assign_send_reminder_button_id').text("Send Reminder");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-success");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-warning");
	     $("#faculty_task_assign_send_reminder_button_id").removeClass("btn-danger");
	     $("#faculty_task_assign_send_reminder_button_id").addClass("btn-primary");	
	}
    
    }
  });
 });
 	
	 
	   	    $(document).on('click', '.faculty_task_assign_delete_button_class', function(){									//delete messages
			
  var record_table_id = $('#status_record_table_id').val();
   $('#deleteModal').modal('show');
    $('#modal_title').text("Are you sure you want to delete?");
	$('#notdelbtn').click(function(){
		record_table_id = null;
	});
   $(document).on('submit', '#delete_form', function(event){
  event.preventDefault();
   
    $.ajax({
     url:"faculty_task_assign_delete.php",
     method:"POST",
     data:{record_table_id:record_table_id},
     success:function(data){
	  $('#deleteModal').modal('hide');
	  $('#report_modal').modal('hide');
      $('#alert_task_assign_by_hod_message').html('<div class="alert alert-danger">'+data+'</div>');
	 
	
     }
    });
    setInterval(function(){
     $('#alert_task_assign_by_hod_message').html('');
    }, 5000);
   
  });
  });
	 
	
	
	 $(document).on('submit', '#faculty_reset_password_form', function(event){    //Faculty Reset Password
  event.preventDefault();
  var faculty_reset_password = $('#faculty_reset_password').val();
  var faculty_confirm_reset_password = $('#faculty_confirm_reset_password').val();
  if(faculty_reset_password != ''  && faculty_confirm_reset_password != '')
  {
   $.ajax({
    url:"faculty_reset_password_php_code.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
	 $('#faculty_reset_password_form')[0].reset();
     $('#faculty_reset_password_message').html(data);
	 $(".form-group").removeClass("has-success has-error");
    }
   });
   setInterval(function(){
     $('#faculty_reset_password_message').html('');
    }, 50000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });

 
	
	 
 
$('.modal_close').click(function(){
	 $(".form-group").removeClass("has-success has-error");
	 $('#faculty_task_status_form')[0].reset();
	 $('label[id*=select_task_status-error').html('');
	 });
 
  $(document).on('click', '#my_info_button', function(){
	 $('.modal-title').text("My Information");
 });
 $(document).on('click', '#change_password_button', function(){
	 $('.modal-title').text("Change Password");
 });



    
});