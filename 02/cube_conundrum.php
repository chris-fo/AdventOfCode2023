<?php
require_once('game.php');
$input_array = file('input.txt');
$red_cubes = 12;
$green_cubes = 13;
$blue_cubes = 14;
$sum = 0;
$power_sum = 0;
foreach ($input_array as $line) {
    // remove linebreaks at end of line
    $line = str_replace(array("\r", "\n"), '', $line);
    $game = new Game($line);
    if ($game->isGamePossible($red_cubes, $green_cubes, $blue_cubes)) {
        $sum += $game->getID();
    }
    $power_sum += $game->getPower();
}
echo "Part 1: " . $sum . "\n";
echo "Part 2: " . $power_sum . "\n";
