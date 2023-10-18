<?php
	extract($_POST);
	if(isset($save))
	{	
	
	mysqli_query($conn,"update faculty_list set school_id='$school_id',firstname='$fname',lastname='$lname',email='$email',password='$pass',image='$image' where email='".$_SESSION['email']."'");	

    $err="<font color='green'>Faculty Details updated</font>";

	}

$con=mysqli_query($conn,"select * from faculty_list where email='".$_SESSION['email']."'");

$res=mysqli_fetch_assoc($con);	

?>


<h1 class="page-header">Update  Faculty</h1>
<div class="col-lg-8" style="margin:15px;">

	<form method="post">
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label><?php echo @$err;?></label>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Image</label>
            	<input type="file" value="<?php echo @$res['image'];?>" name="image" class="form-control" required>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>School ID</label>
            	<input type="text" value="<?php echo @$res['school_id'];?>" name="school_id" class="form-control" required>
        </div>
   	</div>
 	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>First Name</label>
            	<input type="text" value="<?php echo @$res['firstname'];?>"  name="fname" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Last Name</label>
          <input type="text" value="<?php echo @$res['lastname'];?>"  name="lname" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Email</label>
  <input type="email"  name="email" value="<?php echo @$res['email'];?>" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Password</label>
  <input type="text"  name="pass" value="" class="form-control" required>
        </div>
    </div>
	<div class="control-group form-group">
    	<div class="controls">
            	<input type="submit" class="btn btn-success" name="save" value="Update Profile">
        </div>
  	</div>
	</form>


</div>