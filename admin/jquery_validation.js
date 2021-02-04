$(function() {
	
	$.validator.addMethod( "mobile", function( value, element ) {
	return this.optional( element ) 
	|| /^-?\d+$/.test( value )
	&& value.length==10;
       }, "Number should be integer and length should be 10" );
	
	$.validator.addMethod( "pwd", function( value, element ) {
	return this.optional( element ) 
	|| value.length>=6
	&& value.length<=200;
       }, "Password must be of at least 6 Characters" );
	   
	$.validator.addMethod( "alphanumeric", function( value, element ) {
	return this.optional( element ) 
	|| /^\w+$/i.test( value )
	&& value.length>=4
	&& value.length<=40;
    }, "Minimum 4 and Maximum 40 Characters and Small letters, numbers, and underscores only please" );
	
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
	
    $("#hod_form").validate({
        rules: {
            
			hod_username: {
                required: true,
				alphanumeric : true
             
            },
			hod_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			hod_name: {
				required:true,
				lettersonly:true
			},
			hod_email: {
                required: true,
                email: true,
				email_2:true
            },
			hod_number: {
				required:true,
				mobile:true
			},
			hod_department: {
				required:true,
				lettersonly:true
			}
			
        },
		messages:{
			hod_email:{
				email:'Not a valid Email'
			},
		}

    });
	
    $("#faculty_form").validate({
        rules: {
            
			faculty_username: {
                required: true,
				alphanumeric : true
             
            },
			faculty_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			faculty_name: {
				required:true,
				lettersonly:true
			},
			faculty_email: {
                required: true,
                email: true
            },
			faculty_number: {
				required:true,
				mobile:true
			},
			faculty_department: {
				required:true,
				lettersonly:true
			}
			
			
			
        },
		messages:{
			faculty_email:{
				email:'Not a valid Email'
			},
		}

    });
	
	$("#admin_change_password_form").validate({
		rules:{
			admin_old_change_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			admin_new_change_password: {
				required:true,
				pwd:true,
				invalid_characters:true
			},
			admin_confirm_change_password: {
				required:true,
				pwd:true,
				equalTo:"#admin_new_change_password",
				invalid_characters:true
			},
		},
		
	});
});