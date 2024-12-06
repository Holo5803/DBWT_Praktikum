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
            </tr>
            </thead>
            <tbody>
            @foreach($meals as $meal)
                <tr>
                    <td>{{$meal["name"]}}</td>
                    <td>{{$meal["preisintern"]}}</td>
                    <td>{{$meal["preisextern"]}}</td>
                    <td>{{$meal["Allergen"]}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p id="allergenliste"> Liste aller Allergene: </p>
        <div id='allergenliste'>{{$allergenCode}}</div>
    </div>

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
