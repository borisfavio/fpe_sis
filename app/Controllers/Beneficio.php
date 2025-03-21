<?php
namespace App\Controllers;

use App\Models\ActividadModel;
use App\Models\Beneficios_model;
use App\Models\PersonasModel;

class Beneficio extends BaseController {

    protected $session;
    protected $beneficioModel;
    protected $actividadModel;
    protected $personaModel;

	public function __construct() {
        helper('url'); // Agrega esta línea para cargar la biblioteca de URL
        $this->beneficioModel = new Beneficios_model();
        $this->actividadModel = new ActividadModel();
        $this->personaModel = new PersonasModel();
        $this ->session = \Config\Services::session();
    }

    public function index()
    {
        if ($this->session->get('login')) {
            $usuario = $this->session->get('usuario');
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'beneficios/beneficios';
            $lib = ['script' => 'mi-script.js'];
            $beneficios = $this->actividadModel->findAll();

            //la cantidad y listado de notificaciones
            /*$data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            */
            $data = [
                'titulo' => 'FPE - Beneficios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuarios' => 'usuario',
                'usuario' => $this->session->get('usuario'),
                'beneficios' => $beneficios,
            ];
            //var_dump($data); exit;
            return view('templates/estructura',$data);
        } else {
            redirect('logout');
        }
       
    }
    public function buscar($codigo) 
    {
        // Validar el código (opcional, pero recomendado)
        if (empty($codigo)) {
            return $this->response->setStatusCode(400)->setJSON(['error' => 'Código no proporcionado']);
        }
    
        // Buscar el beneficiario por código
        $beneficiario = $this->personaModel->getPersonByCod($codigo);
    
        if ($beneficiario) {
            // Si se encuentra, devolver los datos en JSON
            return $this->response->setJSON([
                'codigo'  => $beneficiario['codigo'],
                'nombres' => $beneficiario['nombres']
            ]);
        } else {
            // Si no se encuentra, devolver un error 404
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Beneficiario no encontrado']);
        }
    }


    public function entrega($id) {
        if ($this->session->get('login')) {
            /*$data['lib'] = 0;
            $data['datos_menu'] = null;
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['titulo'] = "FPE-Usuarios";
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            $data['contenido'] = 'beneficios/entrega_beneficio';
            $usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            $data['username'] = $this->session->userdata('username');
           */
            $usuario = $this->session->get('usuario');
            $datos_menu = ['menu' => 'Inicio'];
            $contenido = 'beneficios/entrega_beneficio';
            $lib = ['script' => 'mi-script.js'];
            $regalo = $this->actividadModel->find($id);
            //var_dump($regalo); exit;

            //la cantidad y listado de notificaciones
            /*$data['cantidadN'] = 2;
            $data['thema'] = "main";
            $data['descripcion'] = "ventas";
            //$usrid = $this->session->userdata('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            */
            $data = [
                'titulo' => 'FPE - Beneficios',
                'datos_menu' => $datos_menu,
                'contenido' => $contenido,
                'lib' => $lib,
                'usuario' => $usuario,
                'regalo' => $regalo,
            ];
            //var_dump($data); exit;
            return view('templates/estructura',$data);
        } else {
            redirect('logout');
        }
       
    }

public function guardar(){
    // Verificar si el usuario está logueado
    if (!$this->session->get('login')) {
        return redirect('logout');
    }

    // Obtener el ID de la actividad
    $idB = $this->request->getPost('id');
    if (empty($idB)) {
        // Manejar el caso en que el ID no esté presente
        return redirect('beneficios')->with('error', 'ID de actividad no válido');
    }

    // Preparar los datos para la inserción
    $data = [
        'cod_ben' => $this->request->getPost('codBen'), // Código del beneficiario
        'descripcion' => $this->request->getPost('actId'), // Descripción del regalo
        'fecha_entrega' => $this->request->getPost('fechaEntrega'), // Fecha de entrega
        'act_id' => $idB, // ID de la actividad
        'ruta_foto' => 'esto es una ruta',//$this->request->getPost('archivoFoto') // Ruta de la foto
    ];

    // Validar los datos (puedes agregar más validaciones según sea necesario)
    if (empty($data['cod_ben']) || empty($data['descripcion']) || empty($data['fecha_entrega'])) {
        return redirect('beneficios')->with('error', 'Todos los campos son obligatorios');
    }

    try {
        // Insertar los datos en la base de datos
        $this->beneficioModel->insert($data);
        
        // Redirigir al usuario a la página de entrega
        return redirect('beneficios/entrega/'.$idB);
    } catch (\Exception $e) {
        // Manejar cualquier excepción que ocurra durante la inserción
        return redirect('beneficios')->with('error', 'Ocurrió un error al guardar los datos: ' . $e->getMessage());
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
