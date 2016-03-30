<?php
	$number=0;
	//echo "nama ".$_POST['resfile'].$_POST["url"];
  if(isset($_POST["chid"])){
	if($_POST["url"] !=  ""){ 
		$q  = "insert into resource values(null,'".$_POST["chid"]."','".$_POST["url"]."','".$_POST["title"]."')";
	}
	else {
		
		if ($_FILES["resfile"]["error"] > 0)
			{
				echo "Return Code: " . $_FILES["resfile"]["error"] . "<br />";
			}
		  else
			{
			if (file_exists("./resource/" . $_FILES["resfile"]["name"]))
			  {
				echo "<p>".$_FILES["resfile"]["name"] . " already exists. </p>";
			  }
			else
			  {
				move_uploaded_file($_FILES["resfile"]["tmp_name"], "./resource/" . $_FILES["resfile"]["name"]);
				$q  = "insert into resource values(null,'".$_POST["chid"]."','".$_FILES["resfile"]["name"]."','".$_POST["title"]."')";
			  }
			}

	}
	  
  } else {
	if ($_FILES["resfile"]["error"] > 0)
	{
		echo "Return Code: " . $_FILES["resfile"]["error"] . "<br />";
	}
    else
	{
		if (file_exists("./assessment/" . $_FILES["resfile"]["name"]))
		  {
			echo "<p>".$_FILES["resfile"]["name"] . " already exists. </p>";
		  }
		else
		  {
			move_uploaded_file($_FILES["resfile"]["tmp_name"], "./assessment/" . $_FILES["resfile"]["name"]);
			
		  }
	}
	  $q  = "insert into assessment values(null,'".$_POST["chid1"]."','".$_POST["title"]."','".$_FILES["resfile"]["name"]."')";
	}
    $rs = $db->Execute($q);
?>
<div class="mainbar">
	<div class="article">
<?php
  if(empty($_GET["chid"])){
	echo "error.. 404";
  } else {
    $chid=$_GET["chid"];
    $q  = "select * from chapter where chapter_id='$chid'";
    $rs = $db->Execute($q);
    if($rs->EOF){
      echo "error.. chapter not exist";  // handle this error (redirect to 404?) next time..
    } else {
  ?>
    <dl>
      <dt>Course Code</dt>
      <dd><?php echo $rs->fields['course_id']; ?></dd>
      <dt>Chapter</dt>
      <dd><?php echo $rs->fields['chapter_id']; ?></dd>
      <dt>Title</dt>
      <dd><?php echo $rs->fields['title']; ?></dd>
    </dl>
    <!-- Resources -->
	<h2><span>Resources</span></h2>
	<<<a href=<?php echo "index.php?cid=".$rs->fields['course_id']."&menu=application/lecturer/course.php"; $cidb = $rs->fields['course_id'];?>>back to course</a>
    <table>
      <thead>
        <tr><th>Res.#</th><th>Title</th><th>File..........................................OR</th><th>........................URL</th><th>&nbsp;</th></tr>
      </thead>
      <tbody>
<?php
    $q  = "select * from resource where chapter_id='$chid' order by res_id";
    $rs = $db->Execute($q);
    while(!$rs->EOF){ ?>
        <tr>
          <td><?php echo ++$number; ?></td>
          <td><?php echo $rs->fields['title']; ?></td>
          <td><a target="_blank" href="resource/learn.php?<?php echo "title=".$rs->fields['title']."&res=".$rs->fields['url']; ?>">get</a></td>
          <td><a href="index.php?type=res&id=<?php echo $rs->fields['res_id']; ?>&menu=application/lecturer/delete.php">Delete</a></td>
        </tr>
<?php
      $rs->MoveNext();
    }
?>
        <tr><form method="post" action="" enctype="multipart/form-data">
          <td><input type="hidden" name="chid" value="<?php echo $chid; ?>">&nbsp;</td>
          <td><input type="text" name="title" maxlength="50"></td>
          <td><input type="file" name="resfile" /></td>
          <td><input type="text" name="url" maxlength="30"></td>
          <td><input type="submit" value="add"></td>
        </form></tr>
      </tbody>
    </table>
    <!-- Assessments -->
	</br></br>
	<h2><span>Assessments</span></h2>
	<<<a href=<?php echo "index.php?cid=".$cidb."&menu=application/lecturer/course.php";?>>back to course</a>
    <table>
      <thead>
        <tr><th>Assm.#</th><th>Title</th><th>File</th><th>&nbsp;</th></tr>
      </thead>
      <tbody>
<?php
    $number = 0;
	$q  = "select * from assessment where chapter_id='$chid' order by assm_id";
    $rs = $db->Execute($q);
    while(!$rs->EOF){ ?>
        <tr>
          <td><?php echo ++$number; ?></td>
          <td><?php echo $rs->fields['title']; ?></td>
          <td><a target="_blank" href="assessment/learn.php?res=<?php echo $rs->fields['url']; ?>">get</a></td>
          <td><a href="index.php?type=asm&id=<?php echo $rs->fields['assm_id']; ?>&menu=application/lecturer/delete.php">Delete</a></td>
        </tr>
<?php
      $rs->MoveNext();
    }
?>
        <tr><form method="post" action="" enctype="multipart/form-data">
          <td><input type="hidden" name="chid1" value="<?php echo $chid; ?>">&nbsp;</td>
          <td><input type="text" name="title" maxlength="50"></td>
		  <td><input type="file" name="resfile" /></td>
          <td><input type="submit" value="add"></td>
        </form></tr>
      </tbody>
    </table>
  <?php
    }
  }
  ?>
	</div>
</div>