<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HududController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/forget',[AuthController::class, 'forget'])->name('forget');
Route::post('/forget',[AuthController::class, 'forgetPassword'])->name('forgetPassword');

Route::get('/logout',[AuthController::class,'logout'])->name('logout');

Route::post('/task-status',[TaskController::class,'status'])->name('task.status');

Route::middleware('auth')->group(function(){
    Route::get('/profile',[AuthController::class,'profile'])->name('profile');
    Route::put('/profile-update{user}',[AuthController::class,'updateProfile'])->name('profile.update');

    Route::get('/task-data{key}',[TaskController::class,'data'])->name('task.data');
    Route::get('/task-confirm',[TaskController::class,'confirm'])->name('task.confirm');
    Route::get('task-reject',[TaskController::class,'reject'])->name('task.reject');

    Route::get('/index',[\App\Http\Controllers\UserController::class,'index'])->name('index');
    Route::put('/send{id}',[\App\Http\Controllers\UserController::class,'send'])->name('send');
    Route::post('/filter',[\App\Http\Controllers\UserController::class,'filter'])->name('filter');
});

Route::middleware('check')->group(function(){

    Route::get('/category-index',[CategoryController::class,'index'])->name('category.index');
    Route::post('/category-store',[CategoryController::class,'store'])->name('category.store');
    Route::put('/category-update{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/category-delete/{id}',[CategoryController::class,'delete'])->name('category.delete');

    Route::get('/task-index',[TaskController::class,'index'])->name('task.index');
    Route::get('/task-create',[TaskController::class,'create'])->name('task.create');
    Route::post('/task-store',[TaskController::class,'store'])->name('task.store');
    Route::get('/task-edit/{task}',[TaskController::class,'edit'])->name('task.edit');
    Route::put('/task-update/{id}',[TaskController::class,'update'])->name('task.update');
    Route::get('/task-delete/{id}',[TaskController::class,'delete'])->name('task.delete');
    Route::post('/task-filter',[TaskController::class,'filter'])->name('task.filter');

    Route::get('/hudud-index',[HududController::class,'index'])->name('hudud.index');
    Route::post('/hudud-store',[HududController::class,'store'])->name('hudud.store');
    Route::put('/hudud-update/{id}',[HududController::class,'update'])->name('hudud.update');
    Route::get('/hudud-delete/{id}',[HududController::class,'delete'])->name('hudud.delete');

    Route::get('/user-index',[AuthController::class,'index'])->name('user.index');
    Route::post('user-store',[AuthController::class,'store'])->name('user.store');
    Route::put('user-update/{user}',[AuthController::class,'update'])->name('user.update');
    Route::get('user-delete/{id}',[AuthController::class,'delete'])->name('user.delete');

    Route::post('/izoh{id}',[\App\Http\Controllers\UserController::class,'izoh'])->name('izoh');
});



