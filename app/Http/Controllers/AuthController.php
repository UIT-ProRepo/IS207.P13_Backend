<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function signup(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|min:10|max:11',
            'hashed_password' => 'required|string|min:6|confirmed', // Tên gọi hashed_password nhưng là password chưa hash
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'nullable|date',
        ]);

        return $this->authService->signup($data);
    }
    
    public function signin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'hashed_password' => 'required|string|min:6', // Tên gọi hashed_password nhưng là password chưa hash
        ]);
       
        return $this->authService->signin($data);
    }
}
