<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;

Route::get('/', [ListingController::class,'index'])->name('index');
# Create Listing form
Route::get('/listings/create', [ListingController::class,'create'])->name('create');
# Store Listing
Route::post('/listings', [ListingController::class,'store'])->name('store_listing');
# Show Edit Listing form
Route::get('/listings/{listing}/edit', [ListingController::class,'edit'])->name('edit_listing');
# Update Listing
Route::put('/listings/{listing}', [ListingController::class,'update']);
# delete Listing
Route::delete('/listings/{listing}', [ListingController::class,'delete']);
# Show Listing 
Route::get('/listings/{listing}', [ListingController::class,'show'])->name('show');

# Show Register form
Route::get('/register', [UserController::class,'create'])->name('user_create');
# Store user
Route::post('/users', [UserController::class,'store'])->name('user_store');
# Logout user
Route::post('/logout', [UserController::class,'logout'])->name('user_logout');
# Show login form 
Route::get('/login', [UserController::class,   'login'])->name('user_login');
# Authenticate user 
Route::post('/users/authenticate', [UserController::class,   'authenticate'])->name('user_authenticate');


