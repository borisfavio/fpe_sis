<?php
namespace App\Controllers;

use App\Models\Personas_model;

class Dashboard extends BaseController {
    protected $personas_model;

    public function __construct() {
        $this->personas_model = new Personas_model();
        
    }
    public function index(): string
    {
        return view('welcome_message');
    }
    
    public function indexx() {
        if (session()->get('login')) {
            $data['grupos'] = $this->personas_model->get_persons();

            //return view('grupos/index', $data);
            
            $data['lib'] = 0;
            $data['datos_menu'] = $this->setpermiso();
            //la cantidad y listado de notificaciones
            $data['cantidadN'] = 2;
            $data['lst_noti'] = null;
            $data['titulo'] = "Dashboard";
            $data['thema'] = "main";
            $data['personas'] = $this->personas_model->get_persons();
            $data['descripcion'] = "ventas";
            $data['contenido'] = 'dashboard';
            $usrid = session()->get('id_usuario');
            $data['chatUsers'] = 1;
            $data['getUserDetails'] = "admin";
            $data['username'] = session()->get('username');
            return view('templates/estructura', $data);
        } else {
            redirect('auth/logout');
        }
       
    }

    function setpermiso(){
        $login=session()->get('login');
        if($login) {
            $accesos['permisos'] = session()->get('permisos');
            return $accesos;
        }
    }
}
