<?php

function checkInputIsValid($inputString)
{
    $numberStrings = explode(' ', trim($inputString));
    foreach ($numberStrings as $numberString) {
        if (!is_numeric($numberString)) {
            return false;
        }
    }
    return true;
}

function summarizeNumbers($numbers)
{
    $maxValue = max($numbers);
    $minValue = min($numbers);
    $total = array_sum($numbers);
    $averageValue = $total / count($numbers);

    echo "\n=== Results ===\n";
    echo "Maximum: $maxValue\n";
    echo "Minimum: $minValue\n";
    echo "Sum: $total\n";
    echo "Average: " . number_format($averageValue, 2) . "\n\n";
}

while (true) {
    echo "Enter a list of numbers separated by spaces (or type 'exit' to quit): ";
    $inputString = trim(fgets(STDIN));

    if (strtolower($inputString) === 'exit') {
        break;
    }

    if (!checkInputIsValid($inputString)) {
        echo "Invalid input. Please enter only numbers separated by spaces.\n\n";
        continue;
    }

    $numberArray = array_map('floatval', explode(' ', $inputString));
    summarizeNumbers($numberArray);
}