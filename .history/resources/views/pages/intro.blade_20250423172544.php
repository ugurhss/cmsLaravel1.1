<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoş Geldin</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #1f1c2c, #928dab);
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            color: white;
        }

        .intro {
            text-align: center;
        }

        .intro h1 {
            font-size: 3em;
            margin-bottom: 20px;
            animation: fadeInDown 1.5s ease-out;
        }

        .typing {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            border-right: .15em solid orange;
            animation: typing 3s steps(30, end), blink-caret .75s step-end infinite;
            font-size: 1.5em;
        }

        @keyframes fadeInDown {
            0% { opacity: 0; transform: translateY(-20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes typing {
            from { width: 0; }
            to { width: 100%; }
        }

        @keyframes blink-caret {
            from, to { border-color: transparent; }
            50% { border-color: orange; }
        }

        .btn {
            margin-top: 30px;
            background-color: orange;
            border: none;
            padding: 12px 24px;
            font-size: 1em;
            border-radius: 30px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background-color: darkorange;
        }
    </style>
</head>
<body>
    <div class="intro">
        <h1>Merhaba, Uğurcan Doğan 👋</h1>
        <div class="typing">Sisteme hoş geldin!</div>
        <br>
        <a href="{{ route('users') }}" class="btn">Devam Et</a>
    </div>
</body>
</html>
