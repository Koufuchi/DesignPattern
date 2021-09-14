<?php

use PHPUnit\Framework\TestCase;
include_once('pattern\prototype.php'); 

class prototypeTest extends TestCase
{
    public function testPrototype() {
        $obj1 = new SubObject('obj1');
        $obj2 = new SubObject('obj2');

        // 產生一個 NovelPrototype 物件
        $novel1 = new NovelPrototype($obj1, $obj2, 'Novel1');

        $expect = [
            'topic' => 'Novel',
            'title' => 'Novel1',
            'object1_Value' => 'obj1',
            'object2_Value' => 'obj2'
        ];

        $this->assertEmpty(array_diff_assoc($novel1->show(), $expect));
        $this->assertEquals(1, $novel1->subObject1->instance);
        $this->assertEquals('obj1', $novel1->subObject1->value);
        $this->assertEquals(2, $novel1->subObject2->instance);
        $this->assertEquals('obj2', $novel1->subObject2->value);

        // 複製 $novel1
        $novel2 = clone $novel1;
        $this->assertEmpty(array_diff_assoc($novel2->show(), $expect));
        $this->assertEquals(3, $novel2->subObject1->instance);  // 建立了新實體
        $this->assertEquals('obj1', $novel2->subObject1->value);
        $this->assertEquals(2, $novel2->subObject2->instance);
        $this->assertEquals('obj2', $novel2->subObject2->value);

        // 修改 $novel2 的 title
        $novel2->setTitle('modified Novel2 Title');

        $novel3 = $novel2;

        $this->assertNotEmpty(array_diff_assoc($novel3->show(), $expect)); // title 修改過了
        $this->assertEquals('modified Novel2 Title', $novel3->title);
        $this->assertEquals(3, $novel3->subObject1->instance);  // 引用原來物件
        $this->assertEquals('obj1', $novel3->subObject1->value);
        $this->assertEquals(2, $novel3->subObject2->instance);
        $this->assertEquals('obj2', $novel3->subObject2->value);
        
    }
}

?>