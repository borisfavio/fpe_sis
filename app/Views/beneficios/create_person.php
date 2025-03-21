        <!-- start: Content -->
        <div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">Dashboard</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
      
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                    <h1>Agregar Beneficiario</h1>
    <form action="<?php echo site_url('persona/store'); ?>" method="post">
        <label for="local_id">Local ID:</label>
        <input type="text" name="local_id" required>
        <br>

        <label for="account_name">Nombre de la Cuenta:</label>
        <input type="text" name="account_name" required>
        <br>

        <label for="estado">Estado:</label>
        <select name="estado" required>
            <option value="1">Activo</option>
            <option value="0">Inactivo</option>
        </select>
        <br>

        <label for="birthdate">Fecha de Nacimiento:</label>
        <input type="date" name="birthdate" required>
        <br>

        <label for="caregiver_birthdate">Fecha de Nacimiento del Cuidador:</label>
        <input type="date" name="caregiver_birthdate">
        <br>

        <label for="gender">Género:</label>
        <select name="gender" required>
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
            <option value="Otro">Otro</option>
        </select>
        <br>

        <label for="phone">Teléfono:</label>
        <input type="text" name="phone">
        <br>

        <label for="primary_caregiver">Cuidador Principal:</label>
        <input type="text" name="primary_caregiver">
        <br>

        <label for="religious_affiliation">Afiliación Religiosa:</label>
        <input type="text" name="religious_affiliation">
        <br>

        <label for="street">Calle:</label>
        <input type="text" name="street">
        <br>

        <button type="submit">Guardar</button>
    </form>



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