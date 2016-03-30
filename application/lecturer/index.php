<div class="mainbar">
	<div class="article">
		Here Lecturer can view requests of his classes, reminder of coming activities (live learning, un-open feedbacks)
		<?php
		//echo "status ".$userStatus;
		if($userStatus > 0){
			echo "<h2><span>Hello</span>, Lecturer</h2>";
			echo "<h4>New Student request</h4><table>";
			$count = 0;
			$sql = "SELECT * FROM user WHERE user_type='student' AND status=0";
			$rs = $db->Execute($sql);
				
			if (!$rs) 
			{
				echo 'Not Executed!</br>';//db->ErrorMsg();
			}
			else{
				while(!$rs->EOF){
					$fbid = $rs->fields['fbid'];
					$c_user= $facebook->api("$fbid");
					echo "<tr><td><a target='_blank' href='http://www.facebook.com/profile.php?id=".$fbid."' >".$c_user["name"]."<br><img src=\"https://graph.facebook.com/".$fbid."/picture\"/></a></td><td> <a href='index.php?menu=application/lecturer/confirm_student.php&priv=tc&act=c&id=".$fbid."'>confirm</a> <br> or <br> <a href='index.php?menu=application/lecturer/confirm_student.php&priv=tc&act=d&id=".$fbid."' ><c>deny</c></a></td></tr>";
					$count++;
					$rs->MoveNext();
				}
				if($count == 0){
					echo "No Request for Student</br>";
				}	
			}
			echo "</table>";
		}else{
			echo "<h2><span>Ooops</span>, I am Sorry Lecturer</h2>";
			echo "<h4>You are not yet confirmed or neither denied by the Headmaster as a Lecturer</h4>";
		}
		?>
	</div>
</div>
