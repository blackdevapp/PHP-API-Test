<?php
namespace models;

use core\parent_model;

/**
 * I used model becaues in future we shoul work with database so it will be the sampemodel
 */

class Shoutes_model extends parent_model{

    /**
     * Gets data from databas(file)
     * @param string $name name of human
     * @param int $count counts of requestes sentences
     * @return array a random array of sentences
     */
    public function getShoutes($name,$counts){
        $data = $this->getData();
        $qutes=[];
        // This loop just selects all the sentences of requested human
        foreach($data->quotes as $quote){
            if(strtolower($quote->author) == $name){
                $str = strtoupper($quote->quote);
                $str = preg_replace('/\.$/',"!",$str);
                if(!preg_match("/\!$/",$str)){ //As i found some strings has a ! at its end 
                    $str .= "!";
                }
                $qutes[] = $str;
            }
        }
        if(!count($qutes)){
            return [];
        }
        // Randomise responce
        shuffle($qutes);
        return array_slice($qutes,0,($counts<count($qutes))?$counts:count($qutes));
    }
}