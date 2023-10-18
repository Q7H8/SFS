<?php
include('../dbconfig.php');
	
	$id=$_GET['id'];
    mysqli_query($conn, "DELETE FROM restriction_list WHERE subject_id = '$id'");
	mysqli_query($conn,"delete from subject_list where id='$id'");
	header('location:index.php?info=subject_list');
?>