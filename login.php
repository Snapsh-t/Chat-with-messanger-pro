<?php
session_start();   
include("db_connect.php"); 
 
if(isset($_POST['login_button'])) {
	$user_email = trim($_POST['user_email']);
	$user_password = trim($_POST['password']);
	
		
	$usql = "SELECT * FROM Users WHERE Email='$user_email' && Password='$user_password' ";
	$uresult = mysqli_query($db, $usql) or die("database error:". mysqli_error($db));
	$urow = mysqli_fetch_assoc($uresult);	
	
		
	if($urow['Password']==$user_password){				
		
	 setcookie("userid",$user_password,time()+(60*60*24*7));
	 setcookie("useremail",$user_email,time()+(60*60*24*7));
	  
	  $time=time();
	  $queryz = "UPDATE Users Set Online='Online',Time='$time' WHERE Password='$user_password' ";                        
      $db->query($queryz) or die('Errorr, query failed to upload');	
	
	 echo "ok";	 
		
	}  
	else {				
		echo "email or password does not exist."; // wrong details 
	       }		
}


 	
?>