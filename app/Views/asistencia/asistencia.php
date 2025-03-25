        <!-- start: Content -->
        <div id="layoutSidenav_content">
        
<h1>Registrar Asistencia</h1>

<form action="<?= base_url('asistencia/registrar') ?>" method="post">
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $fecha_actual ?>" required>
        <input type="text" name="grupo_id" value="<?= $idGrupo ?>">
    </div>
    
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Asistencia</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
                <th>Matrícula</th>
                <th>Nombre</th>
                <th>Grupo</th>
                <th>Asistencia</th>
                <th>Observaciones</th>
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($alumnos as $alumno): ?>
            <tr>
                <td><input type="hidden" name="id_<?= $alumno['id'] ?>" value="<?= $alumno['id'] ?>" class="form-control">
                    <?= $alumno['codigo'] ?>
            </td>

                <td><?= $alumno['nombres'] ?></td>
                <td><?= $alumno['id'] ?></td>
                <td>
                    <select name="asistencia_<?= $alumno['id'] ?>" class="form-select">
                        <option value="presente">Presente</option>
                        <option value="ausente">Ausente</option>
                        <option value="justificado">Justificado</option>
                    </select>
                </td>
                <td>
                    <input type="text" name="observacion_<?= $alumno['id'] ?>" class="form-control">
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <button type="submit" class="btn btn-primary">Guardar Asistencias</button>
</form>
