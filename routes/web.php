<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

//Developer
$router->post('/createDeveloper', 'ProjectController@addDeveloper');
$router->post('/editDeveloper', 'ProjectController@editDeveloper');
$router->post('/deleteDeveloper', 'ProjectController@deleteDeveloper');
$router->get('/getDevelopers', 'ProjectController@getDevelopers');

//project
$router->post('/createProject', 'ProjectController@addProject');
$router->post('/editProject', 'ProjectController@editProject');
$router->get('/getProject', 'ProjectController@getProject');
$router->get('/deleteProject/{id}', 'ProjectController@deleteProject');
$router->post('/uploadMedia', 'ProjectController@uploadMedia');


$router->get('/getAttached', 'ProjectController@getAttProject');
$router->get('/getDetached', 'ProjectController@getDetProject');

$router->get('/address/{value}', 'ProjectController@address');

//Admin setting
$router->get('/getGS', 'ProjectController@getGS');
$router->post('/saveGS', 'ProjectController@saveGS');
$router->post('/login', 'ProjectController@login');
$router->post('/changePassword', 'ProjectController@changePassword');
$router->post('/changeUsername', 'ProjectController@changeUsername');

$router->post('/contact', 'ProjectController@contact');

// Newsletter
$router->post('/joinNewsletter', 'ProjectController@joinNewsletter');
$router->get('/getNewsletter', 'ProjectController@getNewsletter');

//testing route
$router->post('/test', 'ProjectController@uploadVideo');
