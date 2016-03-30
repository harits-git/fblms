<script>
function processGrade(sid,cid,a,m,f){
	//alert(sid+", "+a+", "+m+", "+f);
	document.getElementById("update_a").value = a;
	document.getElementById("update_m").value = m;
	document.getElementById("update_f").value = f;
	document.getElementById("sform").action = "index.php?menu=application/lecturer/student.php&sid="+sid+"&cid="+cid;
	//top.location.href="#sform";
}
</script>
<div class="mainbar">
	<div class="article">
	<h2><span>Students</span></h2>
    <ul>
<?php
$cid= $_GET['cid'];
$sid= $_GET['sid'];
	if($_POST['process']){
		$rs = $db->Execute("DELETE FROM grade WHERE student_id=$sid AND type=0");
		$rs = $db->Execute("INSERT INTO grade VALUES($sid,$cid,".$_POST['update_a'].",0)");
		
		$rs = $db->Execute("DELETE FROM grade WHERE student_id=$sid AND type=1");
		$rs = $db->Execute("INSERT INTO grade VALUES($sid,$cid,".$_POST['update_m'].",1)");
		
		$rs = $db->Execute("DELETE FROM grade WHERE student_id=$sid AND type=2");
		$rs = $db->Execute("INSERT INTO grade VALUES($sid,$cid,".$_POST['update_f'].",2)");
	}
	$index=0;
	$tot = array();
  	
    $q  = "select * from course inner join user_teaching using(course_id) where lecturer_id='$dummyFBID' order by name";
    $rs = $db->Execute($q);
    while(!$rs->EOF){
	  $res=$db->Execute("SELECT * FROM grade_formula WHERE course_id=".$rs->fields['course_id']);
	  $p_assessment = ($res->fields['assessment_pcg']+0)/100;
	  $p_mid = ($res->fields['middle_pcg']+0)/100;
	  $p_final = ($res->fields['final_pcg']+0)/100;
      echo "<li><b>".$rs->fields['name']."</b></li><table width='500'>";
	  $res=$db->Execute("SELECT count(course_id) FROM chapter WHERE course_id=".$rs->fields['course_id']);
	  //echo "total chapter ".$tot[$index++]."";
	  $res1=$db->Execute("SELECT * FROM user_student WHERE course_id=".$rs->fields['course_id']);
	  while(!$res1->EOF){
		$res2=$db->Execute("SELECT count(student_id) FROM user_do_chapter 
							WHERE student_id=".$res1->fields['student_id']." AND chapter_id IN 
							(SELECT chapter_id FROM chapter WHERE course_id=".$rs->fields['course_id'].")");
		$res3=$db->Execute("SELECT avg(grade) FROM grade 
							WHERE student_id=".$res1->fields['student_id']." AND course_id=".$rs->fields['course_id']." AND type=0");
		$a_grade=$res3->fields[0]+0;
		$a_grade = number_format($a_grade,0,'.','');
		$res3=$db->Execute("SELECT grade FROM grade 
							WHERE student_id=".$res1->fields['student_id']." AND course_id=".$rs->fields['course_id']." AND type=1");
		$m_grade=$res3->fields[0]+0;
		$m_grade = number_format($m_grade,0,'.','');
		$res3=$db->Execute("SELECT grade FROM grade 
							WHERE student_id=".$res1->fields['student_id']." AND course_id=".$rs->fields['course_id']." AND type=2");
		$f_grade=$res3->fields[0]+0;
		$f_grade = number_format($f_grade,0,'.','');
		$cgrade = $p_assessment*$a_grade + $p_mid*$m_grade + $p_final*$f_grade;
		$cgrade = number_format($cgrade,0,'.','');
		$sfbid = $rs->fields['student_id'];
		$c_user= $facebook->api("$sfbid");
		echo "<tr><td align='right'><a target='_blank' href='http://www.facebook.com/profile.php?id=".$res1->fields['student_id']."' >".$c_user["name"]."<br><img src=\"https://graph.facebook.com/".$res1->fields['student_id']."/picture\"/></a></td><td>learning <b>".number_format((100*($res2->fields[0]/$res->fields[0])),0,'.','')."%</b></td><td>, grade : <b>$cgrade</b> </td><td>(assessment : $a_grade, mid : $m_grade, final : $f_grade)</td><td><input type='button' name='update' value='Update' onClick='processGrade(\"".$res1->fields['student_id']."\",\"".$rs->fields['course_id']."\",$a_grade,$m_grade,$f_grade)'/></td></tr>";
		$res1->MoveNext();
	  }
	  echo "</table><br>";
      $rs->MoveNext();
    }
  ?>
    </ul>
  
	<h4>Update Grades for</h4>
	<form name='sform' id='sform' method='post'>
	<table><tr>
	<td>assessment</td><td><input type='text' id='update_a' name='update_a' /></td></tr>
	<td>middle</td><td><input type='text' id='update_m' name='update_m' /></td></tr>
	<td>final</td><td><input type='text' id='update_f' name='update_f' /></td></tr></table>
	<input type='submit' name='process' value='Process' /><br>
	</form>
	</div>
</div>