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

$router->group(['prefix' => 'candidate'], function () use ($router) {

	$router->get('/', [
		'uses' => 'CandidateController@all'
	]);

	$router->get('/{id}', [
		'uses' => 'CandidateController@show'
	]);

	$router->get('/{id}/votes', [
		'uses' => 'CandidateController@votes'
	]);

	$router->put('/{id}', [
		'uses' => 'CandidateController@update',
		'middleware' => 'admin'
	]);

	$router->post('/', [
		'uses' => 'CandidateController@create',
		'middleware' => 'admin'
	]);

	$router->delete('/{id}', [
		'uses' => 'CandidateController@delete',
		'middleware' => 'admin'
	]);

});

$router->group(['prefix' => 'vote'], function () use ($router) {

	$router->get('/', [
		'uses' => 'VoteController@all'
	]);

	$router->get('/{id}', [
		'uses' => 'VoteController@show'
	]);

	$router->post('/', [
		'uses' => 'VoteController@create'
	]);

	$router->delete('/{id}', [
		'uses' => 'VoteController@delete',
		'middleware' => 'admin'
	]);

});