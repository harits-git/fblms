<html>
<head><title><?php echo "Resource : ".$title;?></title>
</head>
<body>
<div class="mainbar">
	<div class="article">
	<?php 
	$res= $_GET['res'];
	$type= $_GET['type'];
	$sid= $_GET['sid'];
	$aid= $_GET['aid'];
	echo "<a href='$res'>get it!</a><br><embed src='$res' TYPE='application/x-pdf' TITLE='title' width='600' height='800'>";
		
	?>
	</div>
</div>
</body>
</html>
<?
php include '../config.php';
if($type=="student"){
	$log = $db->Execute("select * from user_do_assessment where student_id=$sid and assm_id=$aid");
	if($log->fields['student_id'] == '') $db->Execute("INSERT into user_do_assessment values($sid,$aid,'assessment','')");
	// else{
		// echo "<br>You have been here before";
	// }
}

?>