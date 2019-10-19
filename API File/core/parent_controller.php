<?php
namespace core;
/**
 * I used aPArrent controller so i can add som public methods rhat can use by
 * child controlles and also can initial some data in future
 */
class parent_controller{

    public $request; // all the requests contains get, post body cookie ... should be save in this param
    public function __construct(){
        $this->request=(object)["get"=>[],"post"=>[],"body"=>[]]; // initialising $resuest
    }
    /**
     * Sets all get requests
     */
    public function setRequestGets($getItems){ // add Get params into request
        $this->request->get = (is_array($getItems) && count ($getItems) > 0)?$getItems:[];
        // var_dump($getItems);exit;
    }
    /**
     * return requested get param
     * @param string $param
     * @return mixed
     */
    public function get($param=NULL){
        if($param == NULL){
            return $this->request->get;
        }
        elseif(isset($this->request->get[$param])){
            return $this->request->get[$param];
        }
        return NULL;
    }

}
?>