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
                        <a href="anecdotario.php?codigo=<?= $beneficiario['id'] ?>" class="btn btn-info m-1">
                            <i class="fas fa-book"></i> Anecdotario
                        </a>
                        <?php //var_dump($beneficiario); exit;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

