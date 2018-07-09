<?php

namespace utility;

class htmlTable
{
    public static function genarateTableForCourses($array)
    {
        if($array!= null) {
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
                  <td>" .'$' .$row['ResidentialPrice'] . "</td>
                  <td>" . '$'. $row['CommuterPrice'] . "</td>
                </tr>";
            }

            echo "</table>";
        }
        else{
                $text = 'No Records present.Please Insert the records';
                print $text;
        }
    }
}

?>