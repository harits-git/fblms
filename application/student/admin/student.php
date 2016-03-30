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
	<h2><span>My Learning Progress and Grades</span></h2>
    <ul>
<?php
$sid= $_GET['sid'];
$cid= $_GET['cid'];
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
  	
    $q  = "select * from course where course_id = ANY (select course_id from user_student where student_id=$dummyFBID) order by name";
    $rs = $db->Execute($q);
    while(!$rs->EOF){
	  $res=$db->Execute("SELECT * FROM grade_formula WHERE course_id=".$rs->fields['course_id']);
	  $p_assessment = ($res->fields['assessment_pcg']+0)/100;
	  $p_mid = ($res->fields['middle_pcg']+0)/100;
	  $p_final = ($res->fields['final_pcg']+0)/100;
      echo "<li><b>".$rs->fields['name']."</b></li><table width='500'>";
	  $res=$db->Execute("SELECT count(course_id) FROM chapter WHERE course_id=".$rs->fields['course_id']);
	  $tot = $res->fields[0];
	  //echo "tot ".$tot;
		$res2=$db->Execute("SELECT count(student_id) FROM user_do_chapter 
							WHERE student_id='$dummyFBID' AND chapter_id IN 
							(SELECT chapter_id FROM chapter WHERE course_id=".$rs->fields['course_id'].")");
		$res3=$db->Execute("SELECT avg(grade) FROM grade 
							WHERE student_id='$dummyFBID' AND course_id=".$rs->fields['course_id']." AND type=0");
		$a_grade=$res3->fields[0]+0;
		$a_grade = number_format($a_grade,0,'.','');
		$res3=$db->Execute("SELECT grade FROM grade 
							WHERE student_id='$dummyFBID' AND course_id=".$rs->fields['course_id']." AND type=1");
		$m_grade=$res3->fields[0]+0;
		$m_grade = number_format($m_grade,0,'.','');
		$res3=$db->Execute("SELECT grade FROM grade 
							WHERE student_id='$dummyFBID' AND course_id=".$rs->fields['course_id']." AND type=2");
		$f_grade=$res3->fields[0]+0;
		$f_grade = number_format($f_grade,0,'.','');
		$cgrade = $p_assessment*$a_grade + $p_mid*$m_grade + $p_final*$f_grade;
		$cgrade = number_format($cgrade,0,'.','');
		echo "<tr><td>progress : <b>".number_format((100*($res2->fields[0]/$tot)),0,'.','')."%</b></td><td>, grade : <b>$cgrade</b> </td><td>(assessment : $a_grade, mid : $m_grade, final : $f_grade)</td></tr>";
		
	  echo "</table><br>";
      $rs->MoveNext();
    }
  ?>
    </ul>
  
	</div>
</div>