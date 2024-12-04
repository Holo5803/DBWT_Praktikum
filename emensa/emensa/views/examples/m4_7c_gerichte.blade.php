<!Doctype html>
<html  lang="DE">
<head>
    <meta charset="utf-8">
    <title>m4_7c_gerichte</title>


</head>
<body>
<h1>Gerichte mit internen Preise mehr als 2€</h1>
<ol>
    @foreach($gerichte as $gericht)
        <li>
            {{$gericht['name']}} - {{$gericht['preisintern']}} Euro
        </li>
    @endforeach
</ol>
</body>

</html>