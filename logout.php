<?php
	session_start();
include("db_connect.php"); 

	if(isset($_COOKIE['userid']))
	   {
	   	            $passwords=$_COOKIE['userid'];
					$user_email=$_COOKIE['useremail'];
	   	    setcookie("userid",$passwords,time()-(60*60*24*7));
			setcookie("useremail",$user_email,time()-(60*60*24*7));
			$queryz = "UPDATE Users Set Online='Offline' WHERE Password='$passwords' ";                        
        $db->query($queryz) or die('Errorr, query failed');	
							
		    header("Location: index.html");
	   }
	
	
	else{ header("Location: index.html");}
?>