<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->group("api", ["namespace" => "App\Controllers\Api"] , function($routes){


    $routes->post("login", "LoginController::login");

    $routes->group("estado_misiones", function($routes){

       $routes->get("listar", "EstadoMIsionesController::listarEstado");
       $routes->post("agregar", "EstadoMIsionesController::agregarEstado");
       $routes->get("individual/(:num)", "EstadoMIsionesController::EstadoIndividual/$1");
       $routes->put("actualizar/(:num)", "EstadoMIsionesController::actualizarEstado/$1");
       $routes->delete("eliminar/(:num)", "EstadoMIsionesController::eliminarEstado/$1");
    });

    $routes->group("rol_mision", function($routes){

        $routes->get("listar", "RolMisionController::listarRol");
        $routes->post("agregar", "RolMisionController::agregarRol");
        $routes->get("individual/(:num)", "RolMisionController::RolIndividual/$1");
        $routes->put("actualizar/(:num)", "RolMisionController::actualizarRol/$1");
        $routes->delete("eliminar/(:num)", "RolMisionController::eliminarRol/$1");
     });

    $routes->group("permisos", function($routes){

        $routes->get("listar", "PermisosController::listarPermisos");
        $routes->post("agregar", "PermisosController::agregarPermisos");
        $routes->get("individual/(:num)", "PermisosController::PermisoIndividual/$1");
        $routes->put("actualizar/(:num)", "PermisosController::actualizarPermiso/$1");
        $routes->delete("eliminar/(:num)", "PermisosController::eliminarPermiso/$1");
     });

     $routes->group("misiones", function($routes){

        $routes->get("listar", "MisionController::listarMisiones");
        $routes->post("agregar", "MisionController::agregarMision");
        $routes->get("individual/(:num)", "MisionController::MisionIndividual/$1");
        $routes->put("actualizar/(:num)", "MisionController::actualizarMision/$1");
        $routes->delete("eliminar/(:num)", "MisionController::eliminarMision/$1");
     });

    $routes->group("usuarios", function($routes){

        $routes->get("listar", "UsuarioController::get");
        $routes->post("agregar", "UsuarioController::create");
        $routes->get("individual/(:num)", "UsuarioController::getById/$1");
        $routes->put("actualizar/(:num)", "UsuarioController::updates/$1");
        $routes->delete("eliminar/(:num)", "UsuarioController::deletes/$1");
    });

     $routes->group("roles", function($routes){

        $routes->get("listar", "RolesController::listarRoles");
        $routes->post("agregar", "RolesController::agregarRoles");
        $routes->get("individual/(:num)", "RolesController::RoleIndividual/$1");
        $routes->put("actualizar/(:num)", "RolesController::actualizarRol/$1");
        $routes->delete("eliminar/(:num)", "RolesController::eliminarRol/$1");
     });

    
    $routes->group('employee', function ($routes) {
        $routes->get('all/', 'EmployeesController::index');
        $routes->post('create','EmployeesController::create');
        $routes->get('(:num)','EmployeesController::edit/$1');
        $routes->put('update/(:num)','EmployeesController::update/$1');
        $routes->delete('delete/(:num)','EmployeesController::delete/$1');
    });

    $routes->group('department', function ($routes) {
        $routes->get('all/', 'DepartmentsController::index');
        $routes->post('create','DepartmentsController::create');
        $routes->get('(:num)','DepartmentsController::edit/$1');
        $routes->put('update/(:num)','DepartmentsController::update/$1');
        $routes->delete('delete/(:num)','DepartmentsController::delete/$1');
    });

    $routes->group('financing', function ($routes) {
        $routes->get('all/', 'FinancingController::index');
        $routes->post('create','FinancingController::create');
        $routes->get('(:num)','FinancingController::edit/$1');
        $routes->put('update/(:num)','FinancingController::update/$1');
        $routes->delete('delete/(:num)','FinancingController::delete/$1');
    });

    $routes->group('modality', function ($routes) {
        $routes->get('all/', 'ModalityController::index');
        $routes->post('create','ModalityController::create');
        $routes->get('(:num)','ModalityController::edit/$1');
        $routes->put('update/(:num)','ModalityController::update/$1');
        $routes->delete('delete/(:num)','ModalityController::delete/$1');
    });

    $routes->group('trainingstatus', function ($routes) {
        $routes->get('all/', 'TrainingStatusController::index');
        $routes->post('create','TrainingStatusController::create');
        $routes->get('(:num)','TrainingStatusController::edit/$1');
        $routes->put('update/(:num)','TrainingStatusController::update/$1');
        $routes->delete('delete/(:num)','TrainingStatusController::delete/$1');
    });

    $routes->group('training', function ($routes) {
        $routes->get('all/', 'TrainingController::index');
        $routes->post('create','TrainingController::create');
        $routes->get('(:num)','TrainingController::edit/$1');
        $routes->put('update/(:num)','TrainingController::update/$1');
        $routes->delete('delete/(:num)','TrainingController::delete/$1');
    });

    $routes->post('register', 'UsuarioController::index');
    $routes->post('login', 'LoginController::index');
    $routes->get('users', 'User::index', ['filter' => 'authFilter']);


     
});



/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
