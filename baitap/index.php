<?php

function solveEquation($a, $b, $c, $d, $xPrime, $yPrime, $rM, $rN, $m, $n) {
    // Tạo ma trận và vector từ các giá trị đầu vào
    $matrixA = [
        [$a, $c],
        [$b, $d]
    ];
    $vectorB = [
        [$xPrime - $rM],
        [$yPrime - $rN]
    ];
    $modulusVector = [
        [$m],
        [$n]
    ];

    // Tính nghịch đảo của ma trận modulo
    $inverseMatrix = inverseMatrixModulo($matrixA, $modulusVector);

    // Tính kết quả
    $resultVector = multiplyMatrixVectorModulo($inverseMatrix, $vectorB, $modulusVector);

    // Trả về giá trị x và y
    return [$resultVector[0][0], $resultVector[1][0]];
}

function inverseMatrixModulo($matrix, $modulusVector) {
    // Tính determinant của ma trận
    $det = ($matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0]) % $modulusVector[0][0];

    // Tính nghịch đảo modulo
    $detInverse = modInverse($det, $modulusVector[0][0]);

    // Tính nghịch đảo của ma trận
    $inverseMatrix = [
        [$matrix[1][1], -$matrix[0][1]],
        [-$matrix[1][0], $matrix[0][0]]
    ];

    // Nhân nghịch đảo determinant vào từng phần tử của ma trận nghịch đảo
    foreach ($inverseMatrix as &$row) {
        foreach ($row as &$element) {
            $element = ($element * $detInverse) % $modulusVector[0][0];
        }
    }

    return $inverseMatrix;
}

function multiplyMatrixVectorModulo($matrix, $vector, $modulusVector) {
    $result = [];
    foreach ($matrix as $row) {
        $sum = 0;
        foreach ($row as $index => $element) {
            $sum = ($sum + $element * $vector[$index][0]) % $modulusVector[0][0];
        }
        $result[] = [$sum];
    }
    return $result;
}

// Hàm tính nghịch đảo modulo
function modInverse($a, $m) {
    $m0 = $m;
    $x0 = 0;
    $x1 = 1;

    while ($a > 1) {
        $q = intval($a / $m);
        $t = $m;

        $m = $a % $m;
        $a = $t;

        $t = $x0;
        $x0 = $x1 - $q * $x0;
        $x1 = $t;
    }

    if ($x1 < 0) {
        $x1 += $m0;
    }

    return $x1;
}

// Sử dụng ví dụ:
$a = 2;
$b = 1;
$c = 3;
$d = 4;
$xPrime = 5;
$yPrime = 6;
$rM = 1;
$rN = 2;
$m = 5;
$n = 7;

list($x, $y) = solveEquation($a, $b, $c, $d, $xPrime, $yPrime, $rM, $rN, $m, $n);

echo "x = $x\n";
echo "y = $y\n";
?>
