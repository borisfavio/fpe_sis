<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Pagos</title>
</head>
<body>
    <h2>Generar Reporte de Pagos</h2>
    <form method="post" action="<?= site_url('aportes/reporte-pagos') ?>">
        <label for="fecha_inicio">Fecha inicio:</label>
        <input type="date" name="fecha_inicio" required>
        <br><br>
        <label for="fecha_fin">Fecha fin:</label>
        <input type="date" name="fecha_fin" required>
        <br><br>
        <button type="submit">Generar Reporte</button>
    </form>
</body>
</html>
