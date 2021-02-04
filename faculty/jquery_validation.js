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
	
	
	errorPlacement: function( label, element ) {
	if( element.attr( "name" ) === "select_task_status" ) {
		element.parent().append( label ); // this would append the label after all your checkboxes/labels (so the error-label will be the last element in <div class="controls"> )
	} else {
		label.insertAfter( element ); // standard behaviour
	}
}
	
	
	
  });

	
	$("#faculty_task_status_form").validate({
		rules:{
			select_task_status: {
				required:true,
				invalid_characters:true,
				alphanumeric : true,
				
			},
			
		},
		
	});
	
		 $("#faculty_reset_password_form").validate({
		rules:{
			faculty_reset_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			faculty_confirm_reset_password: {
				required:true,
				pwd:true,
				equalTo:"#faculty_reset_password",
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
$('.modal_close').click(function(){
	$("input.multiple_select_faculty_task_assign").attr("disabled",true);

});	 
});