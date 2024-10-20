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
            'phone' => 'required|string|min:10|max:11',
            'password' => 'required|string|min:6|confirmed',
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'required|date',
        ]);

        return $this->authService->signup($data);
    }
    
    public function signin(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:6',
        ]);
       
        return $this->authService->signin($data);
    }
}
