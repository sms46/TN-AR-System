<?php

//each page extends controller and the index.php?page=tasks causes the controller to be called
class registrationController extends http\controller
{

    public static function register()
    {
        if(isset($_POST["proceed_to_payment"])) {
            self::getTemplate('show_profile',NULL, NULL);
        }
    }

    public static function store(){

        $user = new studentInfoModel();
        $user->studentName = $_POST['studentName'];
        $user->studentEmail = $_POST['email'];
        $user->parentName = $_POST['parentName'];
        $user->schoolName = $_POST['highSchool'];
        $user->streetAddress = $_POST['streetAddress'];
        $user->city = $_POST['city'];
        $user->state = $_POST['state'];
        $user->zipCode = $_POST['zipCode'];
        $user->save();

        header("Location: index.php?page=accounts&action=showProfile");
    }

    public static function showProfile()
    {
        $architectureRecords = ArchitectureCourseMaster::findAll();
        self::getTemplate('show_profile',$architectureRecords);
    }

    public static function selectArchitectureCourses()
    {
        $architectureRecords = ArchitectureCourseMaster::findAll();
        self::getTemplate('show_profile', $architectureRecords);
    }

    public static function selectDesignCourses()
    {
        $designRecords = DesignCourseMaster::findAll();
        self::getTemplate('show_profile', $designRecords);
    }

    public static function createTable()
    {
        if ($_POST['action'] && $_POST['id']) {
            if ($_POST['action'] == 'Add') {

                print_r($_POST['id']);
                self::getTemplate('show_profile' );
            }
        }
    }

    public static function show()
    {
        $record = accounts::findOne($_REQUEST['id']);
        self::getTemplate('show_account', $record);
    }

    public static function all()
    {

        $records = accounts::findAll();
        self::getTemplate('all_accounts', $records);

    }

    public static function edit()
    {
        $profile = new account();
        $profile->id = $_GET['id'];
        $profile->fname = $_POST['fname'];
        $profile->lname = $_POST['lname'];
        $profile->email = $_POST['email'];
        $profile->phone = $_POST['phone'];
        $profile->birthday = $_POST['birthday'];
        $profile->gender = $_POST['gender'];
        $profile->password = $_POST['password'];
        $profile->save();
        //self::getTemplate('all_tasks', $user);

        header("Location: index.php?page=accounts&action=showProfile");

    }
    
    public static function editProfile()
    {
        $record = accounts::findOne($_REQUEST['id']);
        self::getTemplate('edit_account', $record);
    }

    //this is used to save the update form data
    public static function save() {
        $user = accounts::findOne($_REQUEST['id']);

        $user->email = $_POST['email'];
        $user->fname = $_POST['fname'];
        $user->lname = $_POST['lname'];
        $user->phone = $_POST['phone'];
        $user->birthday = $_POST['birthday'];
        $user->gender = $_POST['gender'];
        $user->save();
        header("Location: index.php?page=tasks&action=all");

    }

    public static function delete() {

        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }

}