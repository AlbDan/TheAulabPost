<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="author" content="Alberto D'Antuono">
    @vite (['resources/css/app.css', 'resources/js/app.js'])
    <title>The Aulab Post - {{$title ?? 'Page'}}</title>
</head>
<body>
    <x-navbar/>
    {{$slot}}
    <x-footer/>
</body>
</html>