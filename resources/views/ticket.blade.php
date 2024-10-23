<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Parqueo</title>
    <style>
        /* Estilo general del ticket */
        body {
            font-family: Arial, sans-serif;
            width: 80mm; /* Ancho típico de un ticket */
            margin: 0 auto;
            padding: 10px;
            text-align: center; /* Alineación central del contenido */
        }

        /* Header del ticket */
        .header {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        /* Línea separadora */
        .line {
            border-bottom: 1px dashed #000;
            margin: 10px 0;
        }

        /* Detalles del ticket */
        .details {
            font-size: 14px;
            line-height: 1.4;
            text-align: left; /* Alineación a la izquierda de los detalles */
        }

        .details p {
            margin: 5px 0;
        }

        /* Estilo para resaltar títulos */
        .details p strong {
            font-weight: bold;
        }

        /* Footer del ticket */
        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <!-- Header del ticket -->
    <div class="header">
        Sistema de parqueo Real Plaza
    </div>
    <!-- Hola posho -->
    <p>Servicio de Parqueo</p>
    <p>Av. Giráldez 550, Huancayo 12001</p>
    <!-- Línea separadora -->
    <div class="line"></div>

    <!-- Detalles del ticket -->
    <div class="details">
        <p><strong>Placa:</strong> {{ $evento->placa }}</p>
        <p><strong>Cliente:</strong> {{ $evento->cliente->nombres }} {{ $evento->cliente->apellidos }}</p>
        <div class="line"></div>
        <p><strong>Espacio:</strong> {{ $evento->parqueo->numero }}</p>
        <p><strong>Hora de Ingreso:</strong> {{ $evento->created_at->format('H:i') }}</p>
        <p><strong>Fecha de Ingreso:</strong> {{ $evento->created_at->format('Y-m-d') }}</p>
        <p><strong>Operador:</strong> {{ $evento->operador->nombres }}</p>
        
        
        
        
        
    </div>

    <!-- Línea separadora -->
    <div class="line"></div>

    <!-- Footer del ticket -->
    <div class="footer">
        ¡Gracias por su visita!
    </div>
</body>
</html>
