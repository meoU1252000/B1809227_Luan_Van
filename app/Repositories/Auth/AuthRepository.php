<?php

namespace App\Repositories\Auth;
use App\Repositories\BaseRepository;

class AuthRepository extends BaseRepository implements AuthRepositoryInterface
{
    public function getModel()
    {
        return \App\Models\User::class;
    }
}
