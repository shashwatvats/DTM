<?php
include '../db.php';
include '../header.php';

session_start();  
 if(!isset($_SESSION["faculty_username"]))  
 {  
     header('Location: login-faculty.php');
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
               <!--<ul class="nav navbar-nav">
                  <li class="active"><a>Home</a></li>
               </ul>-->
               <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                     <a class="dropdown-toggle" data-toggle="dropdown" href="">Faculty
                     <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li><a data-toggle="modal" data-target="#info_modal" href="" id="my_info_button">My Info</a></li>
                        <li><a data-toggle="modal" data-target="#faculty_change_password_modal" href="" id="change_password_button">Change Password</a></li>
                     </ul>
                  </li>
                  <li><a href="logout_faculty.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!--Navbar Ends-->
	 <br><br><br><br> 
	 
	   <div class="container">
         <div class="well well-lg">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#task_assign_by_hod" id="task_assign_by_hod_tab">Task Assign By HoD</a></li>
               <li><a data-toggle="tab" href="#task_list" id="task_list_tab">Task List</a></li>
               <li><a data-toggle="tab" href="#receive_message" id = "receive_message_tab">Messages</a></li>
               
            </ul>
            <div class="tab-content">
			
			          <!--TASK ASSIGN BY HOD TAB-->
               <div id="task_assign_by_hod" class="tab-pane fade in active">
                  <br>
				  <div id="alert_task_assign_by_hod_message"></div>
                  <h3>Task List</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "task_assign_by_hod_data">
                        <thead>
                           <tr>
                              <th>Sl.No.</th>
                              <th>Task Name</th>
                              <th>Task Description</th>
                              <th>Type</th>
                              <th>Priority</th>
                              <th>Assigned on</th>
							  <th>Deadline</th>
							  <th>Document</th>
							  <th>Task Assigned To</th>
                              <th>Task Status</th>
                              <th>Assign</th>
                              <th>Report</th>
  
                   
                              
							  
							  
                             <!-- <th>Delete</th>
                              -->
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--TASK ASSIGN BY HOD TAB ENDS-->
			
			
			
               <!--TASK LIST TAB-->
               <div id="task_list" class="tab-pane fade">
                  <br>
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
                              <th>Assigned on</th>
							  <th>Deadline</th>
                              <th>Task Status</th>
                              <th>Updated on</th>
                             <th>Assigned By</th>
                             <th>Document</th>
                              <!-- <th>Delete</th>
                              -->
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--TASK LIST TAB ENDS-->
              
			   <!--SEND MESSAGE TAB-->
               <div id="receive_message" class="tab-pane fade">
                  <br>
               
				  
                  <h3>Messages</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "receive_message_data">
                        <thead>
                           <tr>
                              <th>Sl.No.</th>
                              <th>Message</th>                              
                              <th>Received on</th>
                              <th>Received From</th>
                              
                              
                           </tr>
                        </thead>
					 <tbody id = "receive_message_table_body">
					 </tbody>
                     </table>
                  </div>
               </div>
               <!--SEND MESSAGE TAB ENDS-->   
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
			   $query = "SELECT * FROM faculty_list WHERE faculty_username = '".$_SESSION['faculty_username']."'";
			   $result = mysqli_query($connect,$query);
			   $row = mysqli_fetch_assoc($result);
			   $faculty_department_capital_letter = strtoupper($row["faculty_department"]);
			   echo '
			    <b>Username : </b> '.$_SESSION['faculty_username'].'<br><br>
			    <b>Name : </b> '.$row["faculty_name"].'<br><br>
			    <b>Email : </b> '.$row["faculty_email"].'<br><br>
			    <b>Mobile Number : </b> '.$row["faculty_number"].'<br><br>
			    <b>Department : </b> '.$faculty_department_capital_letter.'<br>
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
	  
	  
	  	  	  	   <!-- Modal for Assign Task-->
      <div class="modal fade" id="faculty_task_assign_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="faculty_task_assign_form" enctype="multipart/form-data" autocomplete = "off">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                       
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
						   $query = "SELECT * FROM faculty_list WHERE faculty_department = '".$_SESSION['faculty_department']."' AND faculty_username != '".$_SESSION['faculty_username']."' ORDER BY faculty_name";
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
					 <input type="hidden" name="faculty_task_id" id="faculty_task_id" />
					 <input type="hidden" name="assign_record_table_id" id="assign_record_table_id" />
					 <input type="hidden" name="assign_hod_task_id" id="assign_hod_task_id" />
                     <input type="hidden" name="faculty_task_assign_operation" id="faculty_task_assign_operation" />
                     <input type="submit" name="faculty_task_assign_action" id="faculty_task_assign_action" class="btn btn-primary pull-left" value="Assign" />
                     <button type="button" name="faculty_task_assign_send_email_button" id="faculty_task_assign_send_email_button" class="btn btn-primary modal_close pull-left" value="send_email">Send Email</button>
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
			</form>
		   </div>
            
         </div>
      </div>
      <!--Assign Task Modal Ends-->
	  
	   <!-- Modal for Report-->
      <div class="modal fade" id="report_modal" role="dialog">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Report</h4>
               </div>
               <div class="modal-body" id="report_modal_body">
                  <!-- Modal body, Content available in hod_task_status.php-->
               </div>
               <div class="modal-footer">
			   
			      <input type="hidden" name="status_record_table_id" id="status_record_table_id" />
                  <input type="hidden" name="status_hod_task_id" id="status_hod_task_id" />
			   
				  <button type="button" name="faculty_task_assign_send_reminder_button" id="faculty_task_assign_send_reminder_button_id" class="faculty_task_assign_send_reminder_button_class btn btn-primary modal_close pull-left" value="send_reminder">Send Reminder</button>
				  
				  <button type="button" name="faculty_task_assign_delete_button" id="faculty_task_assign_delete_button_id" class="faculty_task_assign_delete_button_class btn btn-danger modal_close pull-left" value="delete">Delete</button>
				  
				 
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               </div>
            </div>
         </div>
      </div>
      <!--Modal for report ends-->
	  
	        
	  	   <!-- Modal for Change Password-->
      <div class="modal fade" id="faculty_change_password_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="faculty_change_password_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label>Enter Old Password</label>
                           <input type="password" name="faculty_old_change_password" id="faculty_old_change_password" class="form-control" />
                        </div>
                        <div class="form-group col-sm-12">
                           <label>Enter New Password</label>
                           <input type="password" name="faculty_new_change_password" id="faculty_new_change_password" class="form-control" />
                          
                        </div>
						
						<div class="form-group col-sm-12">
                           <label>Confirm Password</label>
                           <input type="password" name="faculty_confirm_change_password" id="faculty_confirm_change_password" class="form-control" />
                          
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
	  
	  
	  	        <!-- Modal for Task Update-->
      <div class="modal fade" id="faculty_task_status_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="faculty_task_status_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Task Status</h4>
                  </div>
                  <div class="modal-body">
                    
					<div class="radio">
                     <div class= "row">
                         <div class="col-sm-12">
                            <label><input type="radio" name="select_task_status" value = "100" checked>Completed (100%)</label>
                        </div>                       
                     </div>
					 <br>In Progress
					 
					 <div class= "row">
                         <div class="col-md-3">
                           <label><input type="radio" name="select_task_status" value = "80">80%</label>
                        </div> 
						<div class="col-md-3">
                           <label><input type="radio" name="select_task_status" value = "60">60%</label>
                        </div>
						<div class="col-md-3">
                           <label><input type="radio" name="select_task_status" value = "40">40%</label>
                        </div>
						<div class="col-md-3">
                           <label><input type="radio" name="select_task_status" value = "20">20%</label>
                        </div>
                     </div>
                    </div>
                     
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="hod_status_faculty_task_id" id="hod_status_faculty_task_id" />
                     <input type="submit" name="faculty_task_status_action" id="faculty_task_status_action" class="btn btn-success" value="Update" />
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
            </form>
			</div>
            
         </div>
      </div>
      <!--Modal Ends-->
	  
	  <!-- Modal for confirm delete-->
      <div id="deleteModal" class="modal fade">
         <div class="modal-dialog">
            <form method="post" id="delete_form" enctype="multipart/form-data">
               <div class="modal-content">
                  <div class="modal-header">
                     <button type="button" class="close notdelbtn" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title" id="modal_title">Are you sure you want to delete ?</h4>
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
	   
	  <!--Jquery Ajax Script link-->
<script src = "faculty_jquery_ajax.js"></script>
<?php
mysqli_close($connect);
?>