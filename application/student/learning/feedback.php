<form method="post" action="">
<strong>Feedback</strong><br /><br />

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
        
        </select>


<br /><br />
Your Feedback :<br />
<textarea rows="5" cols="100" name="feedback"></textarea><br />
<div align="left">
<input type="submit" name="submit" value="Send Feedback"/>
</div>
</form>

<?php

/**
 * @author MESMERiZE
 * @copyright 2011
 */

if($_POST["submit"]){
    
    $result=$db->execute("insert into feedback values('".$_SESSION["username"]."',
                                                        '".$_POST["course"]."',
                                                        '".$_POST["feedback"]."'
                                                        )");
    
    echo '<b><font color="#051AFC"><blink>Your feedback has been sent.</blink></font></b>';
}


?>