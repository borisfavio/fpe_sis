        <!-- start: Content -->
        <div id="layoutSidenav_content">
  <main>
    <div class="container-fluid">
       
            <div class="col-md-12">
                <div class="panel">
                    <div class="panel-heading"></div>
                    <div class="panel-body">
                    <p class="animated fadeInDown">
                          Beneficiarios <span class="fa-angle-right fa"></span> Lista de Regalos
                        </p>
                    <div class="container">
        <div class="card border-primary mb-3 mt-3" style="max-width: 80rem;">
            <div class="card-header">
                <h5><?php  echo isset($regalo->id) ? 'Editar Regalo' : 'Registrar Nuevo'; ?></h5>
            </div>
            <div class="card-body">
                <h4 class="card-title">Beneficiario</h4>
                <form action="<?php echo site_url('/beneficio/guardar');?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $regalo->id ?? ''; ?>" />
                    <div class="row">
                        <div class="col-sm-10">
                            <input id="codigoInput" class="form-control" type="text" name="codBen" value="" required placeholder="CODIGO BENEFICIARIO" /><br />
                        </div>
                        <div class="col-sm-2">
                            <input type="button" value="Buscar" class="btn btn-primary" onclick="buscarBeneficiario()">
                        </div>
                    </div>

                    <label class="form-label">Nombre:</label>
                    <input class="form-control" id="nombreInput" name="nombre" type="text" value="" required /><br />
                    <label class="form-label">Fecha de Entrega:</label>
                    <input class="form-control" id="fecha" type="date" name="fechaEntrega" value="<?php echo $regalo->fecha_creacion?? ''; ?>" required /><br />

                    <label>Actividad:</label>
                    <input class="form-control" type="text" name="actId" value="<?php echo $regalo->nombre ?? ''; ?>" required /><br />
                    <label>Foto:</label>
                    <input class="form-control" type="file" name="archivoFoto" accept="image/*" id="archivoFoto"><br />
                    <img id="preview" src="" alt="Vista previa de la imagen" style="display: none;">

                    <button class="btn btn-primary" type="submit">Guardar</button>
                </form>
                <a href="/regalos">Volver al listado</a>
            </div>
        </div>
    </div>

    <script>
   function buscarBeneficiario() {
    let codigo = document.getElementById('codigoInput').value;

    // Formatear el código si tiene 1, 2 o 3 cifras
    if (codigo.length <= 3) {
        codigo = "BO046700" + codigo.padStart(3, '0'); // Autocompletar con ceros a la izquierda
    }

    // Hacer la solicitud a la API de CodeIgniter
    fetch(`<?php echo site_url('/beneficio/buscar/'); ?>${codigo}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Beneficiario no encontrado');
            }
            return response.json();
        })
        .then(data => {
            // Actualizar los campos con los datos recibidos
            document.getElementById('nombreInput').value = data.nombres;
            document.getElementById('codigoInput').value = data.codigo;
        })
        .catch(error => {
            alert("Código Incorrecto!!");
            console.error('Error:', error);

            // Limpiar los campos en caso de error
            document.getElementById('nombreInput').value = "";
            document.getElementById('codigoInput').value = "";
        });
}

        
        // Obtener la fecha de hoy
        const hoy = new Date();
        // Formatear la fecha para que se ajuste al formato yyyy-mm-dd requerido por el input date
        const fechaFormateada = hoy.toISOString().split('T')[0];
        // Asignar la fecha al input
        document.getElementById('fecha').value = fechaFormateada;

        //previsualizar imagen
        document.getElementById('archivoFoto').addEventListener('change', function (event) {
            const archivo = event.target.files[0];
            if (archivo) {
                const lector = new FileReader();
                lector.onload = function (e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                lector.readAsDataURL(archivo);
            }
        });
    </script>



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