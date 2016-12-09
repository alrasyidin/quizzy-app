<?php

/*
 * Bootstrap helper is the front controller for the application
 */

class Bootstrap {

    private $url;
    private $controller = 'Quiz';
    private $action = 'index';
    private $param = '';

    function __construct() {

        $this->url = (isset($_GET['url'])) ? $_GET['url'] : null;

        /*
         * if the user passes a url value then start to work with enterd values
         */

        if ($this->url !== null) {

            $url = $this->parseUrl($this->url);
            $this->setUrl($url);
        }

        /*
         * call the controller and tha action
         */

        $this->call();
    }

    public function parseUrl($url) {

        $url = explode('/', rtrim($url, '/'));
        return $url;

    }

    public function setUrl($url) {

        // set the controller
        $this->controller = ucfirst($url[0]);
        // what if the user pases a action
        (isset($url[1])) ? $this->action = $url[1] : null;
        // what if the user pases a parameters
        (isset($url[2])) ? $this->param = $url[2] : null;

    }

    public function call() {

        $this->controller = $this->controller . 'Controller';
        $file = CONTROLLERS . $this->controller . '.php';
        // call the controller file if exists
        if (file_exists($file)) {
            // init the controller
            require CONTROLLERS . $this->controller . '.php';
            $controller = new $this->controller;
            // call the method if exist
            (method_exists($controller, $this->action)) ? $controller->{$this->action}($this->param) : $this->error();
        } else {
            $this->error();
        }

    }

    public function error() {

        echo 'Error: some error';

    }

}
