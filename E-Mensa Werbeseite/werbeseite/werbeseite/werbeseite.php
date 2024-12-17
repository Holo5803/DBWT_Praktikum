<?php

//Session dient zum Zählern Neuladen
session_start();

//GLobale Variablen zuweisen
global $meal;
global $confirmationMessage;

if (!isset($_SESSION['anmeldung'])) {
    $_SESSION['anmeldung'] = 0;
}

//Verbindung zur Datenbank
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "emensawerbeseite";

$verbindung = new mysqli($servername, $username, $password, $dbname);

if ($verbindung->connect_error) {
    die("Verbindung fehlgeschlagen: " . $verbindung->connect_error);
}

//Besucher zählen
$sql = "INSERT INTO besucher () VALUES ()";
$verbindung->query($sql);


// Neuer Besucherzähler
$sql = "SELECT COUNT(*) AS AnzahlBesucher FROM besucher";
$result = $verbindung->query($sql);
$anzahlBesucher = $result->fetch_assoc()['AnzahlBesucher'];
?>

<!DOCTYPE html>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<?php include "meals.php" ?>
<?php include "formular.php" ?>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link href="werbeseite_styling.css" rel="stylesheet">
</head>
<body>


<?php

//Neuer Alterzähler
$sql = "SELECT COUNT(*) AS AnzahlGericht FROM gericht";
$result = $verbindung->query($sql);
$anzahlGerichte = $result->fetch_assoc()['AnzahlGericht']; //Holt die nächste Zeile aus dem Ergebnis einer SQL-Abfrage und gibt Sie als Array zurück


// Laden der Gerichte aus Datenbank
$sortOrder = $_GET['sort'] ?? 'asc';
$sortOrder = ($sortOrder == 'asc') ? 'asc' : 'desc';

$sql = "
    SELECT id, name, preisintern, preisextern 
    FROM gericht 
    ORDER BY name $sortOrder 
    LIMIT 5";
//Schwachstelle
$stmt = $verbindung->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

$meals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meals[] = $row;
    }
}


//Anzeige Gerichte mit Allergenen
$sql = "
    SELECT gericht.name, gericht.preisintern, gericht.preisextern, GROUP_CONCAT(allergen.code SEPARATOR ', ') AS Allergen
    FROM gericht 
    LEFT JOIN gericht_hat_allergen ON gericht.id = gericht_hat_allergen.gericht_id
    LEFT JOIN allergen ON gericht_hat_allergen.code = allergen.code
    GROUP BY gericht.id
    ORDER BY name $sortOrder 
    LIMIT 5";

// Schwachstelle
$stmt = $verbindung->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$meals = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $meals[] = $row;
    }
}


?>


<header>

    <logo><img src="logo mensa.jpg"></logo>

    <nav>
        <ul>
            <li><a href="#Ankuendigung">Ankündigung</a></li>
            <li><a href="#Speisen">Speisen</a></li>
            <li><a href="#Zahlen">Zahlen</a></li>
            <li><a href="#Kontakt">Kontakt</a></li>
            <li><a href="#W.F.U">Wichtig für uns</a></li>
        </ul>
    </nav>
</header>

<main>
    <div id="foto"><img src="mensa foto.jpg" alt="Mensa Foto" class="center"></div>

    <div class="ankuedigung">
        <h1 id="Ankuendigung">Bald gibt es Essen auch online &#59;)</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt rhoncus tortor, vel faucibus dui
            rutrum vitae. Morbi vitae posuere justo. Cras lobortis sodales mattis. Suspendisse vulputate velit sapien,
            et consectetur massa vulputate id. Praesent elementum elit ipsum, sed rutrum nulla sodales non. Nunc tempor
            scelerisque ipsum, ut molestie justo condimentum sit amet. Cras et erat elit. Fusce volutpat finibus
            condimentum. Quisque sodales porttitor nibh faucibus pretium. Duis lobortis nibh semper sem tempor faucibus.
            Aliquam cursus, nisi nec consequat pulvinar, turpis odio ultricies lectus, sit amet vehicula massa orci in
            nulla. Mauris mattis iaculis nulla vitae feugiat. Nunc sed laoreet lectus. Suspendisse laoreet tortor vitae
            elit commodo auctor.</p>
    </div>

    <div class="speisen">
        <h1 id="Speisen">Köstlichkeiten, die Sie warten</h1>
        <a href="?sort=asc">Aufsteigend sortieren</a>
        <a href="?sort=desc">Absteigend sortieren</a>
        <table id="meinetabelle">
            <thead>
            <tr>
                <!--                        <th>Vorschaubild</th>-->
                <th>Gerichte</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
                <th>Allergene</th>

            </tr>
            </thead>
            <tbody>


            <?php
            //                    foreach ($meal as $gerichte) {
            //                        echo "<tr>";
            //                        echo "<td><img src = \"{$gerichte['img']}\" width =\"100\" height =\"80\"></td>";
            //                        echo "<td>".$gerichte['name']."</td>";
            //                        echo "<td>".$gerichte['preis_intern']."</td>";
            //                        echo "<td>".$gerichte['preis_extern']."</td>";
            //                        echo "</tr>";
            //                    }
            //Neue Menü anzeigen
            foreach ($meals as $meal) {
                echo "<tr>";
                echo "<td>" . $meal["name"] . "</td>";
                echo "<td>" . $meal["preisintern"] . "</td>";
                echo "<td>" . $meal["preisextern"] . "</td>";
                echo "<td>" . $meal["Allergen"] . "</td>";
                echo "</tr>";
            }

            ?>

            </tbody>
        </table>
        <p id="allergenliste">Liste aller Allergene: </p>

        <?php
        $sql = "SELECT code, name FROM allergen;";
        $result = mysqli_query($verbindung, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Array für Allergene
            $allergene = [];

            // Wenn Allergene vorhanden sind, durchlaufen und in ein Array speichern
            while ($row = mysqli_fetch_assoc($result)) {
                $allergene[] = htmlspecialchars($row['code'] . ": " . $row['name']);
            }

            // Allergene nebeneinander ausgeben, getrennt durch Komma
            echo "<div id='allergenliste'>" . implode(', ', $allergene) . "</div>";
        } else {
            echo "<div id='allergenliste'>Keine Allergene</div>";
        }

        ?>
    </div>

    <div id=wunschgerichte>
        <h1>Neue Empfehlung für die Küche?</h1>
        <a href="wunschgericht.php">Wunschgericht eintragen</a>
    </div>


    <div class="zahlen">
        <h1 id="Zahlen">E-Mensa in Zahlen</h1>
        <ul>
            <li><?php echo $anzahlBesucher ?> Besuche</li>
            <li><?php echo $_SESSION['anmeldung'] ?> Anmeldungen zum Newsletter</li>
            <li><?php echo $anzahlGerichte ?> Speisen</li>
        </ul>
    </div>


    <div class="kontakt">
        <h1 id="Kontakt">Interesse geweckt? Wir informieren Sie!</h1>
        <form class="formular" action="" method="POST">
            <fieldset>
                <div>
                    <label for="vorname">Ihr Name:</label>
                    <input type="text" id="vorname" name="vorname" placeholder="Vorname" required>
                </div>

                <div>
                    <label for="email">Ihre Email:</label>
                    <input type="text" id="email" name="email" placeholder="beispiel@.com" required>
                </div>
                <div>
                    <label for="sprache">Newsletter bitte in:</label>
                    <select id="sprache" name="sprache">
                        <option value="deutsch">Deutsch</option>
                        <option value="englisch">Englisch</option>
                        <option value="spanisch">Spanisch</option>
                    </select>
                </div>

                <div class="checkbox">
                    <input type="checkbox" id="datenschutz" name="datenschutz" value="datenschutz gelesen" required>
                    <label for="datenschutz"> Den Datenschutzbestimmungen stimme ich zu </label> <br>
                </div>

                <div class="submit"><input type="submit" value="Zum Newsletter anmelden"></div>

            </fieldset>
        </form>
        <?php echo $confirmationMessage; ?>
    </div>

    <div class="wichtig">
        <h1 id="W.F.U">Das ist uns wichtig</h1>
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>

    <h1>Wir freuen uns auf Ihren Besuch!</h1>

    <footer>
        <ul>
            <li>&copy; E-Mensa GmbH</li>
            <li>Viet Minh Duc Nguyen und Andreas Huepgen</li>
            <li><a href="#Impressum">Impressum</a></li>

        </ul>

    </footer>

</main>


</body>
</html>