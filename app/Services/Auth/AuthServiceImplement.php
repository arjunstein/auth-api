<?php

namespace App\Services\Auth;

use App\Repositories\Auth\AuthRepository;
use App\Services\Auth\AuthService;
use Illuminate\Support\Facades\Hash;
use LaravelEasyRepository\ServiceApi;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthServiceImplement extends ServiceApi implements AuthService
{

    /**
     * set title message api for CRUD
     * @param string $title
     */
    protected string $title = "";
    /**
     * uncomment this to override the default message
     * protected string $create_message = "";
     * protected string $update_message = "";
     * protected string $delete_message = "";
     */

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected AuthRepository $mainRepository;

    public function __construct(AuthRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    public function register(array $data): array
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->mainRepository->createUser($data);
        $token = JWTAuth::fromUser($user);

        return [
            'user' => $user,
            'token' => $token,
        ];
    }
}
