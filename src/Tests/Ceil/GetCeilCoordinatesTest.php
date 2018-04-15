<?php
use \PHPUnit\Framework\TestCase;

class GetCeilCoordinatesTest extends TestCase
{
    public function testGetCeilCoordinates():void
    {
        $mock = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $ceil = new Ceil(0, $mock);
        $this->assertSame($mock, $ceil->getCoordinates());
    }
}