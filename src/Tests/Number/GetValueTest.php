<?php

use \PHPUnit\Framework\TestCase;

class GetValueTest extends TestCase
{
    /**
     * @param int $value
     * @param int $expected
     * @dataProvider getData
     */
    public function testGetValue(int $value, int $expected): void
    {
        $number = new Number($value);
        $this->assertSame($expected, $number->getValue());
    }

    public function getData(): array
    {
        return [
            'case_0' => [
                'value' => 1,
                'expected' => 1
            ],
            'case_1' => [
                'value' => 0,
                'expected' => 0
            ],
            'case_2' => [
                'value' => PHP_INT_MAX - 10,
                'expected' => PHP_INT_MAX - 10
            ],
        ];
    }
}