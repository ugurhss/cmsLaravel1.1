<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoş Geldin Uğurcan</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: radial-gradient(circle at center, #0f2027, #203a43, #2c5364);
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
            color: #fff;
        }

        .intro-container {
            text-align: center;
            animation: fadeIn 2s ease-in-out;
        }

        h1 {
            font-size: 3.5em;
            background: linear-gradient(90deg, #ff8a00, #e52e71, #9b00ff);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            animation: glow 2s infinite alternate;
        }

        p {
            margin-top: 20px;
            font-size: 1.5em;
            opacity: 0.85;
            animation: slideUp 2.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        @keyframes glow {
            from { text-shadow: 0 0 5px #ff8a00, 0 0 10px #e52e71; }
            to { text-shadow: 0 0 20px #ff8a00, 0 0 40px #e52e71; }
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 0.85; transform: translateY(0); }
        }
    </style>
    <script>
        // Sayfayı otomatik yönlendir
        setTimeout(() => {
            window.location.href = "{{ route('users') }}";
        }, 4000);
    </script>
</head>
<body>
    <div class="intro-container">
        <h1>Hoş Geldin, Uğurcan Doğan ✨</h1>
        <p>Sisteme yönlendiriliyorsun...</p>
    </div>
</body>
</html>
