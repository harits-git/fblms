<?php
$count = 0;
$c_user=$facebook->api('/me');
?>

<font color="red"><?=$_GET["msg"];?></font>
<div id="container">
		<h2>Page for Headmaster only</h2>
		Displaying Requests, Please take note of confirmation <a href="index.php?menu=application/headmaster/index.php">refresh</a>
		<h3>Lecturer</h3>
		
<?php
$hpath = "application/headmaster/";
$sql = "SELECT * FROM user WHERE status=0 AND user_type='lecturer'";
$rs = $db->Execute($sql);
	
if (!$rs) 
{
	echo 'Not Executed!</br>';//db->ErrorMsg();
}
else{
	echo "<table>";
	while(!$rs->EOF){
		$fbid = $rs->fields['fbid'];
		$c_user= $facebook->api("$fbid");
		echo "<form method='post' action='index.php?menu=application/headmaster/confirm.php&priv=hm&act=c&type=lecturer&n=".$count."'>";
		echo "<tr><td><img src=\"https://graph.facebook.com/".$fbid."/picture\"/></td><td>".$c_user["name"]."<br><input disabled type='text' name='fbid".$count."' value='".$fbid."'></input>";
		echo "<br><select name='course".$count."'>";
		$sql1 = "SELECT * FROM course";
		$rs1 = $db->Execute($sql1);
		if(!$rs1) echo "error course db";
		else{
			echo "<option value=0 SELECTED>No Course</option>";
			while(!$rs1->EOF){
				echo "<option value=".$rs1->fields['course_id'].">".$rs1->fields['name']."</option>";
				$rs1->MoveNext();
			}
			//echo "<option value='-1'>DENY</option>";
		}
		echo "</select></td><td><button type='submit'>Process</button></td><td><a href='index.php?menu=application/headmaster/confirm.php&priv=hm&act=d&id=".$fbid."'>deny</a></td></tr></form>";
		$count++;
		$rs->MoveNext();
	}
	echo "</table>";
	
	if($count == 0){
		echo "No Request for Lecturer</br>";
	}
	
}
$count = 0;
?>
		</br>
		<h3>Student</h3>
		
<?php
$sql = "SELECT * FROM user WHERE status=0 AND user_type='student'";
$rs = $db->Execute($sql);
	
if (!$rs) 
{
	echo 'Not Executed!</br>';//db->ErrorMsg();
}
else{
	while(!$rs->EOF){
		$fbid = $rs->fields['fbid'];
		$c_user= $facebook->api("$fbid");
		echo "<img src=\"https://graph.facebook.com/".$fbid."/picture\"/>&nbsp".$c_user["name"]."&nbsp<a href='index.php?menu=application/headmaster/confirm.php&priv=hm&act=c&type=student&id=".$fbid."'>confirm</a> or <a href='index.php?menu=application/headmaster/confirm.php&priv=hm&act=d&id=".$fbid."'>deny</a></br>";
		$count++;
		$rs->MoveNext();
	}
	if($count == 0){
		echo "No Request for Student</br>";
	}	
}
echo "<hr><h2>Active Lecturer</h2>";
$sql = "SELECT * FROM user WHERE status=1 AND user_type='lecturer'";
$rs = $db->Execute($sql);
$count = 0;	
if (!$rs) 
{
	echo 'Not Executed!</br>';//db->ErrorMsg();
}
else{
	while(!$rs->EOF){
		$fbid = $rs->fields['fbid'];
		$c_user= $facebook->api("$fbid");
		echo "<img src=\"https://graph.facebook.com/".$fbid."/picture\"/>&nbsp".$c_user["name"]."&nbsp<a href='http://www.hassanhoma.com/fb-lms/index.php?alias=".$fbid."'>check</a> or <a href='index.php?menu=application/headmaster/del.php&priv=hm&act=d&fbid=".$fbid."'>deactivate</a></br>";
		$count++;
		$rs->MoveNext();
	}
	if($count == 0){
		echo "No Active Lecturer</br>";
	}	
}
echo "<br><h2>Active Student</h2>";
$sql = "SELECT * FROM user WHERE status=1 AND user_type='student'";
$rs = $db->Execute($sql);
$count = 0;	
if (!$rs) 
{
	echo 'Not Executed!</br>';//db->ErrorMsg();
}
else{
	while(!$rs->EOF){
		$fbid = $rs->fields['fbid'];
		$c_user= $facebook->api("$fbid");
		echo "<img src=\"https://graph.facebook.com/".$fbid."/picture\"/>&nbsp".$c_user["name"]."&nbsp<a href='http://www.hassanhoma.com/fb-lms/index.php?alias=".$fbid."'>check</a> or <a href='index.php?menu=application/headmaster/del.php&priv=hm&act=d&fbid=".$fbid."'>deactivate</a></br>";
		$count++;
		$rs->MoveNext();
	}
	if($count == 0){
		echo "No Active Student</br>";
	}	
}
echo "<hr><h2>All Deactivated/Denied Users</h2>";
$sql = "SELECT * FROM user WHERE status=-1";
$rs = $db->Execute($sql);
$count = 0;	
if (!$rs) 
{
	echo 'Not Executed!</br>';//db->ErrorMsg();
}
else{
	while(!$rs->EOF){
		$fbid = $rs->fields['fbid'];
		$c_user= $facebook->api("$fbid");
		echo "<img src=\"https://graph.facebook.com/".$fbid."/picture\"/>&nbsp".$c_user["name"]."&nbsp<a href='index.php?menu=application/headmaster/del.php&priv=hm&act=c&fbid=".$fbid."'>reset</a></br>";
		$count++;
		$rs->MoveNext();
	}
	if($count == 0){
		echo "No Deactivated/denied user</br>";
	}	
}
?>
</div>

</br></br><a href="http://www.hassanhoma.com/fb-lms/">headmaster out</a>


