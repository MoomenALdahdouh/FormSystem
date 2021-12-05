<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ManagerHomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RedirectsController;
use App\Http\Controllers\SubprojectController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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
        return redirect()->route('redirects');
    }
    return view('welcome');
})->name('welcome');

/*Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'type:0', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::get('/home', [HomeController::class, 'index']);
    });
    Route::group(['middleware' => 'type:1', 'prefix' => 'manager', 'as' => 'manager.'], function () {
        Route::get('/home', [ManagerHomeController::class, 'index']);
    });
});*/

Route::get('/redirects', [RedirectsController::class, 'index'])->name('redirects');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/manager', [ManagerHomeController::class, 'index'])->name('manager');

/*Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/manager', function () {
    return view('manager.manager_home');
})->name('manager');*/


Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index'])->name('projects');
    Route::get('/all', [ProjectController::class, 'all'])->name('projects.all');
    Route::get('/trash', [ProjectController::class, 'trash'])->name('projects.trash');
    Route::get('/view/{id}', [ProjectController::class, 'show'])->name('project.view');
    Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('project.edit');
    Route::post('/update/{id}', [ProjectController::class, 'update'])->name('project.update');
    Route::get('/restore/{id}', [ProjectController::class, 'restore'])->name('project.restore');
    Route::delete('/delete/{id}', [ProjectController::class, 'destroy'])->name('project.delete');
    Route::get('/forcedelete/{id}', [ProjectController::class, 'forcedestroy'])->name('forcedestroy');
    Route::post('/add', [ProjectController::class, 'store'])->name('project.add');
    Route::post('/create', [ProjectController::class, 'create'])->name('project.create');
});


Route::prefix('subprojects')->group(function () {
    Route::get('/', [SubprojectController::class, 'index'])->name('subprojects');
    Route::get('/all', [SubprojectController::class, 'all'])->name('subprojects.all');
    Route::post('/add', [SubprojectController::class, 'store'])->name('subproject.add');
    Route::delete('/delete/{id}', [SubprojectController::class, 'destroy'])->name('destroy');
    Route::get('/forcedelete/{id}', [SubprojectController::class, 'forcedestroy'])->name('forcedestroy');
    Route::get('/restore/{id}', [SubprojectController::class, 'restore'])->name('restore');
    Route::get('/view/{id}', [SubprojectController::class, 'show'])->name('subproject.view');
    Route::get('/edit/{id}', [SubprojectController::class, 'edit'])->name('subproject.edit');
    Route::post('/update/{id}', [SubprojectController::class, 'update'])->name('subproject.update');
    Route::post('/create', [SubprojectController::class, 'create'])->name('subproject.create');
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
    Route::get('/view/{id}', [UserController::class, 'show'])->name('users.view');
    Route::get('/admin', [UserController::class, 'admin'])->name('users.admin');
    Route::get('/managers', [UserController::class, 'managers'])->name('users.managers');
    Route::get('/workers', [UserController::class, 'workers'])->name('users.workers');
    Route::post('/create', [UserController::class, 'create'])->name('users.create');
});

Route::prefix('activities')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->name('activities');
    Route::get('/all', [ActivityController::class, 'all'])->name('activities.all');
    Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::get('/view/{id}', [ActivityController::class, 'show'])->name('activities.view');
    Route::post('/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::delete('/delete/{id}', [ActivityController::class, 'destroy'])->name('activities.delete');
});

Route::prefix('form')->group(function () {
    Route::post('/create', [FormController::class, 'create'])->name('form.create');
    Route::get('/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
    Route::get('/apply/{id}', [FormController::class, 'apply'])->name('form.apply');
});

Route::prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('questions');
    Route::post('/store', [QuestionController::class, 'store'])->name('questions.store');
});


Route::middleware(['auth:sanctum', 'verified'])->get('/workers', function () {
    return view('workers');
})->name('workers');






/*Route::get('/', function () {
    return view('welcome');
});*/

/*Route::get('/', function () {
    return view('index');
});*/

/*Route::name('projects')->group(function () {
    Route::get('/projects', [ProjectController::class, 'index']);
});*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/activities', function () {
    return view('activities');
})->name('activities');*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/users', function () {
    return view('users');
})->name('users');*/

/*Route::middleware(['auth:sanctum', 'verified'])->get('/admins', function () {
    return view('admins');
})->name('admins');*/

/*Route::prefix('projects')->group(function () {

    Route::get('/', [ProjectController::class, 'index']);

    Route::get('/{id}', [ProjectController::class, 'show']);

    Route::post('add', [ProjectController::class, 'store']);

    Route::put('edit/{id}', [ProjectController::class, 'update']);

    Route::get('search/{string}', [ProjectController::class, 'search']);

    Route::delete('delete/{id}', [ProjectController::class, 'destroy']);

});*/

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
