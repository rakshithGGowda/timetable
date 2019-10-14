<?php 
include('../config.php');
extract($_POST);


if(isset($save))
{
$que=mysqli_query($con,"select * from timeschedule where department_name='$courseid' and semester_name='$s' and subject_name='$subject_name' and teacher_id='$teacher'");	
$row=mysql_num_rows($que);
	if($row)
	{
	$err="<font color='red'>This user already exists</font>";
	}
	else
	{
mysqli_query($con,"insert into timeschedule values('','$courseid','$s','$subject_name','$time','$date','$teacher')");	

	$err="<font color='blue'>Congrates Your Data Saved!!!</font>";
	//$err=$courseid.",".$s.",".$subject_name;
	
	}
	
}

?>

<script>
function showSubject(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}



xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("subject").innerHTML=xmlhttp.responseText;
}
}
//alert(str);
xmlhttp.open("GET","subject_ajax.php?id="+str,true);
xmlhttp.send();
}
</script>

<script>
function showSemester(str)
{
if (str=="")
{
document.getElementById("txtHint").innerHTML="";
return;
}

if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}



xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("semester").innerHTML=xmlhttp.responseText;
}
}
//alert(str);
xmlhttp.open("GET","semester_ajax.php?id="+str,true);
xmlhttp.send();
}
</script>


<div class="row">
<div class="col-sm-12">
<h2>Add Time Table</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" class="table">
  <tr>
  <td colspan="2"><?php echo @$err; ?></td>
  </tr>
  <tr>
    <th width="237" scope="row">Select Department</th>
    <td width="213">
	<select name="courseid" class="form-control" onchange="showSemester(this.value)" id="courseid">
    <option disabled selected >Select Department</option>
	<?php 
	$dep=mysqli_query($con,"select * from department");
	while($dp=mysqli_fetch_array($dep))
	{
	$dp_id=$dp[0];
	echo "<option value='$dp_id'>".$dp[1]."</option>";
	}
	?>
	
    </select>
	</td>
  </tr>
	
 <tr>
    <th width="237" scope="row">Select Semester</th>
    <td width="213">
	<select name="s" id="semester" onchange="showSubject(this.value)" class="form-control"/>
    <option disabled selected >Select Semester</option>
    
 	</select>
	</td>
  </tr>

  <tr>
    <th width="237" scope="row">Subject Name </th>
    <td width="213">
	<select name="subject_name" id="subject"  class="form-control"/>
    <option disabled selected >Select Subject</option>
    
 	</select>
	</td>
  </tr>
  <tr>
    <th width="237" scope="row">Teacher </th>
    <td width="213">
	<select name="teacher" id="teacherid" onchange="showTeacher(this.value)" class="form-control">
	<?php
	$t=mysqli_query($con,"select * from teacher");
	while($s=mysqli_fetch_array($t))
	{
		$t_id=$s[0];
		echo "<option value='$t_id'>".$s[1]."</option>";
	}
	
	?>
	
	</td>
  </tr>
  <tr>
    <th width="237" scope="row">Enter  Time </th>
    <td width="213"><input type="time" name="time" class="form-control"/></td>
  </tr>
  <tr>
  <tr>
    <th width="237" scope="row">Date </th>
    <td width="213"><input type="date" name="date" class="form-control"/></td>
  </tr>
  <tr>
  
  <tr>
    <th colspan="1" scope="row"></th>
	<td>
	<input type="submit" value="Add Time Table" name="save" class="btn btn-success" />
	
	<input type="reset" value="Reset" class="btn btn-success"/>
	</td>
  </tr>
  
  </table>
  </form>
  </div>
  </div>