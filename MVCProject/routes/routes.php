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

        //TO-DO:

        // Add Courses in cart
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'add';
        $route->page = 'courseRegistration';
        $route->controller = 'courseRegistrationController';
        $route->method = 'addCourses';
        $routes[] = $route;

        //Remove Courses
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'remove';
        $route->page = 'courseRegistration';
        $route->controller = 'courseRegistrationController';
        $route->method = 'removeCourses';
        $routes[] = $route;

        //Empty Cart
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'empty';
        $route->page = 'courseRegistration';
        $route->controller = 'courseRegistrationController';
        $route->method = 'emptyCart';
        $routes[] = $route;

        //Redirect to Student Registration page
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'register';
        $route->page = 'studentRegistration';
        $route->controller = 'studentRegistrationController';
        $route->method = 'register';
        $routes[] = $route;

        //Store Student Information
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'storeStudentInfo';
        $route->page = 'studentRegistration';
        $route->controller = 'studentRegistrationController';
        $route->method = 'storeStudentInfo';
        $routes[] = $route;
        
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

        //Redirect to check balance page.
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'checkBalance';
        $route->page = 'homepage';
        $route->controller = 'checkBalanceController';
        $route->method = 'checkBalance';
        $routes[] = $route;

        //Registered student report
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'viewRegistrations';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'viewRegistrations';
        $routes[] = $route;

        //Student with deposit payment type
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'viewPartialPayment';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'viewPartialPayment';
        $routes[] = $route;

        //View Couses on admin page
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'viewCourses';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'viewCourses';
        $routes[] = $route;

        //View Couses on admin page
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'viewCoursesInfo';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'viewCoursesInfo';
        $routes[] = $route;

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