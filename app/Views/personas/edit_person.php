        <!-- start: Content -->
        <div id="layoutSidenav_content">
          <div class="panel box-shadow-none content-header">
            <div class="panel-body">
              <div class="col-md-12">
                <h3 class="animated fadeInLeft">Nuevo Beneficiario</h3>

                <p class="animated fadeInDown">
                  Ministerio <span class="fa-angle-right fa"></span> Modificar Persona
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-12">
            <div class="panel">
              <div class="panel-heading"></div>
              <div class="panel-body">
                <form action="<?php echo site_url('persona/update'); ?>" method="post">
                          
                  <input type="hidden" name="id" value="<?php echo $beneficiario->id; ?>">
                  <label for="local_id">CODIGO:</label>
                  
                  <input type="text" name="local_id" value="<?php echo $beneficiario->codigo; ?>" required>
                  <br>

                  <label for="account_name">Nombres:</label>
                  <input type="text" name="account_name" value="<?php echo $beneficiario->nombres; ?>" required>
                  <br>

                  <label for="apellidos">Apellidos:</label>
                  <input type="text" name="apellidos" value="<?php echo $beneficiario->apellidos; ?>" required>
                  <br>

                  <label for="estado">Estado:</label>
                  <select name="estado" required>
                    <option value="activo" <?php echo ($beneficiario->estado == "activo") ? 'selected' : ''; ?>>Activo</option>
                    <option value="inactivo" <?php echo ($beneficiario->estado == "inactivo") ? 'selected' : ''; ?>>Inactivo</option>
                  </select>
                  <br>

                  <label for="birthdate">Fecha de Nacimiento:</label>
                  
                  <input type="date" name="birthdate" value="<?php echo $beneficiario->fecha_nacimiento; ?>">
                  <br>

                  <label for="gender">Género:</label>
                  <select name="gender" required>
                    <option value="Masculino" <?php echo ($beneficiario->sexo == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="Femenino" <?php echo ($beneficiario->sexo == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
                    <option value="Otro" <?php echo ($beneficiario->sexo == 'Otro') ? 'selected' : ''; ?>>Otro</option>
                  </select>
                  
                  <br>

                  <label for="phone">Teléfono:</label>
                  <input type="text" name="phone" value="<?php echo $beneficiario->telefono; ?>">
                  <br>

                  <label for="primary_caregiver">Cuidador Principal:</label>
                  <input type="text" name="primary_caregiver" value="<?php echo $beneficiario->cuidador_principal; ?>">
                  <br>

                  

                  <label for="street">Calle:</label>
                  <input type="text" name="street" value="<?php echo $beneficiario->calle; ?>">

                  <br>

                  <button type="submit">Guardar Cambios</button>
                </form>


              </div>
            </div>
          </div>
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



          });
        </script>
        <!-- end: Javascript -->
        </body>

        </html>