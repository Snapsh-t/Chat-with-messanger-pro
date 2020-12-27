<?php
ob_start();

 $db = new mysqli("localhost","root","");
   if($db->connect_errno > 0){
         die('Unable to connect to database [' . $db->connect_error . ']');  } 
     
	 $db->query("CREATE DATABASE IF NOT EXISTS `phpchart`");
	 
             mysqli_select_db($db,"phpchart"); 	  
								  
                     
						$stable56="CREATE TABLE IF NOT EXISTS Users (id int(11) NOT NULL auto_increment,
                                  Firstname varchar(300)NOT NULL, 
                                  Sirname varchar(300)NOT NULL,
                                  Mtitle Varchar(30)NOT NULL,                                 
                                  Phone varchar(30)NOT NULL,                                 
                                  Institution varchar(300)NOT NULL,
                                  Email varchar(300)NOT NULL,
                                  Password varchar(300)NOT NULL,
                                  Online varchar(300)NOT NULL,
                                  Time bigint(30)NOT NULL,                         
                                  PRIMARY KEY(id) )";
                         $db->query($stable56);  
                    
		                      $stableZ="CREATE TABLE IF NOT EXISTS Profilepictures (id int(11) NOT NULL auto_increment,
                 ids varchar(30)NOT NULL,Category varchar(30)NOT NULL,name varchar(1000)NOT NULL,type varchar(30)NOT NULL,
                 Size decimal(10)NOT NULL,content longblob NOT NULL,
                 PRIMARY KEY(id) )";
               $db->query($stableZ);
                  					   	   
                     $forum="CREATE TABLE IF NOT EXISTS Chart (id int(11) NOT NULL auto_increment,
                                  Userid varchar(30)NOT NULL,Name varchar(30)NOT NULL,Message text(1000)NOT NULL,
                                  Date varchar(15)NOT NULL,Time Time,Group_Name varchar(30)NOT NULL,
                                  PRIMARY KEY(id) )";
								    $db->query($forum);			                                             
               
         	           $forum="CREATE TABLE IF NOT EXISTS Groups (id int(11) NOT NULL auto_increment,
                                  Userid varchar(30)NOT NULL,GName varchar(30)NOT NULL,Members text(1000)NOT NULL,
                                  Date varchar(15)NOT NULL,
                                  PRIMARY KEY(id) )";
								    $db->query($forum);			                                             
                	  
						 		
			 
					$sql="SELECT * FROM Users ";
                   $result=mysqli_query($db,$sql);
                    $rowcount=mysqli_num_rows($result);
                       if($rowcount==0)
                         {                                 $time=time();
                              $enter="INSERT INTO Users (Password,Email,Firstname,Sirname,Institution,Phone,Time) VALUES('1234554321','mvumapatrick@gmail.com','Patrick','Mvuma','MOH','265999107724','$time')";
                              $db->query($enter);
							  $queryz = "INSERT INTO Profilepictures (name,size,type,content,Category,ids) ".
                                 "VALUES ('IMG_0458.JPG','194348','image/jpeg', 'IMG_0458.JPG','User','1')";                                 
                                     $db->query($queryz) or die('Errorr, query failed to upload');	
                                                        $date=date("d/m/y");
                                                         $today = date("g:i a");
				                                       $dbFormat = date('H:i:s', strtotime($today));
				
                                     $query1zk = "INSERT INTO Chart (Message,Name,Userid,Time,Date) ".
                                         "VALUES ('What do you think about javascrpt and php after seeing this demo?','Patrick','1234554321','$dbFormat','$date')";
                                       $db->query($query1zk) or die('Error, query failed');
           
								         
                               	 $entern="INSERT INTO Groups (GName,Userid,Members,Date) VALUES('Malawi','1234554321','1','$date')";
                                  $db->query($entern);
								  
								  $querydy = "INSERT INTO Profilepictures (name,size,type,content,Category,ids) ".
                                 "VALUES ('339264-Berserker.jpg','110920','image/jpeg', '339264-Berserker.jpg','Group','1')";                                 
                                     $db->query($querydy) or die('Errorr, query failed to upload');	
                             								                                 
							            $query1zv = "INSERT INTO Chart (Message,Name,Userid,Time,Date,Group_Name) ".
                                                    "VALUES ('Malawi is the warm heart of africa with beautiful lake and mountains','Patrick','1234554321','$dbFormat','$date','Malawi')";
                                                 $db->query($query1zv) or die('Error, query failed');
              
                         }
?>