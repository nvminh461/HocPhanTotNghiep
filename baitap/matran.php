<?php

define("ROW1", 2); // Số hàng của ma trận thứ nhất
define("COL1", 2); // Số cột của ma trận thứ nhất

define("ROW2", 2); // Số hàng của ma trận thứ hai
define("COL2", 1); // Số cột của ma trận thứ hai

function matrixMultiply($mat1, $mat2, &$res, $rows1, $cols1, $cols2) {
    for ($row = 0; $row < $rows1; $row++) {
        for ($col = 0; $col < $cols2; $col++) {
            $sum = 0;
            for ($i = 0; $i < $cols1; $i++) {
                $sum += $mat1[$row][$i] * $mat2[$i][$col];
            }
            $res[$row][$col] = $sum;
        }
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $First = $Second = $Result = array();

    // Nhận giá trị từ biểu mẫu và tính toán
    for ($i = 0; $i < ROW1; $i++) {
        for ($j = 0; $j < COL1; $j++) {
            $First[$i][$j] = $_POST["first_matrix"][$i][$j];
        }
    }

    for ($i = 0; $i < ROW2; $i++) {
        for ($j = 0; $j < COL2; $j++) {
            $Second[$i][$j] = $_POST["second_matrix"][$i][$j];
        }
    }

    if (COL1 == ROW2) {
        matrixMultiply($First, $Second, $Result, ROW1, COL1, COL2);

        echo "Product of the matrices:\n";

        for ($i = 0; $i < ROW1; $i++) {
            for ($j = 0; $j < COL2; $j++) {
                echo $Result[$i][$j] . "\t";
            }
            echo "\n";
        }
    } else {
        echo "Sorry! Multiplication is not possible";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matrix Multiplication</title>
</head>

<body>
<h2>Matrix Multiplication</h2>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <p>Enter elements for the first matrix (<?php echo ROW1; ?>x<?php echo COL1; ?>):</p>
    <?php for ($i = 0; $i < ROW1; $i++) : ?>
        <?php for ($j = 0; $j < COL1; $j++) : ?>
            <input type="number" name="first_matrix[<?php echo $i; ?>][<?php echo $j; ?>]" required>
        <?php endfor; ?>
        <br>
    <?php endfor; ?>

    <p>Enter elements for the second matrix (<?php echo ROW2; ?>x<?php echo COL2; ?>):</p>
    <?php for ($i = 0; $i < ROW2; $i++) : ?>
        <?php for ($j = 0; $j < COL2; $j++) : ?>
            <input type="number" name="second_matrix[<?php echo $i; ?>][<?php echo $j; ?>]" required>
        <?php endfor; ?>
        <br>
    <?php endfor; ?>

    <br>
    <input type="submit" value="Multiply">
</form>
</body>

</html>
