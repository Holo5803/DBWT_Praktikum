<!DOCTYPE>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Anmeldung</title>
</head>
<body>




<h1>Anmeldungsformular</h1>
<fieldset>
    <form action ="/anmeldenConfirm" method="post">

        <label for="email">Ihre E-Mail: </label>
        <input type="email" id="email" name="email" placeholder="Bitte geben Sie Ihre E-Mail ein" required><br><br>

        <label for="passwort">Ihr Passwort: </label>
        <input type="password" id="passwort" name="passwort" required><br><br>


        <button type="submit" name="submit">Anmelden</button>

    </form>

</fieldset>
<div class="Warnung">
    {{$msg}}
</div>
</body>
</html>

