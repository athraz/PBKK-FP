<?php

namespace App\Http\Module\User\Domain\Services\Repository;

use App\Http\Module\User\Domain\Model\User;

interface UserRepositoryInterface
{
    public function save(User $user);

}