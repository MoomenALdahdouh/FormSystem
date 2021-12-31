<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ManagerHomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\RedirectsController;
use App\Http\Controllers\SubActivitiesController;
use App\Http\Controllers\SubprojectController;
use App\Http\Controllers\UserController;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//TODO:: MOOMEN S. ALDAHDOUH 11/13/2021

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('redirects');
    }
    return view('welcome');
})->name('welcome');

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);

Route::get('/languageDemo', 'App\Http\Controllers\HomeController@languageDemo');

Route::get('/redirects', [RedirectsController::class, 'index'])->name('redirects');
Route::get('/register', [RedirectsController::class, 'index'])->name('redirects');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/manager', [ManagerHomeController::class, 'index'])->name('manager');
//TODO:: MOOMEN S. ALDAHDOUH 11/16/2021
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

//TODO:: MOOMEN S. ALDAHDOUH 11/18/2021
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
//TODO:: MOOMEN S. ALDAHDOUH 11/23/2021
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
//TODO:: MOOMEN S. ALDAHDOUH 11/26/2021
Route::prefix('activities')->group(function () {
    Route::get('/', [ActivityController::class, 'index'])->name('activities');
    Route::get('/all', [ActivityController::class, 'all'])->name('activities.all');
    Route::get('/edit/{id}', [ActivityController::class, 'edit'])->name('activities.edit');
    Route::post('/update/{id}', [ActivityController::class, 'update'])->name('activities.update');
    Route::get('/view/{id}', [ActivityController::class, 'show'])->name('activities.view');
    Route::post('/create', [ActivityController::class, 'create'])->name('activities.create');
    Route::delete('/delete/{id}', [ActivityController::class, 'destroy'])->name('activities.delete');
});
//TODO:: MOOMEN S. ALDAHDOUH 11/26/2021
Route::prefix('subactivities')->group(function () {
    Route::get('/', [SubActivitiesController::class, 'index'])->name('subactivities');
    Route::get('/{id}/forms', [SubActivitiesController::class, 'forms'])->name('subactivities.forms');
    Route::get('/all', [SubActivitiesController::class, 'all'])->name('subactivities.all');
    Route::get('/edit/{id}', [SubActivitiesController::class, 'edit'])->name('subactivities.edit');
    Route::post('/update/{id}', [SubActivitiesController::class, 'update'])->name('subactivities.update');
    Route::get('/view/{id}', [SubActivitiesController::class, 'show'])->name('subactivities.view');
    Route::post('/create', [SubActivitiesController::class, 'create'])->name('subactivities.create');
    Route::post('/createForm', [SubActivitiesController::class, 'createForm'])->name('subactivities.createForm');
    Route::delete('/delete/{id}', [SubActivitiesController::class, 'destroy'])->name('subactivities.delete');
});
//TODO:: MOOMEN S. ALDAHDOUH 11/25/2021
Route::prefix('form')->group(function () {
    Route::get('/', [FormController::class, 'index'])->name('forms');
    Route::post('/create', [FormController::class, 'create'])->name('form.create');
    Route::get('/edit/{id}', [FormController::class, 'edit'])->name('form.edit');
    Route::get('/apply/{id}', [FormController::class, 'apply'])->name('form.apply');
    Route::delete('/delete/{id}', [FormController::class, 'destroy'])->name('form.delete');
    Route::post('/worker/remove/{id}', [FormController::class, 'remove_worker'])->name('form.remove_worker');
    Route::post('/worker/add', [FormController::class, 'add_worker'])->name('form.add_worker');
});
//TODO:: MOOMEN S. ALDAHDOUH 11/28/2021
Route::prefix('questions')->group(function () {
    Route::get('/', [QuestionController::class, 'index'])->name('questions');
    Route::post('/store', [QuestionController::class, 'store'])->name('questions.store');
});
//TODO:: MOOMEN S. ALDAHDOUH 11/28/2021
Route::prefix('interviews')->group(function () {
    Route::get('/', [InterviewController::class, 'index'])->name('interviews');
    Route::get('/fetch', [InterviewController::class, 'fetch'])->name('interviews.fetch');
    Route::get('/view/{id}', [InterviewController::class, 'show'])->name('interviews.view');
    Route::delete('/delete/{id}', [InterviewController::class, 'destroy'])->name('interviews.delete');
});

//TODO:: MOOMEN S. ALDAHDOUH 11/30/2021
Route::middleware(['auth:sanctum', 'verified'])->get('/workers', function () {
    return view('workers');
})->name('workers');



//TODO:: MOOMEN S. ALDAHDOUH 11/12/2021
