<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Comprobante de Pago</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            width: 18cm;
            margin: 0.5cm auto;
            padding: 0.5cm;
            box-sizing: border-box;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            border-bottom: 1px solid #000;
            padding-bottom: 5px;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .header-info {
            text-align: center;
            flex-grow: 1;
        }
        .header-info h2 {
            margin: 5px 0;
            font-size: 16px;
        }
        .header-info p {
            margin: 2px 0;
            font-size: 11px;
        }
        .receipt-info {
            display: flex;
            justify-content: space-between;
            margin: 5px 0;
        }
        .content {
            margin: 10px 0;
        }
        .divider {
            border-top: 1px dashed #000;
            margin: 5px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        .table th, .table td {
            padding: 4px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .signature {
            width: 50%;
            margin: 15px auto 0;
            text-align: center;
            font-size: 11px;
        }
        .signature-line {
            border-top: 1px solid #000;
            margin: 15px auto 5px;
            width: 80%;
        }
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            font-size: 10px;
        }
        .qr-code {
            width: 60px;
            height: 60px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>

    <!-- Encabezado con logo -->
    <div class="header">
    <img src="" alt="Logo" class="logo">
        <div class="header-info">
            <h2>Fundación Pasos de Esperanza</h2>
            <p>Calle 4 Nro 467, Zn Alto Santiago de Lacaya</p>
            <p>Teléfono: 69700259</p>
        </div>
        <div class="qr-code">
        <img src="" alt="QR" class="qr-code">
        </div>
    </div>

    <!-- Información del recibo -->
    <div class="receipt-info">
        <div>
            <p><strong>Recibí de:</strong> <?= esc($pagador) ?></p>
        </div>
        <div>
            <p><strong>Fecha:</strong> <?= esc($fecha) ?></p>
            <p><strong>Nro. Comprobante:</strong> <?= esc($numero) ?></p>
        </div>
    </div>

    <!-- Detalles del pago -->
    <div class="content">
        <h3 class="text-center">Detalle del Pago</h3>
        <table class="table">
            <tr>
                <th>Beneficiario</th>
                <th>Meses Pagados</th>
                <th class="text-right">Monto (Bs)</th>
            </tr>
            <?php 
            $totalPagado = 0;
            foreach ($comprobantes as $comprobante): 
                $totalPagado += floatval($comprobante['monto']);
            ?>
            <tr>
                <td><?= esc($comprobante['codigo_beneficiario']) ?></td>
                <td><?= esc($comprobante['meses_pagados']) ?> (<?= implode(", ", array_map('esc', $comprobante['meses_array'])) ?>)</td>
                <td class="text-right"><?= esc(number_format($comprobante['monto'], 2)) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" class="text-right"><strong>Total Pagado:</strong></td>
                <td class="text-right"><strong>Bs <?= esc(number_format($totalPagado, 2)) ?></strong></td>
            </tr>
        </table>
    </div>

    <!-- Firma -->
    <div class="signature">
        <div class="signature-line"></div>
        <p>Nombre: __________________________</p>
        <p>C.I.: __________________________</p>
        <p>Firma del Pagador</p>
    </div>

    <!-- Pie de página -->
    <div class="footer">
        <p>Gracias por su apoyo.</p>
        <p>Comprobante válido con firma y sello</p>
    </div>

</body>
</html>