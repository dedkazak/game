<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');


include "Puzzle.php";
session_start();
$names = range(1, 16);
shuffle($names);
//заполнение массива пазлов
function fillArray(array $names) {
    $x = 1;
    $y = 1;
    foreach ($names as $number) {
        if ($y < 5) {

            if ($x < 4) {
                $puzzle[$number] = new Puzzle($x, $y, $number);
                $x++;
            }
            else {
                $puzzle[$number] = new Puzzle($x, $y, $number);
                $x = 1;
                $y++;
            }
        }
    }
    return $puzzle;
}
//вывод пазлов
function view(array $array) {
    echo "<form method='post'><table border = 1><tr>";
    foreach ($array as $value) {
        if ($value->getName() == 16) {
            $style = "visibility:hidden;";
        }
        else $style = "width:50px;";
        $value->viewPuzzle($style);
    }
    echo "</tr></table></form>";
}
function getFinish(array $array, $i = 1, $result = true) {
    foreach ($array as $value) {
        $result *= $value->getFinish($i);
        $i++;
    }
    return $result;
}

if (!isset($_POST['char'])) {
    $_SESSION['puz'] = fillArray($names);
    view($_SESSION['puz']);
}

//если передвинут пазл
else {
    $name = $_POST['char'];
    foreach ($_SESSION['puz'] as $value) {
        if (empty($empty))
            $empty = $value->getEmptyPuzzle();
        if (empty($choice))
            $choice = $value->getChoicePuzzle((int)$name);
        $arr[] =  $value->getName();
    }

    $empty->movePuzzle($choice);
    if (getFinish($_SESSION['puz'])) echo "Игра окончена! Чтоб начать сначала, перезагрузите страницу.";
    else view($_SESSION['puz']);
}
