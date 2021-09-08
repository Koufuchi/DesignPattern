<?php
/**
 *優點：

 * 1. 有了 Factory Method 設計模式，就不必再將與應用場合高度相依的類別寫死在主程式裡。主程式只須面對 Product 介面，
 *    因此可和任何未知的 ConcreteProduct 類別合作無間。
 *
 * 2. 不論工廠內部的管理方法、製造流程如何地更換變動，都不會影響到系統外部使用者的操作行為，完善地封裝隱藏物件生成過程的實做細節。
 *
 *缺點：

 * 1. 在添加新產品時，需要編寫新的具體產品類，而且還要提供與之對應的具體工廠類，系統中類別的個數將成對增加，在一定程度上增加了系統的複雜度，
 *    有更多的類別需要編譯和運行，會給系統帶來一些額外的開銷。
 *
 * 2. 由於考慮到系統的可擴展性，需要引入抽象層，在用戶端代碼中均使用抽象層進行定義，增加了系統的抽象性和理解難度，
 *    且在實現時可能需要用到DOM、反射等技術，增加了系統的實現難度。
 * 
 * 使用時機：
 *
 * 1. 當類別無法明指欲生成的物件類別時。
 *
 * 2. 當類別希望讓子類別去指定欲生成的物件類型時。
 *
 * 3. 當類別將權力下放給一個或多個輔助用途的子類別，你又希望將「交付給哪些子類別」的知識集中在一處時。
 *
 */

// 抽象的建築物工廠
// Creator：宣告 Factory Method，它會傳回 Product 型別之物件。
abstract class BuildFactory 
{
    abstract function outputUnit();
}

// 指揮中心
// ConcreteCreator：覆寫 Factory Method 以傳回 ConcreteProduct 的物件個體。
class CommandCenter extends BuildFactory
{
    public function outputUnit() {
        return new Worker();
    }
}
// 軍營  ConcreteCreator
class Barrack extends BuildFactory
{
    public function outputUnit() {
        return new Solider();
    }
}

// 空軍基地  ConcreteCreator
class Airport extends BuildFactory
{
    public function outputUnit() {
        return new Aircraft();
    }
}

// 抽象單位
// Product：定義 Factory Method 所造物件的介面。
abstract class Unit
{
   public abstract function playSlogan();  // 播放單位口號
}

// 工人
// ConcreteProduct：具體實作出 Product 介面。
class Worker extends Unit
{   
    public function playSlogan() {
        return "工人已就緒!";
    }
}

// 士兵  ConcreteProduct
class Solider extends Unit
{   
    public function playSlogan() {
        return "士兵已就緒!";
    }
}

// 飛機  ConcreteProduct
class Aircraft extends Unit
{
    public function playSlogan() {
        return "飛機已就緒!";
    }
}




?>