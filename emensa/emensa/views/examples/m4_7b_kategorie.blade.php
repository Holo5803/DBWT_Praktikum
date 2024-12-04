<!Doctype html>
<html  lang="DE">
<head>
    <meta charset="utf-8">
    <title>m4_7b_kategorie</title>
    <style>
        li:nth-child(even){
            font-weight: bold;
        }
    </style>

</head>
<body>
<h1>Liste Kategorie der Gerichte</h1>
<ol>
    @foreach($kategorien as $kategorie)
        <li>
            {{$kategorie['name']}}
        </li>
    @endforeach
</ol>
</body>

</html>