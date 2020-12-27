<?php 
session_start();
include("db_connect.php");
 
if(isset($_COOKIE['userid'])&&$_COOKIE['useremail']){
$adminid = $_COOKIE['userid'];
$adminemail = $_COOKIE['useremail'];

$sqluser ="SELECT * FROM Users WHERE Password='$adminid' && Email='$adminemail'";

$retrieved = mysqli_query($db,$sqluser);
    while($found = mysqli_fetch_array($retrieved))
	     {
              $firstname = $found['Firstname'];
		      $sirname= $found['Sirname'];
              $id= $found['id'];
		 }	   
 }

?>
<!DOCTYPE HTML>
<html>
<head>
<title>Chat System</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="admin/css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="admin/css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="admin/css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='admin/css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->
 
 <!-- js-->
<script src="admin/js/jquery-1.11.1.min.js"></script>
<script src="admin/js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 



<!-- Metis Menu -->
<script src="admin/js/metisMenu.min.js"></script>
<script src="admin/js/custom.js"></script>
<link href="admin/css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
 <script src="script/sweetalert.min.js"></script>
<link rel="stylesheet" type="text/css" href="script/sweetalert.css">
   <link rel="stylesheet" href="dist/css/lightbox.min.css"></head>
		  <script src="dist/js/lightbox-plus-jquery.min.js"></script>

<style>
#chartdiv {
  width: 100%;
  height: 295px;
}
</style>

<script type="text/javascript">
$(function() {


  $('#btnSave').click(function() {
  	
  	var myReply = document.getElementById("txt").value;
    var value =document.getElementById("vid").value;
        $.ajax ({
                 type :'POST',
                  url: "register.php",
                 data: {postid:value,replied:myReply},
               success: function(result) {               
                                            $("#errors1").html(result);
                                          }
               });
      $("#txt").val("");
      
                 });
                  
  });
  


 	$(document).ready(function(){
 		
 		var optionValue='chart';
 		 $.ajax({
 		 	    type :'POST',
                  url: "register.php",
                 data: {loadid:optionValue},
               success: function(result) {               
                                            $("#errors1").html(result);
                                          }
                });  
         });
         
         
         $(document).ready(function(){
 		
 		var optionValue='group';
 		 $.ajax({
 		 	    type :'POST',
                  url: "register.php",
                 data: {loadgroup:optionValue},
               success: function(result) {               
                                            $("#groupshow").html(result);
                                          }
                });  
         }); 
         
</script>

<script type="text/javascript"> 
            $(document).on("click", ".open-Delete", function () {
                                  var myValue = $(this).data('id');
                                        swal({
                                         title: "Are you sure?",
                                         text: "You want to delete this group",
                                         type: "warning",
                                         showCancelButton: true,
                                        cancelButtonColor: "red",
                                        confirmButtonColor: "green",
                                        confirmButtonText: "Yes, remove!",
                                         cancelButtonText: "No, cancel!",
                                        closeOnConfirm: false,
                                        closeOnCancel: false,
                                          buttonsStyling: false
                                        },
                     function(isConfirm){
                                      if (isConfirm) {                                      	
                                                  	var vals=myValue;
                                               $.ajax ({
                                                      type : 'POST',
                                                      url: "register.php",
                                                      data: { Valuedel: vals},
                                                      success: function(result) {
                                                      if(result=="ok"){
                                                                    swal({title: "Deleted!", text: "Group has been deleted.", type: "success"},
                                                          function(){ 
                                                                          var optionValue='group';
 		                                                                 $.ajax({
 		 	                                                                      type :'POST',
                                                                                    url: "register.php",
                                                                                   data: {loadgroup:optionValue},
                                                                                success: function(result) {               
                                                                                                            $("#groupshow").html(result);
                                                                                                          }
                                                                                }); 
                                                                    }
                                                                      );                               	                        
                                                                 }

                                                       }
                                                  }); } else {
	                                                           swal("Cancelled", "Your group is safe :)", "error");
                                                          }
                                         });
                                       
                                       });
                </script>

<script type="text/javascript">
 $(document).on("click", ".open-Updatepicture", function () {
     var myTitle = $(this).data('id');
     $(".modal-body #bookId").val(myTitle);
     
}); 
 </script>
 
 <script type="text/javascript">
 $(document).on("click", ".open-Updatepictures", function () {
     var myTitle = $(this).data('id');
     $(".modal-body #bookId").val(myTitle);
     
}); 
 </script>

<script type="text/javascript">
 $(document).on("click", ".open-group", function () {
    
    var mygroupname = $(this).data('id');

     		 $.ajax({
 		 	    type :'POST',
                  url: "register.php",
                 data: {groups:mygroupname},
               success: function(result) {               
                                            $("#groupshow").html(result);
                                          }
                });  
}); 
 </script>
 
 <script type="text/javascript">
 $(document).on("click", ".open-exit", function () {
       var optionValue='group';
 		 $.ajax({
 		 	    type :'POST',
                  url: "register.php",
                 data: {loadgroup:optionValue},
               success: function(result) {               
                                            $("#groupshow").html(result);
                                          }
                });    
}); 
 </script>
 
 <script type="text/javascript"> 
            $(document).on("click", ".open-btnGroup", function () {
                                  var userid = $(this).data('id');
                               var mygroup = document.getElementById("gname").value;
                                    $.ajax ({
                                              type :'POST',
                                                url: "register.php",
                                               data: {username:userid,gnamed:mygroup},
                           success: function(result) {               
                                                        $("#groupshow").html(result);
                                                       }
                                             });
           
                                       });
                </script>
                <script type="text/javascript"> 
            $(document).on("click", ".open-btnPost", function () {
                                  var userid = $(this).data('id');
                                   var groupn = $(this).data('ib');
                               var mygroup = document.getElementById("txtpost").value;
                                    $.ajax ({
                                              type :'POST',
                                                url: "register.php",
                                               data: {username:userid,txtpost:mygroup,gname:groupn},
                           success: function(result) {               
                                                        $("#groupshow").html(result);
                                                       }
                                             });
           
                                       });
                </script>

 
                       
	</head> 

<div id="Updatepicture" class="modal fade" role="dialog">
  <div class="modal-dialog" style="float:right;width:20%">
    <!-- Modal content-->
    <div class="modal-content" style="font-size: 14px; font-family: Times New Roman;color:black;">
      <div class="modal-header" style="background-color:#00a78e;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Profile        	        	
        	</h4>
      </div>
      <div class="modal-body" >
        <center><p></p>
        	<form method="post" action="register.php" enctype='multipart/form-data'>        		
            
        	<p style="margin-bottom:10px;">
        			Select picture<input name='file2' type='file' id='file2' >
           </p>  
           <p>
        	<input name='id' type='hidden' value='' id='bookId'>
        	<input name='category' type='hidden' value='User'>

           </p>     	      		
	                
        </center>
      </div>
      <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Change" id="btns1" name="Change"> &nbsp;
                  
      </div>
      </div>
       </form>
  </div>
  </div>
 
 <div id="Updatepictures" class="modal fade" role="dialog">
  <div class="modal-dialog" style="float:right;width:15%">
    <!-- Modal content-->
    <div class="modal-content" style="font-size: 14px; font-family: Times New Roman;color:black;">
      <div class="modal-header"  style="background-color:#0091cd">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change group icon        	        	
        	</h4>
      </div>
      <div class="modal-body" >
        <center><p></p>
        	<form method="post" action="register.php" enctype='multipart/form-data'>        		
            
        	<p style="margin-bottom:10px;">
        			Select picture<input name='file2' type='file' id='file2' >
           </p>  
           <p>
        	<input name='id' type='hidden' value='' id='bookId'>
        	<input name='category' type='hidden' value='Group'>

           </p>     	      		
	                
        </center>
      </div>
      <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Change" id="btns1" name="Change"> &nbsp;
                  
      </div>
      </div>
       </form>
  </div>
  </div>

<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
       </button>
             						
         
            <h1>
            	<a class="navbar-brand" href="index.html"><span class="fa fa-clock">
            		
            	</span>&nbsp;<span class="dashboard_text"></span>
            	</a>
           </h1>
                    </div>
        
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="header">
              	 <h4>PHP CHAT SYSTEM</h4>
              </li> 
              <li class="treeview">
                <a href="#">
                <i class="fa fa-bars"></i>
                <span>CHAT FUNCTIONS</span>
                </a>
               <li class="treeview"> 
               	  <a href="#">             
                
                <span>1.Create a group</span> 
                </a>     
              </li> 
              <li class="treeview"> 
              	  <a href="#">             
                
                <span>2.Change group icon</span>
                </a>      
              </li> 
              
              <li class="treeview"> 
              	  <a href="#">             
             
                <span>3.Delete group</span>
                </a>      
              </li> 
              <li class="treeview">   
              	  <a href="#">           
           
                <span>4.Clickable group name(Open)</span>
                </a>      
              </li>           
                <li class="treeview">
                	  <a href="#">              
               
                <span>5.Post in a group</span>
                </a>      
              </li>
              <li class="treeview">
                	  <a href="#">              
               
                <span>5.View Full Image</span>
                </a>      
              </li>
              <li class="treeview">
                	  <a href="#">              
               
                <span>6.Click User Image</span>
                </a>      
              </li>
              <li class="treeview">
                	  <a href="#">              
               
                <span>7.Change Profile pic</span>
                </a>      
              </li>
              <li class="treeview">
                	  <a href="#">              
               
                <span>6.View active users</span>
                </a>      
              </li>
              <li class="treeview">
                	  <a href="#">              
               
                <span>8.Only allowed to del ur group</span>
                </a>      
              </li>
              </li>           
                          
                </ul>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section">
			
			<div class="header-right">
				
				
				<!--search-box-->
				<!--//end-search-box-->
				
				<div class="profile_details" >		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img">
										<?php   
										$sql ="SELECT * FROM Profilepictures WHERE ids='$id' && Category='User'";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($found = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $found['name'];
		                                                            }
																	echo"<img src='admin/images/$profile' height='50px' width='50px' alt=''>";	   
												             }
												        else{
												           	echo"<img src='admin/images/profile.png' height='50px' width='50px' alt=''>";	   
														     	
												             }
										
										?>
										 </span> 
									<div class="user-name" >
										<p style="color:#1D809F;"><?php if(isset($sirname))
                                            {echo"<strong>".$firstname." ".$sirname."! </strong>";} ?>
				                         </p>
										<span>Online&nbsp;<img src='admin/images/dot.png' height='15px' width='15px' alt=''>
										</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								 <li>
                                  <a data-toggle='modal' data-id='<?php echo$id; ?>' href='#Updatepicture' class='open-Updatepicture'><i class="fa fa-user"></i>Change profile picture</a>
                                 </li>
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper"  >
			<div class="main-page" >
			<div class="col_1">
			<div class="col-md-4 span_8">
				<div class="activity_box">
					<h2>USERS</h2>
					<div class="scrollbar" id="style-1">
					<?php   $sqlmember ="SELECT * FROM Users WHERE id!='$id'";
			       $retrieve = mysqli_query($db,$sqlmember);
				                    $count=0;
                     while($found = mysqli_fetch_array($retrieve))
	                 {
                       $title=$found['Mtitle'];$firstname=$found['Firstname'];$sirname=$found['Sirname'];$phone=$found['Phone'];$ids=$found['id'];$online=$found['Online'];
			                $count=$count+1;  $get_time=$found['Time']; $time=time(); $pass=$found['Password'];
			           if($online=='Online'){
						                    $dis="<img src='admin/images/dot.png' height='15px' width='15px' alt=''>";
                                           }else
                                           {
                                             $dis="<img src='admin/images/dotoffline.png' height='15px' width='15px' alt=''>";											
                                           }
				       $sql ="SELECT * FROM Profilepictures WHERE ids='$ids' && Category='User'";
                                                $rget = mysqli_query($db,$sql);
												$num=mysqli_num_rows($rget);
                                                if($num!=0){
												                   while($found = mysqli_fetch_array($rget))
	                                                                {
                                                                       $profile= $found['name'];
		                                                            }
																	$pic="<img src='admin/images/$profile' height='50px' width='50px' alt=''>";	   
												             }
												        else{
												           	$pic="<img src='admin/images/profile.png' height='50px' width='50px' alt=''>";	   
														     	   $profile='profile.png';
												             }
									
				                  $diff= $time-$get_time;		
		    switch(1)
		           {
				case ($diff < 60):       //calculate seconds
					$count=$diff;
				  if($count==0)
					$count="a moment";
				elseif($count==1)
				    $suffix="second";
				else
					$suffix="seconds";
				break;
				
				case ($diff > 60 && $diff < 3600): //calculate minutes
					$count=floor($diff/60);
				  if($count==1)
					$suffix="minute";
				else
				    $suffix="minutes";
				break;
				
				case ($diff > 3600 && $diff < 86400):   //calculate hours
					$count=floor($diff/3600 );
				  if($count==1)
					$suffix="hour";
				else
				    $suffix="hours";
				break;
				
				case ($diff>86400): //calculate days
					$count=floor($diff/86400);
				  if($count==1)
					$suffix="day";
				else
				    $suffix="days";
				break;
		           
		           }
		           if ($get_time==0){$lseen="Acc unused";}
		           
				   elseif(!isset($suffix)) { $lseen=$count." ago ";}
		                                         else{
		                                         	   $lseen=$count." ".$suffix." ago ";
		                                              }
		                   if($online=='Online'){
						                    $dis="<img src='admin/images/dot.png' height='15px' width='15px' alt=''>";
                                           }else
                                           {
                                             $dis="<img src='admin/images/dotoffline.png' height='15px' width='15px' alt=''>";											
                                           }
				   

                       echo"<div class='activity-row'>
							<div class='col-xs-3 activity-img'>						
      <a class='example-image-link' href='admin/images/$profile' data-lightbox='example-1'>$pic</a></div>
							<div class='col-xs-7 activity-desc'>
								<h5><a href='#'>$firstname $sirname</a></h5>
								<p>Last Seen:$lseen</p>
							</div>
							<div class='col-xs-2 activity-desc1'><h6>$dis</h6></div>
							<div class='clearfix'> </div>
						</div>";

                       }?>						
					</div>
					
				</div>
			</div>
			<div class="col-md-4 span_8">
				<div class="activity_box activity_box2">
					<h3>CHAT</h3>
					<div class="scrollbar" id="style-2">
						  <span id="errors1"></span>						
						
						
					</div>
					<form id="comment_form" method="post" >
                            	<input type="text" id="txt" name="replied" style="width:80%;background-color: #F0F0F0;" placeholder="Enter your text..">
       	                      <input type="hidden" id="vid" name="videoid" value='<?php echo$id; ?>'>

       	                  <a type="button" id="btnSave" class="btn btn-success glyphicon glyphicon-send" style="color:white;"></a>
       	         </form>
				</div>
			</div>
			<div class="col-md-4 span_8">
				<div class="activity_box activity_box1">
									<span id='groupshow'></span>
							
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="clearfix"> </div>
			
		</div>
				
			</div>
		</div>
	<!--footer-->
	<div class="footer">
	   <p>  <a href="#" target="">Chat System</a></p>		
	</div>
    <!--//footer-->
	</div>
		
		
	<!--scrolling js-->
	<script src="admin/js/jquery.nicescroll.js"></script>
	<script src="admin/js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='admin/js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->

	
	<!-- Bootstrap Core JavaScript -->
   <script src="admin/js/bootstrap.js""> </script>
	<!-- //Bootstrap Core JavaScript -->

</body>
</html>