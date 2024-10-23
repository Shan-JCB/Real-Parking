<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Pago</title>
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
    <div class="container">
        <!-- Header del ticket -->
    <div class="header">
        Comprobante de Parqueo: Real Plaza
    </div>
    <!-- Línea separadora -->
    <div class="line"></div>
        <div class="details">
            <p><strong>Placa:</strong> {{ $evento->cliente->placa }}</p>
            <p><strong>DNI:</strong> {{ $evento->cliente->dni }}</p>
            <p><strong>Cliente:</strong> {{ $evento->cliente->nombres }} {{ $evento->cliente->apellidos }}</p>
            <div class="line"></div>
            <p><strong>Hora de Ingreso:</strong> {{ $evento->created_at->format('H:i') }} </p>
            <p><strong>Hora de Salida:</strong> {{ now()->format('H:i') }}</p>
            <div class="line"></div>
            <p><strong>Tarifa:</strong> s/. {{ $pago->tarifa }}</p>
            <p><strong>Total Pagado:</strong> s/. {{ $pago->total }}</p>
        </div>
        <div class="footer">
            <p>Gracias por su preferencia</p>
        </div>
    </div>
</body>
</html>
