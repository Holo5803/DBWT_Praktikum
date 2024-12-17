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
    <form action ="/wunschgerichteConfirm" method="post">
        <label for="ersteller_name">Ihr Name: </label>
        <input type="text" id="ersteller_name" name="ersteller_name" placeholder="Bitte geben Sie Ihren Name ein" ><br><br>

        <label for="email">Ihre E-Mail: </label>
        <input type="email" id="email" name="email" placeholder="Bitte geben Sie Ihre E-Mail ein" required><br><br>

        <label for="gericht_name">Ihr Wunschgericht: </label>
        <input type="text" id="gericht_name" name="gericht_name" placeholder="Name des Gerichts" required><br><br>

        <label for="beschreibung">Gerichtsbeschreibung </label>
        <textarea id="beschreibung" name="beschreibung" placeholder="Gerichtsbeschreibung" required></textarea><br><br>

        <button type="submit" name="submit">Wunsch abschicken</button>
    </form>
    <div>{{$message}}</div>
</fieldset>
</body>
</html>
