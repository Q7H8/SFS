<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_student.php?id='+id;
     }
}
</script>	


<?php
	echo "<table class='table table-responsive table-bordered table-striped table-hover' style=margin:15px;>";
	echo "<tr>";
	
	echo "<th>S.No</th>";
	echo "<th>Shool ID</th>";
	echo "<th>Name</th>";
	echo "<th>Email</th>";
    echo "<th>Current Class</th>";
	echo "<th>Update</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	
    $i = 1;
    $que = mysqli_query($conn, "SELECT *, CONCAT(firstname, CONCAT(' ', lastname)) AS Name FROM student_list");
    while ($row = mysqli_fetch_array($que)) {
        echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row['school_id']."</td>";
        echo "<td>".$row['Name']."</td>";
        echo "<td>".$row['email']."</td>";
        
        $que1 = mysqli_query($conn, "SELECT CONCAT(curriculum, ' ', level, ' - ', section) AS Class FROM class_list WHERE id = '".$row['class_id']."'");
        if ($rwo1 = mysqli_fetch_array($que1)) {
            echo "<td>".$rwo1['Class']."</td>";
        } else {
            echo "<td></td>";
        }
        
        echo "<td class='text-center'><a href='index.php?id=".$row['id']."&info=edit_faculty'><span class='glyphicon glyphicon-pencil' style='color:green;'></span></a></td>";
        echo "<td class='text-center'><a href='#' onclick='deletes(".$row['id'].")'><span class='glyphicon glyphicon-remove' style='color:red;'></span></a></td>";
        echo "</tr>";
        $i++;
    }
	
?>