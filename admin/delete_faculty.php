<?php
include('../dbconfig.php');
	
	$id=$_GET['id'];

	mysqli_query($conn, "DELETE FROM restriction_list WHERE faculty_id = '$id'");
	mysqli_query($conn,"delete from faculty_list where id='$id'");
	header('location:index.php?info=show_faculty');
?>