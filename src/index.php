<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '../vendor/autoload.php';

$rows = 10;
$cols = 4;
$gameFactory = new GamesFactory();
$game = $gameFactory->createNewGamePuzzle($rows, $cols);

$countPushes = 0;
while (!$game->isFinish()) {
    $ceil = 1;
    for ($i = 1; $i <= $rows; $i++) {
        for ($j = 1; $j <= $cols; $j++) {
            echo sprintf("    %d    ", $game->getNumberValue($ceil));
            $ceil++;
        }
        echo PHP_EOL;
    }
    echo PHP_EOL;
    if (!$game->isFinish()) {
        $numberValue = trim(readline("enter number value to push: "));
        try {
            $game->push($numberValue);
            $countPushes++;
        } catch (\Throwable $e) {
            echo "invalid value {$numberValue}" . PHP_EOL;
        }
    }
}

echo "game finish, count pushes = {$countPushes}" . PHP_EOL;