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

Route::get('/admin/lang/{locale}', function ($locale) {
    config()->set('app.locale', $locale);
    session()->put('locale', $locale);

    return redirect()->back();
});