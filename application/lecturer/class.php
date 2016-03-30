
<div class="mainbar">
	<div class="article">
		<h2><span>Courses</span></h2>
			Lecturer can display all his/her classes and create new class<br>
			New Lecturer can select to be a teacher of certain class(es)
		
	</div>
</div>
<div class="sidebar">
	<div class="gadget">
	  <h3 class="star"><span>Create New Classes</h3>
	  <div class="clr"></div>
	  <ul class="sb_menu">
		<li><a href="index.php?menu=application/lecturer/new">Create</a></li>		
	  </ul>
	</div>
	<div class="gadget">
	  <h3 class="star"><span>Classes</h3>
	  <div class="clr"></div>
	  <ul class="sb_menu">
	  <?php $sql = "SELECT class_id,name 
					FROM class
					WHERE class_id = ANY(
						SELECT class_id FROM user_teaching WHERE lecturer_id=".$dummyFBID."
					)";
			$rs = $db->Execute($sql);
			if(!$rs) echo "<li>error</li>";
			else{
				while(!$rs->EOF){
					echo "<li><a href='index.php?class_id=".$rs->fields['class_id']."&menu=application/lecturer/class'>".$rs->fields['name']."</a></li>";
					$rs->MoveNext();
				}
			}
	  ?>
	  </ul>
	</div>
</div>