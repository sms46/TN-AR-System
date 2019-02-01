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

        //routing the default homepage
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'redirectToCoad';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'redirectToCoad';
        $routes[] = $route;

        //Route to the Course Registration page
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'redirectToCourse';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'redirectToCourse';
        $routes[] = $route;

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

        //Validate the admin login credentials
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'validateLogin';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'validateLogin';
        $routes[] = $route;

        //Validate the admin login credentials
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'createLogin';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'createLogin';
        $routes[] = $route;

        //Validate the admin login credentials
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'export';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'export';
        $routes[] = $route;

        //Validate the admin login credentials
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'viewRegistrations';
        $route->page = 'adminHomepage';
        $route->controller = 'adminController';
        $route->method = 'viewRegistrations';
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