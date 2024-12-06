<!DOCTYPE>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Wunschgericht</title>
</head>
<body>
<h1>Wunschgericht Eingabe</h1>
<fieldset>
    <form action="wunschgericht.php" method="post">
        <label for="ersteller_name">Ihr Name: </label>
        <input type="text" id="ersteller_name" name="ersteller_name"
               placeholder="Bitte geben Sie Ihren Name ein"><br><br>

        <label for="email">Ihre E-Mail: </label>
        <input type="email" id="email" name="email" placeholder="Bitte geben Sie Ihre E-Mail ein" required><br><br>

        <label for="gericht_name">Ihr Wunschgericht: </label>
        <input type="text" id="gericht_name" name="gericht_name" placeholder="Name des Gerichts" required><br><br>

        <label for="beschreibung">Gerichtsbeschreibung </label>
        <textarea id="beschreibung" name="beschreibung" placeholder="Gerichtsbeschreibung" required></textarea><br><br>

        <button type="submit" name="submit">Wunsch abschicken</button>
    </form>
</fieldset>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = !empty(trim($_POST['ersteller_name'])) ? trim($_POST['ersteller_name']) : 'anonym';
    $email = trim($_POST['email']);
    $gericht_name = trim($_POST['gericht_name']);
    $beschreibung = trim($_POST['beschreibung']);

    //Erstellung Verbindung zur Datenabank
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "emensawerbeseite";
    $verbingdung = new mysqli ($servername, $username, $password, $dbname);
    if ($verbingdung->connect_error) {
        die("Verbindung fehlschlagen:  " . $verbingdung->connect_error);
    }

    //Ersteller einfügen
    $sql_ersteller = "INSERT INTO ersteller (name, email) VALUES (?, ? ) ON DUPLICATE KEY UPDATE id= LAST_INSERT_ID(id);";
    $stmt = $verbingdung->prepare($sql_ersteller);
    $stmt->bind_param("ss", $name, $email);
    $stmt->execute();
    $ersteller_id = $stmt->insert_id;

    //Wunschgericht einfügen
    $sql_gericht = "INSERT INTO wunschgericht (name, beschreibung, ersteller_id) VALUES (?, ?, ?)";
    $stmt = $verbingdung->prepare($sql_gericht);
    $stmt->bind_param("ssi", $gericht_name, $beschreibung, $ersteller_id);
    $stmt->execute();

    echo "Wunschgericht wurde erfolgreich erstellt!";
    $stmt->close();
    $verbingdung->close();

}
?>





