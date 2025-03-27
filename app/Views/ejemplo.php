<?php

// datos ficticios
$data = [
    'pagador' => 'Boris Favio Quispe Santos',
    'fecha' => '2025-03-25',
    'numero' => '000155',

];
$data['comprobantes'] = [
    [
        'codigo_beneficiario' => 'BEN-001',
        'meses_pagados' => '3 meses',
        'meses_array' => ['Enero', 'Febrero', 'Marzo'],
        'monto' => 1500.00
    ],
    [
        'codigo_beneficiario' => 'BEN-002',
        'meses_pagados' => '2 meses',
        'meses_array' => ['Abril', 'Mayo'],
        'monto' => 1000.50
    ],
    [
        'codigo_beneficiario' => 'BEN-003',
        'meses_pagados' => '4 meses',
        'meses_array' => ['Junio', 'Julio', 'Agosto', 'Septiembre'],
        'monto' => 2000.75
    ],
    [
        'codigo_beneficiario' => 'BEN-004',
        'meses_pagados' => '1 mes',
        'meses_array' => ['Octubre'],
        'monto' => 500.25
    ],
    [
        'codigo_beneficiario' => 'BEN-005',
        'meses_pagados' => '2 meses',
        'meses_array' => ['Noviembre', 'Diciembre'],
        'monto' => 1200.00
    ]
];

require('fpdf/fpdf.php');

// Crear una clase extendida para manejar el pie de página
class PDF extends FPDF
{
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        // Número de página centrado
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

//$pdf->checkSpace(30); // Verifica si hay 30mm disponibles
// Tamaño media carta horizontal (216mm de ancho x 140mm de alto)
$pdf = new PDF('L', 'mm', array(216, 140));
$pdf->AliasNbPages(); // Para el número total de páginas {nb}
$pdf->SetMargins(15, 5, 15, 0); // Márgenes izquierdo, superior y derecho
$pdf->SetAutoPageBreak(true, 5);
$pdf->AddPage();

$num = $data['numero'];

// Configurar fuente principal
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 8, 'Fundacion Pasos de Esperanza', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Calle 4 Nro 467, Zn Alto Santiago de Lacaya', 0, 1, 'C');
$pdf->Cell(0, 5, 'Telefono: 69700259', 0, 0, 'C');
$pdf->Cell(0, 5, 'Nro. Comprobante: ' . $num, 0, 1, 'R');

// Información del comprobante
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 5, 'Recibi de: ' . $data['pagador'], 0, 0);
$pdf->Cell(95, 5, 'Fecha: ' . $data['fecha'], 0, 1, 'R');


// Crear tabla que ocupe el ancho completo
$anchoUtil = 216 - 30; // Ancho total - márgenes
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'Detalle de Pagos', 0, 1, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 10);
// Cabeceras de tabla

$pdf->SetFillColor(100, 100, 100); // Gris más oscuro
$pdf->SetTextColor(255, 255, 255);

$pdf->Cell($anchoUtil * 0.4, 7, 'Concepto', 1, 0,'C',true);
$pdf->Cell($anchoUtil * 0.3, 7, 'Periodo', 1, 0, 'C',true);
$pdf->Cell($anchoUtil * 0.3, 7, 'Monto', 1, 1, 'R',true);
// Restaurar colores para contenido normal
//$pdf->SetFillColor(255, 255, 255); // Blanco
$pdf->SetTextColor(0, 0, 0); // Negro


// Datos de ejemplo
$data = [
    ['Pago de servicios', 'Enero 2023', '150.00'],
    ['Mantenimiento', 'Febrero 2023', '200.50'],
    ['Otros conceptos', 'Marzo 2023', '75.25'],
    ['Pago de servicios', 'Enero 2023', '150.00'],
    ['Mantenimiento', 'Febrero 2023', '200.50'],
    ['Otros conceptos', 'Marzo 2023', '75.25'],
    ['Pago de servicios', 'Enero 2023', '150.00'],
    ['Mantenimiento', 'Febrero 2023', '200.50'],
    ['Otros conceptos', 'Marzo 2023', '75.25'],
    ['Pago de servicios', 'Enero 2023', '150.00'],
    ['Mantenimiento', 'Febrero 2023', '200.50'],
    ['Otros conceptos', 'Marzo 2023', '75.25'],
    ['Pago de servicios', 'Enero 2023', '150.00'],
    ['Mantenimiento', 'Febrero 2023', '200.50'],
    ['Otros conceptos', 'Marzo 2023', '75.25']
];

foreach ($data as $row) {
    //$pdf->checkSpace(10); // Verificar espacio para cada fila
    $spaceNeeded = 10; // Espacio que necesitará el siguiente contenido
    //echo $pdf->GetY();
    // Verificar si hay suficiente espacio antes de añadir contenido
    if ($pdf->GetY() + $spaceNeeded > 140 - 15) { // 140 es altura total, 15 margen inferior
        $pdf->AddPage(); // Si no cabe, crear nueva página
        // Configurar fuente principal
$pdf->SetFont('Arial', '', 14);
$pdf->Cell(0, 8, 'Fundacion Pasos de Esperanza', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 5, 'Calle 4 Nro 467, Zn Alto Santiago de Lacaya', 0, 1, 'C');
$pdf->Cell(0, 5, 'Telefono: 69700259', 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 5, 'Nro. ' . $num, 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);

// Información del comprobante
$pdf->Ln(3);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(95, 5, 'Recibi de: ' . $data['pagador'], 0, 0);
$pdf->Cell(95, 5, 'Fecha: ' . $data['fecha'], 0, 1, 'R');


// Crear tabla que ocupe el ancho completo
$anchoUtil = 216 - 30; // Ancho total - márgenes
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 7, 'Detalle de Pagos', 0, 1, 'C');
$pdf->Ln(1);

$pdf->SetFont('Arial', '', 10);
// Cabeceras de tabla

$pdf->Cell($anchoUtil * 0.4, 7, 'Concepto', 1, 0,'C',true);
$pdf->Cell($anchoUtil * 0.3, 7, 'Periodo', 1, 0, 'C',true);
$pdf->Cell($anchoUtil * 0.3, 7, 'Monto', 1, 1, 'R',true);

    }
    $pdf->Cell($anchoUtil * 0.4, 7, $row[0], 1, 0);
    $pdf->Cell($anchoUtil * 0.3, 7, $row[1], 1, 0, 'C');
    $pdf->Cell($anchoUtil * 0.3, 7, $row[2], 1, 1, 'R');
}
// Total
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($anchoUtil * 0.7, 7, 'Total Pagado:', 1, 0, 'R');
$pdf->Cell($anchoUtil * 0.3, 7, 'Bs ' . number_format($totalPagado, 2), 1, 1, 'R');

// Firma
$pdf->SetFont('Arial', 'I', 8);
$pdf->Ln(10);
$pdf->Cell(0, 4, 'Firma____________________________', 0, 1, 'C');
$pdf->Cell(0, 4, 'Nombre: ________________________', 0, 1, 'C');
$pdf->Cell(0, 4, 'C.I.: __________________________', 0, 1, 'C');

// Pie de página
$pdf->SetY(-15);
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 5, 'Gracias por su apoyo - Fundación Pasos de Esperanza', 0, 0, 'L');
$pdf->Cell(0, 5, 'Comprobante válido con firma y sello', 0, 1, 'R');

// --- Control de espacio para el pie de página ---
$spaceNeeded = 10; // Espacio que necesitará el siguiente contenido
//echo $pdf->GetY();
// Verificar si hay suficiente espacio antes de añadir contenido
if ($pdf->GetY() + $spaceNeeded > 140) { // 140 es altura total, 15 margen inferior
    $pdf->AddPage(); // Si no cabe, crear nueva página
}

$pdf->Output('I', 'recibo_horizontal.pdf');
