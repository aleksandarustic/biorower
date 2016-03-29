<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => 'sandboxc9381d7f8a074ba1b295ee264f98c408.mailgun.org',
		'secret' => 'key-5ac0c8d079315d3fa5e7176e5672c780',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'key' => '',
		'secret' => '',
	],

	/* na serveru */
	'facebook' => [
	    'client_id' => '913759631977819',
	    'client_secret' => 'ecc93e5bcfa88c0e48b15fcf979e0645',
	    'redirect' => 'http://localhost:8080/!powerhub template/blog/public/auth/handle-provider-callback-facebook', //handle-provider-callback
	],	

	'twitter' => [
	    'client_id' => 'qpZnN1Y8aLYekOMGABK36Q',
	    'client_secret' => '63mkGFrTo3maBlAQisvDCqluiQBirZQ2EB8vzuN1CfI',
	    'redirect' => 'http://localhost:8080/!powerhub template/blog/public/auth/handle-provider-callback-twitter', //handle-provider-callback
	],

	/* na serveru */
	/*
	'facebook' => [
	    'client_id' => '507802702573516',
	    'client_secret' => 'a3ed1ee1852fc1af1a35c670e6a8eeb5',
	    'redirect' => 'http://www.servistest88.byethost6.com/public/auth/handle-provider-callback-facebook', //handle-provider-callback
	],	

	'twitter' => [
	    'client_id' => 'qpZnN1Y8aLYekOMGABK36Q',
	    'client_secret' => '63mkGFrTo3maBlAQisvDCqluiQBirZQ2EB8vzuN1CfI',
	    'redirect' => 'http://www.servistest88.byethost6.com/public/auth/handle-provider-callback-twitter', //handle-provider-callback
	],
	*/		

];
