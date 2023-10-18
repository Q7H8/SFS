<?php
error_reporting(1);
	include('../dbconfig.php');
	extract($_POST);
	if(isset($save))
	{	
	
		$stmt = $conn->prepare("INSERT INTO class_list (curriculum, level, section) VALUES (?, ?, ?)");
		$stmt->bind_param("sss", $curriculum, $level, $section);
		
		if($stmt->execute()) {
			$err = "<font color='green'>New Class Successfully Added.</font>";
		} else {
			$err = "<font color='red'>Error: " . $stmt->error . "</font>";
		}
		
		$stmt->close();
	   $err="<font color='green'>New Class Successfully Added.</font>";

}	

?>


<h1 class="page-header">Add Class</h1>
<div class="col-lg-8" style="margin:15px;">

	<form method="post">
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label><?php echo @$err;?></label>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Curriculum</label>
            	<input type="text" value="<?php echo @$curr;?>" name="curriculum" class="form-control" required>
        </div>
   	</div>
	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Year Level</label>
            	<input type="text" value="<?php echo @$level;?>" name="level" class="form-control" required>
        </div>
   	</div>
 	
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Section</label>
            	<input type="text" value="<?php echo @$section;?>"  name="section" class="form-control" required>
        </div>
    </div>
	
	<div class="control-group form-group">
    	<div class="controls">
            	<input type="submit" class="btn btn-success" name="save" value="Add New Class">
        </div>
  	</div>
	</form>


</div>