<?php
namespace core;
/**
 * This parent model class can containes all database conetions
 * and also all orm methodes
 */
class parent_model{

    public function __construct(){
        
    }
/**
 * Insted of loading data from database  i've use this method
 * This method load all jason file into a variable ye it's not good
 * enogh but there is not much data
 */
    protected function getData(){  //
        $data = file_get_contents(__DIR__."/../data/data.json");
        return json_decode($data);
    }
}