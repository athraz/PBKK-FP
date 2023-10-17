<?php

use Illuminate\Support\Facades\Route;

Route::get('ping', function(){
    return csrf_token();
});

Route::post('create_user', [\App\Http\Module\User\Presentation\Controller\UserController::class, 'createUser']);