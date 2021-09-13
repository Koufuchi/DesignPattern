<?php
/**
 * Builder(生成器模式)
 * 
 * 優點：
 * 
 * 1. 客戶端不必知道 Product 內部組成的細節，將 Product 本身與 Product 的創建過程解耦，使得相同的創建過程可以創建不同的 Product 物件。
 * 
 * 2. 每一個 Concrete Builder 都相對獨立，而與其他的 Concrete Builder 無關，因此可以很方便地替換或增加新的 Concrete Builder，
 *    用戶使用不同的 Concrete Builder 即可得到不同的 Product 物件。
 * 
 * 3. 可以更加精細地控制 Product 的創建過程。將複雜 Product 的創建步驟分解在不同的方法中，使得創建過程更加清晰，也更方便使用程式來控制創建過程。
 * 
 * 4. 增加新的 Concrete Builder 無須修改原有類別的代碼，Director 針對 Builder 程式設計，系統擴展方便，符合開閉原則。
 * 
 * 缺點：
 * 
 * 1. Builder 模式所創建的 Product 一般具有較多的共同點，其組成部分相似，
 *    如果 Product 之間的差異性很大，則不適合使用 Builder模式，因此其使用範圍受到一定的限制。
 * 
 * 2. 如果 Product 的內部變化複雜，可能會導致需要定義很多 Concrete Builder 類別來實現這種變化，導致系統變得很龐大。
 * 
 * 使用時機：
 * 
 * 1. 需要生成的產品物件有複雜的內部結構，這些產品物件通常包含多個成員屬性。
 * 
 * 2. 需要生成的產品物件的屬性相互依賴，需要指定其生成順序。
 * 
 * 3. 物件的創建過程獨立於創建該物件的類別。在 Builder 模式中引入了 Director 類別，將創建過程封裝在 Director 類別中，而不在 Builder 類別中。
 * 
 * 4. 隔離複雜物件的創建和使用，並使得相同的創建過程可以創建不同的產品。
 */

// Product 預計被製作的產品
class Meal
{
    private $food;    // 主食
    private $drink;   // 飲料
    private $dessert; // 點心

    public function setFood($food) {
        $this->food = $food;
    }

    public function setDrink($drink) {
        $this->drink = $drink;
    }

    public function setDessert($dessert) {
        $this->dessert = $dessert;
    }

    public function showMeal() {
        return $this->food . ", " . $this->drink . ", " . $this->dessert;
    }
}

// Builder
/** 給出一個抽象介面，以規範產品物件的各個組成成分的建造。一般而言，此介面獨立於應用程式的商業邏輯。
 *  模式中直接創建產品物件的是 ConcreteBuilder。具體建造者類必須實現這個介面所要求的方法：一個是建造方法，另一個是結果返還方法。
 */
abstract class MealBuilder 
{
    protected $meal = null;

    public function __construct() {
        $this->meal = new Meal();
    }

    public abstract function buildFood();
    public abstract function buildDrink();
    public abstract function buildDessert();
    public function getMeal() {
        return $this->meal;
    }
} 

// ConcreteBuilder  實作 Builder 的接口，建造 Product 物件並回傳。
class ChickenKitMealBuilder extends MealBuilder
{    
    public function buildFood() {
        $this->meal->setFood("一個雞腿堡");
    }

    public function buildDrink() {
        $this->meal->setDrink("一杯可樂");
    }

    public function buildDessert() {
        $this->meal->setDessert("一包薯條");
    }
}

// ConcreteBuilder
class BeefKitMealBuilder extends MealBuilder
{
    public function buildFood() {
        $this->meal->setFood("一個牛肉堡");
    }

    public function buildDrink() {
        $this->meal->setDrink("一杯紅茶");
    }

    public function buildDessert() {
        $this->meal->setDessert("一個蘋果派");
    }
}

// Director  使用 Builder 以創建 Product 物件。
class MealDirector
{
    private $mealBuilder;

    public function setMealBuilder(MealBuilder $mealBuilder) {
        $this->mealBuilder = $mealBuilder;
    }

    public function buildMeal() {
        $this->mealBuilder->buildFood();
        $this->mealBuilder->buildDrink();
        $this->mealBuilder->buildDessert();

        return $this->mealBuilder->getMeal();

    }
}
?>