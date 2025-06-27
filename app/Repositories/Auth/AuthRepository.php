<?php

namespace App\Repositories\Auth;

use App\Models\User;
use LaravelEasyRepository\Repository;

interface AuthRepository extends Repository
{
    public function createUser(array $data): User;
    public function findByEmail(string $email): ?User;
}
