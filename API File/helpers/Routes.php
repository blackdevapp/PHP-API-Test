<?php
namespace helpers;

class Routes {
    /**
     * Return parts or url contains controller name and a action also all other get request
     * @return array an array with 2 elemets first is request parts seconds is array of other get 
     * params
     */
    public static function getUrlSection(){ // Parsing request data and initialising
        if(!isset($_GET["req"])){
            return false;   
        }
        $sections = explode("/",$_GET["req"]);
        
        $getParams = $_GET;
        unset($getParams["req"]);
        return [$sections,$getParams];
    }
}