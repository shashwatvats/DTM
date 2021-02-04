<?php
include '../db.php';
include '../header.php';

session_start();  
 if(!isset($_SESSION["hod_username"]))  
 {  
     header('Location: login-hod.php');
 }  

 
 
?>
</head>
<body>
   <script src="jquery_validation.js"></script>    <!--Jquery validation Rules-->
      <!-- Navbar Starts -->
      <nav class="navbar navbar-inverse navbar-fixed-top">
         <div class="container-fluid">
            <div class="navbar-header">
               <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>                        
               </button>
               <a class="navbar-brand">DTM</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="">HoD
                     <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li><a data-toggle="modal" data-target="#info_modal" href="" id="my_info_button">My Info</a></li>
                        <li><a data-toggle="modal" data-target="#hod_change_password_modal" href="" id="change_password_button">Change Password</a></li>
                     </ul>
                  </li>
                  <li><a href="logout_hod.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!--Navbar Ends-->
	 <br><br><br><br> 
	 <div class="container">
		  <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#hod_notification_modal" id="hod_notification_button" data-backdrop="static"><b>Notifications <span class="badge" id ="hod_notification_count"> </span></b></button><br><br><br>
		  </div>
	   <div class="container">
         
         <div class="well well-lg">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#task_list" id="task_list_tab">Task List</a></li>
               <li><a data-toggle="tab" href="#task_assign_list" id = "task_status_tab">Task Status</a></li>
               <li><a data-toggle="tab" href="#send_message" id = "send_message_tab">Messages</a></li>
               <li><a data-toggle="tab" href="#report" id = "report_tab">Report</a></li>
               
            </ul>
            <div class="tab-content">
               <!--TASK LIST TAB-->
               <div id="task_list" class="tab-pane fade in active">
                  <br>
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#add_task_list_modal" id="add_task_list_button" data-backdrop="static">+ Add Task</button>
                  <div id="alert_task_list_message"></div>
                  <h3>Task List</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "task_list_data">
                        <thead>
                           <tr>
                              <th>Sl.No.</th>
                              <th>Task Name</th>
                              <th>Task Description</th>
                              <th>Type</th>
                              <th>Priority</th>
                              <th>Created on</th>
                              <th>Document</th>
							  <th>Assign</th>
                              <th>Update</th>
                              <th>Delete</th>
                              
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--TASK LIST TAB ENDS-->
               <!--TASK STATUS TAB-->
               <div id="task_assign_list" class="tab-pane fade">
                  <br>
                 
				  <div id="alert_task_assign_list_message"></div>
                  <h3>Assign Task</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "task_assign_list_data">
                        <thead>
                           <tr>
                              <th>Date</th>
                              <th>Task Name</th>
                              <th>Task Description</th>
                              <th>Type</th>
                              <th>Priority</th>
                              <th>Deadline</th>
                              <th>Assigned To</th>
                              <th>Document</th>
                              <th>Task Status</th>
                              <th>Change Deadline</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--TASK STATUS TAB ENDS-->   
			   <!--SEND MESSAGE TAB-->
               <div id="send_message" class="tab-pane fade">
                  <br>
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#send_message_modal" id="send_message_button" data-backdrop="static">Send Message</button>
				  <div id="alert_send_message_message"></div>
                  <h3>Messages</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "send_message_data">
                        <thead>
                           <tr>
                              <th>Sl.No.</th>
                              <th>Message</th>
                              <th>Sent to</th>
                              <th>Sent on</th>
                              <th>Delete</th>
                              
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--SEND MESSAGE TAB ENDS-->  
				<div id="report" class="tab-pane fade">
				<br><br>
				<div id="alert_report_message"></div>
				 <form method="post" id="report_form" enctype="multipart/form-data">
				  <div class= "row">
                        <div class="form-group col-sm-12">
                           <label for = "date_timepicker_start">Choose Start Date</label>
                           <input type='text' class="form-control" id="date_timepicker_start" name="date_timepicker_start" placeholder = "Click Here"/>
						</div>
						
				  </div>
				   <div class= "row">
                        <div class="form-group col-sm-12">
                           <label for = "date_timepicker_end">Choose End Date</label>
                           <input type='text' class="form-control" id="date_timepicker_end" name="date_timepicker_end" placeholder = "Click Here"/>
						</div>
						
				  </div>
				  <br>
				    <input type="submit" name="report_submit_button" id="report_submit_button" class="btn btn-primary" value="Submit" />
				 </form>
				 <br><br>
				 
				 
                  <h3>Report</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "report_data">
                        <thead>
                           <tr>
                              <th>Date</th>
                              <th>Task Name</th>
                              <th>Task Description</th>
                              <th>Type</th>
                              <th>Priority</th>
                              <th>Deadline</th>
                              <th>Assigned To</th>
                              <th>Document</th>
                              <th>Task Status</th>
                              <th>Change Deadline</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
				 
				 
				 
				</div>
            </div>
         </div>
      </div>
	  
	  <!-- Modal for information-->
      <div class="modal fade" id="info_modal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"></h4>
               </div>
               <div class="modal-body">
                  <?php
			   $query = "SELECT * FROM hod_list WHERE hod_username = '".$_SESSION['hod_username']."'";
			   $result = mysqli_query($connect,$query);
			   $row = mysqli_fetch_assoc($result);
			   $hod_department_capital_letter = strtoupper($row["hod_department"]);
			   echo '
			    <b>Username : </b> '.$_SESSION['hod_username'].'<br><br>
			    <b>Name : </b> '.$row["hod_name"].'<br><br>
			    <b>Email : </b> '.$row["hod_email"].'<br><br>
			    <b>Mobile Number : </b> '.$row["hod_number"].'<br><br>
			    <b>Department : </b> '.$hod_department_capital_letter.'<br>
			   ';
			   echo mysqli_error($connect);
			   ?>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!--Modal Ends-->
	  
	        <!-- Modal for ADD Task-->
      <div class="modal fade" id="add_task_list_modal" role="dialog">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="add_task_list_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title" id = "task_list_modal_title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label>Enter Task Name</label>
                           <input type="text" name="hod_task_name" id="hod_task_name" class="form-control" />
                          
                        </div>
						
						</div>
						<div class= "row">
                        <div class="form-group col-md-12">
                           <label for="hod_task_description">Enter Task Description</label>
                           <textarea name="hod_task_description" id="hod_task_description" class="form-control" rows="5"></textarea>
                          
                        </div>
						</div>
                     
                     <div class= "row">
                         <div class="col-md-6">
                           <div class="form-group">
                              <label for="hod_task_type">Task Type</label>
                              <select class="form-control" id="hod_task_type" name="hod_task_type">
                                 <option>Recurring</option>
                                 <option>Unique</option>
                                 
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="hod_task_priority">Task Priority</label>
                              <select class="form-control" id="hod_task_priority" name="hod_task_priority">
                                 <option>High</option>
                                 <option>Medium</option>
                                 <option>Low</option>
                                 
                              </select>
                           </div>
                        </div>
                     </div><br>
					 <div class= "row">
					 <div class="col-md-12">
					 <div class="form-group">
					 <label for="hod_image_path">Upload File (Optional)</label><br><br>
					  <input type="file" name="hod_image_path" id="hod_image_path" />
					 </div>
                     </div>
					 </div>
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="hod_task_id" id="hod_task_id" />
                     <input type="hidden" name="hod_task_operation" id="hod_task_operation" />
                     <input type="submit" name="hod_task_action" id="hod_task_action" class="btn btn-success" value="Add" />
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
            
            </form>
			</div>
         </div>
      </div>
      <!--Modal Ends-->
	  	   <!-- Modal for Change Password-->
      <div class="modal fade" id="hod_change_password_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="hod_change_password_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label>Enter Old Password</label>
                           <input type="password" name="hod_old_change_password" id="hod_old_change_password" class="form-control" />
                        </div>
                        <div class="form-group col-sm-12">
                           <label>Enter New Password</label>
                           <input type="password" name="hod_new_change_password" id="hod_new_change_password" class="form-control" />
                          
                        </div>
						
						<div class="form-group col-sm-12">
                           <label>Confirm Password</label>
                           <input type="password" name="hod_confirm_change_password" id="hod_confirm_change_password" class="form-control" />
                          
                        </div>
                     </div>
                                 
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="change_password_id" id="change_password_id" />
                     <input type="hidden" name="change_password_operation" id="change_password_operation" />
                     <input type="submit" name="change_password_action" id="change_password_action" class="btn btn-success" value="Save" />
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
            </form>
			</div>
            
         </div>
      </div>
      <!--Change Password Modal Ends-->
	  
	  	  	   <!-- Modal for Assign Task-->
      <div class="modal fade" id="hod_task_assign_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="hod_task_assign_form" enctype="multipart/form-data" autocomplete = "off">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label for = "datetimepicker">Set Deadline</label>
                           <input type='text' class="form-control" id="datetimepicker" name="datetimepicker" placeholder = "Click Here"/>
						</div>
						<div class="form-group col-sm-12">
						   <!--Displaying faculties-->
						   <label>Select Faculties</label> <br>
						   <div id = "select_all_faculty">
						   <label class="checkbox-inline">
                           <input type="checkbox" value="select_all_faculty_task_assign" id="select_all_faculty_task_assign" name="select_all_faculty_task_assign" checked>Select All
                           </label>
						   </div><br>
						   <div id = "select_multiple_faculty">
						   <?php
						   $query = "SELECT * FROM faculty_list WHERE faculty_department = '".$_SESSION['hod_department']."' ORDER BY faculty_name";
						   $result = mysqli_query($connect, $query);
						   while($row = mysqli_fetch_assoc($result)) {
						   echo '
						   
							<label class="checkbox-inline">
                           <input type="checkbox" class="multiple_select_faculty_task_assign" id="'.$row["faculty_username"].'"  value="'.$row["faculty_username"].'" name="multiple_select_faculty_task_assign[]">'.$row["faculty_name"].' ('.$row["faculty_username"].')
                           </label>
						   
						   ';
						   }
						   //echo mysqli_error($connect);
						   ?>
						   </div>
						   <!--End of displaying faculty-->
                        </div>
                       
                     </div>
                                 
                  </div>
                  <div class="modal-footer">
                     <!--<input type="hidden" name="hod_task_assign_id" id="hod_task_assign_id" />
                     <input type="hidden" name="task_assign_hod_number_of_time_task_assign" id="task_assign_hod_number_of_time_task_assign" />
                     <input type="hidden" name="task_assign_hod_task_id" id="task_assign_hod_task_id" />-->
					 <input type="hidden" name="assign_hod_task_id" id="assign_hod_task_id" />
					 <input type="hidden" name="assign_record_table_id" id="assign_record_table_id" />
                     <input type="hidden" name="hod_task_assign_operation" id="hod_task_assign_operation" />
                     <input type="submit" name="hod_task_assign_action" id="hod_task_assign_action" class="btn btn-primary pull-left" value="Assign" />
                     <button type="button" name="hod_task_assign_send_email_button" id="hod_task_assign_send_email_button" class="btn btn-primary modal_close pull-left" value="send_email">Send Email</button>
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
			</form>
		   </div>
            
         </div>
      </div>
      <!--Assign Task Modal Ends-->
	  

	   <!-- Modal for Task Status-->
      <div class="modal fade" id="hod_task_status_modal" role="dialog">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Task Status</h4>
               </div>
               <div class="modal-body" id="hod_task_status_modal_body">
                  <!-- Modal body, Content available in hod_task_status.php-->
               </div>
               <div class="modal-footer">
			   
			      <input type="hidden" name="status_record_table_id" id="status_record_table_id" />
                  <input type="hidden" name="status_hod_task_id" id="status_hod_task_id" />
			   
				  <button type="button" name="hod_task_assign_send_reminder_button" id="hod_task_assign_send_reminder_button_id" class="hod_task_assign_send_reminder_button_class btn btn-primary modal_close pull-left" value="send_reminder">Send Reminder</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!--Modal for task status ends-->
	  
	  <!-- Modal for Send Message-->
      <div class="modal fade" id="send_message_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="hod_send_message_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Send Message</h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label for = "send_message_field">Send Message</label>
                           <textarea class="form-control" id="send_message_field" name="send_message_field" rows = "4"></textarea>
						</div>
						<div class="form-group col-sm-12">
						   <!--Displaying faculties-->
						   <label>Select Faculties</label> <br>
						   <div id = "select_all_faculty">
						   <label class="checkbox-inline">
                           <input type="checkbox" value="select_all_faculty_send_message" id="select_all_faculty_send_message" name="select_all_faculty_send_message" checked>Select All
                           </label>
						   </div><br>
						   <div id = "select_multiple_faculty">
						   <?php
						   $query = "SELECT * FROM faculty_list WHERE faculty_department = '".$_SESSION['hod_department']."' ORDER BY faculty_name";
						   $result = mysqli_query($connect, $query);
						   while($row = mysqli_fetch_assoc($result)) {
						   echo '
						   
							<label class="checkbox-inline">
                           <input type="checkbox" class="multiple_select_faculty_send_message" value="'.$row["faculty_username"].'" name="multiple_select_faculty_send_message[]">'.$row["faculty_name"].' ('.$row["faculty_username"].')
                           </label>
						   
						   ';
						   }
						   //echo mysqli_error($connect);
						   ?>
						   </div>
						   <!--End of displaying faculty-->
                        </div>
                       
                     </div>
                                 
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="hod_message_id" id="hod_message_id" />
                     <input type="hidden" name="hod_message_sent_to_faculty_id" id="hod_message_sent_to_faculty_id" />
                    
                     <input type="hidden" name="hod_message_operation" id="hod_message_operation" />
                     <input type="submit" name="hod_message_action" id="hod_message_action" class="btn btn-primary pull-left" value="Send Message" />
                     <button type="button" name="hod_message_send_email_button" id="hod_message_send_email_button" class="btn btn-primary modal_close pull-left" value="send_email">Send Email</button>
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
			</form>
		   </div>
            
         </div>
      </div>
      <!--Send Message Modal Ends-->
	  
	  <!-- Modal for Change Deadline-->
      <div class="modal fade" id="hod_task_change_deadline_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="hod_task_change_deadline_form" enctype="multipart/form-data" autocomplete = "off">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label for = "change_deadline">Change Deadline</label>
                           <input type='text' class="form-control" id="change_deadline" name="change_deadline" placeholder = "Click Here"/>
						</div>
                     </div>
                                 
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="change_deadline_record_table_id" id="change_deadline_record_table_id" />
                     <input type="hidden" name="change_deadline_hod_task_id" id="change_deadline_hod_task_id" />
                     <input type="submit" name="change_deadline_action" id="change_deadline_action" class="btn btn-success" value="Change" />
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
            </form>
			</div>
            
         </div>
      </div>
      <!--Change Deadline Modal Ends-->
	  
	    <!-- Modal for Hod Notifications-->
      <div class="modal fade" id="hod_notification_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" id = "hod_notification_modal_close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Notifications</h4>
               </div>
               <div class="modal-body" id="hod_notification_body">
                  
				  <!-- Modal body, Content available in hod_fetch_notification.php-->
               </div>
               <div class="modal-footer">
			 
                  <button type="button" class="btn btn-default" id = "hod_notification_modal_close" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!--Modal for Hod notification ends-->
	  
	  <!-- Modal for confirm delete-->
      <div id="deleteModal" class="modal fade">
         <div class="modal-dialog">
            <form method="post" id="delete_form" enctype="multipart/form-data">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close notdelbtn" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Are you sure you want to delete ?</h4>
                  </div>
                  <div class="modal-body">
				     
                     <input type="submit" name="confirm" id="confirm" class="btn btn-danger" value="Yes" />
                     <button type="button" class="btn btn-default notdelbtn" data-dismiss="modal">No</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!--Modal End-->
	  <br><br><br>
	  <?php
         include '../footer.php';
         ?>
	  
	  </body>
	  </html>
	   <script type="text/javascript">
            
                $('#datetimepicker').datetimepicker({ minDate: new Date() });
                $('#change_deadline').datetimepicker({ minDate: new Date() });
					$('#date_timepicker_start').datetimepicker({
                    format:'Y/m/d',
                    onShow:function( ct ){
                     this.setOptions({
                      maxDate:$('#date_timepicker_end').val()?$('#date_timepicker_end').val():false
                     })
                    },
                    timepicker:false
                 });
                $('#date_timepicker_end').datetimepicker({
                  format:'Y/m/d',
                  onShow:function( ct ){
                   this.setOptions({
                    minDate:$('#date_timepicker_start').val()?$('#date_timepicker_start').val():false
                                   })
                  },
                  timepicker:false
                });
            
        </script>
	  <!--Jquery Ajax Script link-->
<script src = "hod_jquery_ajax.js"></script>

<?php
 mysqli_close($connect);
?>