<?php

$min = 0;
$max = 99;
$currentPoint = 50;

echo "Start point: " . $currentPoint;
echo "\n\n";

$combinations = file('input.txt');
$hit_zero = 0;
$zero_passed = 0;

for($i = 0; $i < count($combinations); $i++) {
// for($i = 0; $i < 100; $i++) {
    $numeric_combination = str_replace(['L', 'R'], '', trim($combinations[$i]));

    if(detectDirection($combinations[$i]) == 'Left')
        $numeric_combination *= -1;

    // echo "Raw Combination " . ($i + 1) . ": " . trim($combinations[$i]) . "\n";
    // echo "Direction: " . detectDirection($combinations[$i]) . "\n";
    echo "Numeric combination: " . $numeric_combination . "\n";

    echo "0. Current point: " . $currentPoint . "\n";

    // Conta attraversamenti dello zero durante il movimento
    $crossings = countZeroCrossings($currentPoint, $numeric_combination);
    $hit_zero += $crossings;

    $currentPoint += $numeric_combination;

    echo "1. Current point: " . $currentPoint . "\n";

    echo "1.1 (Current point % 100) => $currentPoint % 100" . ": " . ($currentPoint % 100) . "\n";

    $currentPoint = (($currentPoint % 100) + 100) % 100;

    // Conta se finiamo esattamente su 0
    if($currentPoint == 0)
        $hit_zero++;

    echo "2. Current point: " . $currentPoint . "\n";
    echo "Zero crossings during movement: " . $crossings . "\n";
    echo "Total zero hits so far: " . $hit_zero . "\n";
    echo "\n";
}

echo "With zero: " . $hit_zero . "\n";

function detectDirection($combination) {
    return str_starts_with($combination, 'L') ? 'Left' : 'Right';
}

function countZeroCrossings($startPos, $movement) {
    if($movement == 0) return 0;

    $zeroHits = 0;

    if($movement > 0) { // TO RIGHT
        for($i = 1; $i < $movement; $i++) {
            $currentPos = ($startPos + $i) % 100;
            if($currentPos == 0) {
                $zeroHits++;
            }
        }
    } else { // TO LEFT
        $absMovement = abs($movement);
        for($i = 1; $i < $absMovement; $i++) {
            $currentPos = (($startPos - $i) % 100 + 100) % 100;
            if($currentPos == 0) {
                $zeroHits++;
            }
        }
    }

    return $zeroHits;
}

