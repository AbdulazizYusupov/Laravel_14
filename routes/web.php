<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HududController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[AuthController::class,'loginPage'])->name('loginPage');
Route::post('/login',[AuthController::class,'login'])->name('login');

Route::get('/forget',[AuthController::class, 'forget'])->name('forget');

Route::middleware('check')->group(function(){
    Route::get('/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/category-index',[CategoryController::class,'index'])->name('category.index');
    Route::post('/category-store',[CategoryController::class,'store'])->name('category.store');
    Route::put('/category-update{id}',[CategoryController::class,'update'])->name('category.update');
    Route::get('/category-delete/{id}',[CategoryController::class,'delete'])->name('category.delete');
    Route::get('/category-active/{id}',[CategoryController::class,'active'])->name('category.active');

    Route::get('/hudud-index',[HududController::class,'index'])->name('hudud.index');
    Route::get('/hudud-create',[HududController::class,'create'])->name('hudud.create');
    Route::post('/hudud-store',[HududController::class,'store'])->name('hudud.store');
    Route::get('/hudud-edit/{id}',[HududController::class,'edit'])->name('hudud.edit');
    Route::post('/hudud-update/{id}',[HududController::class,'update'])->name('hudud.update');
    Route::get('/hudud-delete/{id}',[HududController::class,'delete'])->name('hudud.delete');

});



