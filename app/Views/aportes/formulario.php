<style>
    .meses {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }
</style>


<div id="layoutSidenav_content">

    <div class="card card-border m-3">
        <div class="card-header">
            <p class="card-title">Registro de donaciones</p>
        </div>
        <div class="card-body">
            <form action="<?php echo site_url('/aportes/procesar'); ?>" method="post">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-sm">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="">Fecha</label>
                                <input type="date"
                                    class="form-control col-sm-6" name="fecha" id="fecha" value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label" for="">Fecha</label>
                                <div class="col-sm-10">
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
                    <div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Padre/Madre/Responsable</label>
                            <div class="col-sm-8">
                                <input type="text" name="nombre_pagador" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <h4>Beneficiarios</h4>
                <div class="row">
                    <div class="col-sm-3">
                        <input id="codigoInput" class="form-control" type="text" name="codBen" value="" placeholder="CODIGO BENEFICIARIO" /><br />
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nombreInput" id="nombreInput" placeholder="NOMBRE BENEFICIARIO">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <input type="button" value="Buscar" class="btn btn-primary btn-block" onclick="buscarBeneficiario()">
                    </div>
                    <div class="col-sm-2">
                        <button class="btn btn-success btn-block" type="button" onclick="agregarBeneficiario()">Agregar</button>
                    </div>
                </div>
                <div id="beneficiarios"></div>
                <div class="form-group row justify-content-end">
                    <label class="col-sm-4 align-self-center col-form-label" for="total">TOTAL A PAGAR</label>
                    <div class="col-sm-4 align-self-end">
                        <input type="text" class="form-control" name="total" id="total" placeholder="00.0" readonly>
                    </div>
                </div>

                <br>
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
                <div class="col-sm-3">
                    <label class="form-label">Código de Beneficiario:</label>
                    <input class="form-control" type="text" name="beneficiarios[${contador}][codigo]" value="${codigo}" required>
                </div>
                <div class="col-sm-3 mt-1">
                    <label class="form-label">Meses a pagar:</label>
                    <input class="form-control" type="number" name="beneficiarios[${contador}][meses]" min="1" id="totalMeses_${contador}" value="0" readonly required>
                    <!-- Campo oculto para los meses seleccionados -->
                    <input type="text" name="beneficiarios[${contador}][meses_seleccionados]" id="mesesSeleccionados_${contador}">
                </div>
                <div class="col-sm-6">
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
    return meses.map((mes, i) => `
        <label>
            <input type="checkbox" class="mes" data-index="${index}" value="${mes}" onclick="actualizarContador(${index})">
            ${mes}
        </label>`).join('');
}

        function actualizarContador(index) {
            const seleccionados = document.querySelectorAll(`#meses_${index} .mes:checked`);
            //console.log(seleccionados);
            const mesesSeleccionados = Array.from(seleccionados).map(cb => cb.value);


            document.getElementById(`mesesSeleccionados_${index}`).value = JSON.stringify(mesesSeleccionados);

            document.getElementById(`totalMeses_${index}`).value = seleccionados.length;
            calcularTotal();
        }
        // Agrega esta función al final de tus scripts
        function calcularTotal() {
            // Obtener todos los inputs de meses
            const inputsMeses = document.querySelectorAll('input[name^="beneficiarios"][name$="[meses]"]');

            let totalMeses = 0;

            // Sumar todos los meses seleccionados
            inputsMeses.forEach(input => {
                totalMeses += parseInt(input.value) || 0;
            });

            // Calcular total (multiplicar por 8)
            const totalPagar = totalMeses * 8;

            // Mostrar en el input total
            document.getElementById('total').value = totalPagar.toFixed(2);
        }

        // Modifica la función actualizarContador para llamar a calcularTotal
        /*function actualizarContador(index) {
            const seleccionados = document.querySelectorAll(`#meses_${index} .mes:checked`).length;
            document.getElementById(`totalMeses_${index}`).value = seleccionados;
            calcularTotal(); // Actualizar el total cada vez que cambia la selección
        }*/
    </script>
</div>