<?php

namespace App\Repositories;

use App\Models\User;
use Auth0\Laravel\UserRepositoryAbstract;
use Auth0\Laravel\UserRepositoryContract;
use Illuminate\Contracts\Auth\Authenticatable;

final class UserRepository extends UserRepositoryAbstract implements UserRepositoryContract
{
    public function fromAccessToken(array $user): ?Authenticatable
    {

        return User::where('auth0', $user['sub'])->firstOrFail();
    }

    public function fromSession(array $userData): ?Authenticatable
    {

        $user = User::where('email', $userData['email'])->firstOrFail();
        if ($user != null && $user->auth0 == null) {
            $user->auth0 = $userData['sub'] ?? '';
            $user->save();
        }

        return $user;
    }
}
