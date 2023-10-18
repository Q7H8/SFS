<?php
error_reporting(1);
	include('../dbconfig.php');
	extract($_POST);
	if(isset($save))
	{	
	
		$stmt = $conn->prepare("INSERT INTO subject_list (code, 'subject', 'description') VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $code, $subject, $description);
		
		if($stmt->execute()) {
			$err = "<font color='green'>New Subject Successfully Added.</font>";
		} else {
			$err = "<font color='red'>Error: " . $stmt->error . "</font>";
		}
		
		$stmt->close();
	   $err="<font color='green'>New Subject Successfully Added.</font>";

}	

?>


<h1 class="page-header">Add Subject</h1>
<div class="col-lg-8" style="margin:15px;">

	<form method="post">
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label><?php echo @$err;?></label>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Code</label>
            	<input type="text" value="<?php echo @$code;?>" name="code" class="form-control" required>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Subject</label>
            	<input type="text" value="<?php echo @$subject;?>" name="subject" class="form-control" required>
        </div>
   	</div>
 	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Description</label>
            	<input type="text" value="<?php echo @$description;?>"  name="description" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
            	<input type="submit" class="btn btn-success" name="save" value="Add New Subject">
        </div>
  	</div>
	</form>


</div>