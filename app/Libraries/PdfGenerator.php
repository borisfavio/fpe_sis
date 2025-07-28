<?php

namespace App\Libraries;

use FPDF;

class PdfGenerator extends FPDF
{
    private $logoPath;
    private $qrPath;

    public function __construct()
    {
        parent::__construct('L', 'mm', array(216, 140));
    }

    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-10);
        $this->SetFont('Arial', 'I', 8);
        // Número de página centrado
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
    public function generateReceipt($data)
    {
        //var_dump($data); exit;
        //$this->checkSpace(30); // Verifica si hay 30mm disponibles
        // Tamaño media carta horizontal (216mm de ancho x 140mm de alto)
        $this->AliasNbPages(); // Para el número total de páginas {nb}
        $this->SetMargins(15, 5, 15, 0); // Márgenes izquierdo, superior y derecho
        $this->SetAutoPageBreak(true, 5);
        $this->AddPage();

       // $num = $data['numero'];
        //var_dump($num); exit;
        // Configurar fuente principal
        $this->SetFont('Arial', '', 14);
        $this->Cell(0, 8, 'COMPROBANTE', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Calle 4 Nro 467, Zn Alto Santiago de Lacaya', 0, 1, 'C');
        $this->Cell(0, 5, 'Telefono: 69700259', 0, 0, 'C');
        $this->Cell(0, 5, 'Nro. Comprobante: ' . $data['numero'], 0, 1, 'R');
        
        // Información del comprobante
        $this->Ln(3);
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 5, 'Responsable: ' . $data['pagador'], 0, 0);
        $this->Cell(95, 5, 'Fecha: ' . $data['fecha'], 0, 1, 'R');

        //var_dump($data['fecha']); exit;
        // Crear tabla que ocupe el ancho completo
        $anchoUtil = 216 - 30; // Ancho total - márgenes
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 7, 'Detalle', 0, 1, 'C');
        $this->Ln(1);

        $this->SetFont('Arial', '', 10);
        // Cabeceras de tabla

        $this->SetFillColor(100, 100, 100); // Gris más oscuro
        $this->SetTextColor(255, 255, 255);

        $this->Cell($anchoUtil * 0.4, 7, 'Codigo Beneficiario', 1, 0, 'C', true);
        $this->Cell($anchoUtil * 0.3, 7, 'Nombres', 1, 0, 'C', true);
        $this->Cell($anchoUtil * 0.3, 7, 'Monto', 1, 1, 'R', true);
        // Restaurar colores para contenido normal
        //$this->SetFillColor(255, 255, 255); // Blanco
        $this->SetTextColor(0, 0, 0); // Negro

       /// $comprobantes = $data['comprobantes'];
        //var_dump($comprobantes); exit;
        ///*foreach ($comprobantes as $row) {
            
            //$this->checkSpace(10); // Verificar espacio para cada fila
            $spaceNeeded = 10; // Espacio que necesitará el siguiente contenido
            //echo $this->GetY();
            // Verificar si hay suficiente espacio antes de añadir contenido
            /*if ($this->GetY() + $spaceNeeded > 140 - 15) { // 140 es altura total, 15 margen inferior
                $this->AddPage(); // Si no cabe, crear nueva página
                // Configurar fuente principal
                $this->SetFont('Arial', '', 14);
                $this->Cell(0, 8, 'Fundacion Pasos de Esperanza', 0, 1, 'C');
                $this->SetFont('Arial', '', 10);
                $this->Cell(0, 5, 'Calle 4 Nro 467, Zn Alto Santiago de Lacaya', 0, 1, 'C');
                $this->Cell(0, 5, 'Telefono: 69700259', 0, 0, 'C');
                $this->SetFont('Arial', 'B', 14);
                $this->Cell(0, 5, 'Nro. ' . 1, 0, 1, 'R');
                $this->SetFont('Arial', '', 10);
                var_dump($row['id']); exit;
                // Información del comprobante
                $this->Ln(3);
                $this->SetFont('Arial', '', 10);
                $this->Cell(95, 5, 'Recibi de: ' . $data['pagador'], 0, 0);
                $this->Cell(95, 5, 'Fecha: ' . $data['fecha'], 0, 1, 'R');


                // Crear tabla que ocupe el ancho completo
                $anchoUtil = 216 - 30; // Ancho total - márgenes
                $this->SetFont('Arial', 'B', 12);
                $this->Cell(0, 7, 'Detalle de Pagos', 0, 1, 'C');
                $this->Ln(1);

                $this->SetFont('Arial', '', 10);
                // Cabeceras de tabla

                $this->Cell($anchoUtil * 0.4, 7, 'Concepto', 1, 0, 'C', true);
                $this->Cell($anchoUtil * 0.3, 7, 'Periodo', 1, 0, 'C', true);
                $this->Cell($anchoUtil * 0.3, 7, 'Monto', 1, 1, 'R', true);
            }*/
            
        /*    $this->Cell($anchoUtil * 0.4, 7, $row['id'], 1, 0);
            
            $this->Cell($anchoUtil * 0.3, 7, $row['id'], 1, 0, 'C');
            $this->Cell($anchoUtil * 0.3, 7, $row['id'], 1, 1, 'R');
        }*/
       
        $this->SetFont('Arial', '', 9);
        $totalPagado = 0;
        foreach ($data['comprobantes'] as $comprobante) {
            $totalPagado += floatval($comprobante['monto']);
            $meses = $comprobante['meses_pagados'] . ' (' . implode(', ', $comprobante['meses_array']) . ')';
            
            $this->Cell($anchoUtil * 0.4, 7, $comprobante['codigo_beneficiario'], 1, 0);
            $this->Cell($anchoUtil * 0.3, 7, $meses, 1, 0, 'C');
            $this->Cell($anchoUtil * 0.3, 7, number_format($comprobante['monto'], 2), 1, 1, 'R');
            $totalPagado+$comprobante['monto'];
        }
        
        // Total
        $this->SetFont('Arial', 'B', 10);
        $this->Cell($anchoUtil * 0.7, 7, 'Total Pagado:', 1, 0, 'R');
        $this->Cell($anchoUtil * 0.3, 7, 'Bs ' . number_format($totalPagado, 2), 1, 1, 'R');

        // Firma
        $this->SetFont('Arial', 'I', 8);
        $this->Ln(14);
        $this->Cell(0, 4, 'Firma____________________________', 0, 1, 'L');
        $this->Cell(0, 4, 'Nombre: '.$data['pagador'].'', 0, 1, 'L');
        $this->Cell(0, 4, 'C.I.: __________________________', 0, 0, 'L');


        // Pie de página
        $this->SetY(-19);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 5, 'Gracias por su apoyo - Fundacion Pasos de Esperanza', 0, 1, 'L');
        $this->Cell(0, 5, 'Comprobante valido con firma y sello', 0, 0, 'L');
        $this->Cell(0,4,'Responsable de cobro: Alvaro Apaza',0,1,'R');
        

        // --- Control de espacio para el pie de página ---
        $spaceNeeded = 5; // Espacio que necesitará el siguiente contenido
        //echo $this->GetY();
        // Verificar si hay suficiente espacio antes de añadir contenido
        if ($this->GetY() + $spaceNeeded > 140) { // 140 es altura total, 15 margen inferior
            $this->AddPage(); // Si no cabe, crear nueva página
        }

       // $this->Output('I', 'recibo_horizontal.pdf');
    }
}
