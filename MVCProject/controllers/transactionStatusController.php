<?php

class transactionStatusController extends http\controller
{
    public static function updateTranStatus() {

        //Retrieve Order No from touchnet
        $orderNo = $_REQUEST['EXT_TRANS_ID'];

        //Update the order status if successful payment done via touchnet
        studentOrderInfo::updateStudentOrder($orderNo);

        //Retrieve the student info after successful payment
        $studentOrder = studentOrderInfo::retrieveUpdatedStudentOrder($orderNo);

        //echo '<pre>'; var_dump($studentOrder);
        //echo '<pre>'; var_dump($_REQUEST);
        //echo $_GET['tpg_trans_id '];

        // loop through all the courses taken by the student
        for ($i=0; $i< count($studentOrder); $i++)
        {
            $confirmedCourses = $studentOrder[$i]->course;
            $confirmedDates = $studentOrder[$i]->startDate;
            $seatsCount = $studentOrder[$i]->SeatAvailable;

            //Update the no of seats available for all courses taken by the student to total count
            studentOrderInfo::updateNoOfSeats($confirmedCourses,$confirmedDates,$seatsCount);
        }

        //Redirect to the transaction status page
        transactionStatusController::displayTranStatus();
    }

    public static function displayTranStatus() {

        self::getTemplate('transactionStatus',Null, Null);
    }

    public static function postBackInfo() {

        //Insert into the student - order table
        $post = new postBackInfoModel();
        $post->tpg_trans_id = $_POST['tpg_trans_id'];
        $post->pmt_status = $_POST['pmt_status'];
        $post->pmt_amt = $_POST['pmt_amt'];
        $post->save();


       // $file = '.txt';
        // Open the file to get existing content
       // $current = file_get_contents($file);
        // Append a new person to the file
        //$current .= "John Smith\n";
        // Write the contents back to the file
        //file_put_contents($file, $current);
        //print 'hit here';

        //$filename = "NJIT_File_Test".date('Ymd') . ".xls";
        //header("Content-Type: application/vnd.ms-excel");
        //header("Content-Disposition: attachment; filename=\"$filename\"");

        //$target_dir = "./uploads/";
        //$target_file = $target_dir . basename($_FILES['fileToUpload']['name']);
        //$dump = $_REQUEST;


       // $filename = "NJIT_File_Test".date('Ymd') . ".xls";
        //header("Content-Type: application/vnd.ms-excel");
       // header("Content-Disposition: attachment; filename=\"$filename\"");


        //$csv_handler = fopen ($_SERVER['DOCUMENT_ROOT'] .'/uploads/'.'csvfile.csv','wb');
        //fwrite ($csv_handler, $dump);
        //fclose ($csv_handler);


        //NAME OF THE DIRECTORY WHERE THE FILES SHOULD BE STORED
       // $file_name = 'csvfile.csv';
       // $target_dir = "./uploads/";
        //$target_file = $target_dir . basename($file_name);
        // echo $targetfile;

        // SAVE THE FILE IN THE SERVER
        //if($dump != null)
        //{
            //$csvFileName = $_FILES['fileToUpload']['name'];
            //header('Location: readCsv.php');
            //header('Location: readCsv.php?filename='.$csvFileName.'&file=' .$targetfile);
            //move_uploaded_file($file_name, $target_file);
           // print var_dump($dump)."<br>";
       // }
        //else
        //{
           // echo 'File Upload Failed';
        //}

       // content = "some text here";
        //$fp = fopen("./uploads/" . "/myText.txt","wb");
        //fwrite($fp,$content);
        //fclose($fp);

        //header("Location: index.php");
    }
}
