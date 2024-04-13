<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'InicioController::index');
//producto
$routes->get('/producto', 'ProductoController::index');
$routes->get('/producto/addEdit/(:num)','ProductoController::addEdit/$1');
$routes->post('/producto/addEdit/(:num)','ProductoController::addEdit/$1');
$routes->post('/producto/delete', 'ProductoController::delete');
$routes->get('/producto/detalle/(:num)', 'ProductoController::detalle/$1');
//inventario
$routes->get('/inventario', 'InventarioController::index');
$routes->post('/inventario/agregar', 'InventarioController::agregar');
$routes->post('/inventario/editar', 'InventarioController::editar');
$routes->post('/inventario/eliminar', 'InventarioController::eliminar');

$routes->get('/inventario/registrar', 'InventarioController::form');
$routes->post('/inventario/registrar', 'InventarioController::registrar');

//facturacion
$routes->get('/facturacion', 'FacturacionController::index');
$routes->get('/facturacion/agregar', 'FacturacionController::form');

$routes->post('/facturacion/guardar', 'FacturacionController::guardar');
$routes->get('/facturacion/detalle/(:num)', 'FacturacionController::detalle/$1');

