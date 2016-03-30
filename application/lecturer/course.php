<?php
	$number = 0;
  if(isset($_POST["cid"])){
    $q  = "insert into chapter values(null,'".$_POST["cid"]."','".$_POST["title"]."')";
    $rs = $db->Execute($q);
  }
?>
<div class="mainbar">
	<div class="article">
	
<?php
  if(empty($_GET["cid"])){
?>
		<h2><span>Courses</span></h2>
		<h3><a href="index.php?menu=application/lecturer/new.course.php">New Course</a></h3>
    <ul>
  <?php
    $q  = "select * from course inner join user_teaching using(course_id) where lecturer_id='$dummyFBID' order by name";
    $rs = $db->Execute($q);
    while(!$rs->EOF){
      echo "<li><a href='index.php?cid=".$rs->fields['course_id']."&menu=application/lecturer/course.php'>".$rs->fields['name']."</a></li>";
      $rs->MoveNext();
    }
  ?>
    </ul>
  <?php
  } else {
    $cid=$_GET["cid"];
    $q  = "select * from course where course_id='$cid'";
    $rs = $db->Execute($q);
    if($rs->EOF){
      echo "error.. course not exist";  // handle this error (redirect to 404?) next time..
    } else {
  ?>
    <dl>
      <dt>Course Name :: <?php echo "<a href='index.php?cid=".$rs->fields['course_id']."&menu=application/lecturer/edit.course.php'>edit</a>";?></dt>
      <dd><?php echo $rs->fields['name']; ?></dd>
      <dt>Timeline</dt>
      <dd><?php echo date("d F Y",strtotime($rs->fields['start']))." <b>until</b> ".date("d F Y",strtotime($rs->fields['end'])); ?></dd>
      <dt>Requirement</dt>
      <dd><?php echo $rs->fields['requirement']; ?></dd>
      <dt>Expectation</dt>
      <dd><?php echo $rs->fields['expectation']; ?></dd>
      <dt>Objective</dt>
      <dd><?php echo $rs->fields['objective']; ?></dd>
	  <dt>Grading</dt>
      <dd><?php $grade=$db->Execute("select * from grade_formula where course_id='$cid'");
      
      echo "Grade Formula :<br>FinalGrade = ".$grade->fields['assessment_pcg']."%*Assessment
       + ".$grade->fields['middle_pcg']."%*MiddleExam 
       + ".$grade->fields['final_pcg']."%*FinalExam";
      ?></dd>
	  <dt>Tasks</dt>
      <dd><?php echo $rs->fields['assignment']; ?></dd>
	  <dt>Created by:</dt>
      <dd><?php echo $rs->fields['creator']; ?></dd>
    </dl>
    <!-- Chapters -->
    <table>
      <thead>
        <tr><th>Ch.#</th><th>Title</th><th>&nbsp;</th></tr>
      </thead>
      <tbody>
<?php
    $q  = "select * from chapter where course_id='$cid' order by chapter_id";
    $rs = $db->Execute($q);
    while(!$rs->EOF){ ?>
        <tr>
          <td><?php echo ++$number; ?></td>
          <td>
              <?php echo $rs->fields['title']; ?></td>
          <td><a href="index.php?cid=<?php echo $cid; ?>&chid=<?php echo $rs->fields['chapter_id']; ?>&menu=application/lecturer/chapter.php">Detail</a> :: <a href="index.php?type=ch&id=<?php echo $rs->fields['chapter_id']; ?>&menu=application/lecturer/delete.php">Delete</a></td>
        </tr>
<?php
      $rs->MoveNext();
    }
?>
        <tr><form method="post" action="">
          <td><input type="hidden" name="cid" value="<?php echo $cid; ?>">&nbsp;</td>
          <td><input type="text" name="title" maxlength="30"></td>
          <td><input type="submit" value="add"></td>
        </form></tr>
      </tbody>
    </table>
  <?php
    }
  }
  ?>
	</div>
</div>