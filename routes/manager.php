<?php

use App\Http\Controllers\ManagerHomeController;
use Illuminate\Support\Facades\Route;



Route::group(['prefix'=>'manager'],function (){
    Route::get('/home', [ManagerHomeController::class, 'index'])->name("manager.home");
});
