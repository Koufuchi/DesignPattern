<?php
/**
 * Prototype(原型模式)
 * 
 * 優點：
 * 
 * 1. 當創建新的物件實例較為複雜時，使用 Prototype 可以簡化物件的創建過程。在某些環境下，複製已有物件可以比重新建立物件更有效率。
 * 
 * 2. 可以動態增加或減少產品類。 
 * 
 * 3. 原型模式提供了簡化的創建結構。 
 * 
 * 4. 可以使用深複製(deep clone)的方式保存物件的狀態。
 * 
 * 缺點：
 * 
 * 1. 需要為每一個類別配備一個 clone 方法，而且這個 clone 方法需要對類別的功能進行通盤考慮，這對全新的類別來說不是很難，但對已有的類別進行改造時，
 *    不一定是件容易的事，必須修改其原始程式碼，違背了開閉原則。
 * 
 * 2. 在實現深複製時需要編寫較為複雜的代碼。
 * 
 * 使用時機：
 * 
 * 1. 創建新物件的過程很昂貴或很複雜時，新的物件可以通過 Prototype 模式對已有物件進行複製來獲得，如果是相似物件，則可以對其屬性稍作修改。
 * 
 * 2. 如果系統要保存物件的狀態，而物件的狀態變化很小，或者物件本身占記憶體不大的時候，也可以使用 Prototype 模式配合 Memento 模式來應用。
 *    相反，如果物件的狀態變化很大，或者物件佔用的記憶體很大，那麼採用 State 模式會比 Prototype 模式更好。
 * 
 * 3. 需要避免使用分層次的工廠類別來創建分層次的物件，並且類別的實例物件只有一個或很少的幾個組合狀態，
 *    通過複製原型物件得到新實例可能比使用構造函數創建一個新實例更加方便。
 * 
 * 
 * 淺複製(shallow clone)：
 *   被複製物件的所有變數都含有與原來的物件相同的值，而所有的對其他物件的引用仍然指向原來的物件。
 *   換言之，淺複製僅僅複製所考慮的對象，而不複製它所引用的對象。
 * 
 * 深複製(deep clone)：
 *   被複製物件的所有變數都含有與原來的物件相同的值，除去那些引用其他物件的變數。
 *   那些引用其他物件的變數將指向被複製過的新物件，而不再是原有的那些被引用的物件。換言之，深複製把要複製的物件所引用的物件都複製了一遍。
 * 
 * 
 * PHP 物件複製(Clone)規則：
 * 
 * 1. 有在__clone() 底下指定複製的子物件，會建立新的實體，反之會引用原本的子物件
 * 
 * 2. 數值類的變數會直接複製一份，修改複製過後變數的數值不會影響被複製物件的數值
 * 
 * 3. 使用 assign(=)，只會引用原本的子物件，即使 __clone() 裡有指定
 * * */

// 模擬 Prototype 裡面的子物件
class SubObject 
{
    static $instances = 0;
    public $instance;
    public $value;

    public function __construct($value) {
        $this->instance = ++self::$instances;
        $this->value = $value;
    }
    public function __clone() {
        $this->instance = ++self::$instances;
    }

    public function showValue() {
        return $this->value;
    }
}


// Prototype  抽象類別，負責定義所有 ConcretePrototype 所需的介面(接口)。
abstract class BookPrototype
{
    public $subObject1;
    public $subObject2;
    public $title;
    public $topic;

    public function __construct($obj1, $obj2, $title) {
        $this->subObject1 = $obj1;
        $this->subObject2 = $obj2;
        $this->title = $title;
    } 
    // Deep Clone
    public function __clone() {
        // Force a copy of this->object, otherwise it will point to same object.
        $this->subObject1 = clone $this->subObject1;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function show() {

        return [
            'topic' => $this->topic,
            'title' => $this->title,
            'object1_Value' => $this->subObject1->showValue(),
            'object2_Value' => $this->subObject2->showValue(),
        ]; 
    }
}


// ConcretePrototype  被複製的物件，需實作 Prototype 所定義的介面(接口)。
class NovelPrototype extends BookPrototype
{
    public function __construct($obj1, $obj2, $title) {
        parent::__construct($obj1, $obj2, $title);
        $this->topic = "Novel";
    }

}

// ConcretePrototype
class ReferenceBookPrototype extends BookPrototype
{
    public function __construct($obj1, $obj2, $title) {
        parent::__construct($obj1, $obj2, $title);
        $this->topic = "ReferenceBook";
    }

}




?>