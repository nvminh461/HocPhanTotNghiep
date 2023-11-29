<?php
// $matrixA = [
//     [$a, $c],
//     [$b, $d]
// ];

$matrixA = [
    [1, 3],
    [2, 4]
];

// $vectorB = [
//     [$xPrime - $rM],
//     [$yPrime - $rN]
// ];

$vectorB = [
    [3],
    [5]
];

$modulusVector = [
    [$m],
    [$n]
];

/**
 * tinh nghich dao ma tran
 */
function modInverse($matrix) {
    $det = $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
    if ($det == 0) {
        die("Ma trận không có ma trận nghịch đảo vì định thức bằng 0.");
    }
    $inverseMatrix = [
        [$matrix[1][1] / $det, -$matrix[0][1] / $det],
        [-$matrix[1][0] / $det, $matrix[0][0] / $det]
    ];

    return $inverseMatrix;
}

/**
 * nhan ma tran voi vector
 */
function multiplyMatrices($matrix, $vector) {

    $resultMatrix = [
        [0],
        [0]
    ];

    for ($i = 0; $i < 2; $i++) {
        for ($j = 0; $j < 1; $j++) {
            for ($k = 0; $k < 2; $k++) {
                $resultMatrix[$i][$j] += $matrix[$i][$k] * $vector[$k][$j];
            }
        }
    }
    var_dump($resultMatrix);

    return $resultMatrix;
}

$inverseMatrix = modInverse($matrixA);

$resultMatrix = multiplyMatrices($inverseMatrix, $vectorB);

// In ra ma trận nghịch đảo
echo "Ma trận nghịch đảo là:\n";
foreach ($inverseMatrix as $row) {
    foreach ($row as $element) {
        echo $element . " ";
    }
    echo "\n";
}

// In ra resultMatrix
echo "resultMatrix là:\n";
foreach ($resultMatrix as $row) {
    echo $row[0] . "\n";
}