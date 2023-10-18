<?php
include('../dbconfig.php');
	
	$id=$_GET['id'];
	
	mysqli_query($conn,"delete from student_list where id='$id'");
	header('location:index.php?info=show_student');
?>