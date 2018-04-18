<?php
return [

	/*
	 * The URL to call for API functionalities
	 */
	'url' => 'https://api.qapla.it/1.1/',

	/*
	 * SHIPMENTS
	 * Config parameters
	 */
	'tracks' => [
		'default_fromDate'  => '1970-01-01 00:00:00',   // Get shipments from 1970 to today = ALL
	],

	/*
	 * ORDERS
	 * Config parameters
	 */
	'orders' => [
		'default_fromDate'  => '1970-01-01 00:00:00',   // Get orders from 1970 to today = ALL
	],

	/*
	 * COURIERS
	 * Config parameters
	 */
	'couriers' => [
		'default_country' => 'it,global'
	]

];