<?php

use Illuminate\Support\Facades\Route;

Auth::routes([
	'login' => true,
	'logout' => true,
	'register' => true,
	'reset' => true,
	'confirm' => true,
	'verify' => true
]);
