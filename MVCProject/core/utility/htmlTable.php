<?php

namespace utility;

class htmlTable
{
    public static function generateTableForCourses($array)
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
                          <td>" . $row['id'] . "</td>
                          <td>" . $row['Description'] . "</td>
                          <td>" . $row['StartDate'] . "</td>
                          <td>" . $row['EndDate'] . "</td>
                          <td>" .'$'. $row['ResidentialPrice'] . "</td>
                          <td>" .'$'. $row['CommuterPrice'] . "</td>
                    </tr>";
             }

            echo "</table>";
        }
        else{
                $text = 'No Records present.Please Insert the records';
                print $text;
        }
    }

    //TO-DO: Remove this function later
    public static function generateTableForAdmin($array)
{
    if($array!= null) {
        echo "<table class=\"table table-striped\">";

        echo "<thead class=\"thead-dark shadow-lg p-3 mb-5 bg-white rounded \">";
        echo "<tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Email</th>
                        <th>Order Num</th>
                        <th>Order Status</th>
                        <th>Payment Status</th>
                 </tr>";
        echo "</thead>";

        foreach ($array as $row) {
            echo
                "<tr>
                          <td>" . $row->id . "</td>
                          <td>" . $row->studentName . "</td>
                          <td>" . $row->studentEmail . "</td>
                          <td>" . $row-> orderNum . "</td>
                          <td>" . $row-> orderConfirmed . "</td>
                          <td>" . $row->paymentStatus . "</td>
                    </tr>";
        }

        echo "</table>";
    }
    else{
        $text = 'No Records present.Please Insert the records';
        print $text;
    }
}

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
            $text = 'No Records present.Please Insert the records';
            print $text;
        }
    }
}

?>