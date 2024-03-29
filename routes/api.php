<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\api\ActivityUserController;
use App\Http\Controllers\api\AnswersController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\FormController;
use App\Http\Controllers\api\InterviewController;
use App\Http\Controllers\api\WorkerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//TODO::MOOMEN S. ALDAHDOUH

//TODO::Use ->middleware('auth:sanctum'); in last all Route if you need the authenticator user
// EX:Route::prefix('activities')->group(function () {
//      Route::get('/', [ActivityUserController::class, 'index'])->middleware('auth:sanctum');
//      Route::get('/{id}/form', [ActivityUserController::class, 'form'])->middleware('auth:sanctum');
//    });

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('user', [AuthController::class, 'index']);
    Route::post("logout", [AuthController::class, 'logout']);
});

Route::prefix('activities')->group(function () {
    Route::get('/{id}', [ActivityUserController::class, 'index']);
    Route::get('/{id}/form', [ActivityUserController::class, 'form']);
});

Route::prefix('forms')->group(function () {
    Route::get('/{id}/interviews', [FormController::class, 'index']);//Get all interviews to this form id and when click to view an interview will use interview/answers and forms/questions
    Route::get('/{id}/questions', [FormController::class, 'show']);//When click create interview to this form id will open screen with all form questions so when click submit will create interview and answers
});

Route::prefix('worker')->group(function () {
    Route::get('/forms/{id}', [WorkerController::class, 'forms']);
});

Route::prefix('interviews')->group(function () {
    Route::get('/', [InterviewController::class, 'index'])->middleware('auth:sanctum');
    Route::post('/create', [InterviewController::class, 'create']);//After created will return id so can insert all answer for this interview so ask /answer/crete rout
    Route::get('/{id}/answers', [InterviewController::class, 'show']);
});

Route::prefix('answers')->group(function () {
    Route::get('/', [AnswersController::class, 'index']);
    Route::post('/create', [AnswersController::class, 'create']);
    Route::post('/update', [AnswersController::class, 'update']);
    Route::post('/upload', [AnswersController::class, 'upload']);
});


/*Route::prefix('users')->group(function () {

    Route::get('/', [AuthController::class, 'index']);

    Route::get('/{id}', [AuthController::class, 'show']);

    Route::post('add', [AuthController::class, 'store']);

    Route::put('edit/{id}', [AuthController::class, 'update']);

    Route::get('search/{string}', [AuthController::class, 'search']);

    Route::delete('delete/{id}', [AuthController::class, 'destroy']);

});*/
