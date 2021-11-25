<?php
/**
 * 案例為 ps/2 介面的滑鼠，要插在用 usb 介面的電腦上
 * 
 * Adapter(轉接器模式)
 * 
 * 優點：
 *
 * 1. 將目標類別和被轉接類別解耦，通過引入一個轉接器類別來重用現有的被轉接類別，而無須修改原有代碼。
 * 
 * 2. 增加了類別的透明性和複用性，將具體的實現封裝在轉接器中，對於用戶端類來說是透明的，而且提高了轉接器的複用性。
 * 
 * 3. 靈活性和擴展性都非常好，通過使用設定檔，可以很方便地更換轉接器，也可以在不修改原有代碼的基礎上增加新的轉接器類別，完全符合“開閉原則”。
 * 
 * 缺點：
 * 
 * 1. 對於 Java、C# 等不支援多重繼承的語言，一次最多只能使用一個 Adapter 類別，而且目標抽象類別只能為抽象類別，不能為具體類，
 *    其使用有一定的局限性，不能將一個 Adapter 類別和它的子類都適配到目標介面。
 * 
 * 使用時機：
 * 
 * 需要將一個類別的介面，轉換成另一個介面以供客戶使用。
 * 系統需要使用現有的類別，而這些類別的介面不符合系統的需要
 * 
 */

// USB滑鼠介面
interface UsbMouse
{
    public function usb_click();
    public function usb_move();
    public function usb_connect();
}

// 簡單USB滑鼠
class SimpleUsbMouse implements UsbMouse
{
    public function usb_click() {
        return "USB滑鼠點一下";
    }
    
    public function usb_move() {
        return "USB滑鼠移動";
    }
    
    public function usb_connect() {
        return "USB滑鼠連接";
    }
}

// PS/2滑鼠介面
interface Ps2Mouse
{
    public function ps2_click();
    public function ps2_move();
    public function ps2_connect();
}

// 簡單PS/2滑鼠
class SimplePs2Mouse implements Ps2Mouse
{
    public function ps2_click() {
        return "PS/2滑鼠點一下";
    }
    
    public function ps2_move() {
        return "PS/2滑鼠移動";
    }
    
    public function ps2_connect() {
        return "PS/2滑鼠連接";
    }
}

// PS/2 -> USB轉接器
class Ps2UsbAdapter implements UsbMouse
{
    private $ps2Mouse;
    
    public function __construct(Ps2Mouse $ps2Mouse) {
        $this->ps2Mouse = $ps2Mouse;
    }
    
    public function usb_click() {
        return $this->ps2Mouse->ps2_click();
    }
    
    public function usb_move() {
        return $this->ps2Mouse->ps2_move();
    }
    
    public function usb_connect() {
        return $this->ps2Mouse->ps2_connect();
    }
}



?>