<?php
if (!isset($_SESSION['email'])) {
	header("Location:../login.php");
	exit();
} else {
	if ($_SESSION['login_type'] != 'admin') {
		echo "<br><br><br><center><h1>This page is only for administrators</h1></center>";
		exit();
	}
}
?>

<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

include('../dbconfig.php');
extract($_POST);

if (isset($save)) {
	$q = mysqli_query($conn, "SELECT * FROM student_list WHERE email='$email'");
	$r = mysqli_num_rows($q);

	if ($r == 1) {
		$row = mysqli_fetch_assoc($q);
		if ($row['email'] == $email || $row['school_id'] == $school_id) {
			$err = "<font color='red'>This account already exists. Please choose a different email or school ID.</font>";
		}
	} else {
		$image=$_FILES['image'];
		$path="../images/" . $image['name'];
		move_uploaded_file($image['tmp_name'],$path);
		$photo=$image['name'];

		$pass = md5($pass);

		$mail = new PHPMailer(true);

		try {
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';
			$mail->SMTPAuth   = true;
			$mail->Username   = 'qasem.q7000@gmail.com';
			$mail->Password   = 'zngyhtcpygodpmax';
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port       = 587;

			$mail->setFrom('qasem.q7000@gmail.com', 'Al_Murisi');
			$mail->addAddress($email);

			$mail->isHTML(true);
			$verification_code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
			$mail->Subject = 'Email verification';
			$mail->Body    = '<p>Your verification code is: <b style="font-size: 30px;">' . $verification_code . '</b></p>';

			$mail->send();

			$sql = "INSERT INTO student_list VALUES('', '$school_id', '$fname', '$lname', '$email', '$pass', '$class_id', '$photo', now(), '$verification_code', NULL)";
			if (mysqli_query($conn, $sql)) {
				$err = "<font color='Green'>The student was added successfuly.</font>";

			}
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}
}
?>


<h1 class="page-header">Add Student</h1>
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
            	<input type="file" name="image" class="form-control">
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
        	<label>Last Name</label>
            	<input type="text" value="<?php echo @$lname;?>" name="lname" class="form-control" required>
        </div>
   	</div>
	<div class="control-group form-group">
    	<div class="controls">
        	<label>Email</label>
            	<input type="email" value="<?php echo @$email;?>" name="email" class="form-control" required>
        </div>
   	</div>

   	<div class="control-group form-group">
    	<div class="controls">
        	<label>Password</label>
            	<input type="password" name="pass" class="form-control" required>
        </div>
   	</div>


	<div class="control-group form-group">
	<div class="controls">
    	<label>Class</label>
        <select name="class_id" id="class_id" class="form-control form-control-sm select2">
							<option value=""></option>
							<?php 
							$classes = $conn->query("SELECT id,concat(curriculum,' ',level,' - ',section) as class FROM class_list");
							while($row=$classes->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($class_id) && $class_id == $row['id'] ? "selected" : "" ?>><?php echo $row['class'] ?></option>
							<?php endwhile; ?>
						
   	</div>
	</div>

   	<div class="control-group form-group">
    	<div class="controls">
        	<input type="submit" value="Save" name="save" class="btn btn-primary">
        </div>
   	</div>
    </form>
</div>