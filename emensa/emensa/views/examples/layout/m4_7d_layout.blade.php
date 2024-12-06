<!Doctype html>
<html  lang="DE">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'standard Title')</title>

</head>
<body>
<header>
    <h1>@yield('header')</h1>
</header>

<main>
    @yield('main')
</main>

<footer>
    @yield('footer')
</footer>
</body>

</html>
