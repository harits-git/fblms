<?php
//require_once $DOCUMENT_ROOT.'/fb-lms/config.php';
$type = $_GET['type'];
$priv = $_GET['priv'];
$act= $_GET['act'];
$id= $_GET['id'];
$n= $_GET['n'];
//echo "Processing ".$type.$act." ID :".$_POST['fbid'.$n.''].$id.", course".$_POST['course'.$n.''];
//echo $priv;
if($priv == 'tc'){
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
		
	}
	else if($act == 'd'){
		
		$sql = "UPDATE user SET status=-1 WHERE fbid='".$id."'";//inserting the copy of data to user
		echo $sql;
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

//$db->Close();
?>





	