<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubprojectController;
use App\Models\Project;
use Illuminate\Support\Facades\Route;

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
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return view('welcome');
})->name('home');

/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return view('index');
});*/

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

/*Route::name('projects')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
});*/

Route::get('/projects', [ProjectController::class, 'index'])->name('projects');
Route::get('/projects/all', [ProjectController::class, 'all'])->name('projects.all');
Route::get('/projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
Route::get('/projects/view/{id}', [ProjectController::class, 'show'])->name('project.view');
Route::get('/projects/edit/{id}', [ProjectController::class, 'show'])->name('project.edit');
Route::get('/projects/restore/{id}', [ProjectController::class, 'restore'])->name('project.restore');
Route::get('/projects/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete');
Route::get('/projects/forcedelete/{id}', [ProjectController::class, 'forcedestroy'])->name('forcedestroy');
Route::post('/projects/add', [ProjectController::class, 'store'])->name('project.add');
Route::post('/projects/create', [ProjectController::class, 'create'])->name('project.create');

Route::get('/subprojects', [SubprojectController::class, 'index'])->name('subprojects');
Route::post('/subprojects/add', [SubprojectController::class, 'store'])->name('subproject.add');
Route::get('/subprojects/delete/{id}', [SubprojectController::class, 'destroy'])->name('destroy');
Route::get('/subprojects/forcedelete/{id}', [SubprojectController::class, 'forcedestroy'])->name('forcedestroy');
Route::get('/subprojects/restore/{id}', [SubprojectController::class, 'restore'])->name('restore');

/*Route::middleware(['auth:sanctum', 'verified'])->get('/projects', function () {
    Route::get('/', [ProjectController::class, 'index']);

    Route::get('/{id}', [ProjectController::class, 'show']);

    Route::post('/add', [ProjectController::class, 'store']);

    Route::put('/edit/{id}', [ProjectController::class, 'update']);

    Route::get('/search/{string}', [ProjectController::class, 'search']);

    Route::delete('/delete/{id}', [ProjectController::class, 'destroy']);
})->name('projects');*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/subprojects', function () {
    return view('subprojects');
})->name('subprojects');*/

Route::middleware(['auth:sanctum', 'verified'])->get('/activities', function () {
    return view('activities');
})->name('activities');

Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');

Route::middleware(['auth:sanctum', 'verified'])->get('/workers', function () {
    return view('workers');
})->name('workers');


/*Route::prefix('projects')->group(function () {

    Route::get('/', [ProjectController::class, 'index']);

    Route::get('/{id}', [ProjectController::class, 'show']);

    Route::post('add', [ProjectController::class, 'store']);

    Route::put('edit/{id}', [ProjectController::class, 'update']);

    Route::get('search/{string}', [ProjectController::class, 'search']);

    Route::delete('delete/{id}', [ProjectController::class, 'destroy']);

});*/

