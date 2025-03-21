        <!-- start: Content -->
        <div id="layoutSidenav_content">

               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <p class="animated fadeInDown">
                          Usuarios <span class="fa-angle-right fa"></span> Lista de Usuarios
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
                            <a href="<?= site_url('usuarios/crear'); ?>" class=" btn btn-primary mt-4" value="primary">
                              Agregar Usuario <i class="fa fa-plus" aria-hidden="true"></i>
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
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= esc($usuario['nombre']) ?></td>
                    <td><?= esc($usuario['email']) ?></td>
                    <td>
                        <a href="<?= site_url('usuarios/editar/' . $usuario['id']) ?>">Editar</a>
                        <a href="<?= site_url('usuarios/eliminar/' . $usuario['id']) ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
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