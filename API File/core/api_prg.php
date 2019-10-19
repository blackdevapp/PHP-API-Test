<?php
namespace core;
use helpers\Routes;
use helpers\caching;
// new \controllres\Shout();exit;
// require_once("helpers/Routes.php");
class api_prg{
    /**
     * Runes progect and show results
     * This is main core file. This class loads controllers and run them
     */
    public static function run(){
        $sections = Routes::getUrlSection();
        if(!$sections){
            $result =  ["Missed Parameters"];
            require_once("views/shout/json.php");
            return;
        }
        if(count($sections[0])<2){
            $result =["missed method"];
            require_once("views/shout/json.php");
            return;
        }
        $cach = new caching();
        $cach -> start($sections); // start caching
        $parts1 = $sections[0];
        $controller = ucfirst(strtolower($parts1[0]));
        if(count($parts1)<3){
            $action = "index"; //default value can use as a dynamic user defined value in an option file
            $name = $parts1[1];
        }else{
            $action = $parts1[1];
            $name = $parts1[2];
        }
        $getItems = $sections[1];

        $cntrlr = "\\controllers\\$controller";

        if(!class_exists($cntrlr)){
            $result =  ["Requested method ($controller) is not exists"];
            require_once("views/shout/json.php");
            return;
        }
        $controller = new $cntrlr(); // new a controller dynamicly
        // I use this method to initialising get and post and other requests becaues in this case we can
        // controll any injection hacks request.
        $controller->setRequestGets($getItems); //initialising GET params
        // var_dump($name);exit;
        // Right now our request is so simple so there is only one param to pas to methos
        // So i used a simple way. but for complex requests in future we need to use
        // call_user_func_array
        $result = $controller->$action($name); // run a controller method
        require_once("views/".strtolower($parts1[0])."/json.php");
        $cach->end(); //end caching
        return;
    }
}