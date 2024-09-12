<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIfIsAdmin;
use Illuminate\Support\Facades\Route;

/*
    Dependendo da ordem pode dar erro devido ao entendimento da rota pelo laravel,
    por exemplo, ele ver a rota /users/create como o create sendo um suposto ID, 
    devido a rota show que usa /user/{user} (retorna o ID)

*/
//Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy');
//Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
//Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
//Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
//Route::post('/users', [UserController::class, 'store'])->name('users.store'); 
//Route::get('/users/create', [UserController::class, 'create'])->name('users.create'); //Rote::get('URL', [classe user controler criado, 'função criada']->name('nome da rota criada'))
//Route::get('/users', [UserController::class, 'index'])->name('users.index');


//para acessar a essas rotas, apenas com usuarios autenticados utiliza o midleware
Route::middleware('auth')
    ->prefix('Admin') //serve para adicionar um caminho a mais na url, e mesmo mudando dessa forma nao altera o funcionamento das rotas
    ->group(function() { //entre parenteses é o nome do middleware e auth é um middleware do laravel
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store'); 
        
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}/destroy', [UserController::class, 'destroy'])->name('users.destroy')->middleware(CheckIfIsAdmin::class);
        
        Route::get('/users', [UserController::class, 'index'])->name('users.index');    
});

//pode aplicar o middleware unitariamente em cada rota da seguinte maneira:
//Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware(['', '']); pode contar varios middleware ou um array de middleware



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
