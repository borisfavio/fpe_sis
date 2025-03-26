<?php

namespace App\Controllers;

use App\Models\AportesModel;
use Config\Services;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Libraries\PdfGenerator;

class AportesController extends BaseController
{
    protected $session;
    protected $model;
    protected $permisos;
    protected $datos;

    public function __construct()
    {
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->session = \Config\Services::session();
        $this->model = new AportesModel();
        $this->permisos = Services::AutenticarUsuario();
        //cargar datos
        $this->datos = [
            'titulo' => 'FPE - Aportes',
            'datos_menu' => $this->permisos->getUserPermissions($this->session->get('usuario')['id']),
            'usuario' => $this->session->get('usuario'),
        ];
    }

    public function listar() {
        if ($this->session->get('login')) {
            //var_dump($this->datos); exit;
            $contenido = 'aportes/lista'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'
            $pagos = $this->model->listarComprobantes();
            //var_dump($pagos); exit;
            //cargar datso por modulo
            $data = $this->datos;
            $data['contenido'] =$contenido;
            $data['lib'] = $lib;
            $data['pagos'] = $pagos;
            //var_dump($data['datos_menu']); exit;

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }

    }

    public function mostrarFormulario()
    {
        if ($this->session->get('login')) {
            // Obtener el último número de comprobante
            $ultimoNumero = $this->model->getLastNumComp();

            // Si hay registros, incrementar el número
            if (empty($ultimoNumero)) {
                $siguienteNumero = 151;
            } else {
                // Si hay registros, incrementar el último número
                $siguienteNumero = intval($ultimoNumero['nro_comp']) + 1;
            }
            //var_dump($this->datos); exit;
            $contenido = 'aportes/formulario'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'
            
            //cargar datso por modulo
            $data = $this->datos;
            $data['contenido'] =$contenido;
            $data['lib'] = $lib;
           
            // Formatear el número con ceros a la izquierda (ejemplo: 000152)
            $siguienteNumeroFormateado = str_pad($siguienteNumero, 6, '0', STR_PAD_LEFT);

            // Pasar el número a la vista
            $data['num_comp'] = $siguienteNumeroFormateado;

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }
    }

    public function precesarPago()
    {
        if ($this->session->get('login')) {
            // Validar los datos del formulario
            $validation = \Config\Services::validation();
            $validation->setRules([
                'nro_comp' => 'required',
                'nombre_pagador'   => 'required',
                'beneficiarios'   => 'required',
            ]);

            if (!$validation->withRequest($this->request)->run()) {
                // Si la validación falla, regresar al formulario con errores
                return redirect()->back()->withInput()->with('errors', $validation->getErrors());
            }
            $fecha = date("Y-m-d");
            $total_pago = 0;
            $beneficiarios = $this->request->getPost('beneficiarios');
            //var_dump($beneficiarios); exit;
            $num_comp = $this->request->getPost('nro_comp');
            
            foreach ($beneficiarios as $beneficiario) {
                $codigo_beneficiario = $beneficiario['codigo'];
                $meses_pagados = (int)$beneficiario['meses'];
                $meses = $beneficiario['meses_seleccionados'];
                $monto = $meses_pagados * 8;
                $total_pago += $monto;
                //fecha, nro_comp, nombre_pagador, codigo_beneficiario, meses_pagados, monto)
                $data = [
                    'fecha'    => $fecha,
                    'nro_comp' => $num_comp,
                    'nombre_pagador'   => $this->request->getPost('nombre_pagador'),
                    'codigo_beneficiario' => $codigo_beneficiario,
                    'meses_pagados' => $meses_pagados,
                    'monto'    => $monto,
                    'meses' => $meses,
                ];
                //var_dump($data); exit;
                $this->model->insert($data);
            }

            return redirect()->to(site_url('aportes/generarpdf/' . $num_comp));
        } else {
            return redirect()->to('/logout');
        }
    }

    // Método para generar el PDF
    public function generarPdf($id)
    {
        
        // Obtener los datos del comprobante
        $comprobantes = $this->model->buscarCodigo($id);
        //var_dump($comprobantes); exit;
        foreach ($comprobantes as &$pago) {
            $pago['meses_array'] = json_decode($pago['meses'], true);
        }

        $fecha = $comprobantes[0]['fecha'];
        $pagador = $comprobantes[0]['nombre_pagador'];
        $numero = $comprobantes[0]['nro_comp'];
        $data = [
        'comprobantes' => $comprobantes,
        'fecha' => $fecha,
        'pagador' => $pagador,
        'numero' => $numero,
        ];
            // Convertir imágenes a base64
    $logoPath = ROOTPATH . 'public/assets/images/logo.jpg';
    $qrPath = ROOTPATH . 'public/assets/images/qr.png';
    
    $data['logo_base64'] = $this->imageToBase64($logoPath);
    $data['qr_base64'] = $this->imageToBase64($qrPath);
       
        

        if (!$comprobantes) {
            return redirect()->to(site_url('aportes'))->with('error', 'Comprobante no encontrado');
        }
        //var_dump($data); exit;
        // Cargar la vista del PDF
        $html = view('comprobante_view', $data);

        // Configurar dompdf impresora termica
        /*$dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm de ancho
        $dompdf->render();*/

        // Configurar dompdf media carta vertical
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 612, 396], 'portrait'); // Media carta en vertical
        $dompdf->render();
        $dompdf->stream("comprobante_pago.pdf", ["Attachment" => false]); 

        // Descargar el PDF
        //$dompdf->stream("comprobante_{$id}.pdf", ['Attachment' => true]);
        return redirect()->to(site_url('aportes/formulario'));
    }
    public function generarfPdf($id)
    {
        // Obtener datos del modelo
        
        $comprobantes = $this->model->buscarCodigo($id);
        //var_dump($comprobante); exit;
        // Procesar meses si están en JSON
        foreach ($comprobantes as &$pago) {
            $pago['meses_array'] = json_decode($pago['meses'], true);
        }
        $fecha = $comprobantes[0]['fecha'];
        $pagador = $comprobantes[0]['nombre_pagador'];
        $numero = $comprobantes[0]['nro_comp'];
        $data = [
        'comprobantes' => $comprobantes,
        'fecha' => $fecha,
        'pagador' => $pagador,
        'numero' => $numero,
        ];
        //var_dump($data); exit;
        // Generar PDF
        $pdf = new PdfGenerator();
        $pdf->generateReceipt($data);
        
        // Descargar directamente
        $pdf->Output('comprobante_' . $id . '.pdf', 'D');
        
        // Alternativa para mostrar en navegador:
        // $pdf->Output('comprobante_' . $id . '.pdf', 'I');
    }

    private function imageToBase64($path) 
{
    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        return 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
    return '';
}
}
