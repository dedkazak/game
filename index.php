<?php
declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', '1');


include "Puzzle.php";
session_start();
$names = range(1, 16);
shuffle($names);
//создание массива объектов+вывод на экран
$x = 0;
$y = 0;
if (!isset($_POST['char'])) {
    echo "<form method='post'><table border = 1><tr>";

    foreach ($names as $number) {
        if ($number == 16) {
            $style = "visibility:hidden;";
        }
        else $style = "width:50px;";
        if ($y < 4) {

            if ($x < 3) {
                $puzzle[$number] = new Puzzle($x, $y, $number);
                $x++;
                echo "<td width='30'><input type = 'submit' value='" . $number . "' name='char' style='".$style."'/> </td>";

            } else {


                $puzzle[$number] = new Puzzle($x, $y, $number);
                echo "<td width='30'><input type = 'submit' value='" . $number . "' name='char' style='".$style."'/> </td>";
                echo "</tr><tr>";
                $x = 0;
                $y++;
            }
        }
    }
    echo "</tr></table></form>";
    $_SESSION['puz'] = $puzzle;
}
//если передвинут пазл
else {
    $arrayPuzzle = $_SESSION['puz'];
    $name = $_POST['char'];
    $finish = true;
    $keys = array_keys($arrayPuzzle);
    //определение пустого элемента
    foreach ($arrayPuzzle as $elem) {
        if ($elem->getName() == 16) {
            $empty = $elem;
        }
    }
    //поиск и замена на рядом стоящий элемент с пустым
    foreach ($arrayPuzzle as $elem) {
        $elem->findPuzzle((int )$name, $empty);
    }
    //собран ли пазл?
    foreach ($arrayPuzzle as $key => $value) {
        $currentIndex = array_search($key, $keys) + 1;
        $prevFinish = $value->getFinish($currentIndex);
        $finish = $finish && $prevFinish;
    }


    if ($finish == true) {
        echo "Игра окончена! Чтоб начать сначала, перезагрузите страницу.";
    }
    else {
        echo "<form method='post'><table border = 1><tr>";
        $x = 0;
        $y = 0;
        foreach ($arrayPuzzle as $number) {
            if ($number->getName() == 16) {
                $style = "visibility:hidden;";
            } else $style = "width:50px;";
            if ($y < 4) {

                if ($x < 3) {

                    $x++;
                    echo "<td width='30'><input type = 'submit' value='" . $number->getName() . "' name='char' style='" . $style . "'/> </td>";

                } else {

                    $y++;
                    echo "<td width='30'><input type = 'submit' value='" . $number->getName() . "' name='char' style='" . $style . "'/> </td>";
                    echo "</tr><tr>";
                    $x = 0;
                }
            }
        }
    }




}
