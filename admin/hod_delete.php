<?php
include '../db.php';
include '../validate_input.php';
if(isset($_POST["hod_id"]))
{
 
 $query = "SELECT hod_username,hod_department FROM hod_list WHERE hod_id = '".vi($_POST['hod_id'])."'";
 $result = mysqli_query($connect, $query);
 $row = mysqli_fetch_array($result);
 $table_name="hod_".$row['hod_department']."_".$row["hod_username"];
 $record_table_name="record_table_hod_".$row['hod_department']."_".$row["hod_username"];
 $hod_department = $row['hod_department'];
 
// mysqli_autocommit($connect,FALSE);
 $query = "DROP TABLE $record_table_name";	
  if(mysqli_query($connect, $query))	{
	 // mysqli_autocommit($connect,FALSE);
  //mysqli_commit($connect);
 // mysqli_rollback($connect);
   $query = "DROP TABLE $table_name";	
    if(mysqli_query($connect, $query)){
		// mysqli_autocommit($connect,FALSE);
		//mysqli_commit($connect);
		//mysqli_rollback($connect);
    $query = "DELETE FROM hod_list WHERE hod_id = '".vi($_POST["hod_id"])."'";
    if(mysqli_query($connect, $query))
    {
		// mysqli_autocommit($connect,FALSE);
	// mysqli_commit($connect);
	// mysqli_rollback($connect);
	
	//Directory Delete
 

        function del($dir)
         {
            $result=array_diff(scandir($dir),array('.','..'));
             foreach($result as $item)
               {
                 if(!@unlink($dir.'/'.$item))
                 del($dir.'/'.$item);
			   }
        rmdir($dir);
         }
		 
		 del('../uploads/'.$hod_department.'_documents');
	 echo 'Data Deleted';
    // Directoy Deleted
	}
    else{
		//mysqli_rollback($connect);
     echo "Error : First Delete all the records related to the particular department";
    }
   }
   else{
	  // mysqli_rollback($connect);
	   echo "Error : First Delete all the records related to the particular department";
   }
}   
else{
  echo "Error : First Delete all the records related to the particular department";
 }
}





 mysqli_close($connect);
?>
