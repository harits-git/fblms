<?php
//require_once $DOCUMENT_ROOT.'/fb-lms/config.php';
echo "Processing ".$type." ID :".$_POST['fbid'.$n.''].$id.", course".$_POST['course'.$n.''];

$priv = $_GET['priv'];
$act= $_GET['act'];
$id= $_GET['id'];
$n = $_GET['n'];
$type = $_GET['type'];

if($priv == 'hm'){
	if($act == 'c'){
		
		$sql = "UPDATE user SET status=1 WHERE fbid='".$_POST['fbid'.$n.''].$id."'";//updating user data

		$rs = $db->Execute($sql);
		if($rs == false){
			echo "error confirming<br>";
		}
		else{
			if ($priv == 'hm') go("application/headmaster/index.php");
			else go("application/lecturer/index.php");
		}
		$sql = "INSERT INTO user_teaching VALUES('".$_POST['fbid'.$n.'']."',".$_POST['course'.$n.''].")";//updating user data

		$rs = $db->Execute($sql);
		if($rs == false){
			echo "error confirming<br>";
		}
		else{
			
			if ($priv == 'hm') go("application/headmaster/index.php");
			else go("application/lecturer/index.php");
		}
	}
	else if($act == 'd'){
		
		$sql = "UPDATE user SET status=-1 WHERE fbid='".$id."'";//inserting the copy of data to user

		$rs = $db->Execute($sql);
		if($rs == false){
			echo "error confirming<br>";
		}
		else{
			if ($priv == 'hm') go("application/headmaster/index.php");
			else go("application/lecturer/index.php");
		}
	}
}else{
	
	home();
	
}

$db->Close();
?>





	