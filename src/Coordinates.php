<?php

class Coordinates
{
    /**
     * @var int
     */
    private $rowN;

    /**
     * @var int
     */
    private $colN;

    public function __construct(int $rowN, int $colN)
    {
        $this->rowN = $rowN;
        $this->colN = $colN;
    }

    public function getRowN(): int
    {
        return $this->rowN;
    }

    public function getColN(): int
    {
        return $this->colN;
    }
}