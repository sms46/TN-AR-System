<?php

class routes
{
    public static function getRoutes()
    {
        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'show';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'show';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'showDesign';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'showDesign';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'register';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'register';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'create';
        $route->page = 'accounts';
        $route->controller = 'accountsController';
        $route->method = 'store';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'showProfile';
        $route->page = 'accounts';
        $route->controller = 'accountsController';
        $route->method = 'showProfile';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'selectArchitectureCourses';
        $route->page = 'accounts';
        $route->controller = 'accountsController';
        $route->method = 'selectArchitectureCourses';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'selectDesignCourses';
        $route->page = 'accounts';
        $route->controller = 'accountsController';
        $route->method = 'selectDesignCourses';
        $routes[] = $route;

        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'createTable';
        $route->page = 'accounts';
        $route->controller = 'accountsController';
        $route->method = 'createTable';
        $routes[] = $route;




        ///// ADD COURSES
        $route = new route();
        $route->http_method = 'POST';
        $route->action = 'add';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'addCourses';
        $routes[] = $route;


        /////REMOVE COURSES

        $route = new route();
        $route->http_method = 'GET';
        $route->action = 'remove';
        $route->page = 'homepage';
        $route->controller = 'homepageController';
        $route->method = 'removeCourses';
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