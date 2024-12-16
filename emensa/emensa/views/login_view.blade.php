<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Anmeldung</title>
</head>
<body>
<h2>Anmeldung</h2>

<?php if (!empty($_SESSION['error'])): ?>
<div><?php echo htmlspecialchars($_SESSION['error']); ?></div>
<?php endif; ?>

<form action="/anmeldung_verifizieren" method="POST">
    <label for="email">E-Mail:</label>
    <input type="email" name="email" id="email" required>
    <br>

    <label for="passwort">Passwort:</label>
    <input type="password" name="passwort" id="passwort" required>
    <br>

    <button type="submit">Anmeldung</button>
</form>
</body>
</html>
