<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;

Route::get('/', [ListingController::class,'index'])->name('index');
# Create Listing form
Route::get('/listings/create', [ListingController::class,'create'])->name('create');
# store listing
Route::post('/listings', [ListingController::class,'store'])->name('store_listing');

# Show Listing 
Route::get('/listings/{listing}', [ListingController::class,'show'])->name('show');


