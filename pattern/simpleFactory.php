<?php
/** 
 * 簡單工廠模式舉例
 * 如果有同樣製作流程，但實作內容不同，可用簡單工廠，
 * 但是如果這邊我們多一個類別，為機場，負責建造飛機，而建造飛機會多一個工序時，簡單工廠就不適用，
 * 這時候就要用工廠模式(Factory)來處理。

 *優點：
 *分工明確，各司其職。 
 *用戶端不再創建物件，而是把創建物件的職責交給了具體的工廠去創建。 
 *用戶端只負責調用。

 *缺點：
 *工廠的靜態方法無法被繼承。
 *代碼維護不易 ( 物件要是很多的話，工廠是一個很龐大的類別 ) 。
 *這種模式對OCP原則(Open-Close Principle)支援的不夠，如果有新的產品加入到系統中就要修改工廠類。

 *使用時機：
 *用戶端需要創建物件，物件有同樣製作流程，但實作內容不同，並且數量不多的情況下，可以考慮使用簡單工廠模式。
*/

// 簡單建築物工廠
class SimpleBuildFactory
{
   public static function createUnit($type) {
        switch($type) {
            case "solider":
                return new Solider();
                break;
            
            case "worker":
                return new Worker();
                break;
            
            default:
                return "不存在的參數";
        }
    }
}

// 生產中心
class CreateBuildCenter 
{
    public function outputUnit($type) {

        $unit =  SimpleBuildFactory::createUnit($type); // 把會變動的部份抽離出來，變成簡單工廠
        
        if(is_object($unit)){
            $unit->getMaterial();
            $unit->train();
            $unit->create();
        }
        return $unit;
    }
}


// 抽象單位
// product
abstract class Unit 
{
   public abstract function getMaterial(); // 取得材料
   public abstract function train();       // 訓練
   public abstract function create();      // 生產
}

// 工人
// concreate
class Worker extends Unit
{
    public function getMaterial() {
        return "使用了50單位的水晶";
    }
    
    public function train() {
        return "訓練時間10秒";
    }
    
    
    public function create() {
        return "I am a Worker, I am ready to work!";
    }
}

// 士兵
class Solider extends Unit
{
    public function getMaterial() {
        return "使用了50單位的水晶、10單位的瓦斯";
    }
    
    public function train() {
        return "訓練時間20秒";
    }
    
    public function create() {
        return "I am a Solider, Waiting for your order!";
    }
}


?>