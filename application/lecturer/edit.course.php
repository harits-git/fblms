<?php 
$cid= $_GET['cid'];

if($_POST['submit']){ 
//echo "$userType";	
	if($userType == 'lecturer'){
		$sql = "UPDATE course SET name='".$_POST['name']."',
				start='".$_POST['start']."',
				end='".$_POST['end']."',
				requirement='".$_POST['req']."',
				expectation='".$_POST['expect']."',
				objective='".$_POST['obj']."',
				assignment='".$_POST['task']."',
				grading='".$_POST['grading']."'
				WHERE course_id=$cid";

		$exec = $db->Execute($sql);
		if($exec == false){
			echo "<h3>error editing course!</h3>";
		}
		else echo "<h3>Course Edited</h3>";
	}else{		
					
	}
	//$db->Close();
}else{
	if($userType == 'lecturer'){
		$sql = "SELECT * FROM COURSE WHERE course_id=$cid";
		$exec = $db->Execute($sql);
		if($exec == false){
			echo "cannot find data for course $cid";
		}
		else{
			

?>
<div class="mainbar">
	<div class="article">
		<h2><span>New</span> Course for Student</h2>
	
	<form action="" method="post">
	</br>
	<label class="desc">Course Name</label>
		<div>
		<input type="text" size='50' name="name" value='<?php echo $exec->fields['name'];?>' />		
		
		</div>
	</br>
	Start class (yyyy-mm-dd)&nbsp <input type="text" size="12" name="start" value='<?php echo $exec->fields['start'];?>'/>
	
	</br>
	End class (yyyy-mm-dd)&nbsp <input type="text" size="12" name="end" value='<?php echo $exec->fields['end'];?>'/>
	</br>
	</br>
	<label class="desc">Class Requirements</label>
		<div>		
		<textarea name="req" cols=50 rows=5><?php echo $exec->fields['requirement'];?></textarea>
		</div>
	</br>
	<label class="desc">Class Expectation</label>
		<div>		
		<textarea name="expect" cols=50 rows=5><?php echo $exec->fields['expectation'];?></textarea>
		</div>
	</br>	
	<label class="desc">Class Objectives</label>
		<div>		
		<textarea name="obj" cols=50 rows=5><?php echo $exec->fields['objective'];?></textarea>
		</div>
	</br>
	<label class="desc">Grading</label> 
		<div>		
		<textarea name="grading" cols=50 rows=2><?php echo $exec->fields['grading'];?></textarea>		
		</div>
	</br>	
	<label class="desc">Assignment and assessment</label> 
		<div>		
		<textarea name="task" cols=50 rows=2><?php echo $exec->fields['assignment'];?></textarea>		
		</div>
	<input type="submit" name="submit" value="Update"/>
	</form>
	</div>
</div>
<?php
		}
	}
}
?>