<?php
/**
 * Created by PhpStorm.
 * User: bellanaijadev
 * Date: 2019-02-10
 * Time: 19:48
 */

return [
	/*
	|--------------------------------------------------------------------------
	| Laravel CORS
	|--------------------------------------------------------------------------
	|
	| allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
	| to accept any value.
	|
	*/
	'supportsCredentials' => false,
	'allowedOrigins' => ['istandwithyou.com.ng'],
	'allowedHeaders' => ['Content-Type', 'X-Requested-With'],
	'allowedMethods' => ['*'], // ex: ['GET', 'POST', 'PUT',  'DELETE']
	'exposedHeaders' => [],
	'maxAge' => 0,
];