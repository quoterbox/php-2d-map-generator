<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../backend/route.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Location Generator 2D</title>
    <link rel="icon" type="image/svg+xml" href="dist/assets/favicon.svg">
    <link rel="icon" type="image/png" href="dist/assets/favicon.png">
    <link rel="stylesheet" href="dist/css/plugins.min.css">
    <link rel="stylesheet" href="dist/css/style.min.css">
</head>
<body>
    <header>
        <div class="container">
            <h1 class="header__brand">Location Generator 2D</h1>
        </div>
    </header>
    <main class="container">
        <div id="app">
            <location-generator-component></location-generator-component>
        </div>
    </main>
    <footer>

    </footer>
    <script src="dist/js/app.min.js"></script>
</body>
</html>
