<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante</title>
    <style>
        body, html {
            margin: 2;
            padding: 1;
            width: 76mm;
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        .ticket {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 10px 0;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
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
        <p><strong>Fecha:</strong> <?= esc($fecha) ?></p>
        <p><strong>Recibí de:</strong> <?= esc($pagador) ?></p>
        <div class="divider"></div>

        <h4 class="text-center">DETALLE DE PAGO:</h4>

        <table class="table">
            <?php 
            $totalPagado = 0; // Variable para acumular el total
            foreach ($comprobantes as $comprobante): 
                $totalPagado += floatval($comprobante['monto']); // Sumar el total
            ?>
            <tr>
                <td><strong>Beneficiario:</strong></td>
                <td class="text-right"><?= esc($comprobante['codigo_beneficiario']) ?></td>
            </tr>
            <tr>
                <td><strong>Meses:</strong></td>
                <td class="text-right"><?= esc($comprobante['meses_pagados']) ?> (
                    <?= implode(", ", array_map('esc', $comprobante['meses_array'])) ?>
                    )</td>
            </tr>
            <tr>
                <td><strong>Monto:</strong></td>
                <td class="text-right">Bs <?= esc($comprobante['monto']) ?></td>
            </tr>
            <tr><td colspan="2"><div class="divider"></div></td></tr>
            <?php endforeach; ?>
        </table>

        <p><strong>Total Pagado:</strong> Bs <?= esc(number_format($totalPagado, 2)) ?></p>

        <div class="divider"></div>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>------------------------</p>
        <p>Firma del Pagador</p>
    </div>
</body>
</html>
