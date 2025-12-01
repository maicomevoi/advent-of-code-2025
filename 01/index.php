<?php

$min = 0;
$max = 99;
$dial = range($min, $max);
$currentPoint = 50;

echo "Start point: " . $currentPoint;
echo "\n\n";

$combinations = file('input.txt');
$hit_zero = 0;

for($i = 0; $i < count($combinations); $i++) {
// for($i = 0; $i < 50; $i++) {
    $numeric_combination = str_replace(['L', 'R'], '', $combinations[$i]);

    if(detectDirection($combinations[$i]) == 'Left')
        $numeric_combination *= -1;

    // echo "Raw Combination " . ($i + 1) . ": " . $combinations[$i];
    // echo "Direction: " . detectDirection($combinations[$i]) . "\n";
    // echo "Numeric combination: " . $numeric_combination . "\n";

    $currentPoint += $numeric_combination;

    if($currentPoint >= 100)
        $currentPoint -= 100;

    if($currentPoint == 0)
        $hit_zero++;

    // echo "Current point: " . $currentPoint . "\n";
    // echo "\n";
}

// echo count($combinations) . "\n";
echo "With zero: " . $hit_zero . "\n";

function detectDirection($combination) {
    return str_starts_with($combination, 'L') ? 'Left' : 'Right';
}

