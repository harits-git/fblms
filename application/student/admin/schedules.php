<div class="mainbar">
    <div class="article">
<h2>Schedules</h2>

<table bgcolor="#FFFFFF">
<?php

$number=0;

$rs=$db->Execute("select * from schedules 
					  where course_id IN 
					  (select course_id from user_student where student_id=".$dummyFBID.") order by date,time");
while(!$rs->EOF){
    $rs1 = $db->Execute("select * from course where course_id=".$rs->fields['course_id']);
    echo "<tr><td>".++$number."&nbsp</td><td><b>".$rs->fields['content']."</b>,&nbsp</td>
					<td>".date("H:i",strtotime($rs->fields['time']))."</td>
					<td>of ".date("d F Y",strtotime($rs->fields['date']))."</b></td>
		  </tr>";
    $rs->MoveNext();
}

?>
</table>
</div>
</div>