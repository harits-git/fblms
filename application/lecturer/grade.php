<?php
$cid= $_GET['cid'];
	if($_POST['update']){
	$a_pcg = "a_pcg".$cid;
	$m_pcg = "m_pcg".$cid;
	$f_pcg = "f_pcg".$cid;
	$sql = "update grade_formula set 
			assessment_pcg='".$_POST[$a_pcg]."',
			middle_pcg='".$_POST[$m_pcg]."',
			final_pcg='".$_POST[$f_pcg]."' 
			where course_id=$cid";
	$exec = $db->Execute($sql);
	if($exec == false) echo "<h3>Unable to update</h3>";
	else echo "<h3>done updating</h3>";
}
?>
<div class="mainbar">
	<div class="article">
	<h2><span>Course Grade Formula</span></h2>
    <ul>
  <?php
    $q  = "select * from course inner join user_teaching using(course_id) where lecturer_id='$dummyFBID' order by name";
    $rs = $db->Execute($q);
    while(!$rs->EOF){
		$q1 = "select * from grade_formula where course_id='".$rs->fields['course_id']."'";
		$rs1 = $db->Execute($q1);
      echo "<li><form action='index.php?menu=application/lecturer/grade.php&cid=".$rs->fields['course_id']."' method='post'>".$rs->fields['name']."<br>
			<input type='text' size='2' name='a_pcg".$rs->fields['course_id']."' value='".$rs1->fields['assessment_pcg']."'/>% of Assessment<br>
			<input type='text' size='2' name='m_pcg".$rs->fields['course_id']."' value='".$rs1->fields['middle_pcg']."'/>% of Mid Exam<br>
			<input type='text' size='2' name='f_pcg".$rs->fields['course_id']."' value='".$rs1->fields['final_pcg']."'/>% of Final Exam<br>
			<input type='submit' name='update' value='Update'/></form></li>";
      $rs->MoveNext();
    }
  ?>
    </ul>
  
	</div>
</div>