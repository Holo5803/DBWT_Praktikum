<!DOCTYPE html>
<!--
    - Praktikum DBWT. Autoren:
    - Andreas, Hüpgen, 3679869
    - Viet Minh Duc, Nguyen, 3659300
    -->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Ihre E-Mensa</title>
    <link href="/css/werbeseite_styling.css" rel="stylesheet">
</head>
<body >

<header>
    @yield('header')
</header>

<main>
    <div id="foto"><img src="/img/mensa foto.jpg" alt="Mensa Foto" class="center"></div>

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

    @yield('Gerichte')
    @yield ('Highlight')
    @yield('Bewertungen')
    @yield('Meine Bewertungen')
    @yield('zahlen')
    <div id=wunschgerichte>
        <h1>Neue Empfehlung für die Küche?</h1>
        <a href="/wunschgerichte">Wunschgericht eintragen</a>
    </div>
    @yield('kontakt')
    @yield('wichtig')
    <footer>
        @yield('footer')
    </footer>
</main>
</body>