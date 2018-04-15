<?php

class Ceil
{

    /**
     * @var int
     */
    private $position;

    /**
     * @var Coordinates
     */
    private $coordinates;

    /**
     * @var Number|null
     */
    private $number;

    public function __construct(int $position, Coordinates $coordinates)
    {
        $this->position = $position;
        $this->coordinates = $coordinates;
    }

    public function getPosition(): int
    {
        return $this->position;
    }

    public function getCoordinates(): Coordinates
    {
        return $this->coordinates;
    }

    public function isEmpty(): bool
    {
        return $this->number === null;
    }

    public function setNumber(?Number $number): ?Number
    {
        $previous = $this->getNumber();
        $this->number = $number;
        return $previous;
    }

    public function getNumber(): ?Number
    {
        return $this->number;
    }
}