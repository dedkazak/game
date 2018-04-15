<?php
use \PHPUnit\Framework\TestCase;

class GetCeilByNumberValueTest extends TestCase
{
    /**
     * @param array $ceils
     * @param array $expected
     * @param string|null $expectedException
     * @dataProvider getData
     */
    public function testGetCeilByNumberValue(array $ceils, array $expected, string $expectedException = null): void
    {
        if ($expectedException !== null) {
            $this->expectException($expectedException);
        }
        $ceilcollection = new CeilCollection($this->createCeils($ceils));
        foreach ($expected as $number) {
            $this->assertSame($number, $ceilcollection->getCeilByNumberValue($number)->getNumber()->getValue());
        }
    }

    public function getData(): array
    {
        return [
            'case_0' => [
                'ceils' => [],
                'expected' => [3],
                'expectedException' => InvalidArgumentException::class,
            ],
            'case_1' => [
                'ceils' => [
                    ['getNumber' => null],
                    ['getNumber' => 3],
                ],
                'expected' => [3],
                'expectedException' => null,
            ],
        ];
    }

    private function createCeils(array $data): array
    {
        $result = [];
        foreach ($data as $someCeilData) {
            $mock = $this->getMockBuilder(Ceil::class)
                ->disableOriginalConstructor()
                ->setMethods(['getNumber'])
                ->getMock();
            $mock->method('getNumber')->willReturn($this->createNumber($someCeilData['getNumber']));
            $result[] = $mock;
        }
        return $result;
    }

    private function createNumber(?int $number): ?Number
    {
        $result = null;
        if ($number !== null) {
            $result = $this->getMockBuilder(Number::class)
                ->disableOriginalConstructor()
                ->setMethods(['getValue'])
                ->getMock();
            $result->method('getValue')->willReturn($number);
        }
        return $result;
    }
}