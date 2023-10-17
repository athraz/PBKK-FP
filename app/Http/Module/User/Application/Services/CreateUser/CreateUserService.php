<?php

namespace App\Http\Module\User\Application\Services\CreateUser;

use App\Http\Module\User\Domain\Model\User;
use App\Http\Module\User\Infrastructure\Repository\UserRepository;

class CreateUserService
{

    public function __construct(
        private UserRepository $user_repository
    )
    {
    }

    public function execute(CreateUserRequest $request){
        $user = new User(
            $request->name,
            $request->email,
            $request->password,
        );

        $this->user_repository->save($user);
    }
}