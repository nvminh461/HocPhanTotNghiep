<?php

// Function to calculate the inverse of a 2x2 matrix
function inverseMatrix($matrix) {
    $det = $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
    $adj = [
        [$matrix[1][1], -$matrix[0][1]],
        [-$matrix[1][0], $matrix[0][0]]
    ];
    $inv = [
        [$adj[0][0] / $det, $adj[0][1] / $det],
        [$adj[1][0] / $det, $adj[1][1] / $det]
    ];
    return $inv;
}

// Function to multiply a matrix by a column vector
function multiplyMatrixVector($matrix, $vector) {
    $result = [0, 0];
    for ($i = 0; $i < 2; $i++) {
        for ($j = 0; $j < 2; $j++) {
            $result[$i] += $matrix[$i][$j] * $vector[$j];
        }
    }
    return $result;
}

// Function to calculate the modulo of each element in a vector
function moduloVector($vector, $mod) {
    $result = [];
    foreach ($vector as $element) {
        $result[] = $element % $mod;
    }
    return $result;
}

// Input matrix and vector
$matrix = [[1, 2], [3, 4]];
$vector = [3, 5];
$mod = 5;

// Step 1: Calculate the inverse of the matrix
$inverseMatrix = inverseMatrix($matrix);

// Step 2: Multiply the inverse matrix by the vector
$resultVector = multiplyMatrixVector($inverseMatrix, $vector);

// Step 3: Calculate the modulo of each element in the result vector
$finalResult = moduloVector($resultVector, $mod);

// Output the final result
print_r($finalResult);

?>
