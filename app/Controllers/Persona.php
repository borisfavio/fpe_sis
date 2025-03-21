<?php

namespace App\Controllers;

use App\Models\PersonasModel;

class Persona extends BaseController
{
    protected $personaModel;
    protected $session;

	public function __construct() {
        
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->personaModel = new PersonasModel();
        $this->session = \Config\Services::session(); 
    }

    public function index() {
        //var_dump($this->session->get('login')); exit;
        if ($this->session->get('login')) {
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'personas/personas'; 
            $lib = ['script' => 'mi-script.js']; 
            /*$data['lib'] = 0;
            $data['datos_menu'] = null;
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['personas'] = $this->personaModel->get_persons();
            $data['titulo'] = "Dashboard";
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['contenido'] = 'personas/personas';
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            //$data['username'] = $this->session->userdata('username');*/
             // Datos para la vista 'templates/main'
        // Vista dinámica para el contenido
        // Datos para la vista 'templates/footer'

        $data = [
            'titulo' => 'FPE - Beneficiarios',
            'datos_menu' => $datos_menu,
            'contenido' => $contenido,
            'lib' => $lib,
            'personas' => $this->personaModel->getPersons(),
            'usuario' => $this->session->get('usuario')
        ];
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
       
    }

    public function create() {
        // Lógica para mostrar el formulario de creación
		if ($this->session->get('login')) {
            $datos_menu = ['menu' => 'Inicio']; // Datos para la vista 'templates/main'
            $contenido = 'personas/create_person'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

            $data = [
                'titulo' => 'FPE - Beneficarios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $this->session->get('usuario'),
            ];

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }

    public function store() {
        // Lógica para mostrar el formulario de creación
		if ($this->session->get('login')) {
            $codigo = $this->request->getPost('local_id');
            $nombres = $this->request->getPost('account_name');
            $estado = $this->request->getPost('estado');
            $phone = $this->request->getPost('phone');

            $data = [
                'codigo' => $codigo,
                'nombres' => $nombres,
                'phone' => $phone,
                'estado' => $estado,

            ];
            //var_dump($data); exit;
            $id =$this->personaModel->insertPerson($data);
            //var_dump($id); exit;
            return redirect()->to('/personas');
        } else {
            return redirect()->to('/logout');

        }
    }
}
