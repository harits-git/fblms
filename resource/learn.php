<html>
<head><title><?php 
$title= $_GET['title'];
$res= $_GET['res'];
$type= $_GET['type'];
$sid= $_GET['sid'];
$chid= $_GET['chid'];
echo "Resource : ".$title;?></title>
</head>
<body>
<div class="mainbar">
	<div class="article">
	<?php 

	echo "<a href='$res'>get it!</a><br><embed src='$res' TYPE='application/x-pdf' TITLE='$title' width='600' height='800'>";
		
	include '../config.php';//$_SERVER["DOCUMENT_ROOT"].
if($type=="student"){
	$log = $db->Execute("select * from user_do_chapter where student_id=$sid and chapter_id=$chid");
	if($log->fields['student_id'] == '') $db->Execute("INSERT into user_do_chapter values($sid,$chid)");
	//else echo "<br>You have been here before";
}

?>
</div>
</div>
</body>
</html>