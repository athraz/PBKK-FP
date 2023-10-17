<?php

namespace App\Http\Module\User\Presentation\Controller;

use App\Http\Module\Menu\Application\Services\CreateMenu\Create;
use App\Http\Module\User\Application\Services\CreateUser\CreateUserRequest;
use App\Http\Module\User\Application\Services\CreateUser\CreateUserService;
use Illuminate\Http\Request;

class UserController
{
    public function __construct(
        private CreateUserService $create_user_service
    )
    {
    }

    public function createUser(Request $request){
        // dd($request);
        $request = new CreateUserRequest(
            $request->input('name'),
            $request->input('email'),
            $request->input('password'),
        );

        return $this->create_user_service->execute($request);
    }
}