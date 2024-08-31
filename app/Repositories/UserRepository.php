<?php

namespace app\Repositories;

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

    public function fromSession(array $user): ?Authenticatable
    {
        $userData = User::where('email', $user['email'])->firstOrFail();
        if ($userData != null && $userData->auth0 == null) {
            $userData->auth0 = $user['sub'] ?? '';
            $userData->save();
        }

        return $userData;
    }
}
