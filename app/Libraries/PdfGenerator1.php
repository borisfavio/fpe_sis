<?php

namespace App\Libraries;

use FPDF;

class PdfGenerator extends FPDF
{
    private $logoPath;
    private $qrPath;

    public function __construct()
    {
        parent::__construct('P', 'mm', 'A4');
        $this->logoPath = ROOTPATH . 'public/assets/images/logo_fundacion.png';
        $this->qrPath = ROOTPATH . 'public/assets/images/qr_code.png';
    }

    public function generateReceipt($data)
    {
        $this->AddPage();
        
        // Encabezado
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Fundación Pasos de Esperanza', 0, 1, 'C');
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 5, 'Calle 4 Nro 467, Zn Alto Santiago de Lacaya', 0, 1, 'C');
        $this->Cell(0, 5, 'Teléfono: 69700259', 0, 1, 'C');
        
        // Logo (derecha superior)
        if (file_exists($this->logoPath)) {
            $this->Image($this->logoPath, 160, 10, 30);
        }
        
        // Información del comprobante
        $this->Ln(10);
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 5, 'Recibí de: ' . $data['pagador'], 0, 0);
        $this->Cell(95, 5, 'Fecha: ' . $data['fecha'], 0, 1, 'R');
        $this->Cell(95, 5, '', 0, 0);
        $this->Cell(95, 5, 'N° Comprobante: ' . $data['numero'], 0, 1, 'R');
        
        // Detalle del pago
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 5, 'Detalle del Pago', 0, 1, 'C');
        $this->Ln(5);
        
        // Cabecera de tabla
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(70, 7, 'Beneficiario', 1, 0, 'C');
        $this->Cell(50, 7, 'Meses Pagados', 1, 0, 'C');
        $this->Cell(30, 7, 'Monto (Bs)', 1, 1, 'C');
        
        // Contenido de tabla
        $this->SetFont('Arial', '', 9);
        $totalPagado = 0;
        foreach ($data['comprobantes'] as $comprobante) {
            $totalPagado += floatval($comprobante['monto']);
            $meses = $comprobante['meses_pagados'] . ' (' . implode(', ', $comprobante['meses_array']) . ')';
            
            $this->Cell(70, 7, $comprobante['codigo_beneficiario'], 1, 0);
            $this->Cell(50, 7, $meses, 1, 0, 'C');
            $this->Cell(30, 7, number_format($comprobante['monto'], 2), 1, 1, 'R');
        }
        
        // Total
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(120, 7, 'Total Pagado:', 1, 0, 'R');
        $this->Cell(30, 7, 'Bs ' . number_format($totalPagado, 2), 1, 1, 'R');
        
        // Firma
        $this->Ln(15);
        $this->Cell(0, 5, '__________________________', 0, 1, 'C');
        $this->Cell(0, 5, 'Nombre: __________________________', 0, 1, 'C');
        $this->Cell(0, 5, 'C.I.: __________________________', 0, 1, 'C');
        $this->Cell(0, 5, 'Firma del Pagador', 0, 1, 'C');
        
        // QR (derecha inferior)
        if (file_exists($this->qrPath)) {
            $this->Image($this->qrPath, 160, 240, 30);
            $this->SetXY(160, 270);
            $this->SetFont('Arial', 'I', 8);
            $this->Cell(30, 5, 'Verifique este comprobante', 0, 1, 'C');
        }
        
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 5, 'Gracias por su apoyo - Fundación Pasos de Esperanza', 0, 1, 'C');
        $this->Cell(0, 5, 'Comprobante válido con firma y sello', 0, 1, 'C');
    }
}