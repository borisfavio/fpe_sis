<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante</title>
    <style>
        /* Resetear márgenes y padding */
        body, html {
            margin: 2;
            padding: 1;
            width: 76mm; /* Ancho del ticket */
            font-family: Arial, sans-serif;
            font-size: 12px; /* Tamaño de fuente */
        }
        /* Contenedor principal */
        .ticket {
            width: 100%;
            padding: 5px; /* Espaciado interno */
            box-sizing: border-box; /* Incluir padding en el ancho */
        }
        /* Encabezado */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        /* Divisores */
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        /* Texto centrado */
        .text-center {
            text-align: center;
        }
        /* Texto a la derecha */
        .text-right {
            text-align: right;
            margin-right: 2;
        }
        /* Tabla */
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 5px 0;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <h3>Fundación Pasos de Esperanza</h3>
        <p>Calle 4 Nro 467</p>
        <p>Zn Alto Santiago de Lacaya</p>
        <p>Tel: 69700259</p>
        <div class="divider"></div>
    </div>

    <!-- Detalles del comprobante -->
    <div class="content">
    <?php foreach ($comprobantes as $comprobante):?>
        <p><strong>Fecha:</strong> <?= esc($comprobante['fecha']) ?></p>
        <p><strong>Recibí de:</strong> <?= esc($comprobante['nombre_pagador']) ?></p>
        <div class="divider"></div>

        <h4 class="text-center">DETALLE DE PAGO:</h4>
        <table class="table">
            
            <tr>
                <td><strong>Beneficiario:</strong></td>
                <td class="text-right"><?= esc($comprobante['codigo_beneficiario']) ?></td>
            </tr>
            <tr>
                <td><strong>Meses:</strong></td>
                <td class="text-right"><?= esc($comprobante['meses_pagados']) ?> (<?= esc($comprobante['meses_pagados']) ?>)</td>
            </tr>
            <tr>
                <td><strong>Monto:</strong></td>
                <td class="text-right">Bs <?= esc($comprobante['monto']) ?></td>
            </tr>
            
        </table>
        <div class="divider"></div>

        <p><strong>Total Pagado:</strong> Bs <?= esc($comprobante['monto']) ?></p>
        <p><strong>Total Literal:</strong> <?php //= esc($comprobante['total_literal']) ?></p>
        <?php endforeach; ?>
        <div class="divider"></div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>------------------------</p>
        <p>Firma del Pagador</p>
    </div>
</body>
</html>