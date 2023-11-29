<?php

/**
 * tinh dinh thuc
 * @param $matrix
 * @return float|int
 */
function determinant($matrix)
{
    return $matrix[0][0] * $matrix[1][1] - $matrix[0][1] * $matrix[1][0];
}

/**
 * tinh nghich dao
 * @param $matrix
 * @return array[]|void
 */
function modInverse($matrix)
{
    $det = determinant($matrix);
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
 * tinh Tich 2 ma tran
 * @param $matrix1
 * @param $matrix2
 * @return array|void
 */
function multiplyMatrices($matrix1, $matrix2)
{
    $rows1 = count($matrix1);
    $cols1 = count($matrix1[0]);
    $rows2 = count($matrix2);
    $cols2 = count($matrix2[0]);

    if ($cols1 == $rows2) {
        $result = array();
        for ($i = 0; $i < $rows1; $i++) {
            for ($j = 0; $j < $cols2; $j++) {
                $sum = 0;
                for ($k = 0; $k < $cols1; $k++) {
                    $sum += $matrix1[$i][$k] * $matrix2[$k][$j];
                }
                $result[$i][$j] = $sum;
            }
        }
        return $result;
    } else {
        die("Sorry! Multiplication is not possible");
    }
}

/**
 * tim gia tri x y
 * @param $det
 * @param $x
 * @return int
 */
function findValue($det, $x)
{
    return $det%$x;
}

$matrix1 = array(
    array(1, 2),
    array(3, 4)
);

$matrix2 = array(
    array(3),
    array(5)
);

$m = 2;
$n = 3;

$inverseMatrix = modInverse($matrix1);
echo "Ma trận nghịch đảo là:\n";
foreach ($inverseMatrix as $row) {
    foreach ($row as $element) {
        echo $element . " ";
    }
    echo "\n";
}

$resultMatrix = multiplyMatrices($inverseMatrix, $matrix2);

echo "\nTích ma trận nghịch đảo và vector:\n";
foreach ($resultMatrix as $row) {
    foreach ($row as $element) {
        echo $element . "\t";
    }
    echo "\n";
}

$det = determinant($resultMatrix);

echo ('Gia tri cua X la:'. findValue($det, $m));
echo ('Gia tri cua Y la:'. findValue($det, $n));
?>
