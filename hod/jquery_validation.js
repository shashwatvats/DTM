$(function() {
	
	$.validator.addMethod( "pwd", function( value, element ) {
	return this.optional( element ) 
	|| value.length>=6;
       }, "Password must be of at least 6 Characters" );
	   
	$.validator.addMethod( "invalid_characters", function( value, element ) {
	return this.optional( element ) || /^[^&<>'"]+$/i.test( value );
    }, "single quots double quots & < > Not Allowed !" );
	
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
  
  $("#hod_change_password_form").validate({
		rules:{
			hod_old_change_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			hod_new_change_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			hod_confirm_change_password: {
				required:true,
				pwd:true,
				equalTo:"#hod_new_change_password",
				invalid_characters:true
			},
		},
		
	});
	
	$("#add_task_list_form").validate({
		rules:{
			hod_task_name: {
				required:true,
				invalid_characters:true
				
			},
			hod_task_description: {
				required:true,
				invalid_characters:true
				
			},
			hod_task_type: {
				required:true
				
			},
			hod_task_priority: {
				required:true
		
			},
			hod_image_path: {
			extension: "jpeg|jpg|png|gif|pdf|docx|doc|xls|xlsx|ppt|pptx|odt|txt"
            }
		},
		messages:{
			hod_image_path: 'Extension not allowed, please choose a JPEG, PNG, GIF, PDF, DOC, XLS, PPT, ODT, TXT File.'
		},
	});
	
	
		$("#hod_send_message_form").validate({
		rules:{
			send_message_field: {
				required:true,
				invalid_characters:true
				
			},
		},
		
	});
	
	
	$("#hod_task_assign_form").validate({
		rules:{
			datetimepicker :{
				required:true,
				date:true
			},
		},
	});
	
		$("#hod_task_change_deadline_form").validate({
		rules:{
			change_deadline :{
				required:true,
				date:true
			},
		},
	});
	
	 $("#hod_reset_password_form").validate({
		rules:{
			hod_reset_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			hod_confirm_reset_password: {
				required:true,
				pwd:true,
				equalTo:"#hod_reset_password",
				invalid_characters:true
			},
		},
		
	});
	
  enable_check_box();
   $("input.multiple_select_faculty_task_assign").attr("disabled",true);
  $("#select_all_faculty_task_assign").click(enable_check_box);
  function enable_check_box() {
  if (this.checked) {
    $("input.multiple_select_faculty_task_assign").attr("disabled",true);
  } else {
    $("input.multiple_select_faculty_task_assign").removeAttr("disabled");
  }
}

  enable_check_box_send_message();
  $("input.multiple_select_faculty_send_message").attr("disabled",true);
  $("#select_all_faculty_send_message").click(enable_check_box_send_message);
  function enable_check_box_send_message() {
  if (this.checked) {
    $("input.multiple_select_faculty_send_message").attr("disabled",true);
  } else {
    $("input.multiple_select_faculty_send_message").removeAttr("disabled");
  }
}

$('.modal_close').click(function(){
	$("input.multiple_select_faculty_task_assign").attr("disabled",true);
	$("input.multiple_select_faculty_send_message").attr("disabled",true);
});		
  
});