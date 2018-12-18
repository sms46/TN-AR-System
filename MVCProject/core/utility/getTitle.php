<?php

namespace utility;

class getTitle
{
    public static function getTitleForCourses($array)
    {
        if($array!= null) {

            foreach ($array as $row) {

                $title = $row['Department'];
                print $title;
                break;
            }
        }
        else{
            $text = 'No Records present.Please Insert the records';
            print $text;
        }

    }

}

?>