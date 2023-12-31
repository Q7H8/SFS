<?php 
session_start();
include('../dbconfig.php');
error_reporting(1);

$email= $_SESSION['email'];
if($email=="")
{header('location:../index.php');}
$sql=mysqli_query($conn,"select * ,concat(firstname,' ',lastname) as name from faculty_list where email='$email' ");
$row=mysqli_fetch_assoc($sql);

$fc=$row["email"];

$qry=mysqli_query($conn,"select * from feedback where faculty_id='$fc'");

$ros=mysqli_num_rows($qry);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Faculty feedback System</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/dashboard.css" rel="stylesheet">

    <script src="../js/ie-emulation-modes-warning.js"></script>

    
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top" style="background-color:#0a225c;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" style="color:#FFFFFF" href="index.php">Hello <?php echo $row['name'];?></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           
            <li><a href="../php/logout.php"  style="color:#FFFFFF">Logout</a></li>
          </ul>
          
        </div>
      </div>
    </nav>

    <div class="container-fluid" >
      <div class="row" >
        <div class="col-sm-3 col-md-2 sidebar" style="background-color:#0a225c;">
          <ul class="nav nav-sidebar" >
            <li class="active"><a style="background-color:#f38423;" href="index.php">Dashboard <span class="sr-only">(current)</span></a></li>
			<!-- find users' image if image not found then show dummy image -->
			
			<!-- check users profile image -->
			<?php 
			$q=mysqli_query($conn,"select image from faculty_list where email='".$_SESSION['email']."'");
			$row=mysqli_fetch_assoc($q);
			if($row['image']=="")
			{
			?>
            <li><a href="#"><img style="border-radius:50px" src="../images/person.jpg" width="100" height="100" alt="not found"/></a></li>
			<?php 
			}
			else
			{
			?>
			<li><a href="#"><img style="border-radius:50px" src="../images/<?php echo $row['image'];?>" width="100" height="100" alt=""/></a></li>
			<?php 
			}
			?>
			
			
			
			<li><a style="color:#f38423;" href="index.php?page=update_password"><span class="glyphicon glyphicon-user"></span> Update Password</a></li>
			 <li><a style="color:#f38423;" href="index.php?page=feedback"><span class="glyphicon glyphicon-thumbs-down"></span> Feedback</a></li>
            
      </ul>
         
         
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <!-- container-->
		  <?php 
		@$page=  $_GET['page'];
		  if($page!="")
		  {
		  	if($page=="update_password")
			{
				include('update_password.php');
			
			}
			

			if($page=="feedback")
			{
				include('feedback.php');
			
			}
		  }
		  else
		  {
		  
		  ?>
		 
		  
		  
		  
		  <h1 class="page-header">Dashboard</h1>
		
      <h2 style="margin:50px;" class="text-success"> Number of Feedback Received :  <?php echo($ros); ?> </h2>
        
		  
		  

       
<?php } ?>
        
          
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
