<?php

use PHPUnit\Framework\TestCase;
include_once('pattern\abstractFactory.php'); 

class abstractFactoryTest extends TestCase
{
    public function testCommandCenter() {
        $commandCenter = new CommandCenter();
        $this->assertEquals('人類工人已就緒', $commandCenter->outputTerranUnit()->playSlogan());
        $this->assertEquals('蟲族工人已就緒', $commandCenter->outputZergUnit()->shout());
    }

    public function testBarrack() {
        $Barrack = new Barrack();
        $this->assertEquals('人類士兵已就緒', $Barrack->outputTerranUnit()->playSlogan());
        $this->assertEquals('蟲族士兵已就緒', $Barrack->outputZergUnit()->shout());
    }

    public function testAirport() {
        $Airport = new Airport();
        $this->assertEquals('人類飛機已就緒', $Airport->outputTerranUnit()->playSlogan());
        $this->assertEquals('蟲族飛機已就緒', $Airport->outputZergUnit()->shout());
    }
}

?>