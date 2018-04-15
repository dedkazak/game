<?php
use \PHPUnit\Framework\TestCase;

class SetCeilNumberTest extends TestCase
{
    public function testSetNumber():void
    {
        $number0 = null;
        $number1 = $this->getMockBuilder(Number::class)->disableOriginalConstructor()->getMock();
        $number2 = $this->getMockBuilder(Number::class)->disableOriginalConstructor()->getMock();
        $ceil = new Ceil(0, $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock());
        $this->assertNull($ceil->setNumber($number0));
        $this->assertNull($ceil->setNumber($number1));
        $this->assertSame($number1, $ceil->setNumber($number2));
        $this->assertSame($number2, $ceil->setNumber($number1));
        $this->assertSame($number1, $ceil->setNumber($number0));
    }
}