<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get("/", "Home::index");
$routes->get("/Hoteles", "Home::hoteles_view");
$routes->get("/Tipohabitacion", "Home::tipohabitacion_view");
$routes->get("/Acomodacion", "Home::acomodacion_view");
$routes->get("/HabitaAcomoda", "Home::habitaacomoda_view");
$routes->get("/HotelHabita", "Home::hotelhabita_view");

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

 //grupo para procesos de las HSO
$routes->group("api/hotel", function ($routes) {
    $routes->get("listar", "Hotel::getallData");
    $routes->post("insertar", "Hotel::insertData");
});

 //grupo para procesos de las XXX
$routes->group("api/tipohabitacion", function ($routes) {
    $routes->get("listar", "TipoHabitacion::getallData");
    $routes->post("insertar", "TipoHabitacion::insertData");
});

 //grupo para procesos de las XXX
 $routes->group("api/acomodacion", function ($routes) {
    $routes->get("listar", "Acomodacion::getallData");
	$routes->post("insertar", "Acomodacion::insertData");
});

//grupo para procesos de las XXX
$routes->group("api/habitacomoda", function ($routes) {
    $routes->get("listar", "HabitacionAcomoda::getallData");
	$routes->post("insertar", "HabitacionAcomoda::insertData");
});

//grupo para procesos de las XXX
$routes->group("api/hotelhabita", function ($routes) {
    $routes->get("listar", "HotelHabitacion::getallData");
	$routes->post("insertar", "HotelHabitacion::insertData");
});

if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
