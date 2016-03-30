<div class="clr"></div>
      <div class="mainbar">
        <div class="article">
        <?php
        if($userStatus < 1){
        	echo "<h2><span>Ooops</span>, I am Sorry Student ".$user_profile['name']."</h2>";
		echo "<h4>You are not yet confirmed or neither denied to be a student.</h4>";
        }else{
        ?>
          <h2><span>Welcome</span> <?php echo $user_profile['name'];?></h2>
          <div class="clr"></div>
          
          <img src="http://brainmeasures.com/courses/Personal%20trainer/images/contEDU.jpg" width="201" height="146"/>
          <p>Select Course on the right menu, You can join or enter a course.</p>
          
          
        </div>
        
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
          <h2 class="star"><span>Other Courses</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu"><table>
            <?php 
			if($count == 0) $sql = "select * from course";
			else $sql = "select * from course where course_id != ALL (select course_id from user_student where student_id=".$dummyFBID.")";
			$count = 0;
			$rs = $db->Execute($sql);
			if(!$rs) echo "error DB";
			else{
				while(!$rs->EOF){
					echo "<tr><td><a href='index.php?menu=application/student_me/request.php&cid=".$rs->fields['course_id']."'>Join</a></td><td>".$rs->fields['name']."</td></tr>";
					$count++;
					$rs->MoveNext();
				}
				
			}
			//echo $count;
			if($count == 0){
					echo "<li>Joined All Classes</li>";
				}
			?>
          </table></ul>
        </div>
	</div>
	<?php } ?>