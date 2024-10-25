<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuevo Mensaje de Contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #28a745;
            font-size: 24px;
            text-align: center;
        }
        p {
            font-size: 16px;
            line-height: 1.6;
            margin: 10px 0;
        }
        .info {
            background-color: #e9f7ef;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .info p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>New Mail!</h1>
        <p>From RealParking</p>

        <div class="info">
            <p><strong>Nombre:</strong> {{ $data['nombre'] }}</p>
            <p><strong>Correo:</strong> {{ $data['correo'] }}</p>
            <p><strong>Mensaje:</strong> {{ $data['mensaje'] }}</p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} RealPlaza. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
