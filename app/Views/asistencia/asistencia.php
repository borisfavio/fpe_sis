        <!-- start: Content -->
        <div id="layoutSidenav_content">
<body class="container mt-4">
    <h2 class="text-center">Registro de Asistencia</h2>
    <button class="btn btn-success mb-3" id="marcarTodos">Marcar Todos Presentes</button>
    <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                      <thead>
            <tr>
                <th>Nombre</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
                <th>Nombre</th>
                <th>Estado</th>
            </tr>
        </tfoot>
        <tbody id="tablaAsistencia">
        <?php foreach ($personas as $persona): ?>
            <tr data-beneficiario-id="<?= esc($persona['id']) ?>">
                <td><?= esc($persona['nombres']) ?></td>
                <td>
                    <button class="btn estado-toggle btn-secondary" data-estado="Falta">Falta</button>
                </td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td>María Gómez</td>
                <td>
                    <button class="btn estado-toggle btn-secondary" data-estado="Falta">Falta</button>
                </td>
            </tr>
        </tbody>
    </table>
    <button class="btn btn-primary" id="guardarAsistencia">Guardar Asistencia</button>
    
    <script>
        $(document).ready(function () {
            const estados = ["Falta", "Presente", "Permiso"];
            
            $('.estado-toggle').click(function () {
                let row = $(this).closest('tr');
                let beneficiarioId = row.data('beneficiario-id');
                let grupoId = row.data('<?= esc($idGrupo) ?>');
                let estadoActual = $(this).data('estado');
                let nuevoEstado = estados[(estados.indexOf(estadoActual) + 1) % estados.length];
                $(this).data('estado', nuevoEstado);
                $(this).text(nuevoEstado);
                
                if (nuevoEstado === "Presente") {
                    $(this).removeClass('btn-secondary btn-warning').addClass('btn-success');
                } else if (nuevoEstado === "Permiso") {
                    $(this).removeClass('btn-success btn-secondary').addClass('btn-warning');
                } else {
                    $(this).removeClass('btn-success btn-warning').addClass('btn-secondary');
                }
                
                // Enviar actualización a la base de datos
                $.fetch('asistencia/guardar', {
                    beneficiario_id: beneficiarioId,
                    estado: nuevoEstado,
                    grupo_id: grupoId
                }, function (response) {
                    console.log(response);
                });
            });
            
            $('#marcarTodos').click(function () {
                $('.estado-toggle').each(function () {
                    $(this).data('estado', "Presente");
                    $(this).text("Presente");
                    $(this).removeClass('btn-secondary btn-warning').addClass('btn-success');
                });
            });

            $('#guardarAsistencia').click(function () {
                
                let asistencia = [];
                $('#tablaAsistencia tr').each(function () {
                    let nombre = $(this).find('td:first').text();
                    let estado = $(this).find('.estado-toggle').data('estado');
                    
                    if (nombre) {
                        asistencia.push({ nombre, estado });
                    }
                });

                $.post('asistencia/guardar', { asistencia: JSON.stringify(asistencia) }, function (response) {
                    alert(response);
                });
            });
        });
    </script>
</body>
</html>
