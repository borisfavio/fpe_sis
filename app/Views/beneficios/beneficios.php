        <!-- start: Content -->
        <div id="layoutSidenav_content">

               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <p class="animated fadeInDown">
                          Beneficios <span class="fa-angle-right fa"></span> Lista de Beneficios
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
                            <a href="<?= base_url(); ?>persons/create" class=" btn btn-primary mt-4" value="primary">
                              Agregar Beneficio <i class="fa fa-plus" aria-hidden="true"></i>
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
                <th>ID</th>
                  <th>Descripción</th>
                  <th>Detalle entrega</th>
                  <th>Fecha de entrega</th>
                  <th>Estado</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Descripción</th>
                  <th>Detalle entrega</th>
                  <th>Fecha de entrega</th>
                  <th>Estado</th>
                  <th>Options</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($beneficios as $persona): ?>
                  <tr>
                    <td><?php echo $persona['id']; ?></td>
                    <td><?php echo $persona['nombre']; ?></td>
                    <td><?php echo $persona['descripcion']; ?></td>
                    <td><?php echo $persona['fecha_creacion']; ?></td>
                    <td><?php echo ($persona['estado'] == 1) ? 'Activo' : 'Inactivo'; ?></td>
                    <td>
                            <a href="<?php echo site_url('beneficios/entrega/'.$persona['id'].''); ?>" class="btn btn-circle btn-outline btn-mn btn-info">"
                              <span class="fa fa-shop">entrega</span>
                            </a>
                            <button onclick="eliminarPersona('<?php echo $persona['id']; ?>')" class="btn btn-circle btn-outline btn-mn btn-danger">
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