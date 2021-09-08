<?php
/*
 * 當今天我們有兩個陣營，人類跟蟲族時，工廠模式就要擴展成抽象工廠
 * 
 * 優點：
 *
 * 1. 擴充了工廠方法模式，支援多個產品族的創建
 * 2. 做到了「開-閉」原則
 *
 * 缺點：
 *
 * 1. 暴露具體工廠
 * 2. 系統架構更加複雜
 *
 * 使用時機：
 * 
 * 1. 有創建一批有相同介面物件的需求
 * 2. 不想暴露太多類的細節給使用者，或者隱藏物件的創建工作
 * 3. 產品包含多於一個的產品族，用工廠方法模式無法解決。其中同一個產品族的產品是在一起使用的
 * 4. 系統提供一個產品類的庫，用戶端可以不依賴於實現，做到動態切換產品。
 */


// 抽象的建築物工廠
// AbstractFactory：此介面宣告出可生成各抽象成品物件的操作。
abstract class BuildFactory 
{
    public abstract function outputTerranUnit(); // 產出人類單位
    public abstract function outputZergUnit();   // 產生異形單位
}

// 指揮中心
// ConcreteFactory：具體實作出可建構具象成品物件的操作。
class CommandCenter extends BuildFactory
{
    public function outputTerranUnit() {
        return new TerranWorker();
    }
    
    public function outputZergUnit() {
        return new ZergWorker();
    }
}

// 軍營  ConcreteFactory
class Barrack extends BuildFactory
{
    public function outputTerranUnit() {
        return new TerranSolider();
    }
    
    public function outputZergUnit() {
        return new ZergSolider();
    }
}

// 空軍基地  ConcreteFactory
class Airport extends BuildFactory
{
    public function outputTerranUnit() {
        return new TerranAircraft();
    }
    
    public function outputZergUnit() {
        return new ZergAircraft();
    }
}
////////////////////////////////////////////////////
// 抽象人類單位
// Abstract Product A：宣告某成品物件類型之介面。
abstract class TerranUnit
{
   public abstract function playSlogan(); // 播放單位口號
}

// 工人 Product A1
class TerranWorker extends TerranUnit
{
    public function playSlogan() {
        return "人類工人已就緒";
    }
}

// 士兵 Product A2
class TerranSolider extends TerranUnit
{
    public function playSlogan() {
        return "人類士兵已就緒";
    }
}

// 飛機 Product A3
class TerranAircraft extends TerranUnit
{
    public function playSlogan() {
        return "人類飛機已就緒";
    }
}
///////////////////////////////////////////////////////
// 抽象蟲族單位
// Abstract Product B
abstract class ZergUnit
{
   public abstract function shout(); // 嘶吼
}

// 工人 Product B1
class ZergWorker extends ZergUnit
{
    public function shout() {
        return "蟲族工人已就緒";
    }
}

// 士兵 Product B2
class ZergSolider extends ZergUnit
{
    public function shout() {
        return "蟲族士兵已就緒";
    }
}

// 飛螳 Product B3
class ZergAircraft extends ZergUnit
{
    public function shout() {
        return "蟲族飛機已就緒";
    }
}




?>