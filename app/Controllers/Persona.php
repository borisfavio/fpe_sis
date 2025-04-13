<?php

namespace App\Controllers;

use App\Models\PersonasModel;
use Config\Services;

class Persona extends BaseController
{
    protected $personaModel;
    protected $session;
    protected $authService;
    protected $permisos;

	public function __construct() {
        
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->personaModel = new PersonasModel();
        $this->session = \Config\Services::session();
        $this->permisos = Services::AutenticarUsuario();
    }

    public function index() {
        //var_dump($this->session->permisos); exit;
        if ($this->session->get('login')) {
            $usuarioId = $this->session->get('usuario')['id'];
            $datos_menu = $this->permisos->getUserPermissions($this->session->get('usuario')['id']);
            $contenido = 'personas/personas';
            $lib = ['script' => 'mi-script.js'];

            //var_dump($usuariosM); exit;
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
            'usuario' => $this->session->get('usuario'),

        ];
        //var_dump($data); exit;
            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }

    }

    public function edit($id){
              // Lógica para mostrar el formulario de creación
		if ($this->session->get('login')) {
            $datos_menu = $this->permisos->getUserPermissions($this->session->get('usuario')['id']);
            $contenido = 'personas/edit_person'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

            $data = [
                'titulo' => 'FPE - Beneficarios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $this->session->get('usuario'),
                'beneficiario' => (object)$this->personaModel->getPersonById($id),
            ];
            $objeto = (object)$data['beneficiario'];
            //var_dump($data['beneficiario']); exit;
            //var_dump($objeto); exit;

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');

        }
    }

    public function card($id)
    {
        // Lógica para mostrar el formulario de creación
        if ($this->session->get('login')) {
            $datos_menu = $this->permisos->getUserPermissions($this->session->get('usuario')['id']);
            $contenido = 'personas/tarjeta'; // Vista dinámica para el contenido
            $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

            $data = [
                'titulo' => 'FPE - Beneficarios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $this->session->get('usuario'),
                'beneficiario' => $this->personaModel->getPersonById($id),
            ];
            $objeto = (object)$data['beneficiario'];
            //var_dump($data['beneficiario']); exit;
            //var_dump($objeto); exit;

            return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }
    }

    public function update() {
        // Lógica para procesar el formulario de edición
        // Obtener los datos del formulario
        //$id = $this->request->getPost('id');
        /**$data = array(
            'local_id' => $this->request->getPost('local_id'),
            'account_name' => $this->request->getPost('account_name'),
            'estado' => $this->request->getPost('estado'),
            'birthdate' => $this->request->getPost('birthdate'),
            'caregiver_birthdate' => $this->request->getPost('caregiver_birthdate'),
            'gender' => $this->request->getPost('gender'),
            'phone' => $this->request->getPost('phone'),
            'primary_caregiver' => $this->request->getPost('primary_caregiver'),
            'religious_affiliation' => $this->request->getPost('religious_affiliation'),
            'street' => $this->request->getPost('street')
        ); */
        $id = $this->request->getPost('id');
    
        $data = array(
            'codigo'  => $this->request->getPost('local_id'),
            'nombres' => $this->request->getPost('account_name'),
            'estado'  => $this->request->getPost('estado'),
            'phone'   => $this->request->getPost('phone'),
        );
         // Si los datos son correctos, proceder con la actualización
    $this->personaModel->update_person($id, $data);
    
    return redirect()->to('personas'); // Redirige correctamente
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
