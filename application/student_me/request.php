<div class="mainbar">
	<div class="article">
		<h2><span>Processing New</span> Request</h2>
		<?php 
		$cid = $_GET['cid'];
		//echo "course : ".$cid." fbid : ".$dummyFBID."<br>";
		$sql = "INSERT INTO user_student(student_id,course_id) VALUES('".$dummyFBID."','".$cid."')";

		$exec = $db->Execute($sql);
		if($exec == false){
			echo "error registering<br>";
		}//else{
			//echo "<div class=\"fb-comments\" data-href=\"https://apps.facebook.com/social_lms/\" data-num-posts=\"2\" data-width=\"500\"></div>";
			go("application/student_me/index.php");
		//}
		?>
		
		
	
	</div>
</div>