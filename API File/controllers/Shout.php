<?php
namespace controllers;

use core\parent_controller;
use models\Shoutes_model;

/**
 * A sample controller
 */
class Shout extends parent_controller{

    /** 
     * Default method
     * @param string $name;
     * @return array 
     */
    public function index($name){
        $model = new Shoutes_model(); 
        $limit = $this->get("limit");
        if($limit == null){
            return ["Missed Limit parameter"];
        }
        if($limit<1 || $limit > 10){ // limit should be between 1 & 10
            return ["Limit should be between 1 to 10"];
            // return ["status"=>0,"message"=>"Limit should be between 1 to 10"];
        }
        $name = strtolower(str_replace("-"," ",$name)); // replace dashes from name
        $result = $model->getShoutes($name,$limit); //request data ftom model
        if(count($result) > 0){  // in the case of no result return a message
            return $result;
            // return ["status"=>1,"message"=>$result];
        }else{
            return ["Noting found"]; // result not found for requested name
            // return ["status"=>0,"message"=>"Noting found"];
        }
    }
}