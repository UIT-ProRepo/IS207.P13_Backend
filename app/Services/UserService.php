<?php

namespace App\Services;

use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;
use Exception;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUserById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function createUser(array $data)
    {
        // Hash mật khẩu trước khi lưu
        $data['hashed_password'] = Hash::make($data['hashed_password']);
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data)
    {
        if (isset($data['hashed_password'])) {
            $data['hashed_password'] = Hash::make($data['hashed_password']);
        }

        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        $user = $this->userRepository->findById($id);
        if (!$user) {
            throw new Exception('User not found');
        }

        return $this->userRepository->delete($id);
    }
}
