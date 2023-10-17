<?php

namespace App\Http\Module\User\Infrastructure\Repository;

use App\Http\Module\User\Domain\Model\User;
use App\Http\Module\User\Domain\Services\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function save(User $user)
    {
        DB::table('users')->upsert(
            [
                'nama' => $user->name,
                'price' => $user->email,
                'description' => $user->password,
            ],'nama'
        );
    }
}