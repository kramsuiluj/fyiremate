<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    <style>
        #main-container, #sub-header {
            transition: margin-left .5s;
        }

        .font-noto {
            font-family: 'Noto Serif', serif;
        }
    </style>
    <title>Fyiremate</title>
</head>
<body class="bg-gray-100">
{{ $slot }}
</body>
</html>
