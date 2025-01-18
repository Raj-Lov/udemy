<?php

if (!class_exists('App')) {
    class App {
        protected $controller = '_404';
        protected $method = 'index';

        function __construct(){
           $arr = ($this->getURL());

           $filename = '../app/controllers/' . ucfirst($arr[0]) . '.php';

           if(file_exists($filename)){
              require $filename;
                $this->controller = $arr[0];
                unset($arr[0]);
           }else{
              require '../app/controllers/' .$this->controller . '.php';
           } 
           
           $myController = new $this->controller;
           $mymethod = $arr[1] ?? $this->method;

           if(!empty($arr[1])){
             if(method_exists($myController, strtolower($mymethod))){
                $this->method = strtolower($mymethod);
                unset($arr[1]);
             }
           }
           
           $arr = array_values($arr);
           
           call_user_func_array([$myController, $this->method], []);
        }

        /**
         * Retrieves and processes the URL from the query string.
         *
         * This function checks if a 'url' parameter is set in the query string ($_GET).
         * If it is set, it retrieves its value; otherwise, it defaults to 'home'.
         * The function then trims any trailing slashes from the URL, sanitizes it to remove
         * any unwanted characters, and finally splits the URL into an array using '/' as the delimiter.
         *
         * @return array An array of URL segments.
         */
        private function getURL(){
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
$app = new App();