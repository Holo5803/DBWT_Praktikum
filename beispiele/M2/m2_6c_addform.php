<?php
/**
 * Praktikum DBWT. Autoren:
 * Andreas, Hüpgen, 3679869
 * Viet Minh Duc, Nguyen, 3659300
 */
include "m2_6a_standardparameter.php";
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8"/>
    <title>m2_6c_addform</title>
    <style>
        * {
            font-family: Arial, serif;
        }
    </style>
</head>
<body>

<form method="get">
    <input type="number" name="eingabe_a" placeholder="a" required>
    <input type="number" name="eingabe_b" placeholder="b" required>
    <select name="auswahl">
        <option value="Multiplizieren">Multiplizieren</option>
        <option value="Addieren">Addieren</option>
    </select>
    <button type="submit" name="rechne">Rechne!</button>
</form> <br><br>

<?php
if (isset($_GET['eingabe_a']) && isset($_GET['eingabe_b']) && isset($_GET['auswahl'])) {
    $a = $_GET['eingabe_a'];
    $b = $_GET['eingabe_b'];
    $operation = $_GET['auswahl'];

    if ($operation === "Multiplizieren") {
        echo "Ergebnis (Multiplikation): " . multiply($a, $b);
    } elseif ($operation === "Addieren") {
        echo "Ergebnis (Addition): " . addition($a, $b);
    }/* else {
        echo "Ungültige Operation!";
    }*/
}
?>
</body>
</html>
