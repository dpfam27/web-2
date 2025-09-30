<?php

// function sum($a, $b) {
// return $a + $b;
// }

$a = 4;
$b = 6;
$c = 9;
// $sum = sum($x, $y);
// echo("Tong cua 4 va 5 la " . $sum);

include ("func.php");

echo("Number a is " . $a); echo(" <br>");
echo("Number b is " . $b); echo(" <br>");
echo("Number c is " . $c); echo(" <br><br>");

echo("Max of 3 numbers: " . max3($a, $b, $c)); echo(" <br>");
echo("Min of 3 numbers: " . min3($a, $b, $c)); echo(" <br>");
echo("Sum of 3 numbers: " . sum3($a, $b, $c)); echo(" <br>");
echo("Diff of 3 numbers: " . diff3($a, $b, $c)); echo(" <br>");
swap ($a, $b);

?>