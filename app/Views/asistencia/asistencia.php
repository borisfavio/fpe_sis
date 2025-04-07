        <!-- start: Content -->
        <style>
            body {
                background-color: #f8f9fa;
                padding-top: 20px;
            }

            .header {
                background-color: #0d6efd;
                color: white;
                padding: 15px 0;
                margin-bottom: 30px;
                border-radius: 5px;
            }

            .table-container {
                background-color: white;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                padding: 20px;
                margin-bottom: 30px;
            }

            .btn-add {
                margin-bottom: 20px;
            }

            .attendance-toggle {
                width: 120px;
                position: relative;
            }

            .attendance-toggle .btn {
                width: 100%;
                position: relative;
                overflow: hidden;
            }

            .attendance-toggle .dropdown-menu {
                min-width: 120px;
                padding: 0;
            }

            .attendance-toggle .dropdown-item {
                padding: 0.5rem 1rem;
                text-align: center;
            }

            .status-empty {
                background-color: #f8f9fa;
                color: #6c757d;
            }

            .status-present {
                background-color: #d1e7dd;
                color: #0f5132;
            }

            .status-absent {
                background-color: #f8d7da;
                color: #842029;
            }

            .status-permission {
                background-color: #fff3cd;
                color: #664d03;
            }
        </style>
        <!-- start: Content -->

        <div id="layoutSidenav_content">
            <div class="container">
                <div class="header text-center">
                    <h4><i class="fas fa-clipboard-check"></i> Registro de Asistencia</h4>
                    <p class="mb-0">Control diario de asistencia de estudiantes</p>
                </div>

                <form action="<?= base_url('asistencia/registrar') ?>" method="post">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?= $fecha_actual ?>" required>
                        <input type="hidden" name="grupo_id" value="<?= $idGrupo ?>">
                    </div>
<div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                            <tr>
                                <th>N.</th>
                                <th>Cod.</th>
                                <th>Nombres</th>
                                <th class="d-none d-md-table-cell">Grupo</th>
                                <th>Asistencia</th>
                                <th class="d-none d-md-table-cell">Observaciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $nro = 1; ?>
                            <?php foreach ($alumnos as $alumno):
                                $id = $alumno['id'];
                                
                                $asistencia = isset($asistencias[$id]) ? $asistencias[$id] : null;
                                
                                // Determinar estado
                                $estado = (!empty($asistencia) && !empty($asistencia['estado'])) ? $asistencia['estado'] : 'empty';
                                //var_dump($estado); exit;
                                $estado_texto = match ($estado) {
                                    'present' => 'Presente',
                                    'absent' => 'Falta',
                                    'permission' => 'Permiso',
                                    'empty' => 'Vacio',
                                    default => 'Vacio'
                                };
                                //var_dump($estado_texto); exit;
                                $estado_icono = match ($estado) {
                                    'present' => 'fa-check text-success',
                                    'absent' => 'fa-times text-danger',
                                    'permission' => 'fa-exclamation text-warning',
                                    default => 'fa-circle text-muted'
                                };
                                //var_dump($estado_icono); exit;
                                $estado_class = 'status-' . $estado;
                            ?>
                                <tr data-id="<?= $id ?>">
                                <td><?= $nro++ ?></td>
                                    <td>
                                        <input type="hidden" name="id_<?= $id ?>" value="<?= $id ?>">
                                        <?= substr($alumno['codigo'], -4) ?>
                                    </td>
                                    <td><?= $alumno['nombres'] ?></td>
                                    <td class="d-none d-md-table-cell"><?= $alumno['codigo'] ?></td>
                                    
                                    <td>
                                        <div class="attendance-toggle dropdown">
                                        
                                            <input type="hidden" name="asistencia_<?= $id ?>" value="<?= $estado ?>">
                                            <button class="btn btn-secondary dropdown-toggle <?= $estado_class ?>"
                                                type="button" data-bs-toggle="dropdown">
                                                <i class="fas <?= $estado_icono ?>"></i> <?= $estado_texto ?>
                                                
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item attendance-option" href="#" data-id="<?= $id ?>" data-status="present"><i class="fas fa-check text-success"></i> Presente</a></li>
                                                <li><a class="dropdown-item attendance-option" href="#" data-id="<?= $id ?>" data-status="absent"><i class="fas fa-times text-danger"></i> Falta</a></li>
                                                <li><a class="dropdown-item attendance-option" href="#" data-id="<?= $id ?>" data-status="permission"><i class="fas fa-exclamation text-warning"></i> Permiso</a></li>
                                            </ul>
                                            
                                        </div>
                                    </td>
                                    <td class="d-none d-md-table-cell">
                                        <input type="text" name="observacion_<?= $id ?>" class="form-control"
                                            value="<?= $asistencia ? esc($asistencia['observaciones']) : '' ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Asistencias</button>
                </form>
            </div>

            <script>
                const statusTexts = {
                    'present': '<i class="fas fa-check"></i> Presente',
                    'absent': '<i class="fas fa-times"></i> Falta',
                    'permission': '<i class="fas fa-exclamation"></i> Permiso'
                };
                const statusClasses = {
                    'present': 'status-present',
                    'absent': 'status-absent',
                    'permission': 'status-permission'
                };

                $(document).on('click', '.attendance-option', function(e) {
                    e.preventDefault();
                    const status = $(this).data('status');
                    const id = $(this).data('id');

                    const row = $(`tr[data-id="${id}"]`);
                    const button = row.find('.attendance-toggle .btn');
                    const hiddenInput = row.find('input[name="asistencia_' + id + '"]');

                    button.removeClass('status-empty status-present status-absent status-permission')
                        .addClass(statusClasses[status])
                        .html(statusTexts[status]);

                    hiddenInput.val(status);
                });
            </script>

            <!-- Asegúrate de tener jQuery y Bootstrap JS cargados -->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        </div>