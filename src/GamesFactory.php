<?php

class GamesFactory
{
    public function createNewGamePuzzle(int $rows, int $cols): PuzzleGame
    {
        $ceils = [];
        for ($i = 1; $i <= $rows*$cols; $i++) {
            $ceil = new Ceil($i, $this->getCoordinates($i, $cols));
            if ($i < $rows*$cols) {
                $ceil->setNumber(new Number($i));
            }
            $ceils[] = $ceil;
        }
        $collection = new CeilCollection($ceils);
        $result = new PuzzleGame($collection, $rows, $cols);
        $result->start();
        return $result;
    }

    private function getCoordinates(int $position, int $cols): Coordinates
    {
        $rowN = ceil($position / $cols);
        $colN = $position < $cols ? $position: $position % $cols;
        $colN = $colN === 0 ? $cols : $colN;
        return new Coordinates($rowN, $colN);
    }
}