<div id="layoutSidenav_content">

    <div class="card card-border">
        <div class="card-body">
            <h4 class="card-title">Registro de donaciones</h4>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('/aportes/procesar'); ?>" method="post">
                <div class="mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label for="">Fecha</label>
                              <input type="date"
                                class="form-control" name="fecha" id="fecha">
                              </div>
                        </div>
                        <div class="col">
                            <div>Nro. <div class="mb-3">
                                    <input
                                        type="text"
                                        class="form-control"
                                        name="nro_comp"
                                        id="num_comp"
                                        value="<?= esc($num_comp) ?>"
                                        readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                    <label class="form-label">Padre/Madre/Responsable</label>
                    <input type="text" name="nombre_pagador" class="form-control" required>
                </div>
                <h3>Beneficiarios</h3>
                <div class="row">
                        <div class="col-sm-5">
                            <input id="codigoInput" class="form-control" type="text" name="codBen" value="" placeholder="CODIGO BENEFICIARIO" /><br />
                        </div>
                        <div class="col-sm 5">
                            <div class="form-group">
                              <input type="text" class="form-control" name="nombreInput" id="nombreInput" placeholder="NOMBRE BENEFICIARIO" >
                              </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="button" value="Buscar" class="btn btn-primary" onclick="buscarBeneficiario()">
                        </div>
                    </div>
                <div id="beneficiarios"></div>
                <br>
                <button class="btn btn-success" type="button" onclick="agregarBeneficiario()">Agregar otro beneficiario</button>
                <br><br>
                <input class="btn btn-primary" type="submit" value="Registrar Pago">
            </form>
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
    </script>
    <script>
        let contador = 0;

        function agregarBeneficiario() {
            let codigo = document.getElementById('codigoInput').value;
            let div = document.createElement("div");
            div.classList.add("beneficiario", "row", "mb-3");
            div.innerHTML = `
                <div class="col">
                    <label class="form-label">Código de Beneficiario:</label>
                    <input class="form-control" type="text" name="beneficiarios[${contador}][codigo]" value="${codigo}" required>
                </div>
                <div class="col">
                    <label class="form-label">Meses a pagar:</label>
                    <input class="form-control" type="number" name="beneficiarios[${contador}][meses]" min="1" id="totalMeses_${contador}" value="0" readonly required>
                </div>
                <div class="col">
                    <div class="meses" id="meses_${contador}">
                        ${generarCheckboxes(contador)}
                    </div>
                </div>`;
            document.getElementById("beneficiarios").appendChild(div);
            contador++;
            document.getElementById('nombreInput').value = "";
            document.getElementById('codigoInput').value = "";
        }

        function generarCheckboxes(index) {
            const meses = ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"];
            return meses.map(mes => `<label><input type="checkbox" class="mes" data-index="${index}" onclick="actualizarContador(${index})"> ${mes}</label>`).join('');
        }

        function actualizarContador(index) {
            const seleccionados = document.querySelectorAll(`#meses_${index} .mes:checked`).length;
            document.getElementById(`totalMeses_${index}`).value = seleccionados;
        }
    </script>
</div>