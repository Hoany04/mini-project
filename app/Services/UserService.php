<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected UserRepository $userRepo;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    // Lấy danh sách user (thêm logic nghiệp vụ)
    public function getUsersWithFilters($filters)
    {
        return $this->userRepo->getAllUsers($filters);
    }

    // Thêm người dùng mới
    public function createUser(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        if (!empty($data['status'])) {
            try{
                $data['status'] = UserStatus::from($data['status'])->value;
            } catch (\ValueError $e) {
                throw new \Exception("Trạng thái user không hợp lệ");
            }
        }

        $user = $this->userRepo->createUser($data);

        $user->profile()->create([]); // Tạo profile rỗng

        return $user;
    }

    // Cập nhật thông tin user
    public function updateUser($id, array $data)
    {
        // dd($id, $data);
        $user = $this->userRepo->findById($id);

        if (!$user) {
            throw new \Exception("Không tìm thấy user ID: $id");
        }

        // Nếu có password trong data thì mã hóa lại
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']); // Không ghi đè password nếu form không có
        }

        if (!empty($data['status'])) {
            try {
                $newStatus = UserStatus::from($data['status']);
            } catch (\ValueError $e) {
                throw new \Exception("Trạng thái user không hợp lệ");
            }

            if ($newStatus === UserStatus::INACTIVE) {
                // Xoá tất cả session của user này để đăng xuất
                DB::table('sessions')->where('user_id', $id)->delete();
            }

            $data['status'] = $newStatus->value;
        }

        return $this->userRepo->updateUser($user, $data);
    }

    // Xóa user
    public function deleteUser($id)
    {
        $user = $this->userRepo->findById($id);
        $this->userRepo->deleteUser($user);
    }

    // Lấy user chi tiết
    public function getUserById($id)
    {
        return $this->userRepo->findById($id, false);
    }
}
