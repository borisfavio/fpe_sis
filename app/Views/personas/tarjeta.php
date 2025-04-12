<?php
// Datos de ejemplo
$beneficiario = [
    'codigo' => '248',
    'nombres' => 'Dylan Jhonatan Mamani Tola',
    'telefono' => '71234567',
    'direccion' => 'Zona Alto Santiago de Lacaya',
    'grupo' => 'Descubridores',
    'dias_asistencia' => 'Lunes, Miércoles y Viernes',
    'imagen' => 'avatar.jpg' // Imagen de perfil (puedes cambiarla por una ruta dinámica)
];
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-body text-center">
                    <!-- Imagen de perfil -->
                    <img src="<?= $beneficiario['imagen'] ?>" class="rounded-circle mb-3" width="120" height="120" alt="Foto de perfil">

                    <!-- Datos del beneficiario -->
                    <h5 class="card-title font-weight-bold text-primary"><?= $beneficiario['nombres'] ?></h5>
                    <p class="mb-1"><strong>Código:</strong> <?= $beneficiario['codigo'] ?></p>
                    <p class="mb-1"><strong>Grupo:</strong> <?= $beneficiario['grupo'] ?></p>
                    <p class="mb-1"><strong>Días de asistencia:</strong> <?= $beneficiario['dias_asistencia'] ?></p>
                    <p class="mb-1"><i class="fas fa-map-marker-alt text-danger"></i> <?= $beneficiario['direccion'] ?></p>
                    <p class="mb-3"><i class="fas fa-phone-alt text-success"></i> <?= $beneficiario['telefono'] ?></p>

                    <!-- Botones -->
                    <div class="d-flex justify-content-center flex-wrap">
                        <a href="https://wa.me/591<?= $beneficiario['telefono'] ?>" target="_blank" class="btn btn-success m-1">
                            <i class="fab fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="editar.php?codigo=<?= $beneficiario['codigo'] ?>" class="btn btn-warning m-1">
                            <i class="fas fa-edit"></i> Editar
                        </a>
                        <a href="anecdotario.php?codigo=<?= $beneficiario['codigo'] ?>" class="btn btn-info m-1">
                            <i class="fas fa-book"></i> Anecdotario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

