@extends('layouts.layout')

@section('header')
    <header>

        <img src="/img/logo mensa.jpg" alt="">


        <nav>
            <ul>
                <li><a href="#Ankuendigung">Ankündigung</a></li>
                <li><a href="#Speisen">Speisen</a></li>
                <li><a href="#Zahlen">Zahlen</a></li>
                <li><a href="#Kontakt">Kontakt</a></li>
                <li><a href="#W.F.U">Wichtig für uns</a></li>
                @if (isset($_SESSION['email']))
                    <div class="user_info">
                        <p>Angemeldet als: {{$_SESSION['email']}}</p>
                        <li><a href="/abmeldung">Abmelden</a></li>
                        @else
                            <p>Willkommen
                                <li><a href="/anmelden">Anmelden</a></li>
                            </p>
                    </div>
                @endif

            </ul>
        </nav>
    </header>

@endsection


@section('Gerichte')
    <!-- Gerichte -->
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
                <th>Gerichts Fotos</th>
                <th>Bewertungen</th>
            </tr>
            </thead>
            <tbody>
            @foreach($meals as $meal)
                <tr>
                    <td>{{$meal["name"]}}</td>
                    <td>{{$meal["preisintern"]}}</td>
                    <td>{{$meal["preisextern"]}}</td>
                    <td>{{$meal["Allergen"]}}</td>
                    <td>
                        @if ($meal["bildname"] && file_exists('img/gerichte/' . $meal["bildname"]))
                            <img src="{{'img/gerichte/' . $meal["bildname"]}}"
                                 alt="{{$meal["bildname"]}}"
                                 width="100"
                                 height="100"
                        @else
                            <img src="img/gerichte/00_image_missing.jpg"
                                 alt="Kein Bild verfügbar"
                                 width="100"
                                 height="100">
                        @endif

                    </td>

                    <td><a href="/bewertung?gerichtid={{$meal["id"]}}">Bewertung abgeben</a></td>



                </tr>
            @endforeach
            </tbody>
        </table>
        <p id="allergenliste"> Liste aller Allergene: </p>
        <div id='allergenliste'>{{$allergenCode}}</div>
    </div>

@endsection

@section('Highlight')
    <h1>Unsere Highlight</h1>
    <table id="highlight">
        <thead>
        <tr>
            <th>Gericht</th>
            <th>Benutzer</th>
            <th>Bemerkung</th>
            <th>Sternebewertung</th>
            <th>Bewertungszeitpunkt</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($highlights as $highlight)
            <tr class="{{$highlight['hervorgehoben'] ? 'highlighted' : '' }}">
                <td>{{$highlight['gericht_name']}}</td>
                <td>{{$highlight['benutzer_name']}}</td>
                <td>{{$highlight['bemerkung']}}</td>
                <td>{{$highlight['sternbewertung']}}</td>
                <td>{{$highlight['bewertungszeitpunkt']}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('Bewertungen')
    <h1 id="Bewertung">Alle Bewertungen</h1>
    <a href="/bewertungen">Hier anschauen</a>
@endsection

@section('Meine Bewertungen')
    @if (isset($_SESSION['id']))
        <h1 id="Bewertung">Deine Bewertungen</h1>
        <a href="/meinebewertungen">Hier anschauen</a>
    @endif

@endsection


@section('zahlen')
    <div class="zahlen">
        <h1 id="Zahlen">E-Mensa in Zahlen</h1>
        <ul>
            <li>{{$anzahlBesucher}} Besuche</li>
            <li>{{$anzahlAnmeldung}} Anmeldungen zum Newsletter</li>
            <li>{{$anzahlGerichte }} Speisen</li>
        </ul>
    </div>

@endsection

@section('kontakt')
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
        {{$confirmationMessage}}
    </div>
@endsection

@section('wichtig')
    <div class="wichtig">
        <h1 id="W.F.U">Das ist uns wichtig</h1>
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>

    <h1>Wir freuen uns auf Ihren Besuch!</h1>
@endsection

@section('footer')
    <ul>
        <li>&copy; E-Mensa GmbH</li>
        <li>Viet Minh Duc Nguyen und Andreas Huepgen</li>
        <li><a href="#Impressum">Impressum</a></li>
    </ul>
@endsection
