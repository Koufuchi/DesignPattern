<?php
//composer require --dev phpunit/phpunit
use PHPUnit\Framework\TestCase;
include_once('pattern\simpleFactory.php'); 

class SimpleFactoryTest extends TestCase
{
    public function testCreateWorker() {
       $unit = new CreateBuildCenter ('worker');
       $this->assertEquals('使用了50單位的水晶', $unit->outputUnit('worker')->getMaterial());
       $this->assertEquals('訓練時間10秒', $unit->outputUnit('worker')->train());
       $this->assertEquals('I am a Worker, I am ready to work!', $unit->outputUnit('worker')->create());
    }

    public function testCreateNotExist() {
        $unit = new CreateBuildCenter ('test');
        $this->assertEquals('不存在的參數', $unit->outputUnit('test'));
    }
}


?>