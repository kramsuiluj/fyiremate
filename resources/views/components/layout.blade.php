<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/ui.js'])
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif&display=swap" rel="stylesheet">
    <style>
        #main-container, #sub-header {
            transition: margin-left .5s;
        }

        .font-noto {
            font-family: 'Noto Serif', serif;
        }

        .loading {
            z-index: 20;
            position: absolute;
            top: 0;
            /*left:-5px;*/
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
        }
        .loading-content {
            position: absolute;
            border: 4px solid #f3f3f3; /* Light grey */
            border-top: 4px solid #F97316; /* Blue */
            border-radius: 50%;
            width: 25px;
            height: 25px;
            top: 50%;
            left:50%;
            animation: spin 2s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
    <title>Fyiremate</title>
</head>
<body class="bg-gray-100">
{{ $slot }}
</body>
</html>
