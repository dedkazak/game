<?php

use \PHPUnit\Framework\TestCase;

class CoordinatesTest extends TestCase
{
    /**
     * @param int $rowN
     * @param int $colN
     * @param array $expected
     * @dataProvider getData
     */
    public function testCoordinates(int $rowN, int $colN, array $expected): void
    {
        $coordnates = new Coordinates($rowN, $colN);
        $this->assertSame($expected['rowN'], $coordnates->getRowN());
        $this->assertSame($expected['colN'], $coordnates->getColN());
    }
    public function getData(): array
    {
        return [
            'case_0' => [
                'rowN' => 1,
                'colN' => 1,
                'expected' => [
                    'rowN' => 1,
                    'colN' => 1,
                ]
            ],
            'case_1' => [
                'rowN' => 0,
                'colN' => 0,
                'expected' => [
                    'rowN' => 0,
                    'colN' => 0,
                ]
            ],
            'case_2' => [
                'rowN' => 10,
                'colN' => 3,
                'expected' => [
                    'rowN' => 10,
                    'colN' => 3,
                ]
            ]
        ];

    }
}