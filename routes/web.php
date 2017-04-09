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

$app->get('/', function () use ($app) {
    //return $app->version();
    return "Ejemplo de creación de un API RESTful con Lumen";
});

$app->group(['namespace' => 'api', 'prefix' => 'api/v1'], function ($app)
{
	$app->get('marking', 'EmployeesMarkingController@createMarkingList');
	$app->get('employees', 'EmployeesController@listEmployee');
	$app->get('employee/{id}', 'EmployeesController@getEmployee');
	$app->post('employee', 'EmployeesController@createEmployee');
	$app->put('employee/in/{id}', 'EmployeesController@updateEmployeeMarkingIn');
	$app->put('employee/out/{id}', 'EmployeesController@updateEmployeeMarkingOut');
	$app->delete('employee/{id}', 'EmployeesController@deleteEmployee');
});