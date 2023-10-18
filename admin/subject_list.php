<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_subject.php?id='+id;
     }
}
</script>	

<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_class" href="index.php?info=add_subject"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
<?php
	echo "<table class='table table-responsive table-bordered table-striped table-hover' style=margin:15px; class='text-center'> ";
	echo "<tr>";
	echo "<thead>";
	echo "<th class='text-center'>S.No</th>";
	echo "<th class='text-center'>Code</th>";
	echo "<th class='text-center'>Subject</th>";
	echo "<th class='text-center'>Description</th>";
    echo "<th class='text-center'>Update</th>";
	echo "<th class='text-center'>Delete</th>";
    echo "</thead>"; 
	echo "</tr>";
	
	$i=1;
$que=mysqli_query($conn,"select * from subject_list order by id asc");
	
	while($row=mysqli_fetch_array($que))
	{
		echo "<tr class='text-center'>";
		echo "<td>".$i."</td>";
		echo "<td>".$row['code']."</td>";
        echo "<td>".$row['subject']."</td>";
        echo "<td>".$row['description']."</td>";
        
		echo "<td class='text-center'><a href='index.php?id=$row[id]&info=edit_subject'><span class='glyphicon glyphicon-pencil'style=color:green;></span></a></td>";
		
		echo "<td class='text-center'><a href='#' onclick='deletes($row[id])'><span class='glyphicon glyphicon-remove' style=color:red;></span></a></td>";
		
	
		echo "</tr>";
		$i++;
	}
	
?>