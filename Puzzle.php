<?php


class Puzzle
{
    private $x;
    private $y;
    private $name;
    /**
     * @var Puzzle
     */

    public function __construct(int $x, int $y, int $name)
    {
        $this->x = $x;
        $this->y = $y;
        $this->name = $name;

    }


    public function getName(): int
    {
        return $this->name;
    }

    public function findPuzzle (int $name, Puzzle $empty)
    {
        if ($this->name == $name) {
            if ((($this->x === $empty->x) && (abs($this->y-$empty->y) == 1)) || (($this->y === $empty->y) && (abs($this->x-$empty->x) == 1))) {
                $f = $this->name;
                $this->name = $empty->name;
                $empty->name = $f;
            }


        }

    }

    public function getFinish (int $i) : bool
    {
        $result = false;
        if ($this->name == $i)
            $result = true;
        return $result;
    }


}