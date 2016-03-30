<?php 

if($_POST['submit']){ 
//echo "$userType";	
	if($userType == 'lecturer'){
		$sql = "INSERT INTO course(name,start,end,requirement,expectation,objective,creator,assignment,grading) 
				VALUES('".$_POST['name']."',
				'".$_POST['starty']."-".$_POST['startm']."-".$_POST['startd']."',
				'".$_POST['endy']."-".$_POST['endm']."-".$_POST['endd']."',
				'".$_POST['req']."', '".$_POST['expect']."', '".$_POST['obj']."', '".$dummyFBID."', '".$_POST['assignment']."', '".$_POST['grading']."')";

		$exec = $db->Execute($sql);
		if($exec == false){
			echo "<h3>error registering new course, PLEASE COMPLETE COURSE DETAIL!</h3>";
		}
		//$sql = "INSERT INTO user_teaching VALUES('".$dummyFBID."',)";
		$rs = $db->Execute("SELECT course_id FROM course WHERE name='".$_POST['name']."'");
		echo "course ID :".$rs->fields['course_id']."<br>";
		$db->Execute("INSERT INTO user_teaching VALUES('".$dummyFBID."','".$rs->fields['course_id']."')");
		$db->Execute("INSERT INTO grade_formula VALUES('".$rs->fields['course_id']."','".$_POST['a_pcg']."','".$_POST['m_pcg']."','".$_POST['f_pcg']."')");
		echo "<h3>New Course Added</h3>";
	}else{		
					
	}
	//$db->Close();
}
?>
<div class="mainbar">
	<div class="article">
		<h2><span>New</span> Course for Student</h2>
	
	<form action="" method="post">
	</br>
	<label class="desc">Course Name</label>
		<div>
		<input type="text" size='50' name="name"/>		
		
		</div>
	</br>
	Start class <input type="text" size="1" name="startd"/>
	<select name="startm">
		<option value="1">Jan</option>
		<option value="2">Feb</option>
		<option value="3">Mar</option>
		<option value="4">Apr</option>
		<option value="5">May</option>
		<option value="6">Jun</option>
		<option value="7">Jul</option>
		<option value="8">Aug</option>
		<option value="9">Sep</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
		<option value="12">Dec</option>
	</select>
	<input type="text" size='4' name="starty"/>
	</br>
	End class&nbsp&nbsp<input type="text" size="1" name="endd"/>
	<select name="endm">
		<option value="1">Jan</option>
		<option value="2">Feb</option>
		<option value="3">Mar</option>
		<option value="4">Apr</option>
		<option value="5">May</option>
		<option value="6">Jun</option>
		<option value="7">Jul</option>
		<option value="8">Aug</option>
		<option value="9">Sep</option>
		<option value="10">Oct</option>
		<option value="11">Nov</option>
		<option value="12">Dec</option>
	</select>
	<input type="text" size='4' name="endy"/>
	</br>
	</br>
	<label class="desc">Class Requirements</label>
		<div>		
		<textarea name="req" cols=50 rows=5></textarea>
		</div>
	</br>
	<label class="desc">Class Expectation</label>
		<div>		
		<textarea name="expect" cols=50 rows=5></textarea>
		</div>
	</br>	
	<label class="desc">Class Objectives</label>
		<div>		
		<textarea name="obj" cols=50 rows=5></textarea>
		</div>
	</br>
	<label class="desc">Grading</label> 
		<div>		
		<textarea name="grading" cols=50 rows=2></textarea>
		<br>
		Define grading formula : 
		<br>
		assessment percentage ---><input type="text" size='2' name="a_pcg" value='0'/>%
		<br>
		middle exam percentage ---><input type="text" size='2' name="m_pcg" value='0'/>%
		<br>
		final exam percentage -------><input type="text" size='2' name="f_pcg" value='0'/>%
		</div>
	</br>	
	<label class="desc">Assignment and Assignment</label> 
		<div>		
		<textarea name="task" cols=50 rows=2></textarea>		
		</div>
	</br>
	
	<input type="submit" name="submit" value="Proceed"/>	
	</form>
	</div>
</div>