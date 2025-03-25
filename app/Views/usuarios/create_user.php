        <!-- start: Content -->
        <div id="layoutSidenav_content">
          <main>
            <div class="container">

              <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>

              <div class="col-md-12">
                <div class="panel">
                  <div class="panel-heading"></div>
                  <div class="panel-body">
                    
                    


                    <div class="card">
                      <div class="card-header">
                      <div class="card-title">Agregar Usuario</div>
                      </div>
                      <div class="card-body">
                      <?php if (session('errors')): ?>
                      <div style="color: red;">
                        <?php foreach (session('errors') as $error): ?>
                          <p><?= esc($error) ?></p>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>

                    <form action="<?= site_url('usuarios/guardar') ?>" method="post">
                      <label for="nombre">Nombre:</label>
                      <input type="text" name="nombre" id="nombre" value="<?= old('nombre') ?>">
                      <br>
                      <label for="email">Email:</label>
                      <input type="email" name="email" id="email" value="<?= old('email') ?>">
                      <br>
                      <label for="password">Contraseña:</label>
                      <input type="password" name="password" id="password">
                      <br>
                      <button class="btn btn-primary" type="submit">Guardar</button>
                    </form>
                      </div>
                    </div>

                    

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

        <!-- end: content -->





        </div>


        <!-- start: Javascript -->
        <script src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/jquery.ui.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/bootstrap.min.js"></script>


        <!-- plugins -->
        <script src="<?= base_url(); ?>assets/js/plugins/jquery.steps.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/moment.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/jquery.validate.min.js"></script>
        <script src="<?= base_url(); ?>assets/js/plugins/jquery.nicescroll.js"></script>


        <!-- custom -->
        <script src="<?= base_url(); ?>assets/js/main.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {


            function registrarPersona() {
              const nombres = document.getElementById('nombres').value;
              const apellidos = document.getElementById('apellidos').value;

              const newUser = {
                nombres: nombres,
                apellidos: apellidos,
                ministerio: "general"
                // Otros campos del usuario
              };

              // Configurar la solicitud HTTP POST
              fetch('persons/store', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/json', // Indicar que estás enviando datos en formato JSON
                  },
                  body: JSON.stringify(newUser), // Convertir el objeto a formato JSON
                })
                .then(response => {
                  if (!response.ok) {
                    throw new Error('Error al enviar los datos');
                  }
                  return response.json();
                })
                .then(data => {
                  // Manejar la respuesta del servidor
                  console.log('Datos enviados correctamente:', data);
                  alert("registrado!" + data);
                })
                .catch(error => {
                  // Manejar errores durante la solicitud
                  console.error('Error en la solicitud:', error);
                });

            }

          });
        </script>
        <!-- end: Javascript -->
        </body>

        </html>