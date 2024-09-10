<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

    <title>EmNet</title>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
</head>

<body class="bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-300 font-hanken-grotesk">
    @inertia
</body>

</html>
