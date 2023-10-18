<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_class.php?id='+id;
     }
}
</script>	

<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary new_class" href="index.php?info=add_class"><i class="fa fa-plus"></i> Add New</a>
			</div>
		</div>
<?php
	echo "<table class='table table-responsive table-bordered table-striped table-hover' style=margin:15px;>";
	echo "<tr>";
	
	echo "<th>S.No</th>";
	echo "<th>Class</th>";
	echo "<th>Update</th>";
	echo "<th>Delete</th>";
	echo "</tr>";
	
	$i=1;
$que=mysqli_query($conn,"select * ,concat(curriculum,' ',level,'-',section) as class from class_list order by id asc");
	
	while($row=mysqli_fetch_array($que))
	{
		echo "<tr>";
		echo "<td>".$i."</td>";
		echo "<td>".$row['class']."</td>";
		echo "<td class='text-center'><a href='index.php?id=$row[id]&info=edit_class'><span class='glyphicon glyphicon-pencil'style=color:green;></span></a></td>";
		
		echo "<td class='text-center'><a href='#' onclick='deletes($row[id])'><span class='glyphicon glyphicon-remove' style=color:red;></span></a></td>";
		
	
		echo "</tr>";
		$i++;
	}
	
?>