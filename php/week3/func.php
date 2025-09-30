<?php

// Hàm tìm số lớn nhất trong 3 số
function max3($a, $b, $c) {
    return max($a, $b, $c);
}

// Hàm tìm số nhỏ nhất trong 3 số
function min3($a, $b, $c) {
    return min($a, $b, $c);
}

// Hàm tính tổng 3 số
function sum3($a, $b, $c) {
    return $a + $b + $c;
}

// Hàm tính hiệu của 3 số (a - b - c)
function diff3($a, $b, $c) {
    return $a - $b - $c;
}

// Hàm hoán đổi 2 số
function swap(&$a, &$b) {
    $tmp = $a;
    $a = $b;
    $b = $tmp;
}

?>
