<?php 
include('../config.php');
$subject_id=$_REQUEST['subject_id'];
$q=mysqli_query($con,"select * from subject where subject_id='$subject_id'");
$res=mysqli_fetch_assoc($q);

extract($_POST);
if(isset($update))
{	

	mysqli_query($con,"update subject set subject_name='$subname', sem_id='$s',department_id='$course'  where subject_id='$subject_id' ");
	
	echo "Records updated";
	
	}
	
?>


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
xmlhttp.open("GET","updatesubject_ajax.php?id="+str,true);
xmlhttp.send();
}
</script>



<div class="row">
<div class="col-sm-8">
<h2>Update subject</h2>
<form method="POST" enctype="multipart/form-data">
  <table border="0" class="table">
  <tr>
  <td colspan="2"><?php echo @$err; ?></td>
  </tr>
   <tr>
    <th width="237" scope="row">Department Name </th>
    <td width="213">
	
	<select name="course" id="courseid" onChange="showSemester(this.value)" class="form-control">
	<?php
	$cou=mysqli_query($con,"select * from department");
	while($c=mysqli_fetch_array($cou))
	{
	$c_id=$c[0];
	?>
	<option value='<?php echo $c_id; ?>' <?php if($c_id==$res['department_id']){echo "selected";} ?>>
	<?php echo $c[1]; ?>
	</option>
	<?php
	}
	?>
	
    </select>
	</td>
	
	</tr>
   <tr>
    <th width="237" scope="row">Semester Name </th>
    <td width="213">
	
	<select name="s" id="semester" class="form-control">
	<?php	
	$sem=mysqli_query($con,"select * from semester where department_id='".$res['department_id']."'");
	while($s=mysqli_fetch_array($sem))
	{
	$s_id=$s[0];
	?>
	<option value='<?php echo $s_id; ?>' <?php if($s_id==$res['sem_id']){echo "selected";} ?>>
	<?php echo $s[1]; ?>
	</option>
	<?php
	}
	?>
	
	
    </select>
	</td>
	
	</tr>
	
   <tr>
    <th width="237" scope="row">Subject Name </th>
    <td width="213"><input type="text" name="subname" class="form-control" value="<?php echo $res['subject_name'];?>"/></td>
  </tr>
   <tr>
    <th colspan="2" scope="row" align="center">
<input type="submit" value="Update Records" name="update"/>
	</th>
  </tr>
</table>
</form>

</div>
</div>

