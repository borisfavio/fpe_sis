<?php

namespace App\Libraries;

use FPDF;

class DirectPrinter extends FPDF
{
    private $logoPath;
    private $qrPath;

    public function __construct()
    {
        // Tamaño personalizado: 88 mm de ancho, altura automática (tú puedes definirlo según necesidad)
        parent::__construct('P', 'mm', [88, 200]); // 88mm de ancho
        $this->logoPath = ROOTPATH . 'public/assets/images/logo_fundacion.png';
        $this->qrPath = ROOTPATH . 'public/assets/images/qr_code.png';
    }

    public function generateReceipt($data)
    {
        $this->AddPage();
        
        // Encabezado
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 5, 'Fundación Pasos de Esperanza', 0, 1, 'C');
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 4, 'Calle 4 Nro 467, Zn Alto Santiago de Lacaya', 0, 1, 'C');
        $this->Cell(0, 4, 'Teléfono: 69700259', 0, 1, 'C');

        // Logo (si deseas usarlo, pero opcional por espacio)
        if (file_exists($this->logoPath)) {
            $this->Image($this->logoPath, 28, 20, 30); // centrado
            $this->Ln(25);
        } else {
            $this->Ln(5);
        }

        // Información del comprobante
        $this->SetFont('Arial', '', 8);
        $this->Cell(0, 4, 'Recibí de: ' . $data['pagador'], 0, 1);
        $this->Cell(0, 4, 'Fecha: ' . $data['fecha'], 0, 1);
        $this->Cell(0, 4, 'N° Comprobante: ' . $data['numero'], 0, 1);
        
        // Detalle del pago
        $this->Ln(2);
        $this->SetFont('Arial', 'B', 9);
        $this->Cell(0, 5, 'Detalle del Pago', 0, 1, 'C');
        $this->Ln(2);

        // Cabecera
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(30, 6, 'Benef.', 1, 0, 'C');
        $this->Cell(28, 6, 'Meses', 1, 0, 'C');
        $this->Cell(20, 6, 'Monto', 1, 1, 'C');

        // Detalles
        $this->SetFont('Arial', '', 7);
        $totalPagado = 0;
        foreach ($data['comprobantes'] as $comprobante) {
            $totalPagado += floatval($comprobante['monto']);
            $meses = implode(',', $comprobante['meses_array']);
            $this->Cell(30, 5, $comprobante['codigo_beneficiario'], 1, 0);
            $this->Cell(28, 5, $meses, 1, 0);
            $this->Cell(20, 5, number_format($comprobante['monto'], 2), 1, 1, 'R');
        }

        // Total
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(58, 6, 'Total Pagado:', 1, 0, 'R');
        $this->Cell(20, 6, 'Bs ' . number_format($totalPagado, 2), 1, 1, 'R');

        // Firma
        $this->Ln(10);
        $this->SetFont('Arial', '', 7);
        $this->Cell(0, 4, '__________________________', 0, 1, 'C');
        $this->Cell(0, 4, 'Nombre: __________________', 0, 1, 'C');
        $this->Cell(0, 4, 'C.I.: ____________________', 0, 1, 'C');
        $this->Cell(0, 4, 'Firma del Pagador', 0, 1, 'C');

        // QR (opcional en impresoras térmicas, si se imprime bien)
        if (file_exists($this->qrPath)) {
            $this->Ln(5);
            $this->Image($this->qrPath, 29, $this->GetY(), 30); // centrado
            $this->Ln(32);
            $this->SetFont('Arial', 'I', 6);
            $this->Cell(0, 4, 'Verifique este comprobante', 0, 1, 'C');
        }

        // Pie de página
        $this->SetY(-20);
        $this->SetFont('Arial', 'I', 6);
        $this->Cell(0, 4, 'Gracias por su apoyo', 0, 1, 'C');
        $this->Cell(0, 4, 'Fundación Pasos de Esperanza', 0, 1, 'C');
        $this->Cell(0, 4, 'Comprobante válido con firma y sello', 0, 1, 'C');
    }
}
