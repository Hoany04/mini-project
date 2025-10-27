<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    // Lấy danh sách user (có filter)
    public function getAllUsers($filters = [])
    {
        $query = User::with('role', 'profile');

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('username', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['role_id'])) {
            $query->where('role_id', $filters['role_id']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        return $query->orderBy('id', 'desc')->paginate(10);
    }

    // Tạo user mới
    public function createUser(array $data)
    {
        return User::create($data);
    }

    // Cập nhật user
    public function updateUser(User $user, array $data)
    {
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->role_id = $data['role_id'];
        $user->status = $data['status'];
        $user->save();

        return $user;
    }

    // Xóa user
    public function deleteUser(User $user)
    {
        return $user->delete();
    }

    // Lấy user theo ID
    public function findById($id, $throw = true)
    {
        $query =  User::with('role', 'profile');
        return $throw ? $query->findOrFail($id) : $query->find($id);
    }
}
