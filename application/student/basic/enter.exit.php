<strong>List of your course</strong><br /><br />
<table width="80%" border="0">
    <tr bgcolor="#D6E360" align="center">
        <td><strong>Course Name</strong></td>
        <td><strong>Lecture Name</strong></td>
        <td><strong># Student</strong></td>
        <td colspan="2"><strong>Action</strong></td>
    </tr>
    <?
        $result=$db->execute("select * from course order by name");
        while(!$result->EOF){
            
            echo '
                <tr>
                    <td>'.$result->fields["name"].'</td>
                    <td>Jhon Doe</td>
                    <td align="center">23</td>
                    <td align="center"><a href="">enter</a>  -  <a href="">exit</a></td>
                </tr>
                ';
            
            $result->MoveNext();
        }
    
    
    ?>


</table>


<?php

/**
 * @author MESMERiZE
 * @copyright 2011
 */



?>