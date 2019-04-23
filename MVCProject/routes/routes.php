<?php

class routes
{
    public static function getRoutes()
    {

        //routing the default landing page
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'show';
        $route->page = 'landingPage';
        $route->controller = 'homepageController';
        $route->method = 'showDefault';
        $routes[] = $route;

        //--------ADMIN ROUTING-------------------------
        //----------------------------------------------
        //Validate the admin login credentials
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'validateLogin';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'validateLogin';
        $routes[] = $route;

        //Request an access for admin login credentials
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'createLogin';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'createLogin';
        $routes[] = $route;

        //Add Products by the admin
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'addProducts';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'addProducts';
        $routes[] = $route;

        //Add Products by the admin
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'addPriceType';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'addPriceType';
        $routes[] = $route;

        //Add Questions by the admin
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'addUserQuest';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'addUserQuest';
        $routes[] = $route;

        //Add Pay Type by the admin
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'addPayType';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'addPayType';
        $routes[] = $route;

        //Add Pay Type by the admin
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'grantAccess';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'grantAccess';
        $routes[] = $route;

        //--------REGISTRATION ROUTING-------------------------
        //----------------------------------------------
        //Route to the Product Registration page
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'redirectToProduct';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'redirectToProduct';
        $routes[] = $route;

        // Add Courses in cart
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'add';
        $route->page = 'productRegistration';
        $route->controller = 'productRegistrationController';
        $route->method = 'addCourses';
        $routes[] = $route;

        //Remove Courses
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'remove';
        $route->page = 'productRegistration';
        $route->controller = 'productRegistrationController';
        $route->method = 'removeCourses';
        $routes[] = $route;

        //Empty Cart
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'empty';
        $route->page = 'productRegistration';
        $route->controller = 'productRegistrationController';
        $route->method = 'emptyCart';
        $routes[] = $route;

        //-------- USER REGISTRATION ROUTING-------------------------
        //----------------------------------------------
        //Redirect to User Registration page
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'register';
        $route->page = 'userRegistration';
        $route->controller = 'userRegistrationController';
        $route->method = 'register';
        $routes[] = $route;

        //Store User Information in db
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'storeUserInfo';
        $route->page = 'userRegistration';
        $route->controller = 'userRegistrationController';
        $route->method = 'storeUserInfo';
        $routes[] = $route;

        //-------- POSTBACK ROUTING(AFTER SUCCESS FROM TOUCHNET)-------------------------
        //----------------------------------------------
        //Post URL route back from successful transaction from TouchNet.
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'postBackInfo';
        $route->page = 'studentRegistration';
        $route->controller = 'transactionStatusController';
        $route->method = 'postBackInfo';
        $routes[] = $route;

        //After successful transaction
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'storeStudentInfo';
        $route->page = 'studentRegistration';
        $route->controller = 'transactionStatusController';
        $route->method = 'displayTranStatus';
        $routes[] = $route;

        //-------- CHECK BALANCE ROUTING-------------------------
        //----------------------------------------------
        //Redirect to check balance page.
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'checkBalance';
        $route->page = 'homepage';
        $route->controller = 'checkBalanceController';
        $route->method = 'checkBalance';
        $routes[] = $route;

        //to:do

        //Export to Excel - Student Info
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'exportStudentInfo';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'exportStudentInfo';
        $routes[] = $route;

        return $routes;
    }
    
    public static function create($http_method,$action,$page,$controller,$method) {
        $route = new route();
        $route->http_method = $http_method;
        $route->action = $action;
        $route->page = $page;
        $route->controller = $controller;
        $route->method = $method;
    }
}

class route
{
    public $page;
    public $action;
    public $method;
    public $controller;
}