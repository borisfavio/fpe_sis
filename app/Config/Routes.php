<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Auth::login');



$routes->get('/login', 'Auth::login');
$routes->post('/do_login', 'Auth::do_login');
$routes->get('/logout', 'Auth::logout');
$routes->get('/dashboard', 'Dashboard::index');

//Ruta para Modulo de Personas
$routes->get('/personas', 'Persona::index');
$routes->get('/persons/create', 'Persona::create');
$routes->post('/persona/store', 'Persona::store');
$routes->get('/persona/store', 'Persona::store');
$routes->get('persons/edit/(:any)', 'Persona::edit/$1');
$routes->get('persona/ver/(:any)', 'Persona::card/$1');
$routes->post('persona/update', 'Persona::update');
$route['persons/delete/(:any)'] = 'persona/delete/$1';

//Ruta para Modulo de Usuarios
$routes->get('/usuarios', 'UsuarioController::index');
$routes->get('/usuarios/crear', 'UsuarioController::create');
$routes->post('/usuarios/guardar', 'UsuarioController::guardar');
$routes->get('/usuarios/editar/(:num)', 'UsuarioController::editar/$1');
$routes->post('/usuarios/actualizar/(:num)', 'UsuarioController::actualizar/$1');
$routes->get('/usuarios/eliminar/(:num)', 'UsuarioController::eliminar/$1');

//Ruta para Modulo de Beneficios
$routes->get('/beneficios', 'Beneficio::index');
$routes->post('beneficio/guardar','Beneficio::guardar');
$route['persons/create'] = 'persona/create';
$route['persons/store'] = 'persona/store';
$route['persons/edit/(:any)'] = 'persona/edit/$1';
$route['persons/update'] = 'persona/update';
$route['persons/delete/(:any)'] = 'persona/delete/$1';
$routes->get('beneficios/entrega/(:any)', 'Beneficio::entrega/$1');
//$routes->post('/beneficio/buscar/(:any)', 'Beneficio::buscar/$1');
$routes->get('/beneficio/buscar/(:any)', 'Beneficio::buscar/$1');

//Ruta para Modulo de Grupos



$routes->get('/grupos','GruposController::inicio');
$routes->get('/grupos/create', 'GruposController::create');
$routes->post('/grupos/store', 'GruposController::store');
$routes->get('/grupos/edit/(:num)', 'GruposController::edit/$1');
$routes->post('/grupos/update/(:num)', 'GruposController::update/$1');
$routes->get('/grupos/delete/(:num)', 'GruposController::delete/$1');
$routes->get('grupos/tutor/(:any)', 'Grupo::tutor/$1');

//Ruta para Aportes
$routes->get('/aportes/lista', 'AportesController::listar');
$routes->get('/aportes/formulario', 'AportesController::mostrarFormulario');
//$routes->get('/aportes/procesar', 'AportesController::precesarPago');
$routes->post('/aportes/procesar', 'AportesController::precesarPago');
$routes->get('/aportes/generar_pdf/(:num)', 'AportesController::generarPdf/$1');
$routes->get('aportes/generarpdf/(:num)', 'AportesController::generarfPdf/$1');

//reportes
$routes->get('aportes/reporte-pagos', 'AportesController::reporteFormulario');
$routes->post('aportes/reporte-pagos', 'AportesController::generarReporte');



// Configuración de rutas asistencia

    $routes->get('/asistencia', 'AsistenciaController::index');
    $routes->get('/asistencia/mes/(:any)', 'AsistenciaController::asistenciaMes/$1');
    $routes->get('/asistencia/tg/(:any)', 'AsistenciaController::tutor/$1');
    $routes->get('/asistencia/grupos/(:any)', 'AsistenciaController::asistenciaGrupos/$1');
    $routes->get('/asistencia/tutor/', 'AsistenciaController::asistenciaGruposTutor');
    $routes->get('(:num)', 'AsistenciaController::show/$1');
    $routes->post('/asistencia/registrar', 'AsistenciaController::registrar');
    $routes->put('(:num)', 'AsistenciaController::update/$1');
    $routes->delete('(:num)', 'AsistenciaController::delete/$1');
    $routes->get('/beneficiarios/getPorFiltro', 'AsistenciaController::getPorFiltro');


