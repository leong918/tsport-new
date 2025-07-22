<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Display Web">
    <title>Web</title>
</head>

<body>
    @vite(['resources/scss/web/app.scss', 'resources/js/web/app.js'])
    <div id="app">
        web index
    </div>

    <script type="text/javascript"></script>
</body>

</html>
