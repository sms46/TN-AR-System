<?php

class routes
{
    public static function getRoutes()
    {
        //routing the default homepage
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'show';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'show';
        $routes[] = $route;

        // Design Course view
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'showDesign';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'showDesign';
        $routes[] = $route;

        //Route to the Course Registration page
        //GET Architecture Courses
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'registerArchitecture';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'registerArchitecture';
        $routes[] = $route;

        // Add Courses in cart
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'add';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'addCourses';
        $routes[] = $route;

        //Remove Courses
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'remove';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'removeCourses';
        $routes[] = $route;

        //Empty Cart
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'empty';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'emptyCart';
        $routes[] = $route;

        //Redirect to Student Registration page
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'register';
        $route->page = 'studentRegistration';
        $route->controller = 'registrationController';
        $route->method = 'register';
        $routes[] = $route;

        //Store Student Information
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'storeStudentInfo';
        $route->page = 'studentRegistration';
        $route->controller = 'registrationController';
        $route->method = 'storeStudentInfo';
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