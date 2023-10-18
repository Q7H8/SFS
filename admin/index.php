<?php
session_start();
if(!isset($_SESSION['email']))
{
header('location:index.php');
}
include('../dbconfig.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Dashboard</title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    
    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">


    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper" >

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" style="background-color: #153f82;" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="color:white">Faculty Feedback System</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="index.php?info=update_password"><i class="fa fa-gear fa-fw"></i>Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../php/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar"style="background-color: #153f82;" role="navigation">
                <div class="sidebar-nav navbar-collapse text-white">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php" style="color:#f38423 ;"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>

                        <li>
                            <a href="index.php?info=class_list" style="color:#f38423 ;"><i class="fa fa-user fa-book"></i>Class</a>
                        </li>

                        <li>
                            <a href="index.php?info=subject_list" style="color:#f38423 ;"><i class="fa fa-user fa-book"></i>Subject</a>
                        </li>
                        
						<li>
                            <a href="#" style="color:#f38423 ;"><i class="fa fa-user fa-fw"></i>Faculty<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="index.php?info=add_faculty" style="color:#f38423 ;"><i class="fa fa-plus fa-fw"></i> Add Faculty</a>
                                </li>
								 <li>
                                    <a href="index.php?info=show_faculty" style="color:#f38423 ;"><i class="fa fa-eye"></i> Manage faculty</a>
                                </li>                           
							</ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
						
						<li>
                            <a href="#" style="color:#f38423 ;"><i class="fa fa-user fa-fw"></i>Student<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                 <li>
                                    <a href="index.php?info=add_student" style="color:#f38423 ;"><i class="fa fa-plus fa-fw"></i> Add Student</a>
                                </li>
                                
								 <li>
                                    <a href="index.php?info=show_student" style="color:#f38423 ;"><i class="fa fa-eye"></i> Manage Student</a>
                                </li> 
							             
							</ul>
                        </li>
                        <li>
                            <a href="index.php?info=manage_restriction" style="color:#f38423 ;"><i class="fa fa-user fa-book"></i>Restriction</a>
                        </li>
		                    <!-- feedback-->
		                            <li>
                                      <a href="#" style="color:#f38423 ;"><i class="fa fa-user fa-book"></i>Feedback<span class="fa arrow"></span></a>
                                         <ul class="nav nav-second-level">
                                            <li><a href="index.php?info=feedback" style="color:#f38423 ;"><i class="fa fa-eye"></i> feedback</a></li>
\	                 					 </ul>
                                    </li>
		                   <!--feedback end-->     
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                   
                	<?php 
								@$id=$_GET['id'];
								@$info=$_GET['info'];
								if($info!="")
								{
									if($info=="add_faculty")
										{
											include('add_faculty.php');
										}
										
									elseif($info=="show_faculty")
										{
											include('show_faculty.php');
										}
									elseif($info=="class_list")
                                    {
                                        include('class_list.php');
                                    }
                                    elseif($info=="add_class")
                                    {
                                        include('add_class.php');
                                    }

									elseif($info=="edit_faculty")
										{
											include('edit_faculty.php');
										}
                                        elseif($info=="subject_list")
                                        {
                                            include('subject_list.php');
                                        }
                                        elseif($info=="edit_subject")
                                        {
                                            include('edit_subject.php');
                                        }
                                        elseif($info=="add_subject")
                                        {
                                            include('add_subject.php');
                                        }
                                    elseif($info=="add_student")
                                    {
                                        include('add_student.php');
                                    }
                                    elseif($info=="show_student")
                                    {
                                        include('show_student.php');
                                    }
                                    
									elseif($info=="manage_restriction")
                                    {
                                        include('manage_restriction.php');
                                    }	
									elseif($info=="feedback")
										{
											include('feedback.php');
										}
		
									
								
										else if($info=="update_password")
										{
										include('update_password.php');
										}
									
								}
								else
								{
								include('dashboard_home.php');
								}
							
							
							?>
				
				</div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../css/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../css/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../css/metisMenu.min.js"></script>

  
    <!-- Custom Theme JavaScript -->
    <script src="../css/sb-admin-2.js"></script>

</body>

</html>
