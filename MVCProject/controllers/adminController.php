<?php

class adminController extends http\controller
{
    //Function to validate a user in db based on appId
    public static function validateLogin()
    {
        if(isset($_POST["btnSignIn"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];
            $appKey = $_POST['adminDropDown'];

            //Check the user in the DB
            $user = adminAccounts::findUser($adminName, $appKey);

            if ($user == FALSE) {
                echo '<script>alert("No User Found")</script>';
                self::getTemplate('landingPage', NULL, NULL);
            } else {

                if($user->checkPassword($password) == TRUE) {
                    if($user->has_access == 1){
                        self::getTemplate('adminHomepage', NULL, $appKey);
                    }else{
                        echo '<script>alert("Access Denied. Contact Admin for Access")</script>';
                        self::getTemplate('landingPage', NULL, NULL);
                    }
                } else {
                    echo '<script>alert("Password does not match")</script>';
                    self::getTemplate('landingPage', NULL, NULL);
                }
            }
        }
    }

    //Function to add a user in db when a user admin request an access
    public static function createLogin()
    {
        if(isset($_POST["btnRequest"])) {
            $adminName = $_POST['userName'];
            $password = $_POST['password'];
            $appKey = $_POST['adminDropDown'];

            //Check the user in the DB
            $user = adminAccounts::findUser($adminName, $appKey);

            //Add the user admin if no records found
            if ($user == FALSE) {
                $addUser = new adminAccountsModel();
                $addUser->user_name = $adminName;
                $addUser->password = $addUser->setPassword($password);
                $addUser->app_id = $appKey;
                $addUser->is_admin = 0;
                $addUser->has_access = 0;

                $addUser->save();

                echo '<script>alert("You have successfully requested for an admin access request.")</script>';
                self::getTemplate('landingPage', NULL, NULL);

            } else {
                echo '<script>alert("User already registered")</script>';
                self::getTemplate('landingPage', NULL, NULL);
            }
        }
    }

    //Function to add product in the product table
    public static function addProducts()
    {
        if(isset($_POST["btnAdd"])) {
            $productName = $_POST['productName'];
            $category = $_POST['category'];
            $description = $_POST['desc'];
            $totalCount = $_POST['total'];
            $sortId = $_POST['sort'];
            $addDropDown = $_POST['addDropDown'];
            $appKey = $_POST['appId'];

            //Add products in the product Table
            $addProduct = new productsModel();
            $addProduct->sort_count = $sortId;
            $addProduct->name = $productName;
            $addProduct->categories = $category;
            $addProduct->description = $description;
            $addProduct->app_id = $appKey;
            $addProduct->item_remain = $totalCount;
            $addProduct->active = $addDropDown ;

            $addProduct->save();

            // Pass the app key back to admin homepage
            self::getTemplate('adminHomepage', NULL, $appKey);
        }
    }

    //Function to add product in the product price table
    public static function addPriceType()
    {
        if(isset($_POST["btnAddPrice"])) {
            $priceType = $_POST['priceType'];
            $price = $_POST['price'];
            $productId = $_POST['productDropDown'];
            $appKey = $_POST['appId'];

            //Add products in the product Table
            $addPriceType = new productPriceModel();
            $addPriceType->priceType = $priceType;
            $addPriceType->product_id = $productId;
            $addPriceType->price = $price;

            $addPriceType->save();

            // Pass the app key back to admin homepage
            self::getTemplate('adminHomepage', NULL, $appKey);
        }
    }

    //Function to add product in the user quest template table
    public static function addUserQuest()
    {
        if(isset($_POST["btnAddQuest"])) {

            $sort_id = $_POST['sort'];
            $userInfo = $_POST['addQuest'];
            $infoType = $_POST['infoDropDown'];
            $fieldRequired = $_POST['fieldDropDown'];
            $appKey = $_POST['appId'];

            //Add products in the product Table
            $addQuest = new userQuestTemplateModel();
            $addQuest->sort_count = $sort_id;
            $addQuest->quest = $userInfo;
            $addQuest->quest_type = $infoType;
            $addQuest->is_required = $fieldRequired;
            $addQuest->app_id = $appKey;

            $addQuest->save();

            // Pass the app key back to admin homepage
            self::getTemplate('adminHomepage', NULL, $appKey);
        }
    }

    //Function to add product in the payment type table
    public static function addPayType()
    {
        if(isset($_POST["btnAddPayType"])) {

            $payType = $_POST['payType'];
            $discount = $_POST['discount'];
            $appFee = $_POST['AppFee'];

            $depositAmt = $_POST['depAmt'];
            $discPer = $_POST['discPer'];
            $appFeeAmt = $_POST['appFeeAmt'];

            $appKey = $_POST['appId'];
            $myArray = array();
            $k=0;

            // output / process all data
            foreach ($payType as $value) {
                $myArray[$k] = $value;
                $k+=1;
            }

            //Check if the payment type already exists
            $payType = paymentType::getPaymentTypeById($appKey);

            if($payType == FALSE){
                //Add products in the product Table
                for($c= 0; $c < count($myArray);$c++) {

                    $addPayType = new paymentTypeModel();
                    $addPayType->pay_type = $myArray[$c];
                    $addPayType->app_id = $appKey;
                    $addPayType->save();
                }
            }

            for($s= 0; $s < count($myArray);$s++) {

                if ($myArray[$s] == 'Deposit') {
                    //Save the details in the appConfig Table
                    $updateAppConfig = new appConfigModel();
                    $updateAppConfig->id = $appKey;
                    $updateAppConfig->is_deposit = 1;
                    $updateAppConfig->deposit_amt = $depositAmt;
                    $updateAppConfig->save();
                }
            }


            $AppConfig = new appConfigModel();
            $AppConfig->id = $appKey;
            $AppConfig->is_discount = $discount;

            if($discount == '1'){
                $AppConfig->disc_percent = $discPer;
            }

            if($appFee == '1'){
                $AppConfig->app_fee = $appFeeAmt;
            }
            $AppConfig->save();

            // Pass the app key back to admin homepage
            self::getTemplate('adminHomepage', NULL, $appKey);
        }
    }

    //Function to grant access to the users by the admin
    public static function grantAccess()
    {
        if(isset($_POST["btnGrant"])) {

            $grantUsers = $_POST['grant'];
            $appKey = $_POST['appId'];
            $admin = $_POST['adminName'];
            $myArray = array();
            $k=0;

            // output / process all data
            foreach ($grantUsers as $value) {
                $myArray[$k] = $value;
                $k+=1;
            }

            for($c= 0; $c < count($myArray);$c++) {

                $user = adminAccounts::findUser($myArray[$c], $appKey);
                $grant = new adminAccountsModel();
                $grant->id = $user->id;
                $grant->has_access = 1;
                $grant->grant_access_by = $admin;
                $grant->save();
            }

            // Pass the app key back to admin homepage
            self::getTemplate('adminHomepage', NULL, $appKey);
        }
    }

    //Export User Info Details
    public static function exportUserInfo()
    {
        $app_id = $_GET['appId'];

        //Get the Result set for data to be exported in excel
        $resultSet = userOrderInfo::getRegisteredUserInfo($app_id);
        $finalArray = array();

        foreach ($resultSet as $item){
            $itemArray = array( array('Order Number' => $item->OrderNo,'User' => $item->User,
                'Primary Email' => $item ->PrimaryEmail, 'Date Registered' => $item ->DateRegistered));

            $finalArray[] = $itemArray;
        }

        $filename = "NJIT_File_".date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        //echo var_dump($itemArray)."<br>";
        $isColumn = false;
        if(!empty($finalArray)) {
            foreach($finalArray as $value) {

                if(!$isColumn) {
                    print implode("\t", array_keys($value[0])) . "\n";
                    $isColumn = true;
                }

                print implode("\t", array_values($value[0])) . "\n";
            }
        }
        exit;
    }

    //Export Partial Payment Details
    public static function exportPPInfo()
    {
        $app_id = $_GET['appId'];

        //Get the Result set for data to be exported in excel
        $resultSet = userOrderInfo::getPartialPayment($app_id);
        $finalArray = array();

        foreach ($resultSet as $item){
            $itemArray = array( array('Order Number' => $item->OrderNo,'User' => $item->User,
                'Primary Email' => $item ->PrimaryEmail, 'Total Amount' => $item ->TotalAmt, 'Due Amount' => $item ->DueAmt,
                'Date Registered' => $item ->DateRegistered));

            $finalArray[] = $itemArray;
        }

        $filename = "NJIT_File_".date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        //echo var_dump($itemArray)."<br>";
        $isColumn = false;
        if(!empty($finalArray)) {
            foreach($finalArray as $value) {

                if(!$isColumn) {
                    print implode("\t", array_keys($value[0])) . "\n";
                    $isColumn = true;
                }

                print implode("\t", array_values($value[0])) . "\n";
            }
        }
        exit;
    }

    //Export Product Info Details
    public static function exportProductInfo()
    {
        $app_id = $_GET['appId'];

        //Get the Result set for data to be exported in excel
        $resultSet = userOrderInfo::getProductsAdmin($app_id);
        $finalArray = array();

        foreach ($resultSet as $item){
            $itemArray = array( array('Product ID' => $item->ProductId,'Name' => $item->Name,
                'Category' => $item ->Category, 'Description' => $item ->description,
                'Items Remaining' => $item ->ItemsRemaining,'Active Status' => $item ->ActiveStatus ));

            $finalArray[] = $itemArray;
        }

        $filename = "NJIT_File_".date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        //echo var_dump($itemArray)."<br>";
        $isColumn = false;
        if(!empty($finalArray)) {
            foreach($finalArray as $value) {

                if(!$isColumn) {
                    print implode("\t", array_keys($value[0])) . "\n";
                    $isColumn = true;
                }

                print implode("\t", array_values($value[0])) . "\n";
            }
        }
        exit;
    }

    //Export User Product Info Details
    public static function exportUserProdInfo()
    {
        $app_id = $_GET['appId'];

        //Get the Result set for data to be exported in excel
        $resultSet = userOrderInfo::getProductsInfoAdmin($app_id);
        $finalArray = array();

        foreach ($resultSet as $item){
            $itemArray = array( array('Order Number' => $item->OrderNo,'User' => $item->UserName,
                'Product Name' => $item ->ProdName, 'Category' => $item ->Category, 'Description' => $item ->Desc ));

            $finalArray[] = $itemArray;
        }

        $filename = "NJIT_File_".date('Ymd') . ".xls";
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$filename\"");

        //echo var_dump($itemArray)."<br>";
        $isColumn = false;
        if(!empty($finalArray)) {
            foreach($finalArray as $value) {

                if(!$isColumn) {
                    print implode("\t", array_keys($value[0])) . "\n";
                    $isColumn = true;
                }

                print implode("\t", array_values($value[0])) . "\n";
            }
        }
        exit;
    }
}