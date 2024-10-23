<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAllUsers()
    {
        return $this->userService->getAllUsers();
    }

    public function getUserById(int $id)
    {
        return $this->userService->getUserById($id);
    }

    public function createUser(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'phone' => 'required|string|min:10|max:11',
            'password' => 'required|string|min:6', // Không cần confirmed
            'gender' => 'required|string|in:male,female,other',
            'date_of_birth' => 'required|date',
        ]);

        return $this->userService->createUser($data);
    }

    public function updateUser(Request $request, int $id)
    {
        $data = $request->validate([
            'full_name' => 'string',
            'email' => 'email|unique:users',
            'phone' => 'string|min:10|max:11',
            'password' => 'string|min:6', // không cần confirmed
            'gender' => 'string|in:male,female,other',
            'date_of_birth' => 'date',
        ]);

        return $this->userService->updateUser($id, $data);
    }

    public function deleteUser(int $id)
    {
        return $this->userService->deleteUser($id);
    }
}
