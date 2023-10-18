<?php 
$q=mysqli_query($conn,"select * from feedback ");
$r=mysqli_num_rows($q);

$sql="SELECT concat(S.firstname,' ',S.lastname) As Sname, concat(F.firstname,' ',F.lastname) As Fname from feedback ff
            join faculty_list F 
			on ff.faculty_id=F.email
			join student_list S
			on ff.student_id=S.email";
$res=mysqli_query($conn,$sql);
$rr = mysqli_fetch_array($res); 

if($r==false)
{
echo "<h3 style='color:Red'>No any records found ! </h3>";
}
else
{
?>

<script type="text/javascript">
function deletes(id)
{
	a=confirm('Are You Sure To Remove This Record ?')
	 if(a)
     {
        window.location.href='delete_feedback.php?id='+id;
     }
}
</script>	


<div class="row">
	<div class="col-sm-12" style="color:#0a225c;">
		<h1 align="center" >Feedback</h1>
	</div>
</div>
<div class="row">

<div class="col-sm-12">

<table class="table table-bordered" >

	<thead style="color:#f38423;" >
	
	<tr class="success">
		<th style="background-color: #153f82">Sr.No</th>
		<th style="background-color: #153f82">Student</th>
		<th style="background-color: #153f82">Teacher</th>
		<th style="background-color: #153f82">Quest1</th>
		<th style="background-color: #153f82">Quest2</th>
		<th style="background-color: #153f82">Quest3</th>
		<th style="background-color: #153f82">Quest4</th>
		<th style="background-color: #153f82">Quest5</th>
		<th style="background-color: #153f82">Quest6</th>
		<th style="background-color: #153f82">Quest7</th>
		<th style="background-color: #153f82">Quest8</th>
		<th style="background-color: #153f82">Quest9</th>
		<th style="background-color: #153f82">Quest10</th>
		<th style="background-color: #153f82">Quest11</th>
		<th style="background-color: #153f82">Quest12</th>
		</tr>
		</thead>
		
		<?php
		$i=1;
	while($row=mysqli_fetch_array($q))
		{
			echo "<tr>";
			echo "<td>".$i."</td>";
    $studentEmail = $row[1];
    $studentQuery = "SELECT concat(firstname, ' ', lastname) AS student_name FROM student_list WHERE email = '$studentEmail'";
    $studentResult = mysqli_query($conn, $studentQuery);
    $studentRow = mysqli_fetch_array($studentResult);
    $studentName = $studentRow['student_name'];
    
    // استعلم عن اسم المدرس باستخدام البريد الإلكتروني في الجدول faculty_list
    $facultyEmail = $row[2];
    $facultyQuery = "SELECT concat(firstname, ' ', lastname) AS faculty_name FROM faculty_list WHERE email = '$facultyEmail'";
    $facultyResult = mysqli_query($conn, $facultyQuery);
    $facultyRow = mysqli_fetch_array($facultyResult);
    $facultyName = $facultyRow['faculty_name'];
    
          echo "<td>".$studentName."</td>";
          echo "<td>".$facultyName."</td>";
			//echo "<td>".$row[1]."</td>";
			//echo "<td>".$row[2]."</td>";
			echo "<td>".$row[3]."</td>";
			echo "<td>".$row[4]."</td>";
			echo "<td>".$row[5]."</td>";
			echo "<td>".$row[6]."</td>";
			echo "<td>".$row[7]."</td>";
			echo "<td>".$row[8]."</td>";
			echo "<td>".$row[9]."</td>";
			echo "<td>".$row[10]."</td>";
			echo "<td>".$row[11]."</td>";
			echo "<td>".$row[12]."</td>";
			echo "<td>".$row[13]."</td>";
			echo "<td>".$row[14]."</td>";
			//echo "<td><a href='#' onclick='deletes($row[id])'>Delete</a></td>";
			echo "</tr>";
		$i++;
		}
		
		?>
		
	
		
</table>
</div>
</div>
<?php }?>