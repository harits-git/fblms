<?php 
$id= $_GET['id'];
$type= $_GET['type'];

//require_once $DOCUMENT_ROOT.'/fb-lms/config.php';
//echo "Processing ".$type." Database...";

//echo $type.",".$id."<br>";
if($type != 'headmaster'){
	$sql = "INSERT INTO user VALUES('".$id."','".$type."','','0')";

	$exec = $db->Execute($sql);
	if($exec == false){
		echo "error registering $id,$type<br>";
	}
	echo "<a href='http://www.hassanhoma.com/fb-lms/'>back to index</a>";
		
}else{
	$sql = "SELECT * FROM user WHERE fbid='".$id."' ";

	$rs = $db->Execute($sql);
	
	echo "id : ".$id.", type : ".$type.", pass : ".$_POST['password'];
	if($_POST['password'] == $rs->fields['password']){
		go("application/headmaster/index.php");
	}else{
		home();
	}
	
}
$db->Close();
?>





	