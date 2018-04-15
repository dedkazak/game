<?php

class CeilCollection implements Countable
{
    /**
     * @var Ceil[]
     */
    private $items = [];

    public function __construct(array $items)
    {
        $this->items = $items;
    }

    public function getCeil(int $position): Ceil
    {
        foreach ($this->getItems() as $item) {
            if ($item->getPosition() === $position) {
                return $item;
            }
        }
        throw new InvalidArgumentException("invalid ceil position {$position}");
    }

    public function getCeilByNumberValue(int $numberValue): Ceil
    {
        foreach ($this->getItems() as $item) {
            $number = $item->getNumber();
            if ($number !== null && $number->getValue() === $numberValue) {
                return $item;
            }
        }
        throw new InvalidArgumentException("invalid numberValue {$numberValue}");
    }

    public function count(): int
    {
        return count($this->getItems());
    }

    /**
     * @return Ceil[]
     */
    private function getItems(): array
    {
        return $this->items;
    }
}