<?php

use App\Http\Controllers\Api\GenerateViewController;
use Illuminate\Support\Facades\Route;


Route::get('/generate', GenerateViewController::class);
