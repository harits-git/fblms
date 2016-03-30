<strong>This pages will guide you (as student) how to register or unregister</strong><br /><br />
<form method="post" action="">
<table>
    <tr>
    <td>Course Name : </td>
    <td>
        <select name="course">
            <option value="">==== Please select class ====</option>
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
    </td>
    </tr>

    
</table>

</form>

<?php

/**
 * @author MESMERiZE
 * @copyright 2011
 */

    if($_POST["submit"]=='Process'){
        
        $result = $db->execute("select * from course where course_id='".$_POST["course"]."'");
        while(!$result->EOF){
            $course_name = $result->fields["name"];
            
            $result->MoveNext();
        }
        
        echo '<form method="post" action="">';
        echo 'Are you sure to register/unregister from <b>'.$course_name.' ?</b>   ';
        echo '<input type="submit" name="submit" value="Yes, I am">
                </form>';
        
        
    }
    else if ($_POST["submit"]=='Yes, I am'){
        
        echo 'Congratulation, you are registered/unregistered';
        
    }

?>






