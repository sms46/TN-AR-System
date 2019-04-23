<?php

namespace utility;

class htmlTable
{
    public static function generateTableForCourses($array,$resPrice,$commPrice)
    {
        if($array!= null) {
            echo "<div class=\"table-responsive\">";
            echo "<table class=\"table table-striped\">";

            echo "<thead class=\"thead-dark shadow-lg p-3 mb-5 bg-white rounded \">";
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
                          <td>" .'$'. $resPrice . "</td>
                          <td>" .'$'. $commPrice . "</td>
                    </tr>";
             }

            echo "</table>";
            echo "</div>";
        }
        else{
                $text = 'No Records present. Please Insert the records';
                print $text;
        }
    }

    //Table for user grant access by the admin 
    public static function generateTableForAccess($array)
    {
        if($array!= null) {
            echo "<div class=\"table-responsive\">";
            echo "<table class=\"table table-striped\">";

            echo "<thead class=\"thead-dark shadow-lg p-2 mb-1 bg-white rounded \">";
            echo "<tr>
                        <th>User Name</th>
                        <th>Grant Access</th>
                 </tr>";
            echo "</thead>";

            foreach ($array as $row) {
                echo
                    "<tr>
                         <td>" . $row->user_name. "</td>
                         <td><input type=\"checkbox\" name=\"grant[]\" value=". $row->user_name."></td>
                    </tr>";
            }

            echo "</table>";
            echo "</div>";
        }
        else{
            $text = 'No Records present.';
            print $text;
        }
    }

    // Dynamic table generated for all html tables
    public static function generateTableForTest($array)
    {
        if($array!= null) {
            $columns = array();

            echo "<table class=\"table table-striped table-responsive\"><tbody>";

            foreach ($array as $name => $values) {
                echo "<tr>";
                foreach ($values as $k => $v) {
                    echo "<td>$v</td>";
                    $columns[$k] = $k;
                }
                echo "</tr>";
            }
            echo "</tbody><thead class=\"thead-dark shadow-lg p-3 mb-5 bg-white rounded \"><tr>";
            foreach ($columns as $column) {
                echo "<th>$column</th>";
            }
            echo "</thead></table>";
        }
        else{
            $text = 'No Records present. Please Insert the records';
            print $text;
        }
    }
}

?>