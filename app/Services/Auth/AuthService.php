<?php

namespace App\Services\Auth;

use LaravelEasyRepository\BaseService;

interface AuthService extends BaseService
{
    public function register(array $data): array;
    public function login(array $credentials): array;
    public function me(): ?object;
    public function refreshToken(): string;
    public function logout(): void;
}
