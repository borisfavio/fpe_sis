<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Asistencia Mensual</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
        }
        
        h1 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }
        
        .header-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .month-selector {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        select, input {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        
        th, td {
            border: 1px solid #e0e0e0;
            padding: 10px;
            text-align: center;
        }
        
        th {
            background-color: #3498db;
            color: white;
            font-weight: 500;
            position: sticky;
            top: 0;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #f1f7fd;
        }
        
        .name-col {
            text-align: left;
            font-weight: 500;
            background-color: #f8f9fa;
            position: sticky;
            left: 0;
        }
        
        .attendance-option {
            display: inline-block;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
            margin: 0 2px;
            transition: transform 0.2s;
        }
        
        .attendance-option:hover {
            transform: scale(1.1);
        }
        
        .present {
            background-color: #2ecc71;
        }
        
        .absent {
            background-color: #e74c3c;
        }
        
        .permission {
            background-color: #f39c12;
        }
        
        .save-btn {
            display: block;
            margin: 0 auto;
            padding: 12px 25px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        
        .save-btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
        }
        
        .save-btn:active {
            transform: translateY(0);
        }
        
        .legend {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .legend-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        @media (max-width: 768px) {
            .header-controls {
                flex-direction: column;
                align-items: flex-start;
            }
            
            th, td {
                padding: 8px 5px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registro de Asistencia Mensual</h1>
        
        <div class="header-controls">
            <div class="month-selector">
                <select id="month">
                    <option value="1">Enero</option>
                    <option value="2">Febrero</option>
                    <option value="3">Marzo</option>
                    <option value="4">Abril</option>
                    <option value="5">Mayo</option>
                    <option value="6">Junio</option>
                    <option value="7">Julio</option>
                    <option value="8">Agosto</option>
                    <option value="9">Septiembre</option>
                    <option value="10">Octubre</option>
                    <option value="11">Noviembre</option>
                    <option value="12">Diciembre</option>
                </select>
                <input type="number" id="year" min="2020" max="2030" value="2023">
                <select id="grupo">
                    <?php foreach ($grupos as $grupo): ?>
                        <option value="<?= esc($grupo['id']) ?>"><?= esc($grupo['nombres']) ?></option>
        
                    <?php endforeach; ?>
                    
                </select>
                <button type="button">Actualizar</button>
            </div>
        </div>
        
        <div class="legend">
            <div class="legend-item">
                <div class="attendance-option present"></div>
                <span>Presente</span>
            </div>
            <div class="legend-item">
                <div class="attendance-option absent"></div>
                <span>Falta</span>
            </div>
            <div class="legend-item">
                <div class="attendance-option permission"></div>
                <span>Permiso</span>
            </div>
        </div>
        
        <table id="attendanceTable">
            
    <thead id="thead-beneficiarios"></thead>
    <tbody id="tbody-beneficiarios"></tbody>
</table>


        
        <button class="save-btn" onclick="saveAttendance()">Guardar Asistencia</button>
    </div>

    <script>
        // Función para cambiar el estado de asistencia
        function toggleAttendance(element) {
            if (element.classList.contains('present')) {
                element.classList.remove('present');
                element.classList.add('absent');
            } else if (element.classList.contains('absent')) {
                element.classList.remove('absent');
                element.classList.add('permission');
            } else if (element.classList.contains('permission')) {
                element.classList.remove('permission');
            } else {
                element.classList.add('present');
            }
        }
        
        // Función para guardar la asistencia
        function saveAttendance() {
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;
            
            // Aquí iría la lógica para guardar los datos
            // Por ahora solo mostramos un mensaje
            alert(`Asistencia guardada para ${month}/${year}`);
            
            // En una implementación real, aquí enviarías los datos al servidor
            // Por ejemplo con fetch() o XMLHttpRequest
        }
        
        // Opcional: Configurar el mes actual
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            document.getElementById('month').value = today.getMonth() + 1;
            document.getElementById('year').value = today.getFullYear();
        });
    </script>
    <script>
 document.querySelector('button[type="button"]').addEventListener('click', function () {
    const mes = document.getElementById('month').value;
    const anio = document.getElementById('year').value;
    const grupo = document.getElementById('grupo').value;

    fetch(`http://192.168.0.58/fpe_sis/public/index.php/beneficiarios/getPorFiltro?mes=${mes}&anio=${anio}&grupo=${grupo}`)
        .then(response => response.json())
        .then(data => {
            const { fechas, data: beneficiarios } = data;

            const thead = document.getElementById('thead-beneficiarios');
            const tbody = document.getElementById('tbody-beneficiarios');

            // Limpiar contenido previo
            thead.innerHTML = '';
            tbody.innerHTML = '';

            // Construir encabezado con fechas
            let headerRow = `<tr><th>Nombre</th>`;
            fechas.forEach(fecha => {
                headerRow += `<th>${fecha}</th>`;
            });
            headerRow += `</tr>`;
            thead.insertAdjacentHTML('beforeend', headerRow);

            // Construir filas con asistencias
            beneficiarios.forEach(beneficiario => {
                let row = `<tr><td>${beneficiario.nombre}</td>`;
                fechas.forEach(fecha => {
                    const estado = beneficiario[fecha] || 'Falta';
                    let color = '';
                    if (estado === 'present') color = '✅';
                    else if (estado === 'absent') color = '❌';
                    else if (estado === 'permission') color = '🟡';

                    row += `<td>${color} ${estado}</td>`;
                });
                row += `</tr>`;
                tbody.insertAdjacentHTML('beforeend', row);
            });
        })
        .catch(error => {
            console.error('Error al obtener beneficiarios:', error);
        });
});

</script>

</body>
</html>