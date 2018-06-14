<?php

namespace utility;

class htmlTable
{
    public static function genarateTableForCourses($array)
    {
        if($array!= null) {
            echo "<table class=\"table table-striped\">";

            echo "<thead class=\"thead-dark\">";
            echo "<tr>
                        <th>Session</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Residential Price</th>
                        <th>Commuter Price</th>
                 </tr>";
            echo "</thead>";

            foreach ($array as $row) {
                echo
                    "<tr>
                  <td>" . $row['Session'] . "</td>
                  <td>" . $row['Description'] . "</td>
                  <td>" . $row['StartDate'] . "</td>
                  <td>" . $row['EndDate'] . "</td>
                  <td>" . $row['ResidentialPrice'] . "</td>
                  <td>" . $row['CommuterPrice'] . "</td>
                </tr>";
            }

            echo "</table>";
        }
        else{
                $text = 'No Records present.Please Insert the records';
                print $text;
        }
    }
    
    public static function genarateTableForCourseSelection($array)
    {
        if($array!= null) {

            echo "";
            echo "<table class=\"table table-striped\">";

            echo "<thead class=\"thead-dark\">";
            echo "<tr>
                        <th>Session</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Select Course</th>
                 </tr>";
            echo "</thead>";

            foreach ($array as $row) {
                echo
                    "<tr>
                        <td>" . $row['Session'] . "</td>
                        <td>" . $row['Description'] . "</td>
                        <td>" . $row['StartDate'] . "</td>
                        <td>" . $row['EndDate'] . "</td>
            
                        <td>
                        
                            <form method=\"post\" action=\"index.php?page=accounts&action=createTable\">
                                <input type=\"submit\" name=\"action\" href= \"index.php?page=accounts&action=createTable\" class=\"btn btn-success\" value=\"Add\"/>
                                <input type=\"hidden\" name=\"id\" value=\" ".$array ."\"/>
                            </form>
                       
                        </td>                     
                    </tr>";
            }

            echo "</table>";
            echo "</form>";

        }
        else{
                $text = 'No Records present.Please Insert the records';
                print $text;
        }
    }
}

?>