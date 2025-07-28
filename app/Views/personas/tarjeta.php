        <!-- start: Content -->
        <div id="layoutSidenav_content">

          <div class="panel box-shadow-none content-header">
            <div class="panel-body">
              <div class="col-md-12">
                <p class="animated fadeInDown">
                  Beneficiarios <span class="fa-angle-right fa"></span> Lista de beneficiarios
                </p>
              </div>


<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <!-- Imagen de perfil -->
                    
                    <img src="<?= base_url('assets/images/avatar.jpg') ?>" class="rounded-circle mb-3" width="120" height="120" alt="Foto de perfil">

                    <!-- Datos del beneficiario -->
                    <h5 class="card-title font-weight-bold text-primary"><?= $beneficiario['nombres'].' '.$beneficiario['apellidos'] ?></h5>
                    
                    <p class="mb-1"><strong>Código:</strong> <?= $beneficiario['codigo'] ?></p>
                    
                    <p class="mb-1"><strong>Grupo:</strong> <?= $beneficiario['grupo_id'] ?></p>
                    <p class="mb-1"><strong>Días de asistencia:</strong> <?= $beneficiario['id'] ?></p>
                    
                    <p class="mb-1"><i class="fas fa-map-marker-alt text-danger"></i> <?= $beneficiario['calle'] ?></p>
                    <p class="mb-3"><i class="fas fa-phone-alt text-success"></i> <?= $beneficiario['telefono'] ?></p>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center flex-wrap">
                        <a href="https://wa.me/591<?= $beneficiario['telefono'] ?>" target="_blank" class="btn btn-success m-1">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="<?= site_url('/persons/edit/' . $beneficiario['id']) ?>" class="btn btn-warning m-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <butt href="anecdotario.php?codigo=<?= $beneficiario['id'] ?>" class="btn btn-info m-1">
                            <i class="fas fa-book"></i> Anecdotario
                        </butt>
                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalRegistro">Agregar al expediente</button>
                        <?php //var_dump($beneficiario); exit;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-profile {
      max-width: 500px;
      margin: 20px auto;
      border-radius: 15px;
    }
    .card-profile img {
      border-radius: 50%;
      width: 120px;
      height: 120px;
      object-fit: cover;
      margin: auto;
    }
  </style>

<div class="card card-profile shadow">
  <div class="card-body text-center">
<!-- Botón para mostrar historial -->
<div class="text-center">
  <button class="btn btn-outline-secondary btn-sm mt-2" id="btnMostrarHistorial">Ver Historial del Expediente</button>
</div>

<!-- Sección de historial -->
<div class="container mt-3 d-none" id="historialExpediente">
  <h5 class="text-center mb-3">🕘 Historial del Expediente</h5>
  <ul class="list-group" id="listaHistorial">
    <!-- Aquí se añadirán dinámicamente los registros -->
  </ul>
</div>
  
</div>
</div>

<!-- Modal dinámico -->
<div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="modalRegistroLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form id="formRegistro" method="post" action="#">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalRegistroLabel">Agregar al expediente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
          </button>
          
        </div>
        
        <div class="modal-body">

          <div class="form-group">
            <label for="tipo">Tipo de Registro</label>
            <select id="tipo" name="tipo" class="form-control" required>
              <option value="">Seleccione una opción</option>
              <option value="anecdotario">Anecdotario</option>
              <option value="permiso">Permiso</option>
              <option value="visita">Visita Domiciliar</option>
              <option value="solicitud">Solicitud</option>
            </select>
          </div>

          <div id="campos-dinamicos">
            <!-- Aquí se insertarán los campos según el tipo -->
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </form>
  </div>
  
</div>

<!-- Scripts necesarios -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $('#tipo').on('change', function () {
    const tipo = $(this).val();
    let html = '';

    if (tipo === 'anecdotario') {
      html = `
        <div class="form-group">
          <label for="titulo">Título</label>
          <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="contenido">Descripción</label>
          <textarea name="contenido" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="responsable">Responsable</label>
          <input type="text" name="responsable" class="form-control" required>
        </div>
      `;
    } else if (tipo === 'permiso') {
      html = `
        <div class="form-group">
          <label for="motivo">Motivo</label>
          <input type="text" name="motivo" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="fecha_permiso">Fecha</label>
          <input type="date" name="fecha_permiso" class="form-control" required>
        </div>
      `;
    } else if (tipo === 'visita') {
      html = `
        <div class="form-group">
          <label for="fecha_visita">Fecha de Visita</label>
          <input type="date" name="fecha_visita" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="observacion">Observaciones</label>
          <textarea name="observacion" class="form-control" required></textarea>
        </div>
      `;
    } else if (tipo === 'solicitud') {
      html = `
        <div class="form-group">
          <label for="tipo_solicitud">Tipo de Solicitud</label>
          <input type="text" name="tipo_solicitud" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="detalle">Detalle</label>
          <textarea name="detalle" class="form-control" required></textarea>
        </div>
      `;
    }

    $('#campos-dinamicos').html(html);
  });
</script>
<script>
  $('#tipo').on('change', function () {
    const tipo = $(this).val();
    let html = '';

    if (tipo === 'anecdotario') {
      html = `
        <div class="form-group">
          <label for="titulo">Título</label>
          <input type="text" name="titulo" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="contenido">Descripción</label>
          <textarea name="contenido" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <label for="responsable">Responsable</label>
          <input type="text" name="responsable" class="form-control" required>
        </div>
      `;
    } else if (tipo === 'permiso') {
      html = `
        <div class="form-group">
          <label for="motivo">Motivo</label>
          <input type="text" name="motivo" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="fecha_permiso">Fecha</label>
          <input type="date" name="fecha_permiso" class="form-control" required>
        </div>
      `;
    } else if (tipo === 'visita') {
      html = `
        <div class="form-group">
          <label for="fecha_visita">Fecha de Visita</label>
          <input type="date" name="fecha_visita" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="observacion">Observaciones</label>
          <textarea name="observacion" class="form-control" required></textarea>
        </div>
      `;
    } else if (tipo === 'solicitud') {
      html = `
        <div class="form-group">
          <label for="tipo_solicitud">Tipo de Solicitud</label>
          <input type="text" name="tipo_solicitud" class="form-control" required>
        </div>
        <div class="form-group">
          <label for="detalle">Detalle</label>
          <textarea name="detalle" class="form-control" required></textarea>
        </div>
      `;
    }

    $('#campos-dinamicos').html(html);
  });

  // Mostrar/Ocultar historial
  $('#btnMostrarHistorial').on('click', function () {
    $('#historialExpediente').toggleClass('d-none');
    $(this).text(function(i, text){
      return text === "Ver Historial del Expediente" ? "Ocultar Historial" : "Ver Historial del Expediente";
    });
  });

  // Simulación de guardado al enviar el formulario
  $('#formRegistro').on('submit', function (e) {
    e.preventDefault(); // evita envío real

    const tipo = $('#tipo').val();
    let texto = `<strong>${tipo.toUpperCase()}</strong>: `;

    const formData = $(this).serializeArray();
    formData.forEach(field => {
      if (field.name !== 'tipo') {
        texto += `<br><em>${field.name}</em>: ${field.value}`;
      }
    });

    $('#listaHistorial').prepend(`<li class="list-group-item">${texto}</li>`);

    // cerrar modal y limpiar formulario
    $('#modalRegistro').modal('hide');
    this.reset();
    $('#campos-dinamicos').html('');
  });
</script>



