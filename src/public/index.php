<?php
session_start();
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Backend/Route.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Map (pattern) Generator 2D</title>
    <link rel="icon" type="image/svg+xml" href="dist/assets/favicon.svg">
    <link rel="icon" type="image/png" href="dist/assets/favicon.png">
    <link rel="stylesheet" href="dist/css/plugins.min.css">
    <link rel="stylesheet" href="dist/css/style.min.css">
</head>
<body>
    <div id="app">
        <header>
            <div class="container">
                <h1 class="header__brand">Map Generator 2D</h1>
            </div>
        </header>
        <main class="container">
            <location-generator-component></location-generator-component>
        </main>
        <footer>
            <div class="container">
                <div class="social-links">
                    <a href="https://github.com/quoterbox/php-2d-location-generator" target="_blank" class="link"><i class="bi bi-github"></i></a>
                    <a href="https://t.me/jqqjoo" target="_blank" class="link"><i class="bi bi-telegram"></i></a>
                </div>
            </div>
        </footer>
    </div>
    <script src="dist/js/app.min.js"></script>
</body>
</html>
