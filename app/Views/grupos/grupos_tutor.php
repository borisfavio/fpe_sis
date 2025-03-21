        <!-- start: Content -->
        <div id="layoutSidenav_content">

               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <p class="animated fadeInDown">
                          Beneficiarios <span class="fa-angle-right fa"></span> Grupos <span class="fa-angle-right fa"></span>Tutor
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
                            
                          </div>
                        </div>
                      </div>
                      
                      
                    </div>

                    <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                <th>Codigo</th>
                  <th>Nombres</th>
                  <th>Options</th>
                </tr>
              </thead>
              <tfoot>
                <tr>
                  <th>Codigo</th>
                  <th>Nombres</th>
                  <th>Options</th>
                </tr>
              </tfoot>
              <tbody>
                <?php foreach ($personas as $persona): ?>
                  <tr>
                  <td><?php echo $persona['codigo']; ?></td>
                    <td><?php echo $persona['nombres']; ?></td>
                    <td>
                            <a href="<?php echo site_url('/persons/edit/'.$persona['id'].''); ?>" class="btn btn-circle btn-outline btn-mn btn-info">
                              <span class="fa fa-edit"></span>
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