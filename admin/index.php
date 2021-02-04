<?php
include '../db.php';
include '../header.php';

session_start();  
 if(!isset($_SESSION["admin_username"]))  
 {  
     header('Location: login-admin.php');
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
                     <a class="dropdown-toggle" data-toggle="dropdown" href="">Admin
                     <span class="caret"></span></a>
                     <ul class="dropdown-menu">
                        <li><a data-toggle="modal" data-target="#info_modal" href="" id="my_info_button">My Info</a></li>
                        <li><a data-toggle="modal" data-target="#admin_change_password_modal" href="" id="change_password_button">Change Password</a></li>
                     </ul>
                  </li>
                  <li><a href="logout_admin.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
               </ul>
            </div>
         </div>
      </nav>
      <!--Navbar Ends-->
      <div class="container">
         <br><br><br><br> 
         <div class="well well-lg">
            <ul class="nav nav-tabs">
               <li class="active"><a data-toggle="tab" href="#hod" id="hod_tab">HoD</a></li>
               <li><a data-toggle="tab" href="#faculty" id = "faculty_tab">Faculty</a></li>
            </ul>
            <div class="tab-content">
               <!--HOD TAB-->
               <div id="hod" class="tab-pane fade in active">
                  <br>
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#hod_modal" id="add_hod_button" data-backdrop="static">+ Add HoD</button>
                  <div id="alert_hod_message"></div>
                  <h3>HoD</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "hod_data">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Username</th>
                              <th>Password</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Number</th>
                              <th>Department</th>
                              <th>Edit</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--HOD TAB ENDS-->
               <!--Faculty TAB-->
               <div id="faculty" class="tab-pane fade">
                  <br>
                  <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#faculty_modal" id="add_faculty_button" data-backdrop="static">+ Add Faculty</button>
				  <div id="alert_faculty_message"></div>
                  <h3>Faculty</h3>
                  <div class="table-responsive">
                     <table class="table table-hover table-bordered" id = "faculty_data">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Username</th>
                              <th>Password</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Number</th>
                              <th>Department</th>
                              <th>Edit</th>
                              <th>Delete</th>
                           </tr>
                        </thead>
                     </table>
                  </div>
               </div>
               <!--Faculty TAB ENDS-->   
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
                  <h4 class="modal-title">Hello Admin</h4>
               </div>
               <div class="modal-body">
			   <?php
			   $query = "SELECT * FROM admin_login_detail WHERE admin_username = '".$_SESSION['admin_username']."'";
			   $result = mysqli_query($connect,$query);
			   $row = mysqli_fetch_assoc($result);
			   echo '
			    <b>Username : </b> '.$_SESSION['admin_username'].'<br><br>
			    <b>Name : </b> '.$row["admin_name"].'<br><br>
			    <b>Email : </b> '.$row["admin_email"].'<br><br>
			    <b>Mobile Number : </b> '.$row["admin_number"].'<br>
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
      <!-- Modal for HOD add-->
      <div class="modal fade" id="hod_modal" role="dialog">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="hod_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div id="hod_username_field" class="form-group col-md-6">
                           <label>Enter Username</label>
                           <input type="text" name="hod_username" id="hod_username" class="form-control" onkeydown="lower_case(this)"/>
                           <p id = "hod_username_availability_message"></p>
                        </div>
                        <div class="form-group col-md-6">
                           <label>Enter New Password</label>
                           <input type="password" name="hod_password" id="hod_password" class="form-control" />
                          
                        </div>
                     </div>
                     <div class= "row">
                        <div class="form-group col-md-6">
                           <label>Enter Name</label>
                           <input type="text" name="hod_name" id="hod_name" class="form-control" />
                        </div>
                        <div id="hod_email_field" class="form-group col-md-6">
                           <label>Enter Email</label>
                           <input type="email" name="hod_email" id="hod_email" class="form-control" onkeydown="lower_case(this)"/>
						   <p id = "hod_email_availability_message"></p>
                        </div>
                     </div>
                     <div class= "row">
                        <div id="hod_number_field" class="form-group col-md-6">
                           <label>Enter Number</label>
                           <input type="text" name="hod_number" id="hod_number" class="form-control" />
						   <p id = "hod_number_availability_message"></p>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="hod_department">Department</label>
                              <select class="form-control" id="hod_department" name="hod_department">
                                 <option value = "it">IT</option>
                                 <option value = "cse">CSE</option>
                                 <option value = "me">ME</option>
                                 <option value = "civil">Civil</option>
                                 <option value = "ece">ECE</option>
                                 <option value="en">EN</option>
                                 <option value = "ei">EI</option>
                                 <option value = "mca">MCA</option>
                                 <option value = "mba">MBA</option>
                                 <option value = "mtech">MTECH</option>
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="hod_id" id="hod_id" />
                     <input type="hidden" name="hod_operation" id="hod_operation" />
                     <input type="submit" name="hod_action" id="hod_action" class="btn btn-success" value="Add" />
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
            </form>
			</div>
            
         </div>
      </div>
      <!--Modal Ends-->
      <!-- Modal for Faculty-->
      <div class="modal fade" id="faculty_modal" role="dialog">
         <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="faculty_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title"></h4>
                  </div>
                    <div class="modal-body">
                     <div class= "row">
                        <div id="faculty_username_field" class="form-group col-md-6">
                           <label>Enter Username</label>
                           <input type="text" name="faculty_username" id="faculty_username" class="form-control" onkeydown="lower_case(this)"/>
                           <p id="faculty_username_availability_message"></p>
                        </div>
                        <div class="form-group col-md-6">
                           <label>Enter New Password</label>
                           <input type="password" name="faculty_password" id="faculty_password" class="form-control" />
                        </div>
                     </div>
                     <div class= "row">
                        <div class="form-group col-md-6">
                           <label>Enter Name</label>
                           <input type="text" name="faculty_name" id="faculty_name" class="form-control" />
                        </div>
                        <div id="faculty_email_field" class="form-group col-md-6">
                           <label>Enter Email</label>
                           <input type="email" name="faculty_email" id="faculty_email" class="form-control" onkeydown="lower_case(this)"/>
						   <p id="faculty_email_availability_message"></p>
                        </div>
                     </div>
                     <div class= "row">
                        <div id="faculty_number_field" class="form-group col-md-6">
                           <label>Enter Number</label>
                           <input type="text" name="faculty_number" id="faculty_number" class="form-control" />
						   <p id="faculty_number_availability_message"></p>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label for="faculty_department">Department</label>
                              <select class="form-control" id="faculty_department" name = "faculty_department">
                                 <?php
								 $query = "SELECT hod_department FROM hod_list";
                                 $result=mysqli_query($connect, $query);
								 while($row = mysqli_fetch_assoc($result)){
									 
									 echo "<option value = ".$row['hod_department'].">".strtoupper($row['hod_department'])."</option>";
								 }
								 ?>
								
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <input type="hidden" name="faculty_id" id="faculty_id" />
                     <input type="hidden" name="faculty_operation" id="faculty_operation" />
                     <input type="submit" name="faculty_action" id="faculty_action" class="btn btn-success" value="Add" />
                     <button type="button" class="btn btn-default modal_close" data-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!--Modal Ends-->
	   <!-- Modal for Change Password-->
      <div class="modal fade" id="admin_change_password_modal" role="dialog">
         <div class="modal-dialog modal-md">
            <!-- Modal content-->
            <div class="modal-content">
               <form method="post" id="admin_change_password_form" enctype="multipart/form-data">
                  <div class="modal-header">
                     <button type="button" class="close modal_close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Change Password</h4>
                  </div>
                  <div class="modal-body">
                     <div class= "row">
                        <div class="form-group col-sm-12">
                           <label>Enter Old Password</label>
                           <input type="password" name="admin_old_change_password" id="admin_old_change_password" class="form-control" />
                        </div>
                        <div class="form-group col-sm-12">
                           <label>Enter New Password</label>
                           <input type="password" name="admin_new_change_password" id="admin_new_change_password" class="form-control" />
                          
                        </div>
						
						<div class="form-group col-sm-12">
                           <label>Confirm Password</label>
                           <input type="password" name="admin_confirm_change_password" id="admin_confirm_change_password" class="form-control" />
                          
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
      <?php
         include '../footer.php';
         ?>
   </body>
</html>

<!--Jquery Ajax Script link-->
<script src = "admin_jquery_ajax.js"></script>
<script>
function lower_case(a){
    setTimeout(function(){
        a.value = a.value.toLowerCase();
    }, 1);
}
</script>
<?php
 mysqli_close($connect);
?>