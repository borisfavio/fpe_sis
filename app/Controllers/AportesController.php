<?php

namespace App\Controllers;

use App\Models\AportesModel;

use Dompdf\Dompdf;
use Dompdf\Options;

class AportesController extends BaseController
{
    protected $session;
    protected $model;

    public function __construct()
    {
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->session = \Config\Services::session();
        $this->model = new AportesModel();
    }

    public function listar() {
        if ($this->session->get('login')) {
            $usuario = $this->session->get('usuario');
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'aportes/lista';
            $lib = ['script' => 'mi-script.js'];
            $pagos = $this->model->listarComprobantes();
            var_dump($pagos); exit;
            /*
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            //$data['username'] = $this->session->userdata('username');
            //var_dump($data); exit;
            $data['cantidadN'] = 2;
            
            $data['titulo'] = "FPE-Grupos";
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['contenido'] = 'grupos/grupos';
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            $data['username'] = $this->session->userdata('username');
            */
            $data = [
                'titulo' => 'FPE - Usuarios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuarios' => 'usuario',
                'usuario' => $this->session->get('usuario'),
                'pagos' => $pagos,
            ];
            
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

            $datos_menu = ['menu' => 'Inicio']; // Datos para la vista 'templates/main'
            $contenido = 'aportes/formulario'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

            $data = [
                'titulo' => 'Página de inicio',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $this->session->get('usuario'),
            ];
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
            $num_comp = $this->request->getPost('nro_comp');
            
            foreach ($beneficiarios as $beneficiario) {
                $codigo_beneficiario = $beneficiario['codigo'];
                $meses_pagados = (int)$beneficiario['meses'];
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
                ];
                //var_dump($data); exit;
                $this->model->insert($data);
            }

            return redirect()->to(site_url('aportes/generar_pdf/' . $num_comp));
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

        if (!$comprobantes) {
            return redirect()->to(site_url('aportes'))->with('error', 'Comprobante no encontrado');
        }

        // Cargar la vista del PDF
        $html = view('comprobante_pdf', ['comprobantes' => $comprobantes]);
        
        // Configurar dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper([0, 0, 226.77, 841.89], 'portrait'); // 80mm de ancho
        $dompdf->render();

        // Descargar el PDF
        $dompdf->stream("comprobante_{$id}.pdf", ['Attachment' => true]);
        return redirect()->to(site_url('aportes/formulario'));
    }
}
