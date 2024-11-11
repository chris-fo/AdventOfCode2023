<?php

$input_array = file('input.txt');
$sum = 0;
foreach ($input_array as $line) {
    $line_chars = str_split($line);
    $first_number;
    $last_number;
    // find first number
    foreach($line_chars as $character) {
        if(is_numeric($character)) {
            $first_number = $character;
            break;
        }
    }
    // find last number
    foreach(array_reverse($line_chars) as $character) {
        if(is_numeric($character)) {
            $last_number = $character;
            break;
        }
    }
    // concat numbers
    $number = $first_number . $last_number;
    // add to sum
    $sum += intval($number);
}

echo $sum;

?>