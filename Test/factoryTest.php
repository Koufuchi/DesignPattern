<?php

use PHPUnit\Framework\TestCase;
include_once('pattern\factory.php'); 

class FactoryTest extends TestCase
{
    public function testCommandCenter() {
        $commandCenter = new CommandCenter();
        $this->assertEquals('工人已就緒!', $commandCenter->outputUnit()->playSlogan());
    }

    public function testBarrack() {
        $Barrack = new Barrack();
        $this->assertEquals('士兵已就緒!', $Barrack->outputUnit()->playSlogan());
    }

    public function testAirport() {
        $Airport = new Airport();
        $this->assertEquals('飛機已就緒!', $Airport->outputUnit()->playSlogan());
    }
}

?>