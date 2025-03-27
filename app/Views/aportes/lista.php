<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Aportes</li>
      </ol>

      <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col">
                <i class="fas fa-table mr-1"></i>
                Historial de pago
                </div>
                <div class="col left">
            <a name="" id="" class="btn btn-primary btn-sm float-right" href="<?php echo site_url('aportes/formulario');?>" role="button">Nuevo Pago</a>
        </div>
            </div>
          
          
        </div>
        
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Local ID</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Name</th>
                  <th>Local ID</th>
                  <th>Office</th>
                  <th>Age</th>
                  <th>Start date</th>
                  <th>Salary</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($pagos as $pago): ?>
                  <tr>
                    <td><?= esc($pago['fecha']); ?></td>
                    <td><?= esc($pago['nro_comp']); ?></td>
                    <td><?= esc($pago['codigo_beneficiario']); ?></td>
                    <td><?= esc($pago['nombre_pagador']); ?></td>
                    <td><?= number_format($pago['total'], 2) ?></td>
                    <td>
                      <a href="<?php echo site_url('aportes/generarpdf/' . $pago['nro_comp']);?>">
                        imprimir
                      </a>
                    </td>
                  </tr>
                <?php endforeach; ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main>
  <footer class="py-4 bg-light mt-auto">
    <div class="container-fluid">
      <div class="d-flex align-items-center justify-content-between small">
        <div class="text-muted">Copyright &copy; Your Website 2020</div>
        <div>
          <a href="#">Privacy Policy</a>
          &middot;
          <a href="#">Terms &amp; Conditions</a>
        </div>
      </div>
    </div>
  </footer>
</div>