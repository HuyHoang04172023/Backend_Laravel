<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AuthController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


//Route of Post
Route::get('/posts', [PostController::class, 'index']);







// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
// Route::get('/logout', [AuthController::class,'logout'])->name('logout');

Route::get('/no-access', function () {
    return view('no_access');
})->name('no-access');

Route::middleware('auth')->group(function () {
    Route::middleware('role:admin,editor,user')->group(function () {
        //Route of Project
        Route::get('/projects', [ProjectController::class, 'index'])->name('project.index');
        Route::get('/project/create', [ProjectController::class, 'create'])->name('project.create');
        Route::post('/project/store', [ProjectController::class, 'store'])->name('project.store');
        Route::get('/project/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
        Route::patch('/task/update/{id}', [ProjectController::class, 'update'])->name('project.update');
        Route::delete('/project/delete/{id}', [ProjectController::class, 'destroy'])->name('project.destroy');
    });

    Route::middleware('role:admin,user')->group(function () {
        //Route of Task
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
        Route::post('/tasks/store', [TaskController::class, 'store'])->name('tasks.store');
        Route::get('/tasks/edit/{id}', [TaskController::class, 'edit'])->name('tasks.edit');
        Route::patch('/tasks/update/{id}', [TaskController::class, 'update'])->name('tasks.update');
        Route::delete('/tasks/delete/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
        Route::post('/tasks/filter', [TaskController::class, 'filter'])->name('tasks.filter');
    });

    Route::middleware('role:admin')->group(function () {
        
    });




});

//Route of User
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::patch('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');