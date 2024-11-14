<?php

// 467..114..
// ...*......
$sum = 0;
$input_array = file('input.txt');
// create 2-dimensional array
for ($index=0; $index<count($input_array); $index++) {
    $input_array[$index] = str_split(str_replace(array("\r", "\n"), '',$input_array[$index]));
}
$max_char_index = count($input_array[0])-1;
$max_line_index = count($input_array)-1;
$is_engine_number = false;
$current_number_string = "";
for ($line_index=0; $line_index<=$max_line_index; $line_index++) {
    for ($char_index=0; $char_index<=$max_char_index; $char_index++) {
        $current_char = $input_array[$line_index][$char_index];
        if (is_numeric($current_char)) {
            $current_number_string .= $current_char;
            // check for adjacent "symbol" character
            if (
                $char_index != 0 && is_symbol($input_array[$line_index][$char_index-1]) || // same line one left
                $char_index != $max_char_index && is_symbol($input_array[$line_index][$char_index+1]) || // same line one right
                $char_index != 0 && $line_index != 0 && is_symbol($input_array[$line_index-1][$char_index-1]) || // previous line one left
                $line_index != 0 && is_symbol($input_array[$line_index-1][$char_index]) || // previous line same
                $char_index != $max_char_index && $line_index != 0 && is_symbol($input_array[$line_index-1][$char_index+1]) || // previous line one right
                $char_index != 0 && $line_index != $max_line_index && is_symbol($input_array[$line_index+1][$char_index-1]) || // next line one left
                $line_index != $max_line_index && is_symbol($input_array[$line_index+1][$char_index]) || // next line same
                $char_index != $max_char_index && $line_index != $max_line_index && is_symbol($input_array[$line_index+1][$char_index+1]) // next line one right
            ) {
                $is_engine_number = true;
            }
            if ($char_index==$max_char_index) {
                // end of line, check if number should be added to sum and reset
                if ($is_engine_number) {
                    echo intval($current_number_string) . "\n";
                    $sum += intval($current_number_string);
                    $is_engine_number = false;
                }
                $current_number_string = "";
            }
        } else {
            // reached end of number or do nothing
            if ($current_number_string!="") {
                // reached end of a number
                if ($is_engine_number) {
                    echo intval($current_number_string) . "\n";
                    $sum += intval($current_number_string);
                    $is_engine_number = false;
                }
                $current_number_string = "";
            }
        }
    }
}
print_r($sum);

function is_symbol($char) {
    if (!is_numeric($char) && $char!=".") {
        return true;
    } else {
        return false;
    }
}