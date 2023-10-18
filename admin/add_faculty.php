<?php
error_reporting(1);
	include('../dbconfig.php');
	extract($_POST);
	if(isset($save))
	{	
		
    $q=mysqli_query($conn,"select * from faculty_list where email='$email' or school_id='$school_id'");
	$r=mysqli_num_rows($q);	
	if($r)
	{
	$err="<font color='red'>This account already exists choose diff email or school_id.</font>";
	}
	else
	{	
		$image=$_FILES['image'];
		$path="../images/" . $image['name'];
		move_uploaded_file($image['tmp_name'],$path);
		$photo=$image['name'];
		$pass=md5($pass);

		mysqli_query($conn,"insert into faculty_list values('','$school_id','$fname','$lname','$email','$pass','$photo',now(),'0')");	
	$err="<font color='green'>New Faculty Successfully Added.</font>";
	}

}	

?>


<h1 class="page-header">Add Faculty</h1>
<div class="col-lg-8" style="margin:15px;">
	<form method="post" enctype="multipart/form-data">
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label><?php echo @$err;?></label>
        </div>
   	</div>
	   <div class="control-group form-group">
    	<div class="controls">
        	<label>Image</label>
            	<input type="file" value="<?php echo @$image;?>" name="image" class="form-control" required>
        </div>
   	</div>
    <div class="control-group form-group">
    	<div class="controls">
        	<label>School ID</label>
            	<input type="text" value="<?php echo @$school_id;?>" name="school_id" class="form-control" required>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>First Name</label>
            	<input type="text" value="<?php echo @$fname;?>" name="fname" class="form-control" required>
        </div>
   	</div>

	<div class="control-group form-group">
    	<div class="controls">
        	<label>last Name</label>
            	<input type="text" value="<?php echo @$lname;?>" name="lname" class="form-control" required>
        </div>
   	</div>
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Email :</label>
            	<input type="email" value="<?php echo @$email;?>"  name="email" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Password :</label>
            	<input type="password" value="<?php echo @$pass;?>"  name="pass" class="form-control" required>
        </div>
    </div>
	<div class="control-group form-group">
    	<div class="controls">
            	<input type="submit" class="btn btn-success" name="save" value="Add New Faculty">
        </div>
  	</div>
	</form>


</div>