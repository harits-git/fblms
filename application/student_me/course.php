<div class="clr"></div>
      <div class="mainbar">
	  <?php 
	  $cid= $_GET['cid'];
	  $sql = "select * from course where course_id = ".$cid ;
			$rs = $db->Execute($sql);
			if(!$rs) : echo "error DB";
			else :?>
        <div class="article">
          <h2><span><?php echo $rs->fields['name'] ?></span></h2>
          <div class="clr"></div>
          <p class="infopost">Start <span class="date">on<b> <?php echo date("d F Y",strtotime($rs->fields['start'])); ?></b>	</span> until <span class="date"><b><?php echo date("d F Y",strtotime($rs->fields['end'])); ?></b></span> <br>Created by <a>&nbsp;<?php echo $rs->fields['creator'];?></a> &nbsp;|
          <div class="fl">
          <h3>Course Requirements</h3>
		  <p><?php echo $rs->fields['requirement'];?></p>
		  <h3>Course Expectation</h3>
		  <p><?php echo $rs->fields['expectation'];?></p>
		  <h3>Course Requirements</h3>
		  <p><?php echo $rs->fields['objective'];?></p>		  
		  <h3>Course Assignments</h3>
		  <p><?php echo $rs->fields['assignment'];?></p>
		  <h3>Course Grading</h3>
		  <p><<?php $grade=$db->Execute("select * from grade_formula where course_id='$cid'");
      
      echo "Grade Formula :<br>FinalGrade = ".$grade->fields['assessment_pcg']."%*Assessment
       + ".$grade->fields['middle_pcg']."%*MiddleExam 
       + ".$grade->fields['final_pcg']."%*FinalExam";
      ?></p>
          </div>         
        </div>
		<?php endif ?>
        
      </div>
      <div class="sidebar">
        <div class="gadget">
          <h2 class="star"><span>Student Courses</span> Menu</h2>
          <div class="clr"></div>
          <ul class="sb_menu">
            <?php 
			$count = 0;
			$sql = "select * from course where course_id = ANY (select course_id from user_student where student_id=".$dummyFBID.")" ;
			$rs = $db->Execute($sql);
			if(!$rs) echo "error DB";
			else{
				while(!$rs->EOF){
					echo "<li><a href='index.php?menu=application/student_me/course.php&cid=".$rs->fields['course_id']."'>".$rs->fields['name']."</a><br /></li>";
					$count++;
					$rs->MoveNext();
				}
				
			}
			//echo $count;
			if($count == 0){
					echo "<li>No class</li>";
				}
			?>
          </ul>
        </div>
        <div class="gadget">
          <h2 class="star"><span>Outline and Learning</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu"><table>
            <?php 
			$sql = "select * from chapter where course_id=".$cid;
			$count = 0;
			$rs = $db->Execute($sql);
			if(!$rs) echo "error DB";
			else{
				while(!$rs->EOF){
					$rs2 = $db->Execute("select * from resource where chapter_id='".$rs->fields['chapter_id']."'");
					$rs3 = $db->Execute("select * from assessment where chapter_id='".$rs->fields['chapter_id']."'");
					echo "<tr><td>".++$count.".</td><td>".$rs->fields['title'];
					if($rs2->fields['url'] != ""){
						echo "</td><td><a target='_blank' 
								href='resource/learn.php?
								type=$userType&
								sid=".$dummyFBID."&
								chid=".$rs2->fields['chapter_id']."&
								title=".$rs2->fields['title']."&
								res=".$rs2->fields['url']."' >read</a></td>";
					}
					if($rs3->fields['url'] != ""){
						echo "<td><a target='_blank' 
								href='assessment/learn.php?
								type=$userType&
								sid=".$dummyFBID."&
								aid=".$rs3->fields['assm_id']."&
								chid=".$rs3->fields['chapter_id']."&
								title=".$rs3->fields['title']."&
								res=".$rs3->fields['url']."'>assess</a></td></tr>";
					}
					$rs->MoveNext();
				}
				
			}
			
			?>
          </table></ul>
        </div>
	</div>