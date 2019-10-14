<script>
	function deleteData(id)
	{
		if(confirm("You want to delete ?"))
		{
		window.location.href="delete_timetable.php?timeschedule_id="+id;
		}
	
	}
</script>

<?php 
include('../config.php');



//<!--data display-->


echo "<table border='1' class='table'>";

echo "<tr class='danger'><th colspan='9'><a href='admindashboard.php?info=add_timetable'>Add New</a></th></tr>";

echo "<Tr>
<th>Time Schdule Id</th>
<th>Department</th>
<th>Subject Name</th>
<th>Semester Name</th>
<th>Teacher Name</th>
<th>Time</th>
<th>Date</th>

<th>Update</th>
<th>Delete</th></tr>";

$que=mysqli_query($con,"select *  from timeschedule");
	while($res=mysqli_fetch_array($que))
	{
	echo "<tr>";
	echo "<td>".$res['timeschedule_id']."</td>" ;
	
	//display department name
	$que2=mysqli_query($con,"select *  from department where department_id='".$res['department_name']."'");
	$res2=mysqli_fetch_array($que2);
	
	echo "<td>".$res2['department_name']."</td>" ;
	
	
	
	//display subject name
	$que3=mysqli_query($con,"select *  from subject where subject_id='".$res['subject_name']."'");
	$res3=mysqli_fetch_array($que3);
	echo "<td>".$res3['subject_name']."</td>" ;
	
	//display semester name
	$que4=mysqli_query($con,"select *  from semester where sem_id='".$res['semester_name']."'");
	$res4=mysqli_fetch_array($que4);
	echo "<td>".$res4['semester_name']."</td>" ;
	
	
	//display teacher name
	$que5=mysqli_query($con,"select *  from teacher where teacher_id='".$res['teacher_id']."'");
	$res5=mysqli_fetch_array($que5);
	echo "<td>".$res5['name']."</td>" ;
	
	
	echo "<td>".$res['time']."</td>" ;
	echo "<td>".$res['date']."</td>" ;


	echo "<td><a href='admindashboard.php?info=updatetimetable&timeschedule_id=$res[timeschedule_id]'>Update</a></td>";
	?>
    
	<td>
	<a href='javascript:deleteData("<?php echo  $res[timeschedule_id];?>")'>Delete</a></td>
	<?php
	echo "</tr>";
	}
	echo "</table>";	

?>