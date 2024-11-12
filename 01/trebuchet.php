<?php
$number_array = array(
    'one' => 1,
    'two' => 2,
    'three' => 3,
    'four' => 4,
    'five' => 5,
    'six' => 6,
    'seven' => 7,
    'eight' => 8,
    'nine' => 9,
);
$lookahead_number_regex = '/(?=(one|two|three|four|five|six|seven|eight|nine))/';
$input_array = file('input.txt');
$sum = 0;

function find_first_or_last_number($chars, $find_first) {
    global $number_array, $lookahead_number_regex;
    $substring = '';
    foreach($chars as $character) {
        if(is_numeric($character)) {
            // check if previous substring contains number word
            if (preg_match_all($lookahead_number_regex, $substring, $matches) >= 1) {
                $find_first ? $number = $number_array[$matches[1][0]] : $number = $number_array[end($matches[1])];
                return $number;
            } else {
                return $character;
            }
            break;
        }
        $find_first ? $substring .= $character : $substring = $character . $substring;
    }
    preg_match_all($lookahead_number_regex, $substring, $matches);
    $find_first ? $number = $matches[1][0] : $number = end($matches[1]);
    return $number_array[$number];
}
foreach ($input_array as $line) {
    //echo $line;
    $line_chars = str_split($line);
    // find first number
    $first_number = find_first_or_last_number($line_chars, true);
    // find last number
    $last_number = find_first_or_last_number(array_reverse($line_chars), false);
    // concat numbers
    //echo "First Number: " . $first_number . "\n";
    //echo "Last Number: " . $last_number . "\n";
    $number = $first_number . $last_number;
    //echo "Number: " . $number . "\n";
    // add to sum
    $sum += intval($number);
}

echo $sum;

?>