$(document).ready(function(){
	$('#add_task_list_button').click(function(){
     $('#add_task_list_form')[0].reset();
     $('#task_list_modal_title').text("Add Task");
     $('#hod_task_action').val("Add");
     $('#hod_task_operation').val("Add");
     $('#hod_task_assign_operation').val("Assign");
	 $("#hod_task_action").removeClass("btn-warning");
	 $("#hod_task_action").addClass("btn-success");	
	 $("#hod_task_action").attr("disabled",false);
	 $('label[id*=hod_image_path-error').html('');
    });
	
		 	

    
     function fetch_report_data()		//fetch Report data
     {
   	  
      var dataTable = $('#report_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_report.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[7,8,9,10],
          "orderable":false,
         },
        ],	
      });
     }
	
	
		fetch_send_message_data();  					//fetch send message data
    
     function fetch_send_message_data()
     {
   	  
      var dataTable = $('#send_message_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_hod_send_message.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[4],
          "orderable":false,
         },
        ],	
      });
     }
	
	
	fetch_task_assign_list_data();  					//fetch Assign data
    
     function fetch_task_assign_list_data()
     {
   	  
      var dataTable = $('#task_assign_list_data').DataTable({
       "processing" : true,
       "serverSide" : true,
       "order" : [],
       "ajax" : {
        url:"fetch_task_assign_list.php",
        type:"POST"
        },
   	"columnDefs":[
         {
          "targets":[7,8,9,10],
          "orderable":false,
         },
        ],	
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
          "targets":[0,6,7,8,9],
          "orderable":false,
         },
        ],	
      });
     }
	 
	 
	  $(document).on('submit', '#report_form', function(event){						//Report
  event.preventDefault();
  var date_timepicker_start = $('#date_timepicker_start').val();
  var date_timepicker_end = $('#date_timepicker_end').val();
  if(date_timepicker_start != '' && date_timepicker_end != '')
  {
	  $.ajax({
    url:"fetch_report_session.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {	
	 $('#alert_report_message').html(data);
	$('#report_data').DataTable().destroy();
	fetch_report_data();  
    
    
	
	 
    }
   });
   setInterval(function(){
     $('#alert_report_message').html('');
    }, 10000);
	
  }else{
	  alert("All Fields are Required"); 
  }
  						
  
			 });
	 
	 	 $(document).on('submit', '#add_task_list_form', function(event){						//insert data
  event.preventDefault();
  var hod_task_name = $('#hod_task_name').val();
  var hod_task_description = $('#hod_task_description').val();
  var hod_task_type = $('#hod_task_type').val();
  var hod_task_priority = $('#hod_task_priority').val();

  if(hod_task_name != '' && hod_task_description != ''  && hod_task_type != ''  && hod_task_priority != '')
  {
   $.ajax({
    url:"insert_task_list.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
	beforeSend:function(){
		 
     $('#hod_task_action').val("Uploading..");
	 $("#hod_task_action").removeClass("btn-success");
	 $("#hod_task_action").addClass("btn-warning");	
	 $("#hod_task_action").attr("disabled",true);
	
   },
    success:function(data)
    {
		
	 $('#hod_task_action').val("Success");
	 $("#hod_task_action").removeClass("btn-warning");
	 $("#hod_task_action").addClass("btn-success");
     $("#hod_task_action").attr("disabled",false);	 
		
     $('#alert_task_list_message').html(data);
     $('#add_task_list_form')[0].reset();
     $('#add_task_list_modal').modal('hide');
     $('#task_list_data').DataTable().destroy();
     fetch_task_list_data();
	 $(".form-group").removeClass("has-success has-error");
	 $('label[id*=hod_task_name-error').html('');
	 $('label[id*=hod_task_description-error').html('');
	 $('#task_assign_list_data').DataTable().destroy();
     fetch_task_assign_list_data(); 
    }
   });
   setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });
	 
	 
	       $(document).on('click', '.hod_task_update', function(){						//fetch single entry
  var hod_task_id = $(this).attr("id");
  $.ajax({
   url:"fetch_hod_task_list_single.php",
   method:"POST",
   data:{hod_task_id:hod_task_id},
   dataType:"json",
   success:function(data)
   {
	$('label[id*=hod_image_path-error').html('');
    $('#add_task_list_modal').modal('show');
    $('#hod_task_name').val(data.hod_task_name);
    $('#hod_task_description').val(data.hod_task_description);
    $('#hod_task_type').val(data.hod_task_type);
    $('#hod_task_priority').val(data.hod_task_priority);
    $('#hod_image_path').val('');
    $('.modal-title').html('Edit Task');
    $('#hod_task_id').val(hod_task_id);
   
    $('#hod_task_action').val("Edit");
    $('#hod_task_operation').val("Edit");
   }
  });
 });
	


$(document).on('click', '.hod_task_status', function(){						//Task Status MODAL Open
 //var hod_task_status_class = $(this).attr("class"); //Hod Task ID
 //var hod_task_status_id = $(this).attr("id"); // No. of time task assign
 var status_record_table_id = $(this).attr("id");
 //hod_task_status_class=parseInt(hod_task_status_class, 10);
  $.ajax({
   url:"hod_task_status.php",
   method:"POST",
   data:{
	   status_record_table_id:status_record_table_id
   },
   success:function(data)
   {
    $('#hod_task_status_modal').modal('show');
    $('.modal-title').html('Task Status');
    $('#hod_task_status_modal_body').html(data);
	$('#status_record_table_id').val(status_record_table_id);
	     $("#hod_task_assign_send_reminder_button_id").attr("disabled",false);
	     $('#hod_task_assign_send_reminder_button_id').text("Send Reminder");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-success");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-warning");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-danger");
	     $("#hod_task_assign_send_reminder_button_id").addClass("btn-primary");	
    }
  });
 });
 	

	$(document).on('click', '.hod_task_assign_send_reminder_button_class', function(){						//send reminder of task
 //var send_reminder_hod_task_id = $('#send_reminder_hod_task_id').val();
 //var send_reminder_hod_number_of_time_task_assign = $('#send_reminder_hod_number_of_time_task_assign').val();
 //send_reminder_hod_task_id=parseInt(send_reminder_hod_task_id, 10);
 var status_record_table_id = $('#status_record_table_id').val();
 
  $.ajax({
   url:"hod_task_assign_send_reminder.php",
   method:"POST",
   data:{
	   status_record_table_id:status_record_table_id
   },
   beforeSend:function(){
		 
     $('#hod_task_assign_send_reminder_button_id').text("Sending..");
	 $("#hod_task_assign_send_reminder_button_id").removeClass("btn-primary");
	 $("#hod_task_assign_send_reminder_button_id").removeClass("btn-success");
	 $("#hod_task_assign_send_reminder_button_id").addClass("btn-warning");	
	
   },
   success:function(data)
    {
    
	     if(data == 103){
		 $('#alert_task_assign_list_message').html('<div class="alert alert-success">Email Sent</div>');
	     $("#hod_task_assign_send_reminder_button_id").attr("disabled",true);
		 $('#hod_task_assign_send_reminder_button_id').text("Reminder Sent");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-primary");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-warning");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-danger");
	     $("#hod_task_assign_send_reminder_button_id").addClass("btn-success");	
	     }
		 if(data == 104){
		 $('#alert_task_assign_list_message').html('<div class="alert alert-danger">Reminder not Sent !</div>');
	     $("#hod_task_assign_send_reminder_button_id").attr("disabled",false);
		 $('#hod_task_assign_send_reminder_button_id').text("Try Again");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-primary");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-warning");
	     $("#hod_task_assign_send_reminder_button_id").removeClass("btn-success");
	     $("#hod_task_assign_send_reminder_button_id").addClass("btn-danger");	 
		 }
	
    }
  });
  setInterval(function(){
     $('#alert_task_assign_list_message').html('');
    }, 10000);
 });
	
	

$(document).on('click', '.hod_task_change_deadline', function(){						//Change Deadline MODAL Open
 $('.modal-title').html('Change Deadline');
 //var change_deadline_hod_task_id = $(this).attr("class");
 //var change_deadline_hod_number_of_time_task_assign = $(this).attr("id");
 var change_deadline_record_table_id = $(this).attr("id");
 //change_deadline_hod_task_id=parseInt(change_deadline_hod_task_id, 10);
  $.ajax({
   url:"hod_task_fetch_deadline.php",
   method:"POST",
   data:{
	   change_deadline_record_table_id : change_deadline_record_table_id,
   },
   success:function(data)
   {
    $('#hod_task_change_deadline_modal').modal('show');
	$('#change_deadline_record_table_id').val(change_deadline_record_table_id);
	$('#change_deadline').val(data);
	
    }
  });
 });
 	

$(document).on('submit', '#hod_task_change_deadline_form', function(){						//Change Deadline
event.preventDefault();
 $('.modal-title').html('Change Deadline');
  $.ajax({
   url:"hod_task_change_deadline.php",
   method:"POST",
  data:new FormData(this),
    contentType:false,
    processData:false,
   success:function(data)
   {
	$('#alert_task_assign_list_message').html(data);   
    $('#hod_task_change_deadline_modal').modal('hide');
	$('#hod_task_change_deadline_form')[0].reset();
	$('label[id*=change_deadline-error').html('');
     $(".form-group").removeClass("has-success has-error");
	 $('#task_assign_list_data').DataTable().destroy();
     fetch_task_assign_list_data();
    }
  });
  
   setInterval(function(){
     $('#alert_task_assign_list_message').html('');
    }, 10000);
 });
	
$(document).on('click', '#send_message_button', function(){						//Send Message MODAL Open
 $('#hod_message_send_email_button').hide();
  $.ajax({
   success:function()
   {
    $('#send_message_modal').modal('show');
    $('.modal-title').html('Send Messages');
	$('#hod_message_operation').val("Send");
	$('#hod_send_message_form')[0].reset();
	 $("#hod_message_action").attr("disabled",false);
	 $('#hod_message_action').val("Send");
	 $("#hod_message_action").removeClass("btn-success");
	 $("#hod_message_action").addClass("btn-primary");
	 $("#hod_message_send_email_button").attr("disabled",false);
	     $('#hod_message_send_email_button').text("Send Email");
	     $("#hod_message_send_email_button").removeClass("btn-success");
	     $("#hod_message_send_email_button").removeClass("btn-warning");
	     $("#hod_message_send_email_button").removeClass("btn-danger");
	     $("#hod_message_send_email_button").addClass("btn-primary");	
    }
  });
 });


   $(document).on('submit', '#hod_send_message_form', function(event){						//Send Message
  event.preventDefault();
  var send_message_field = $('#send_message_field').val();

  if(send_message_field != '')
  {
   $.ajax({
    url:"hod_send_message.php",
    method:'POST',
	data:new FormData(this),
    dataType:"json",
	contentType:false,
    processData:false,
    success:function(data)
    {
     $('#alert_send_message_message').html(data.message);     
     $('#hod_message_id').val(data.hod_message_id);     
     $('#hod_message_sent_to_faculty_id').val(data.hod_message_sent_to_faculty_id);     
  
	 $('#hod_message_action').val("Sent");
	 $("#hod_message_action").removeClass("btn-primary");
	 $("#hod_message_action").addClass("btn-success");
     $('#hod_message_send_email_button').show();
	 $("#hod_message_action").attr("disabled",true);
     //$('#hod_task_assign_modal').modal('hide');
	 $('#hod_send_message_form')[0].reset();
	 $("input.multiple_select_faculty_send_message").removeAttr("disabled");
	 $('label[id*=send_message_field-error').html('');
     $(".form-group").removeClass("has-success has-error");
	 $('#send_message_data').DataTable().destroy();
     fetch_send_message_data();
	 
	 //$('label[id*=hod_task_name-error').html('');
	 
    }
   });
   setInterval(function(){
     $('#alert_send_message_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });
 
 
   $(document).on('click', '#hod_message_send_email_button', function(){				// Send email after sending message
	 var hod_message_id = $('#hod_message_id').val();
	 var hod_message_sent_to_faculty_id = $('#hod_message_sent_to_faculty_id').val();
	 if(hod_message_id != '' && hod_message_sent_to_faculty_id != ''){
	 $.ajax({
	 url:"hod_send_message_send_email.php",
     method:"POST",
     data:{
		 hod_message_id:hod_message_id,
		 hod_message_sent_to_faculty_id:hod_message_sent_to_faculty_id
		 },
	 beforeSend:function(){
		 
     $('#hod_message_send_email_button').text("Sending..");
	 $("#hod_message_send_email_button").removeClass("btn-primary");
	 $("#hod_message_send_email_button").removeClass("btn-success");
	 $("#hod_message_send_email_button").addClass("btn-warning");	
	
   },
	 success:function(data){
		 if(data == 105){
		 $('#alert_send_message_message').html('<div class="alert alert-success">Email Sent</div>');
	     $("#hod_message_send_email_button").attr("disabled",true);
		 $('#hod_message_send_email_button').text("Email Sent");
	     $("#hod_message_send_email_button").removeClass("btn-primary");
	     $("#hod_message_send_email_button").removeClass("btn-warning");
	     $("#hod_message_send_email_button").removeClass("btn-danger");
	     $("#hod_message_send_email_button").addClass("btn-success");	
	     }
		 if(data == 106){
		 $('#alert_send_message_message').html('<div class="alert alert-danger">Message Sent to faculty portal but Email not Sent !</div>');
	     $("#hod_message_send_email_button").attr("disabled",false);
		 $('#hod_message_send_email_button').text("Try Again");
	     $("#hod_message_send_email_button").removeClass("btn-primary");
	     $("#hod_message_send_email_button").removeClass("btn-warning");
	     $("#hod_message_send_email_button").removeClass("btn-success");
	     $("#hod_message_send_email_button").addClass("btn-danger");	 
		 }
	 }
	 });
	 setInterval(function(){
     $('#alert_send_message_message').html('');
    }, 10000);
  }
  else {
	  alert("First send the message");
  }
 });
 
	
$(document).on('click', '.hod_task_assign', function(){						//Assign task MODAL Open
 var assign_hod_task_id = $(this).attr("id");
 $('#hod_task_assign_send_email_button').hide();
  $.ajax({
   success:function()
   {
	 //task_assign_hod_task_id = null;
	 //task_assign_hod_number_of_time_task_assign = null;
	 //assign_hod_task_id = null;
	 //assign_record_table_id = null;
	 //$("input.multiple_select_faculty_task_assign").removeAttr("disabled");
    $('#hod_task_assign_modal').modal('show');
    $('.modal-title').html('Assign Task');
	$('#hod_task_assign_operation').val("Assign");
	$('#hod_task_assign_form')[0].reset();
	 $('#assign_hod_task_id').val(assign_hod_task_id);
	 $("#hod_task_assign_action").attr("disabled",false);
	 $('#hod_task_assign_action').val("Assign");
	 $("#hod_task_assign_action").removeClass("btn-success");
	 $("#hod_task_assign_action").addClass("btn-primary");
	 $("#hod_task_assign_send_email_button").attr("disabled",false);
	     $('#hod_task_assign_send_email_button').text("Send Email");
	     $("#hod_task_assign_send_email_button").removeClass("btn-success");
	     $("#hod_task_assign_send_email_button").removeClass("btn-warning");
	     $("#hod_task_assign_send_email_button").removeClass("btn-danger");
	     $("#hod_task_assign_send_email_button").addClass("btn-primary");	
    }
  });
 });
 
 
   $(document).on('submit', '#hod_task_assign_form', function(event){						//Assign Task
  event.preventDefault();
  var datetimepicker = $('#datetimepicker').val();

  if(datetimepicker != '')
  {
   $.ajax({
    url:"hod_task_assign.php",
    method:'POST',
	data:new FormData(this),
    dataType:"json",
	contentType:false,
    processData:false,
    success:function(data)
    {
	//$("input.multiple_select_faculty_task_assign").attr("disabled",true);
     $('#alert_task_list_message').html(data.message);     
     //$('#task_assign_hod_task_id').val(data.hod_task_assign_id);     
     //$('#task_assign_hod_number_of_time_task_assign').val(data.new_hod_task_assign_count); 
     $('#assign_hod_task_id').val(data.assign_hod_task_id); 
     $('#assign_record_table_id').val(data.assign_record_table_id); 
	 $('#hod_task_assign_action').val("Assigned");
	 $("#hod_task_assign_action").removeClass("btn-primary");
	 $("#hod_task_assign_action").addClass("btn-success");
     $('#hod_task_assign_send_email_button').show();
	 $("#hod_task_assign_action").attr("disabled",true);
     //$('#hod_task_assign_modal').modal('hide');
	// $('#hod_task_assign_form')[0].reset();
	 $("input.multiple_select_faculty_task_assign").removeAttr("disabled");
	 $('label[id*=datetimepicker-error').html('');
     $(".form-group").removeClass("has-success has-error");
	 $('#task_assign_list_data').DataTable().destroy();
     fetch_task_assign_list_data();
	 
	 //$('label[id*=hod_task_name-error').html('');
	 
    }
   });
   setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });

 
  $(document).on('click', '#hod_task_assign_send_email_button', function(){				// Send email after assigning task
	 var assign_hod_task_id = $('#assign_hod_task_id').val();
	 var assign_record_table_id = $('#assign_record_table_id').val();
	 if(assign_hod_task_id != '' && assign_record_table_id != ''){
	 $.ajax({
	 url:"hod_task_assign_send_email.php",
     method:"POST",
     data:{
		 assign_hod_task_id:assign_hod_task_id,
		 assign_record_table_id:assign_record_table_id
		 },
	 beforeSend:function(){
		 
     $('#hod_task_assign_send_email_button').text("Sending..");
	 $("#hod_task_assign_send_email_button").removeClass("btn-primary");
	 $("#hod_task_assign_send_email_button").removeClass("btn-success");
	 $("#hod_task_assign_send_email_button").addClass("btn-warning");	
	
   },
	 success:function(data){
		 if(data == 101){
		 $('#alert_task_list_message').html('<div class="alert alert-success">Email Sent</div>');
	     $("#hod_task_assign_send_email_button").attr("disabled",true);
		 $('#hod_task_assign_send_email_button').text("Email Sent");
	     $("#hod_task_assign_send_email_button").removeClass("btn-primary");
	     $("#hod_task_assign_send_email_button").removeClass("btn-warning");
	     $("#hod_task_assign_send_email_button").removeClass("btn-danger");
	     $("#hod_task_assign_send_email_button").addClass("btn-success");	
	     }
		 if(data == 102){
		 $('#alert_task_list_message').html('<div class="alert alert-danger">Task Assigned but Email not Sent !</div>');
	     $("#hod_task_assign_send_email_button").attr("disabled",false);
		 $('#hod_task_assign_send_email_button').text("Try Again");
	     $("#hod_task_assign_send_email_button").removeClass("btn-primary");
	     $("#hod_task_assign_send_email_button").removeClass("btn-warning");
	     $("#hod_task_assign_send_email_button").removeClass("btn-success");
	     $("#hod_task_assign_send_email_button").addClass("btn-danger");	 
		 }
	 }
	 });
	 setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 10000);
  }
  else {
	  alert("First Assign The Task");
  }
 });
	 
	    $(document).on('click', '.hod_task_delete', function(){									//delete data
   var hod_task_id = $(this).attr("id");
   $('#deleteModal').modal('show');
    $('.modal-title').text("Are you sure you want to delete?");
	$('#notdelbtn').click(function(){
		hod_task_id = null;
	});
   $(document).on('submit', '#delete_form', function(event){
  event.preventDefault();
   
    $.ajax({
     url:"hod_task_delete.php",
     method:"POST",
     data:{hod_task_id:hod_task_id},
     success:function(data){
	  $('#deleteModal').modal('hide');
      $('#alert_task_list_message').html('<div class="alert alert-danger">'+data+'</div>');
      $('#task_list_data').DataTable().destroy();
     fetch_task_list_data(); 
     $('#task_assign_list_data').DataTable().destroy();
     fetch_task_assign_list_data(); 	 
	
     }
    });
    setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 10000);
   
  });
  });
  
  
  	    $(document).on('click', '.hod_task_assign_delete', function(){									//delete data of individual assign task
 //var delete_assign_hod_task_id = $(this).attr("class");
 //var delete_assign_hod_number_of_time_task_assign = $(this).attr("id");
 //delete_assign_hod_task_id=parseInt(delete_assign_hod_task_id, 10);  
 
 var delete_assign_record_table_id = $(this).attr("id");
 
   $('#deleteModal').modal('show');
    $('.modal-title').text("Are you sure you want to delete?");
	$('.notdelbtn').click(function(){
		delete_assign_record_table_id = null;
	});
	
	
   $(document).on('submit', '#delete_form', function(event){
  event.preventDefault();
   
    $.ajax({
     url:"hod_task_assign_delete.php",
     method:"POST",
     data:{
		 delete_assign_record_table_id:delete_assign_record_table_id
	 },
     success:function(data){
	  $('#deleteModal').modal('hide');
      $('#alert_task_assign_list_message').html('<div class="alert alert-danger">'+data+'</div>');
      $('#task_assign_list_data').DataTable().destroy();
      fetch_task_assign_list_data();  
	
     }
    });
    setInterval(function(){
     $('#alert_task_assign_list_message').html('');
    }, 10000);
   
  });
  });
  
  
  	    $(document).on('click', '.hod_message_delete', function(){									//delete messages
   var hod_message_id = $(this).attr("id");
   $('#deleteModal').modal('show');
    $('.modal-title').text("Are you sure you want to delete?");
	$('#notdelbtn').click(function(){
		hod_message_id = null;
	});
   $(document).on('submit', '#delete_form', function(event){
  event.preventDefault();
   
    $.ajax({
     url:"hod_send_message_delete.php",
     method:"POST",
     data:{hod_message_id:hod_message_id},
     success:function(data){
	  $('#deleteModal').modal('hide');
      $('#alert_send_message_message').html('<div class="alert alert-danger">'+data+'</div>');
      $('#send_message_data').DataTable().destroy();
     fetch_send_message_data(); 	 
	
     }
    });
    setInterval(function(){
     $('#alert_send_message_message').html('');
    }, 10000);
   
  });
  });
	 
	 
	 
	   $(document).on('submit', '#hod_change_password_form', function(event){    //Change Password
  event.preventDefault();
  var hod_old_change_password = $('#hod_old_change_password').val();
  var hod_new_change_password = $('#hod_new_change_password').val();
  var hod_confirm_change_password = $('#hod_confirm_change_password').val();
  if(hod_old_change_password != '' && hod_new_change_password != ''  && hod_confirm_change_password != '')
  {
   $.ajax({
    url:"hod_change_password.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
	 $('#hod_change_password_form')[0].reset();
     $('#hod_change_password_modal').modal('hide');
     $('#alert_task_list_message').html(data);
    }
   });
   setInterval(function(){
     $('#alert_task_list_message').html('');
    }, 10000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });


 function load_unseen_notification(view = '')     // Notification Code
 {
  $.ajax({
   url:"hod_fetch_notification.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('#hod_notification_body').html(data.notification);
    if(data.unseen_notification >= 0)
    {
     $('#hod_notification_count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
  $(document).on('click', '#hod_notification_modal_close', function(){  //Notification Modal
  $('#hod_notification_count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 50000);

 
 $(document).on('submit', '#hod_reset_password_form', function(event){    //HoD Reset Password
  event.preventDefault();
  var hod_reset_password = $('#hod_reset_password').val();
  var hod_confirm_reset_password = $('#hod_confirm_reset_password').val();
  if(hod_reset_password != ''  && hod_confirm_reset_password != '')
  {
   $.ajax({
    url:"hod_reset_password_php_code.php",
    method:'POST',
	data:new FormData(this),
    contentType:false,
    processData:false,
    success:function(data)
    {
	 $('#hod_reset_password_form')[0].reset();
     $('#hod_reset_password_message').html(data);
	 $(".form-group").removeClass("has-success has-error");
    }
   });
   setInterval(function(){
     $('#hod_reset_password_message').html('');
    }, 50000);
  }
  else
  {
   alert("All Fields are Required");
  }
 });

 
 
$('.modal_close').click(function(){
	 $(".form-group").removeClass("has-success has-error");
     $('label[id*=hod_task_name-error').html('');
	 $('label[id*=hod_task_description-error').html('');
	 $('label[id*=change_deadline-error').html('');
	 $('label[id*=datetimepicker-error').html('');
	 $('label[id*=send_message_field-error').html('');
	 
	 //assign_task_modal_modal
	 //$('#hod_task_assign_form')[0].reset();
	 //$("input.multiple_select_faculty_task_assign").removeAttr("disabled");
	 //$('label[id*=datetimepicker-error').html('');
     //$(".form-group").removeClass("has-success has-error");
	 
	 });
 
 
 $(document).on('click', '#my_info_button', function(){
	 $('.modal-title').text("My Information");
 });
 $(document).on('click', '#change_password_button', function(){
	 $('.modal-title').text("Change Password");
 });
	 
    
});