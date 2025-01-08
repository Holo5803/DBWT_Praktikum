<!DOCTYPE>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Alle Bewertungen anzeigen</title>
    <style>
        .highlighted {
            background-color: #ffffcc;
            font-weight: bold;
        }
    </style>
    <link href="/css/werbeseite_styling.css" rel="stylesheet">
</head>
<body>
<h1>Letzte Bewertungen</h1>
<table id="bewertungen">
    <thead>
    <tr>
        <th>Gericht</th>
        <th>Benutzer</th>
        <th>Bemerkung</th>
        <th>Sternebewertung</th>
        <th>Bewertungszeitpunkt</th>
        <th>Bewertungslöschen</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($bewertungen as $bewertung)
            <tr class="{{$bewertung['hervorgehoben'] ? 'highlighted' : '' }}">
                <td>{{$bewertung['gericht_name']}}</td>
                <td>{{$bewertung['benutzer_name']}}</td>
                <td>{{$bewertung['bemerkung']}}</td>
                <td>{{$bewertung['sternbewertung']}}</td>
                <td>{{$bewertung['bewertungszeitpunkt']}}</td>
                <td>
                    @if(isset($_SESSION['id']))
                        @if($_SESSION['id'] == $bewertung['benutzer_id'])
                            <a id="löschen" href="/bewertungsloeschen?bewertungsID={{$bewertung['id']}}">Bewertungslöschen</a>
                        @endif
                    @endif

                </td>

                <td>
                    @if(isset($_SESSION['admin']) && $_SESSION['admin'])
                        @if($bewertung['hervorgehoben'])
                            <a href="/bewertungenHervorheben?bewertungsID={{$bewertung['id']}}">Hervorhebung abwählen</a>
                        @else
                            <a href="/bewertungenHervorheben?bewertungsID={{$bewertung['id']}}">Hervorheben</a>
                        @endif
                    @endif
                </td>

            </tr>
        @endforeach
    </tbody>
</table>
</body>