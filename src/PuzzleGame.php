<?php

class PuzzleGame
{

    private const COUNT_SHUFFLE = 10000;

    /**
     * @var CeilCollection
     */
    private $ceilCollection;

    /**
     * @var int
     */
    private $rows;

    /**
     * @var int
     */
    private $cols;

    public function __construct(
        CeilCollection $ceilCollection,
        int $rows,
        int $cols
    )
    {
        $this->ceilCollection = $ceilCollection;
        $this->rows = $rows;
        $this->cols = $cols;
    }

    public function getNumberValue(int $ceilNumber): ?int
    {
        $number = $this->ceilCollection->getCeil($ceilNumber)->getNumber();
        return $number === null ? null : $number->getValue();
    }

    public function start(): void
    {
        $i = 0;
        do {
            $this->push(random_int(1, count($this->ceilCollection) - 1));
        } while ($this->isFinish() || $i++ < self::COUNT_SHUFFLE);
    }

    public function push(int $numberValue): bool
    {
        $result = false;
        $ceil = $this->ceilCollection->getCeilByNumberValue($numberValue);
        if ($emptyCeil = $this->getEmptyMovableCeil($ceil)) {
            $ceil->setNumber($emptyCeil->setNumber($ceil->getNumber()));
            $result = true;
        }
        return $result;
    }

    public function isFinish(): bool
    {
        $result = true;
        for ($i = 1, $iMax = count($this->ceilCollection) - 1; $i <= $iMax; $i++) {
            $ceil = $this->ceilCollection->getCeil($i);
            $number = $ceil->getNumber();
            if ($number === null || $number->getValue() !== $ceil->getPosition()) {
                $result = false;
                break;
            }
        }
        return $result;
    }

    private function getEmptyMovableCeil(Ceil $ceil): ?Ceil
    {
        $result = null;
        foreach ($this->getNeighboringPositions($ceil->getPosition()) as $neighboringPosition) {
            $neighboringCeil = $this->ceilCollection->getCeil($neighboringPosition);
            if (
                $neighboringCeil->isEmpty()
                && $this->isMovable($ceil->getCoordinates(), $neighboringCeil->getCoordinates())
            ) {
                $result = $neighboringCeil;
                break;
            }
        }
        return $result;
    }

    private function isMovable(Coordinates $from, Coordinates $to): bool
    {
        $movableRow = $from->getColN() === $to->getColN() && abs($from->getRowN() - $to->getRowN()) === 1;
        $movableCol = $from->getRowN() === $to->getRowN() && abs($from->getColN() - $to->getColN()) === 1;
        return $movableRow || $movableCol;
    }

    /**
     * @param int $position
     * @return int[]
     */
    private function getNeighboringPositions(int $position): array
    {
        $result = [];
        //left
        if ($position - 1 > 0) {
            $result[] = $position - 1;
        }
        //up
        if ($position - $this->cols > 0) {
            $result[] = $position - $this->cols;
        }
        //right
        if ($position + 1 <= $this->cols * $this->rows) {
            $result[] = $position + 1;
        }
        //down
        if ($position + $this->cols <= $this->cols * $this->rows) {
            $result[] = $position + $this->cols;
        }
        return $result;
    }

}