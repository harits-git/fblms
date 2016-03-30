<?php 
$sid= $_GET['sid'];
$sdid= $_GET['sdid'];
//$cid= $_GET['cid'];
if($_POST['submit']){ 
//echo "$userType";	
	if($userType == 'lecturer'){
		$sql = "INSERT INTO schedules(content,date,time,publisher,course_id) 
				VALUES('".$_POST['content']."',
				'".$_POST['date']."',
				'".$_POST['time']."',
				'$dummyFBID',
				'".$_POST['course']."')";
		//echo $sql;
		$exec = $db->Execute($sql);
		if($exec == false){
			echo "<h3>error registering Schedule!</h3>";
		}else echo "<h3>New Schedule Added</h3>";
	}
	//$db->Close();
}else if($_POST['update']){
	$sql = "update schedules set 
			content='".$_POST['content']."',
			date='".$_POST['date']."',
			time='".$_POST['time']."',
			course_id='".$_POST['course']."'
			where schedules_id=$sid";
	//echo $sql;
	$exec = $db->Execute($sql);
}

if($sdid != ''){
	$sql = "delete from schedules where schedules_id=$sdid";
	$exec = $db->Execute($sql);
	
}
?>
<script type="text/javascript">
function editSchedule(s,cid,c,d,t)
{	
	alert("Scroll down this page to edit!");
	document.getElementById("content").innerHTML = c;
	
	document.getElementById("date").value = d;
	document.getElementById("time").value = t;
	
	document.getElementById("process").name = "update";
	document.getElementById("process").value = "Update";
	
	document.getElementById("sform").action = "index.php?menu=application/lecturer/schedule.php&sid="+s;
	// for(var i=0; i< document.getElementById("course").length; i++){
		// if(document.getElementById("course").options[i].value == cid){
			document.getElementById("course").value = cid;
		// }
		
	// }
	//top.location.href="#sform";
	//alert(document.getElementById("course").value);
}
</script>

<div class="mainbar">
	<div class="article">
		<h2><span>Schedule</span> Management</h2>
	<?php //echo 'today '.date('d-m\(F\)- Y');
	$today = date('d-m-Y');
	$number=0;
	$sql = "select * from schedules where course_id IN 
			(select course_id from user_teaching where lecturer_id=$dummyFBID) order by date,time";
	$rs = $db->Execute($sql);
	if($rs == false){}
	else{
		echo "<table width='600'>";
		while(!$rs->EOF){
			$number++;
			$scid = $rs->fields['schedules_id'];
			$ci = $rs->fields['content'];
			$di = $rs->fields['date'];
			$ti = $rs->fields['time'];
			$cid = $rs->fields['course_id'];
			
			$rs1 = $db->Execute("select name from course where course_id=$cid");
			echo "<tr><td>".$number."&nbsp</td><td><b>".$rs->fields['content']."</b>,&nbsp</td>
					<td>".$rs1->fields['name'].",&nbsp</td>
					<td>".date("H:i",strtotime($rs->fields['time']))."</td>
					<td>of ".date("d F Y",strtotime($rs->fields['date']))."</b></td>
					<td><button type='button' onClick='editSchedule(\"".$scid."\",\"".$cid."\",\"".$ci."\",\"".$di."\",\"".$ti."\")'>edit</button></td>
					<td>.....<a href='index.php?menu=application/lecturer/schedule.php&sdid=".$rs->fields['schedules_id']."'>x</a></td>
					</tr>";	
			$rs->MoveNext();
		}
		echo "</table>";
		//href='index.php?menu=application/lecturer/schedule.php&sid=".$rs->fields['schedules_id']."'
	}
	?>
	__________________________________________________________________
	<h3>New Schedule</h3>
	<form id="sform" action="" method="post">
	
	<label class="content">Content</label>
		<div>
		<textarea id="content" name="content" rows=2 cols=50></textarea>			
		</div>
	</br>
	Course
	<select name="course" id="course">
	<?php
		$sel = $db->Execute("select user_teaching.course_id,name from user_teaching,course 						
								where user_teaching.course_id=course.course_id 
								and user_teaching.lecturer_id=$dummyFBID");
		while(!$sel->EOF){
			echo "<option value='".$sel->fields['course_id']."'>".$sel->fields['name']."</option>";
			$sel->MoveNext();
		}
	?>
	</select><br>
	Date (YYYY-MM-DD format)&nbsp&nbsp&nbsp&nbsp <input type="text" size="15" id="date" name="date" value='YYYY-MM-DD' />
	</br>
	Time (HH:MM--> 24h format)&nbsp&nbsp<input type="text" size="15" id="time" name="time" value='HH:MM'/>
	
	</br></br>
	<input type='submit' id='process' name='submit' value='New Schedule'/>
	
	</form>
	</div>
</div>