<?php

use PHPUnit\Framework\TestCase;
include_once('pattern\builder.php'); 

class builderTest extends TestCase
{
    public function testChickenKitMealBuilder() {
        $chickenKitMealBuilder = new chickenKitMealBuilder(); // ConcreteBuilder
        $mealDirector = new mealDirector(); // Director

        $mealDirector->setMealBuilder($chickenKitMealBuilder);
        $chickenKitMeal = $mealDirector->buildMeal();
        
        $this->assertEquals('一個雞腿堡, 一杯可樂, 一包薯條', $chickenKitMeal->showMeal());
    }

    public function testBeefKitMealBuilder() { 
        $beefKitMealBuilder = new BeefKitMealBuilder(); // ConcreteBuilder
        $mealDirector = new mealDirector(); // Director

        $mealDirector->setMealBuilder($beefKitMealBuilder);
        $beefKitMeal = $mealDirector->buildMeal();     
        
        $this->assertEquals('一個牛肉堡, 一杯紅茶, 一個蘋果派', $beefKitMeal->showMeal());
    }
}

?>