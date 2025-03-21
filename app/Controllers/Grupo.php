<?php

namespace App\Controllers;

use App\Models\GrupoModel;
use App\Models\PersonasModel;

class Grupo extends BaseController
{
    protected $grupoModel;
    protected $session;
    protected $personaModel;

	public function __construct() {
        $this->grupoModel = new GrupoModel();
        $this->personaModel = new PersonasModel();
        helper('url'); 
        $this->session = \Config\Services::session();
        
        
    }

    public function index() {
        if ($this->session->get('login')) {
            $usuario = $this->session->get('usuario');
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'grupos/grupos'; 
            $lib = ['script' => 'mi-script.js'];
            $grupos = $this->grupoModel->get_grupos_tutor($usuario['id_tutor']);
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
                'grupos' => $grupos,
            ];
                return view('templates/estructura', $data);
        } else {
            return redirect()->to('/logout');
        }
           
       
    }


    public function tutor($grupoid) {
        if ($this->session->get('login')) {
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'grupos/grupos_tutor'; 
            $lib = ['script' => 'mi-script.js'];
            $personas = $this->grupoModel->ObtenerBeneficiariosTutor($grupoid);
            /*
            $data['cantidadN'] = 2;
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            */
            $data = [
                'titulo' => 'FPE - Grupos',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'personas' => $personas,
                'usuario' => $this->session->get('usuario'),
            ];
            return view('templates/estructura', $data);
        } else {
            redirect('logout');
        }
       
    }

    public function buscar($codigo) {
        
        // Buscar el beneficiario por código
        $beneficiario = $this->beneficios_model->get_person_by_cod($codigo);

        if ($beneficiario) {
            // Si se encuentra, devolver los datos en JSON
            echo json_encode([
                'codigo' => $beneficiario->codigo,
                'nombres' => $beneficiario->nombres
            ]);
        } else {
            // Si no se encuentra, devolver un error
            header("HTTP/1.1 404 Not Found");
            echo json_encode(['error' => 'Beneficiario no encontrado']);
        }
    }


    public function entrega($id) {
        if ($this->session->userdata('login')) {
            $data['lib'] = 0;
            $data['datos_menu'] = null;
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['regalo'] = $this->beneficios_model->get_beneficio_by_id($id);
            $data['titulo'] = "FPE-Usuarios";
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['contenido'] = 'beneficios/entrega_beneficio';
            $usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            $data['username'] = $this->session->userdata('username');
            $this->load->view('templates/estructura',$data);
        } else {
            redirect('logout');
        }
       
    }

    public function guardar(){
        if ($this->session->userdata('login')) {
            $idB = $this->input->post('id');
            $data = [
                'cod_ben' => $this->input->post('codBen'), // Código del beneficiario
                'descripcion' => $this->input->post('actId'), // Descripción del regalo
                'fecha_entrega' => $this->input->post('fechaEntrega'), // Fecha de entrega
                'act_id' => $this->input->post('id'), // ID de la actividad
                'ruta_foto' => $this->input->post('archivoFoto') // Ruta de la foto
            ];
    
            $this->beneficios_model->guardarRegalo($data);
            
            
            redirect('beneficios/entrega/'.$idB.'');
        } else {
            redirect('logout');
        }
    }

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
