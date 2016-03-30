<?php
if(!isset($_GET["type"]) || !isset($_GET["id"])){
  echo "Status: 404 Not found";
} else {
  if(!isset($_SERVER["HTTP_REFERER"])){
	echo "you cannot delete this way.. just click the previous link.";
  } else {
    $type = $_GET["type"];
    $id   = $_GET["id"];
  
    $q = "";
    if($type=="ch"){
	  $q = "delete from chapter where chapter_id='$id'";
    } else if($type=="res"){
  	  $q = "delete from resource where res_id='$id'";
    } else if($type=="asm"){
	  $q = "delete from assessment where assm_id='$id'";
    }
    echo $q;
    $rs = $db->Execute($q);
    go("application/lecturer/course.php");
  }
}
?>