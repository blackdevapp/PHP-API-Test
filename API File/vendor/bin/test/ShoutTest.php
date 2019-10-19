<?php
namespace vendor\bin\test\controllers;

class ShoutTest extends \PHPUnit_Framework_TestCase{


    public function testCangetIndexController(){
        $controller = new \controllers\Shout();
        // $parentController = new core\parent_controller();
        $controller->setRequestGets(["limit"=>"10"]);
        $this->assertEquals($controller->get("limit"),"10");
        $this->assertEquals($controller->index("steve-jobs"),["YOUR TIME IS LIMITED, SO DON'T WASTE IT LIVING SOMEONE ELSE'S LIFE!","THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!"]);
        $this->assertEquals($controller->index("Hassan"),["Noting found"]);
        $controller->setRequestGets(["limit"=>"11"]);
        $this->assertEquals($controller->index("Hassan"),["Limit should be between 1 to 10"]);
        $controller->setRequestGets(["limit"=>"0"]);
        $this->assertEquals($controller->index("Hassan"),["Limit should be between 1 to 10"]);
    }

    public function testCanGetShoutes(){
        $model = new \models\Shoutes_model();
        $data = $model->getShoutes("steve jobs","2");
        $arr = ["YOUR TIME IS LIMITED, SO DON'T WASTE IT LIVING SOMEONE ELSE'S LIFE!","THE ONLY WAY TO DO GREAT WORK IS TO LOVE WHAT YOU DO!"];
        $this->assertTrue($this->checkArrays($data,$arr));
        $this->assertEquals($model->getShoutes("hassan","2"),[]);
    }

    public function testCanInitalParentController(){
        $controller = new \core\parent_controller();
        // $parentController = new core\parent_controller();
        $controller->setRequestGets(["limit"=>"10"]);
        $this->assertEquals($controller->get("limit"),"10");
        $this->assertEquals($controller->get(),["limit"=>"10"]);
        $this->assertEquals($controller->get("Hassan"),NULL);
    }

    
    private function checkArrays($a,$b){
        if(count($a)==0 && count($b) ==0){
            return TRUE;
        }
        if (count($a) != count($b)){
            return FALSE;
        }
        if(count($a)){
            foreach($a as $item){
                if(!in_array($item,$b)){
                    return FALSE;
                }
            }
        }
        return TRUE;
    }
}