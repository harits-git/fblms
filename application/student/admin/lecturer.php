<div class="mainbar">
    <div class="article">
<h2 align="center">List of Lecturer</h2>
<table width="80%" align="center"><tr><td><?=$course_desc;?></td></tr>

<tr bgcolor="#ADE7A3" align="center"><td>Photo</td><td>Name</td><td>Course</td></tr>

<?php
	//$lecturerProfile = $facebook->api('/1175989519');
	//print htmlspecialchars(print_r($lecturerProfile, true));
	//echo $lecturerProfile['id'];
    $sql = "select
                u.lecturer_id as id,c.name as cname
            from
                user_teaching u, course c
            
            where
                c.course_id=u.course_id
    ";
    
    $result = $db->execute($sql);
    
    while(!$result->EOF){
		$id = $result->fields['id'];
        $lecturerProfile = $facebook->api("/".$id);
        echo "<tr><td><a target='_blank' href='http://www.facebook.com/profile.php?sk=info&id=".$id."'><img src=\"https://graph.facebook.com/".$id."/picture\"/></a></td><td><a target='_blank' href='http://www.facebook.com/profile.php?sk=info&id=".$id."'>".$lecturerProfile['name']."</a></td>
                <td>".$result->fields['cname']."</td>
                <td></td>
        ";
        
        $result->MoveNext();
    }
?>
</table>
</div>
</div>