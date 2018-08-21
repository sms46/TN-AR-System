<?php

class adminController extends http\controller
{
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            //PRINT $adminName;
            $password = $_POST['password'];
            //PRINT $password;
            $drpDown =  $_POST['adminDropDown'];
            //PRINT $drpDown;


            $data = courses::findArchitectureCourses('Architecture');
            self::getTemplate('adminHomepage', NULL, $data);
            
        }
    }


    public static function export()
    {

        $data = courses::findArchitectureCourses('Architecture');
        
        if(isset($_POST["btnExport"])) {
            $filename = "NJIT_File_Test".date('Ymd') . ".xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=\"$filename\"");

            //echo var_dump($itemArray)."<br>";
            $is_coloumn = false;
            if(!empty($data)) {
                foreach($data as $key =>$value) {

                    //print_r($value);
                    if(!$is_coloumn) {
                        echo implode("\t", array_keys($value)) . "\n";
                        $is_coloumn = true;
                    }
                    echo implode("\t", array_values($value)) . "\n";
                }
            }
            exit;
        }
    }
            //$data = courses::findArchitectureCourses('Architecture');
            //self::getTemplate('adminHomepage', NULL, $data);
}