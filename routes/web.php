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

Route::get('/login', function() {
	abort_unless(app()->environment('local'), 403);
	auth()->login(\App\Domain\User\Domain\User::first());

	return redirect()->to('/admin');
});
