<?php


class Puzzle
{
    private $x;
    private $y;
    private $name;
    /**
     * @var Puzzle
     */

    public function __construct(int $x, int $y, int $name) {
        $this->x = $x;
        $this->y = $y;
        $this->name = $name;

    }

    public function viewPuzzle(string $style) {
        if ($this->x%4 != 0) {
            echo "<td width='30'><input type = 'submit' value='" . $this->name . "' name='char' style='".$style."'/> </td>";
        }
        else {
            echo "<td width='30'><input type = 'submit' value='" . $this->name . "' name='char' style='".$style."'/> </td>";
            echo "</tr><tr>";
        }
    }

    public function getEmptyPuzzle() {
        if ($this->name == 16) {
            return $this;
        }
    }

    public function getChoicePuzzle(int $name) {
        if ($this->name == $name) {
            return $this;
        }
    }

    public function getName(): int
    {
        return $this->name;
    }

    public function movePuzzle (Puzzle $choice) {
        $y = abs($this->y-$choice->y);
        $x = abs($this->x-$choice->x);
        if ((($this->x === $choice->x) && ($y == 1)) || (($this->y === $choice->y) && ($x == 1))) {
            $f = $this->name;
            $this->name = $choice->name;
            $choice->name = $f;
        }
    }


    public function getFinish (int $i) : bool {
        $result = false;
        if ($this->name == $i)
            $result = true;
        return $result;
    }


}