<?php

use Illuminate\Support\Facades\Route;

use App\Domain\Statistics\Application\Index\StatisticsIndexAction; /* Index */

use App\Domain\User\Application\Index\IndexUserAction; /* Index */
use App\Domain\User\Application\Create\CreateUserAction; /* Create */
use App\Domain\User\Application\Store\StoreUserAction; /* Store */
use App\Domain\User\Application\Show\ShowUserAction; /* Show */
use App\Domain\User\Application\Edit\EditUserAction; /* Edit */
use App\Domain\User\Application\Update\UpdateUserAction; /* Update */
use App\Domain\User\Application\Delete\DeleteUserAction; /* Delete */

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function()
{
	Route::get('/', StatisticsIndexAction::class)->name('statistics.index');
	
	Route::prefix('user')->name('user.')->group(function() {
		Route::get('/', IndexUserAction::class)->name('index');
		Route::get('/create', CreateUserAction::class)->name('create');
		Route::put('/store', StoreUserAction::class)->name('store');
		Route::get('/{user:id}/show', ShowUserAction::class)->name('show');
		Route::get('/{user:id}/edit', EditUserAction::class)->name('edit');
		Route::put('/{user:id}/update', UpdateUserAction::class)->name('update');
		Route::put('/{user:id}/delete', DeleteUserAction::class)->name('delete');
	});
});

Auth::routes();
