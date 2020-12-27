<?php
session_start();
include("db_connect.php");
if(isset($_COOKIE['userid'])){
$userid = $_COOKIE['userid'];
$useremail = $_COOKIE['useremail'];}
          
            
//$timezone = date_default_timezone_get();
//echo "The current server timezone is: " . $timezone;

	                                
if(isset($_POST['valz'])){               
	           $_POST['valz'];
              $sirname = $_POST["valz1"]; //Sirname variable
			   $email = $_POST["valz2"];	//Email variable
			  $password =$_POST["valz4"];	        //password variable
              $institution =$_POST["valz6"];       //institution variable
			  $phone = $_POST["valz7"];      //phone variable
	          $firstname=$_POST["valz"];//Firstname variable
						
	      
		  $sql="SELECT * FROM Users  WHERE Email='$email' && Sirname='$sirname'";
                   $resultn=mysqli_query($db,$sql);                    
                         if($rowcount=mysqli_num_rows($resultn)==0)
                         {
                             	 $sqlp="SELECT * FROM Users WHERE Password='$password' ";
                                 $found=mysqli_query($db,$sqlp);
                               if($rowcount=mysqli_num_rows($found)==0)
                               {
                               	 $enter="INSERT INTO Users (Firstname,Sirname,Email,Password,Institution,Phone) VALUES('$firstname','$sirname','$email','$password','$institution','$phone')";
                                  $db->query($enter);
								  
								   $messaged="Now that your account is set up, you are ready to get started submit your first proposal on www.nhsrc-mw.com<br/>Thanks for signing up! <br/> 
                                         <b>Billy Nyambalo<br/><b>Documentation Officer";			
						 			 $ms="mail";
                      
                                  echo"Now";  
								 // exit;                                 
                               }
                               else
                               {
                      	            echo"pass";
                      	             // exit; 
						       }
                             
                         }
                      else{
                      	     	 	//echo"pamzey"; 
						        //exit;  
					      }                
                     }                
                 else{
          	          //echo"pamzey";
					     //exit;
		             }
	if(isset($_FILES['file2']['name'])&&$_POST['Change'])	{
			 	
	              $id=$_POST['id'];
		          $cat=$_POST['category'];
			     $receiptName = $_FILES['file2']['name'];
                 $receipttmpName = $_FILES['file2']['tmp_name'];
                 $receiptSize = $_FILES['file2']['size'];
                 $receiptType = $_FILES['file2']['type'];
				   $pages=$_POST['page'];
				   
				 if($id=='')
				 {
				       $userid=$_COOKIE['userid'];
                       $useremail=$_COOKIE['useremail'];

                          $sqluser ="SELECT * FROM Users WHERE Password='$userid' && Email='$useremail'";

                          $retrieved = mysqli_query($db,$sqluser);
                          while($found = mysqli_fetch_array($retrieved))
	                     {
                             $id= $found['id'];   
  	                     }
				 }
			
 	 $qued="SELECT * FROM Profilepictures WHERE ids='$id' && Category='$cat' ";
                     $resul=mysqli_query($db,$qued);
                    $checks=mysqli_num_rows($resul);
                     if($checks!=0)
                     {
                     	if( move_uploaded_file ($receipttmpName, 'admin/images/'.$receiptName)){//image is a folder in which you will save documents
                            $queryz = "UPDATE Profilepictures SET name='$receiptName',size='$receiptSize',type='$receiptType',content='$receiptName',Category='$cat' WHERE ids='$id' ";
                                  $db->query($queryz) or die('Errorr, query failed to upload');	
									    //$_SESSION['update']="yes";
										
										    header("Location:user.php");
																		  
						}
						
                     }
                     else{
							  
                             if( move_uploaded_file ($receipttmpName, 'admin/images/'.$receiptName)){//image is a folder in which you will save documents
                                 $queryz = "INSERT INTO Profilepictures (name,size,type,content,Category,ids) ".
                                 "VALUES ('$receiptName','$receiptSize',' $receiptType', '$receiptName','$cat','$id')";                                 
                                     $db->query($queryz) or die('Errorr, query failed to upload');	
									    //$_SESSION['update']="yes";
									
										   header("Location:user.php");
																		     
					
						             }
					   }
			 }

			 
if(isset($_POST['postid'])){
	   
	    $postid=$_POST['postid'];
	if(isset($_POST['replied'])) 
        {$texts=addslashes($_POST['replied']);
      		$text = mysqli_real_escape_string($db,$texts);
		}
		 if(isset($_POST['replied']))
    	     {  
        	      $sql = "SELECT * FROM Users WHERE Password='$userid'";
	               $resultset = mysqli_query($db, $sql) or die("database error:". mysqli_error($db));
	                  while($row = mysqli_fetch_assoc($resultset)){ $fname= $row['Firstname'];}	
	
		                   $time=time();
			              $date=date("d/m/y");
                           $today = date("g:i a");
				          $dbFormat = date('H:i:s', strtotime($today));
				
     	               $query1z = "INSERT INTO Chart (Message,Name,Userid,Time,Date) ".
                    "VALUES ('$text','$fname','$userid','$dbFormat','$date')";
                    $db->query($query1z) or die('Error, query failed');
              
			}
	   
	$get="SELECT * FROM Chart WHERE Group_Name='' ";
						    $gets=mysqli_query($db,$get);						   
                          $entered=mysqli_num_rows($gets);
              if($entered!=0)
              {
              	$time=time();
			  
      while($get_row=mysqli_fetch_array($gets))
      {
      	
		$password=$get_row['Userid'];
      	$nameo=$get_row['Name'];
      	$get_time=$get_row['Time'];
		$get_text=$get_row['Message'];
		$date=$get_row['Date'];
		//$day=$get_row['Today'];
				      
				   $time=strtotime($get_time);
                  $times=date("g:i a",$time);
				  
				           $sqluserk ="SELECT * FROM Users WHERE Password='$password'";
                            $ret = mysqli_query($db,$sqluserk);
                            while($found = mysqli_fetch_array($ret))
	                        {
                                   $idb= $found['id'];
  	                        }
							  
										$sql ="SELECT * FROM Profilepictures WHERE ids='$idb' && Category='User' ";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($foundk = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $foundk['name'];
		                                                            }
												             }
												         else{
												         	     $profile="profile.png";
												            }
						
				   
				      if ($password!=$userid)
		           {
		           	          			
		                echo"<div class='activity-row activity-row1'>
							<div class='col-xs-3 activity-img'>
							
      <a class='example-image-link' href='admin/images/$profile' data-lightbox='example-1'><img src='admin/images/$profile' class='img-responsive' alt=''/></a></div>
							<div class='col-xs-5 activity-img1'>
								<div class='activity-desc-sub'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<span>$date $times</span>
								</div>
							</div>
							<div class='col-xs-4 activity-desc1'></div>
							<div class='clearfix'> </div>
						</div>";
				 
				   }      
				  else{
				  	     echo"
				  	        <div class='activity-row activity-row1'>
							<div class='col-xs-2 activity-desc1'></div>
							<div class='col-xs-7 activity-img2'>
								<div class='activity-desc-sub1'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<p>$date $times</p>
								</div>
							</div>
							<div class='col-xs-3 activity-img'>
							
      <a class='example-image-link' href='admin/images/$profile' data-lightbox='example-1'><img src='admin/images/$profile' class='img-responsive' alt=''/></a></div>
							<div class='clearfix'> </div>
						     </div>";
				  	                           
					 }
                 }
       }
	
}

if(isset($_POST['loadid'])){
	   
	    $postid=$_POST['loadid'];
	
		
	   
	$get="SELECT * FROM Chart WHERE Group_Name='' ";
						    $gets=mysqli_query($db,$get);						   
                          $entered=mysqli_num_rows($gets);
              if($entered!=0)
              {
              	$time=time();
			  
      while($get_row=mysqli_fetch_array($gets))
      {
      	
		$password=$get_row['Userid'];
      	$nameo=$get_row['Name'];
      	$get_time=$get_row['Time'];
		$get_text=$get_row['Message'];
		$date=$get_row['Date'];
		 
		 $time=strtotime($get_time);
                  $times=date("g:i a",$time);
				  
		
				
				   
				           $sqluserk ="SELECT * FROM Users WHERE Password='$password'";
                            $ret = mysqli_query($db,$sqluserk);
                            while($found = mysqli_fetch_array($ret))
	                        {
                                   $idb= $found['id'];
  	                        }
							  
										$sql ="SELECT * FROM Profilepictures WHERE ids='$idb' && Category='User' ";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($foundk = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $foundk['name'];
		                                                            }
												             }
												         else{
												         	     $profile="profile.png";
												            }
						
				   
				      if ($password!=$userid)
		           {
		           	          			
		                echo"<div class='activity-row activity-row1'>
							<div class='col-xs-3 activity-img'>
							
      <a class='example-image-link' href='admin/images/$profile' data-lightbox='example-1'><img src='admin/images/$profile' class='img-responsive' alt=''/></a></div>
							<div class='col-xs-5 activity-img1'>
								<div class='activity-desc-sub'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<span>$date $times</span>
								</div>
							</div>
							<div class='col-xs-4 activity-desc1'></div>
							<div class='clearfix'> </div>
						</div>";
				 
				   }      
				  else{
				  	     echo"
				  	        <div class='activity-row activity-row1'>
							<div class='col-xs-2 activity-desc1'></div>
							<div class='col-xs-7 activity-img2'>
								<div class='activity-desc-sub1'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<p>$date $times</p>
								</div>
							</div>
							
      <a class='example-image-link' href='admin/images/$profile' data-lightbox='example-1'><div class='col-xs-3 activity-img'><img src='admin/images/$profile' class='img-responsive' alt=''/></a></div>
							<div class='clearfix'> </div>
						     </div>";
				  	                           
					 }
                 }
       }
}
 if(isset($_POST['gnamed'])){               
	           $gname=$_POST['gnamed'];
              			
	      
		  $sql="SELECT * FROM Groups  WHERE GName='$gname'";
                   $resultn=mysqli_query($db,$sql);                    
                         if($rowcount=mysqli_num_rows($resultn)==0)
                         {
                             	 $date=date("d/m/y");
                               	 $enter="INSERT INTO Groups (GName,Userid,Members,Date) VALUES('$gname','$userid','1','$date')";
                                  $db->query($enter);								                                 
							  
						 } 
                      
                    $sqlL="SELECT * FROM Groups ORDER BY id DESC";
                   $resultnL=mysqli_query($db,$sqlL);                    
                         if($rowcount=mysqli_num_rows($resultnL)!=0)
                         {
                                        echo"<h3>GROUPS</h3>
					                   <div class='scrollbar' id='style-3'>
						               <div class='activity-row activity-row1'>
							              <div class='single-bottom'>";				
		                                                
                             while($foundk = mysqli_fetch_array($resultnL))
	                               {
                                     $grname= $foundk['GName'];$crid= $foundk['Userid'];
		                             $members= $foundk['Date'];$id= $foundk['id'];
		                                                   $sql ="SELECT * FROM Profilepictures WHERE ids='$id' && Category='Group' ";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($foundk = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $foundk['name'];
		                                                            }
												             }
												         else{
												         	     $profile="groups.png";
												            }
		                             echo"<div class='activity-row'>
							               <div class='col-xs-3 activity-img'>
							               
							               <a data-toggle='modal' data-id='$id' href='#Updatepictures' class='open-Updatepictures'><img src='admin/images/$profile' height='50px' width='50px' alt=''></a></div>
							                <div class='col-xs-7 activity-desc'>
								            <h5><a href='#'>$grname</a></h5>
								              <p>Created on:$members</p>
							               </div>";
							               if($crid==$userid){
							              echo"<div class='col-xs-2 activity-desc1'>
			                                       <a data-id='$id' href='#' class='open-Delete'  ><span class='glyphicon glyphicon-trash' style='color:red;font-size:15px'></span></a>
							              </div>";}
							               echo"<div class='clearfix'> </div>
						             </div>";
		                           }
								   echo"</div>
						</div>
					</div>
					<form id='groupsz' method='post' >
						  <input type='text' value=''  id='gname' placeholder='Create group'/>
                          <input type='hidden' value='<?php echo$id; ?>'  id='userid' />						  
       	                  <a type='button' id='btnGroup' class='btn btn-primary' style='color:white;'><i class='fa fa-users'></i></a>
				   </form>";
                      
                         }
                               
 }
if(isset($_POST['loadgroup'])){     
		 
                      
                    $sqlL="SELECT * FROM Groups ORDER BY id DESC";
                   $resultnL=mysqli_query($db,$sqlL);                    
                         if($rowcount=mysqli_num_rows($resultnL)!=0)
                         {
                                     echo"<h3>GROUPS</h3>
					                   <div class='scrollbar' id='style-3'>
						               <div class='activity-row activity-row1'>
							              <div class='single-bottom'>";				
		                            
                             while($foundk = mysqli_fetch_array($resultnL))
	                               {
                                     $grname= $foundk['GName'];$crid= $foundk['Userid'];
		                             $members= $foundk['Date'];$id= $foundk['id'];
									             
									             $sql ="SELECT * FROM Profilepictures WHERE ids='$id' && Category='Group' ";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($foundk = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $foundk['name'];
		                                                            }
												             }
												         else{
												         	     $profile="groups.png";
												            }
						
									 
		                             echo"
		                                   <div class='activity-row'>
							               <div class='col-xs-3 activity-img'>
							               <a data-toggle='modal' data-id='$id' href='#Updatepictures' class='open-Updatepictures'><img src='admin/images/$profile' height='50px' width='50px' alt=''></a></div>
							                <div class='col-xs-7 activity-desc'>
								            <h5><a data-id='$grname' class='open-group' href='#'>$grname</a></h5>
								              <p>Created on:$members</p>
							               </div>";
							               if($crid==$userid){
							              echo"<div class='col-xs-2 activity-desc1'>
			                                       <a data-id='$id' href='#' class='open-Delete'  ><span class='glyphicon glyphicon-trash' style='color:red;font-size:15px'></span></a>
							              </div>";}
							              echo" <div class='clearfix'> </div>
						             </div>
						             ";
		                           }
                                        echo"</div>
						</div>
					</div>
					<form id='groupsz' method='post' >
						  <input type='text' value=''  id='gname' placeholder='Create group'/>
       	                  <a data-id='$userid' class='open-btnGroup btn  btn-primary' style='color:white;'><i class='fa fa-users'></i></a>
        
				   </form>";
                         }
                               
 }
if(isset($_POST['Valuedel'])){     
		 
                        $idsz=$_POST['Valuedel'];
						$sql="SELECT * FROM Groups  WHERE id='$idsz'";
                   $resultn=mysqli_query($db,$sql);                    
                         if($rowcount=mysqli_num_rows($resultn)!=0)
                         {
                             	 $enters="DELETE FROM Groups WHERE id='$idsz'";
                                 $db->query($enters);
                                      echo"ok";
						 }
				   
                               
 }
 if(isset($_POST['groups'])){
	   
	    $groupname=$_POST['groups'];
	
		
	   
	$get="SELECT * FROM Chart WHERE Group_Name='$groupname' ";
						    $gets=mysqli_query($db,$get);						   
                          $entered=mysqli_num_rows($gets);
                          
                          echo"<h3>GROUPS($groupname)<a href='#' style='float: right;color:white' class='open-exit'><span class='glyphicon glyphicon-log-out' style='color: white'></span>&nbsp;Exit</a>			                          </h3>
	             <div class='scrollbar' id='style-3'>
	             <div class='activity-row activity-row1'>
	             <div class='single-bottom'>";				
		
              if($entered!=0)
              {
              	$time=time();
			                           
      while($get_row=mysqli_fetch_array($gets))
      {
      	
		$password=$get_row['Userid'];
      	$nameo=$get_row['Name'];
      	$get_time=$get_row['Time'];
		$get_text=$get_row['Message'];
		$date=$get_row['Date'];
		 
		 $time=strtotime($get_time);
                  $times=date("g:i a",$time);
				  
		
				
				   
				           $sqluserk ="SELECT * FROM Users WHERE Password='$password'";
                            $ret = mysqli_query($db,$sqluserk);
                            while($found = mysqli_fetch_array($ret))
	                        {
                                   $idb= $found['id'];
  	                        }
							  
										$sql ="SELECT * FROM Profilepictures WHERE ids='$idb' && Category='User' ";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($foundk = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $foundk['name'];
		                                                            }
												             }
												         else{
												         	     $profile="profile.png";
												            }
						
				   
				      if ($password!=$userid)
		           {
		           	          			
		                echo"<div class='activity-row activity-row1'>
							<div class='col-xs-3 activity-img'><img src='admin/images/$profile' class='img-responsive' alt=''/></div>
							<div class='col-xs-5 activity-img1'>
								<div class='activity-desc-sub'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<span>$date $times</span>
								</div>
							</div>
							<div class='col-xs-4 activity-desc1'></div>
							<div class='clearfix'> </div>
						</div>";
				 
				   }      
				  else{
				  	     echo"
				  	        <div class='activity-row activity-row1'>
							<div class='col-xs-2 activity-desc1'></div>
							<div class='col-xs-7 activity-img2'>
								<div class='activity-desc-sub1'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<p>$date $times</p>
								</div>
							</div>
							<div class='col-xs-3 activity-img'><img src='admin/images/$profile' class='img-responsive' alt=''/></div>
							<div class='clearfix'> </div>
						     </div>";
				  	                           
					 }
                 }
                
       }
        echo"</div>
						</div>
					</div>					
				   <form id='groupsz' method='post' >
						  <input type='text' value=''  id='txtpost' placeholder='Post your message..'/>
       	                  <a data-id='$userid' data-ib='$groupname' class='open-btnPost btn  btn-success' style='color:white;'><i class='fa fa-send'></i></a>
        
				   </form>";
}
if(isset($_POST['txtpost'])){
	   
	    $postid=$_POST['txtpost'];
	    $postgroup=$_POST['gname'];
	    
	if(isset($_POST['txtpost'])) 
        {
        	  $texts=addslashes($_POST['txtpost']);
      		   $text = mysqli_real_escape_string($db,$texts);
		  
        	      $sql = "SELECT * FROM Users WHERE Password='$userid'";
	               $resultset = mysqli_query($db, $sql) or die("database error:". mysqli_error($db));
	                  while($row = mysqli_fetch_assoc($resultset)){ $fname= $row['Firstname'];}	
	
		                   $time=time();
			              $date=date("d/m/y");
                           $today = date("g:i a");
				          $dbFormat = date('H:i:s', strtotime($today));
				
     	               $query1z = "INSERT INTO Chart (Message,Name,Userid,Time,Date,Group_Name) ".
                    "VALUES ('$text','$fname','$userid','$dbFormat','$date','$postgroup')";
                    $db->query($query1z) or die('Error, query failed');
              
			}
	   
	$get="SELECT * FROM Chart WHERE Group_Name='$postgroup' ";
						    $gets=mysqli_query($db,$get);						   
                          $entered=mysqli_num_rows($gets);
                         
						  echo"<h3>GROUPS($postgroup)<a href='#' style='float: right;color:white' class='open-exit'><span class='glyphicon glyphicon-log-out' style='color: white'></span>&nbsp;Exit</a>			                          </h3>
	             <div class='scrollbar' id='style-3'>
	             <div class='activity-row activity-row1'>
	             <div class='single-bottom'>";				
		
              if($entered!=0)
              {
              	$time=time();
			  
      while($get_row=mysqli_fetch_array($gets))
      {
      	
		$password=$get_row['Userid'];
      	$nameo=$get_row['Name'];
      	$get_time=$get_row['Time'];
		$get_text=$get_row['Message'];
		$date=$get_row['Date'];
		//$day=$get_row['Today'];
				      
				   $time=strtotime($get_time);
                  $times=date("g:i a",$time);
				  
				           $sqluserk ="SELECT * FROM Users WHERE Password='$password'";
                            $ret = mysqli_query($db,$sqluserk);
                            while($found = mysqli_fetch_array($ret))
	                        {
                                   $idb= $found['id'];
  	                        }
							  
										$sql ="SELECT * FROM Profilepictures WHERE ids='$idb' && Category='Administrator' ";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($foundk = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $foundk['name'];
		                                                            }
												             }
												         else{
												         	     $profile="profile.png";
												            }
						
				   
				      if ($password!=$userid)
		           {
		           	          			
		                echo"<div class='activity-row activity-row1'>
							<div class='col-xs-3 activity-img'><img src='admin/images/$profile' class='img-responsive' alt=''/></div>
							<div class='col-xs-5 activity-img1'>
								<div class='activity-desc-sub'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<span>$date $times</span>
								</div>
							</div>
							<div class='col-xs-4 activity-desc1'></div>
							<div class='clearfix'> </div>
						</div>";
				 
				   }      
				  else{
				  	     echo"
				  	        <div class='activity-row activity-row1'>
							<div class='col-xs-2 activity-desc1'></div>
							<div class='col-xs-7 activity-img2'>
								<div class='activity-desc-sub1'>
									<h5>$nameo</h5>
									<p>$get_text</p>
									<p>$date $times</p>
								</div>
							</div>
							<div class='col-xs-3 activity-img'><img src='admin/images/$profile' class='img-responsive' alt=''/></div>
							<div class='clearfix'> </div>
						     </div>";
				  	                           
					 }
                 }
       }
       echo"</div>
						</div>
					</div>					
				   <form id='groupsz' method='post' >
						  <input type='text' value=''  id='txtpost' placeholder='Post your message..'/>
       	                  <a data-id='$userid' data-ib='$postgroup' class='open-btnPost btn  btn-success' style='color:white;'><i class='fa fa-send'></i></a>
        
				   </form>";
       
	
} 
?>