<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Especializa ti</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Auxilia a trazer um layout pronto -->
</head>
<body>
    <header>Header default</header>

    @yield('content')

    <footer>Footer default</footer>
</body>
</html>