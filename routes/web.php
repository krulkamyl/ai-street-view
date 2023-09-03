<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

Route::get('/', function () {
    return response(null)->setStatusCode(Response::HTTP_NOT_FOUND);
});
