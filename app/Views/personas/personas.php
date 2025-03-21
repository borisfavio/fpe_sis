        <!-- start: Content -->
        <div id="layoutSidenav_content">

          <div class="panel box-shadow-none content-header">
            <div class="panel-body">
              <div class="col-md-12">
                <p class="animated fadeInDown">
                  Beneficiarios <span class="fa-angle-right fa"></span> Lista de beneficiarios
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-12 top-20 padding-0">
            <div class="col-md-12">
              <div class="panel">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col-3">
                      <div>
                        <a href="<?= site_url('persons/create'); ?>" class=" btn btn-primary mt-4" value="primary">
                          Agregar Beneficiario <i class="fa fa-plus" aria-hidden="true"></i>
                        </a>

                      </div>
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
                          <th>Options</th>
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
                          <th>Options</th>
                        </tr>
                      </tfoot>
                      <tbody>
                        <?php foreach ($personas as $persona): ?>
                          <tr>
                            <td><?= esc($persona['nombres']) ?></td>
                            <td><?= esc($persona['codigo']) ?></td>
                            <td><?= ($persona['estado'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                            <td><?= esc($persona['id']) ?></td>
                            <td><?= esc($persona['birthdate']) ?></td>
                            <td><?= esc($persona['phone']) ?></td>
                            <td>
                              <a href="https://wa.me/591<?= $persona['phone'] ?>" target="_blank" class="btn btn-circle btn-outline btn-mn btn-user">
                                <span class="fa fa-edit"></span>
                              </a>
                              <a href="<?= site_url('/persons/edit/' . $persona['id']) ?>" class="btn btn-circle btn-outline btn-mn btn-info">
                                <span class="fa fa-edit"></span>
                              </a>
                              <button onclick="eliminarPersona('<?= esc($persona['id']) ?>')" class="btn btn-circle btn-outline btn-mn btn-danger">
                                <span class="fa fa-trash"></span>
                              </button>
                            </td>
                          </tr>
                        <?php endforeach; ?>

                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="panel-body">
                  <div class="responsive-table">

                  </div>
                </div>



              </div>
            </div>

          </div>

        </div>
        <!-- end: content -->