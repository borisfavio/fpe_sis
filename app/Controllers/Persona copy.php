<?php

use App\Controllers;
use App\Models\Personas_model;


class Persona extends BaseController {

    protected $personaModel;
    protected $session;

	public function __construct() {
        
        //helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        //$this->personaModel = new Personas_model();
        //$this->session = \Config\Services::session(); 
    }

    public function index()
    {
        $datos_menu = ['menu' => 'Inicio']; // Datos para la vista 'templates/main'
        $contenido = 'home/index'; // Vista dinámica para el contenido
        $lib = ['script' => 'mi-script.js']; // Datos para la vista 'templates/footer'

        $data = [
            'titulo' => 'Página de inicio',
            'datos_menu' => $datos_menu,
            'contenido' => $contenido,
            'lib' => $lib,
        ];

        return view('templates/estructura', $data);
    }
    /**public function index() {
        var_dump($this->session->get('login')); exit;
        if ($this->session->get('login')) {
            $data['lib'] = 0;
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
            //$data['username'] = $this->session->userdata('username');
            return view('templates/estructura',$data);
        } else {
            redirect('logout');
        }
       
    }*/

	public function create() {
        // Lógica para mostrar el formulario de creación
		$data['lib'] = 0;
		$data['datos_menu'] = null;
        $data['contenido'] = 'personas/create_person';
        $data['username'] = $this->session->userdata('username');
		$this->load->view('templates/estructura',$data);
    }

    public function store() {
        // Lógica para procesar el formulario de creación
        /*$data = array(
            'nombres' => $this->input->post('nombres'),
            'apellidos'   => $this->input->post('apellidos'),
            // Añade más campos según tu estructura de base de datos
        );*/

		$data = $this->input->post();

        $this->personas_model->insert_person($data);
        redirect('persona/index');
    }

    public function edit($id) {
        // Lógica para mostrar el formulario de edición
        $data['lib'] = 0;
        $data['datos_menu'] = null;
        $data['beneficiario'] = $this->personas_model->get_person_by_id($id);
        $data['contenido'] = 'personas/edit_person';
        $data['username'] = $this->session->userdata('username');
		$this->load->view('templates/estructura',$data);
    }

    public function update() {
        // Lógica para procesar el formulario de edición
        // Obtener los datos del formulario
        $id = $this->input->post('id');
        $data = array(
            'local_id' => $this->input->post('local_id'),
            'account_name' => $this->input->post('account_name'),
            'estado' => $this->input->post('estado'),
            'birthdate' => $this->input->post('birthdate'),
            'caregiver_birthdate' => $this->input->post('caregiver_birthdate'),
            'gender' => $this->input->post('gender'),
            'phone' => $this->input->post('phone'),
            'primary_caregiver' => $this->input->post('primary_caregiver'),
            'religious_affiliation' => $this->input->post('religious_affiliation'),
            'street' => $this->input->post('street')
        );

        $this->personas_model->update_person($id, $data);
        redirect('persona/index');
    }

    public function delete($id) {
        // Lógica para eliminar una persona
        $this->person_model->delete_person($id);
        redirect('person_controller/index');
    }
}
