<?php
/**
 * Praktikum DBWT. Autoren:
 * Andreas, Hüpgen, 3679869
 * Viet Minh Duc, Nguyen, 3659300
 */
echo "str_repeat ";
echo "<br>";
echo str_repeat("repeat ", 10);
echo "<br>";
echo "<br>";


echo "str_replace";
echo "<br>";
echo str_replace("gesucht wort", "ersetz Wort", "Das hier ist gesucht wort");

echo "<br>";
echo "<br>";



echo "substr";
echo "<br>";
echo substr("Hallo Welt",6, 2);

echo "<br>";
echo "<br>";


echo "trim";
echo "<br>";
$str = " Hello World ";
echo "Without trim : [" . $str . "]";
echo "<br>";
echo "With trim: [" . trim($str ). "]";

echo "<br>";
echo "<br>";

echo "ltrim";
echo "<br>";
$str1 = " Hello World ";
echo "Without trim : [" . $str . "]";
echo "<br>";
echo "With trim: [" . ltrim($str ). "]";

echo "<br>";
echo "<br>";

echo "rtrim";
echo "<br>";
$str2 = " Hello World ";
echo "Without trim : [" . $str . "]";
echo "<br>";
echo "With trim: [" . rtrim($str ). "]";

echo "<br>";
echo "<br>";

echo "String-Konkatenation";
echo "<br>";
$a = "Hallo";
$b = "Welt";
$c = $a . $b;
echo $c;