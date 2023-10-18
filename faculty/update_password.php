<?php
extract($_POST);
include('../dbconfig.php');
if(isset($_POST['save']))
{
	
	$que=mysqli_query($conn,"select password from faculty_list where email='".$_SESSION['email']."'");
	$row=mysqli_fetch_array($que);
    $pass=$row['password'];
	$op=md5($op);
	$np=md5($np);
	$cp=md5($cp);
	if($op!=$pass)
		{
		$err="<font color='red'>You Enterd wrong old password</font>";
		}
		
	elseif($np!=$cp)
		{
		$err="<font color='red'>New Password and confirm password must be same</font>";
		}
	else
	{
		mysqli_query($conn,"update faculty_list set password='$cp' where email='".$_SESSION['email']."'");
		$err="<font color='green'>Password have been Changed successfully !!</font>";
	}

}

?>
<form method="post">
<table border="0" bgcolor="#99FFCC" style="margin:30px;">
<tr>
	 <th><?php echo @$err; ?></th>
</tr>
	
<tr>
	<th height="87">Old Password  
    <input type="password" name="op" value="" placeholder="Enter your old password" class="form-control" required/></th>
</tr>
	
<tr>
	<th height="93">New Password
    <input type="password" name="np" value="" placeholder="Enter your new password" class="form-control"  required/><br /></th>
</tr>
 
<tr>
	<th height="87">Confirm Password
    <input type="password" name="cp" value=""  placeholder="Re-Enter your new password" class="form-control" required/><br /></th>
</tr>
<tr>
	<th rowspan="2"><input type="submit" value="Update Password" name="save" class="btn btn-success"/></th>
</tr>
</table>
</form>
