        <!-- start: Content -->
        <div id="layoutSidenav_content">
             <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="animated fadeInLeft">Nuevo Miembro</h3>
                        <p class="animated fadeInDown">
                          Beneficiario <span class="fa-angle-right fa"></span> Editar Beneficiario
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

        <label for="local_id">Local ID:</label>
        <input type="text" name="local_id" value="<?php echo $beneficiario->codigo; ?>" required>
        <br>

        <label for="account_name">Nombre de la Cuenta:</label>
        <input type="text" name="account_name" value="<?php echo $beneficiario->nombres; ?>" required>
        <br>

        <label for="estado">Estado:</label>
        <select name="estado" required>
            <option value="1" <?php echo ($beneficiario->estado == 1) ? 'selected' : ''; ?>>Activo</option>
            <option value="0" <?php echo ($beneficiario->estado == 0) ? 'selected' : ''; ?>>Inactivo</option>
        </select>
        <br>

        <label for="birthdate">Fecha de Nacimiento:</label>
        <input type="date" name="birthdate" value="<?php echo $beneficiario->birthdate; ?>" required>
        <br>

        <label for="caregiver_birthdate">Fecha de Nacimiento del Cuidador:</label>
        <input type="date" name="caregiver_birthdate" value="<?php echo $beneficiario->caregiver_birthdate; ?>">
        <br>

        <label for="gender">Género:</label>
        <select name="gender" required>
            <option value="Masculino" <?php echo ($beneficiario->gender == 'Masculino') ? 'selected' : ''; ?>>Masculino</option>
            <option value="Femenino" <?php echo ($beneficiario->gender == 'Femenino') ? 'selected' : ''; ?>>Femenino</option>
            <option value="Otro" <?php echo ($beneficiario->gender == 'Otro') ? 'selected' : ''; ?>>Otro</option>
        </select>
        <br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone" value="<?php echo $beneficiario->phone; ?>">
        <br>

        <label for="primary_caregiver">Cuidador Principal:</label>
        <input type="text" name="primary_caregiver" value="<?php echo $beneficiario->primary_caregiver; ?>">
        <br>

        <label for="religious_affiliation">Afiliación Religiosa:</label>
        <input type="text" name="religious_affiliation" value="<?php echo $beneficiario->religious_affiliation; ?>">
        <br>

        <label for="street">Calle:</label>
        <input type="text" name="street" value="<?php echo $beneficiario->street; ?>">
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
  $(document).ready(function(){


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
          alert("registrado!"+data);
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