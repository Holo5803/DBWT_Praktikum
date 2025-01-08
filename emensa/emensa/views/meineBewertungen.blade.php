<!DOCTYPE>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Meine Bewertungen Anzeigen</title>
    <link href="/css/werbeseite_styling.css" rel="stylesheet">
</head>
<body>
<h1>Meine letzten Bewertungen</h1>
<table id="bewertungen">
    <thead>
    <tr>
        <th>Gericht</th>
        <th>Bemerkung</th>
        <th>Sternebewertung</th>
        <th>Bewertungszeitpunkt</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($meineBewertungen as $bewertung)
        <tr>
            <td>{{$bewertung['gericht_name']}}</td>
            <td>{{$bewertung['bemerkung']}}</td>
            <td>{{$bewertung['sternbewertung']}}</td>
            <td>{{$bewertung['bewertungszeitpunkt']}}</td>

        </tr>
    @endforeach
    </tbody>
</table>
</body>