        <!-- start: Content -->
        <div id="layoutSidenav_content">
          <div class=" container mt-4">
            <div class="">
                  <div class="row">
                  <?php foreach ($personas as $grupo): ?>
                          <div class="col-md-3 m-1">
                          <div
                            class="card border-primary">
                            <div class="card-body">
                              <h3 class="card-title"><?php echo $grupo['nombre']; ?></h3>
                              <p class="card-text">Participantes</p>
                              <a class="btn btn-info" href="<?php echo site_url('/asistencia/mes/'.$grupo['id']);?>">Ver</a>
                              <a class="btn btn-primary" href="<?php echo site_url('/asistencia/tg/'.$grupo['id']);?>">Registrar</a>
                            </div>
                          </div>
                          </div>
                        <?php endforeach; ?>
           
                  </div>
              
            </div>

          </div>

        </div>
        <!-- end: content -->