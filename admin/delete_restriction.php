<?php
include('../dbconfig.php');
	
	$id=$_GET['id'];
	
	mysqli_query($conn,"delete from restriction_list where id='$id'");
	header('location:index.php?info=manage_restriction');
?>