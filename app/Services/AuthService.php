<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function signup(array $data)
    {
        $data['hashed_password'] = Hash::make($data['password']);
        unset($data['password']);

        $newUser = $this->userRepository->create($data);

        $token = $newUser->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $newUser,
            'access_token' => $token,
        ]); 
    }

    public function signin(array $data)
    {
        $user = $this->userRepository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->hashed_password)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ]);
    }
}
