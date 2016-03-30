<?php
/*$res = $db->Execute("select * from user where user_type!='student'");
$index=0;

while(!$res->EOF){
	if($index<1) $dest = $res->fields['lecturer_id'];
	else $dest .= ",".$res->fields['lecturer_id'];
	$index++;
	$res->MoveNext();
}*/
unset($_SESSION["alias"]);
?>
<link rel="stylesheet" href="application/login/css/screen.css" media="screen" />
<font color="red"><?=$_GET["msg"];?></font>
<div id="container">
		<?php if ($userType != 'headmaster'):?>
		You are going to register as a Student (id = <?php echo $dummyFBID ;?>)
		<form id="form1" <?php echo "action='http://www.hassanhoma.com/fb-lms/index.php?menu=application/login/register.php&id=".$dummyFBID."&type=student'";?> method="post">
			<fieldset><legend>New Student</legend>
				<p>
					I agree to the regulations as a student, by clicking this button
				</p>
				
			</fieldset>
			<p class="submit"><button type='submit' id='student' >Student</button></br></p>				
		</form>
		
        </br></br>
		If You want to register as a Lecturer (id = <?php echo $dummyFBID ;?>)
		
		<form id="form1" action="http://www.hassanhoma.com/fb-lms/index.php?menu=application/login/register.php&id=<?php echo $dummyFBID ;?>&type=lecturer" method="post">
			<fieldset><legend>New Lecturer</legend>
				<p>
					I agree to the regulations as a Lecturer, by clicking this button
				</p>
				
			</fieldset>
							

			<p class="submit"><button id='lecturer' type='submit'>Lecturer</button></br></p>		
						
		</form>
		<?php else:?>
		If You want to LOGIN as HEADMASTER
		
		<form id="form1" action="http://www.hassanhoma.com/fb-lms/index.php?menu=application/login/register.php&id=<?php echo $dummyFBID ;?>&type=headmaster" method="post">
			<fieldset><legend>HEADMASTER</legend>
				<p>
					<label for="name">Welcome Sir, please insert your password</label>
				</p>
				<p>
					<label for="password">Password</label>
					<input type="password" name="password" id="password" size="30" />
                    
				</p>
				
			</fieldset>
							

			<p class="submit"><button type="submit">Headmaster</button></br></p>		
						
		</form>
		<?php endif?>
</div>

