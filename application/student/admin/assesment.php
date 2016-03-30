<div class="mainbar">
    <div class="article">
<h2>Due dates of assesment</h2>
<table width="80%" align="center"><tr><td><?=$course_desc;?></td></tr></table><br />
<table bgcolor="#D8B1B1">
<?php

/**
 * @author MESMERiZE
 * @copyright 2011
 */

$result=$db->execute("select * from schedules");
while(!$result->EOF){
    
    echo '<tr><td>'.nl2br($result->fields["content"]).'</td></tr>';
    $result->MoveNext();
}

?>
</table>
</div>
</div>