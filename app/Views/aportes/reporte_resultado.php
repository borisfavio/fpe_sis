<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
        }
        a {
            text-decoration: none;
            color: #007bff;
            margin-bottom: 20px;
            display: inline-block;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 10px 15px;
            border: 1px solid #ccc;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f1f1f1;
        }
        .total-row {
            font-weight: bold;
            background-color: #e0f7fa;
        }
    </style>
</head>
<body>

    <h2>Reporte de Pagos del <?= esc($fecha_inicio) ?> al <?= esc($fecha_fin) ?></h2>
    <a href="<?= base_url('reporte-pagos') ?>">← Volver al formulario</a>

    <?php if (!empty($pagos)): ?>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Nro. Comprobante</th>
                    <th>Pagador</th>
                    <th>Código Beneficiario</th>
                    <th>Meses Pagados</th>
                    <th>Monto (Bs)</th>
                    <th>Meses</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalMonto = 0;
                foreach ($pagos as $pago):
                    $totalMonto += $pago['monto'];
                ?>
                    <tr>
                        <td><?= esc($pago['fecha']) ?></td>
                        <td><?= esc($pago['nro_comp']) ?></td>
                        <td><?= esc($pago['nombre_pagador']) ?></td>
                        <td><?= esc($pago['codigo_beneficiario']) ?></td>
                        <td><?= esc($pago['meses_pagados']) ?></td>
                        <td><?= number_format($pago['monto'], 2) ?></td>
                        <td><?= esc($pago['meses']) ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="5">TOTAL RECAUDADO</td>
                    <td colspan="2"><?= number_format($totalMonto, 2) ?> Bs</td>
                </tr>
            </tbody>
        </table>
    <?php else: ?>
        <p>No se encontraron pagos en el rango de fechas seleccionado.</p>
    <?php endif; ?>

</body>
</html>
