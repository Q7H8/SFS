<?php
include('../dbconfig.php');
	
	$id=$_GET['id'];
    mysqli_query($conn, "DELETE FROM restriction_list WHERE class_id = '$id'");
    mysqli_query($conn, "UPDATE student_list SET class_id = NULL WHERE class_id = '$id'");
	mysqli_query($conn,"delete from class_list where id='$id'");
	header('location:index.php?info=class_list');
?>