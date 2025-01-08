<!DOCTYPE>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<html lang="de">
<head>

</head>
<body>
<h1>Bewertung für {{$gericht['name']}}</h1>
@if ($gericht["bildname"] && file_exists('img/gerichte/' . $gericht["bildname"]))
    <img src="{{'img/gerichte/' . $gericht["bildname"]}}"
         alt="{{$gericht["bildname"]}}"
         width="100"
         height="100">
@else
    <img src="img/gerichte/00_image_missing.jpg"
         alt="Kein Bild verfügbar"
         width="500"
         height="500">
@endif

<form action="/bewertungSubmit" method="post">

    <input type="hidden" name="gerichtid" value="{{$_GET['gerichtid']}}"> <br><br>
    <label for="sternbewertung">Sterne-Bewertung:</label>
    <select name="sternbewertung" required>
        <option value="sehr gut">Sehr gut</option>
        <option value="gut">Gut</option>
        <option value="schlecht">Schlecht</option>
        <option value="sehr schlecht">Sehr schlecht</option>
    </select><br><br>
    <label for="bemerkung">Bemerkung: </label>
    <textarea name="bemerkung" required minlength="5"></textarea><br><br>

    <button type="submit" name="submit">Bewertung abschicken</button>

</form>
</body>
</html>