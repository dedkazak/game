<?php
use \PHPUnit\Framework\TestCase;

class GetCeilPositionTest extends TestCase
{
    /**
     * @param int $position
     * @param int $expected
     * @dataProvider getData
     */
    public function testGetPosition(int $position, int $expected):void
    {
        $mock = $this->getMockBuilder(Coordinates::class)->disableOriginalConstructor()->getMock();
        $ceil = new Ceil($position, $mock);
        $this->assertSame($expected, $ceil->getPosition());
    }

    public function getData(): array
    {
        return [
            'case_0' => [
                'position' => 1,
                'expected' => 1
            ],
            'case_1' => [
                'position' => 5,
                'expected' => 5
            ],
            'case_2' => [
                'position' => PHP_INT_MIN + 100,
                'expected' => PHP_INT_MIN +100
            ]
        ];
    }
}