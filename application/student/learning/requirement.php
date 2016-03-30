
<strong>Student Requirement, Expectation, and Objectives Learning</strong><br /><br />

<form method="post" action="">

Choose the course : 
        <select name="course">
            <option value="">==== Please select course ====</option>
        <?
            $result = $db->execute("select c.name, c.course_id from course c order by name");
            while(!$result->EOF){
                
                if($_POST["course"]==$result->fields["course_id"])
                    $t = ' selected';
                else
                    $t = '';
                
                echo '<option value="'.$result->fields["course_id"].'" '.$t.'>'.$result->fields["name"].'</option>';
                
                $result->MoveNext();
            }
        
        ?>
        
        </select><input type="submit" name="submit" value="Process"/>

</form>
<hr /><br />
<?php

/**
 * @author MESMERiZE
 * @copyright 2011
 */
 
 
 if($_POST["submit"]){
    
    $result = $db->execute("select * from course where course_id='".$_POST["course"]."'");
    while(!$result->EOF){
        
        $course_name = $result->fields["name"];
        $course_desc = $result->fields["description"];
        $course_start = $result->fields["start"];
        $course_end = $result->fields["end"];
        $course_req = $result->fields["requirement"];
        $course_exp = $result->fields["expectation"];
        $course_obj = $result->fields["objective"];
        $course_home = $result->fields["homework"];
        $course_grades = nl2br($result->fields["grades"]);
        $course_out = nl2br($result->fields["outline"]);
        $course_res = nl2br($result->fields["resources"]);
        
        $result->MoveNext();
    }
    
    
    ?>
 

<h2><font color="#0821FC">Course Information</font></h2>
<h3><?=$course_name;?></h3> (start from : <?=$course_start;?> end : <?=$course_end;?>)<hr />

<font size="+2" color="#63041A">Description</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_desc;?></td></tr></table>

<font size="+2" color="#63041A">Requirement</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_req;?></td></tr></table>

<font size="+2" color="#63041A">Objective</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_obj;?></td></tr></table>

<font size="+2" color="#63041A">Expectation</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_exp;?></td></tr></table>

<font size="+2" color="#63041A">Homework</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_home;?></td></tr></table>

<font size="+2" color="#63041A">Grades</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_grades;?></td></tr></table>

<font size="+2" color="#63041A">Outline</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_out;?></td></tr></table>

<font size="+2" color="#63041A">Resources</font><br /><br />
<table width="80%" bgcolor="#E4E599" align="center"><tr><td><?=$course_res;?></td></tr></table>
<?
}


?>