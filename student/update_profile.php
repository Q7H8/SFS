<?php
	include('../dbconfig.php');

	extract($_POST);
	if(isset($save))
	{	
		$image=$_FILES['image'];
		$path="../images/" . $image['name'];
		move_uploaded_file($image['tmp_name'],$path);
		$photo=$image['name'];
	
	mysqli_query($conn,"update student_list set school_id='$school_id',firstname='$fname',lastname='$lname',email='$email',password='$pass',class_id='$class_id',image='$photo',date=now() where email='".$_SESSION['email']."'");	

    $err="<font color='green'>Student Details updated</font>";

	}
	
	$con = mysqli_query($conn, "SELECT * FROM student_list WHERE email='" . $_SESSION['email'] . "'");
	$res = mysqli_fetch_assoc($con);
	$c = $conn->query("SELECT concat(curriculum,' ',level,' - ',section) as class FROM class_list WHERE id='" . $res['class_id'] . "'");
	$class = $c->fetch_assoc(); // Fetch the result and extract the 'class' value
	
?>
	


<h1 class="page-header">Update Student</h1>
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
            	<input type="text" value="<?php echo @$res['firstname'];?>" name="fname" class="form-control" required>
        </div>
   	</div>

	<div class="control-group form-group">
    	<div class="controls">
        	<label>last Name</label>
            	<input type="text" value="<?php echo @$res['lastname'];?>" name="lname" class="form-control" required>
        </div>
   	</div>
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Email</label>
            	<input type="email" value="<?php echo @$res['email'];?>"  name="email" class="form-control" required>
        </div>
    </div>
    <div class="control-group form-group">
    	<div class="controls">
        	<label>Password</label>
            	<input type="text" value=""  name="pass" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Class: <?php echo $class['class']; ?></label>
		   
            <select name="class_id" id="class_id" class="form-control form-control-sm select2">
								<option value=""></option>
								<?php 
								$classes = $conn->query("SELECT id,concat(curriculum,' ',level,' - ',section) as class FROM class_list");
								while($row=$classes->fetch_assoc()):
								?>
								<option value="<?php echo $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? "selected" : "" ?>><?php echo $row['class'] ?></option>
								<?php endwhile; ?>
							</select>
        </div>
    </div>
    

	<div class="control-group form-group">
    	<div class="controls">
            	<input type="submit" class="btn btn-success" name="save" value="Update Student">
        </div>
  	</div>
	</form>


</div>