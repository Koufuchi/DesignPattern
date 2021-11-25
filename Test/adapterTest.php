<?php

use PHPUnit\Framework\TestCase;
include_once('pattern\adapter.php'); 

class adapterTest extends TestCase
{
    public function testPs2Mouse() { 
        $ps2Mouse = new SimplePs2Mouse();              // 建立一個 ps/2 介面的滑鼠  
        $ps2UsbAdapter = new Ps2UsbAdapter($ps2Mouse); // 將 ps/2 介面滑鼠接到轉接器中
        $this->assertEquals('PS/2滑鼠點一下', $ps2UsbAdapter->usb_click());
        $this->assertEquals('PS/2滑鼠移動', $ps2UsbAdapter->usb_move());
        $this->assertEquals('PS/2滑鼠連接', $ps2UsbAdapter->usb_connect());
    }
}

?>