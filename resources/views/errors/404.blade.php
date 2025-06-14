<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Página no encontrada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #111;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            height:80vh;
            margin: 0;
            text-align: center;
        }

        .logo img {
            max-width: 200px;
            margin-bottom: 20px;
        }

        .container {
            max-width: 600px;
            padding: 20px;
        }


        h1 p{
            font-size: 10rem;
            margin: 0;
            color: #ffffff;
            text-shadow: 5px 5px 5px rgba(255, 255, 255, 0.7); 
        }

        h4 {
            font-size: 2rem;
            margin: 0;
            color: #ffffff;
        }

        p {
            font-size: 1.2rem;
            margin: 20px 0;
            font-weight: bold;
            color: #ffffff;
        }

        a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .button {
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background-color: #1D7129;
            border: 1px solid #fff;
            cursor: pointer;
            width: 19vh;
            margin-top: 25px;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <div class="logo">
            <a href="/"><img src="{{ asset('img/Logo.png') }}" alt="Logo"></a> <!-- El logo sigue encima del 404 -->
        </div>
        <h1><p>404</p></h1> <!-- El 404 ahora tiene sombra -->
        <h4>PAGE NOT FOUND</h4>
        <p>The page you are looking for might have been removed, its name changed, or it is temporarily unavailable.</p>
        <a class="button" href="/">HOMEPAGE</a>
    </div>
</body>
</html>