<?php
namespace App\Imports;

use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;
use Spatie\SimpleExcel\SimpleExcelReader;

class UsersImport
{
    public int $total = 0;
    public int $created = 0;
    public int $updated = 0;

    public function import(string $path)
    {
        SimpleExcelReader::create($path)
            ->useHeaders([
                'id',
                'username',
                'email',
                'role_id',
                'status',
            ])
            ->getRows()
            ->each(function (array $row) {
                $this->handleRow($row);
            });
    }

    protected function handleRow(array $data)
    {
        $this->total++;

        if (
            empty($data['username']) ||
            empty($data['email']) ||
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            return;
        }

        $user = null;

        // Có id và id tồn tại trong DB → update theo id
        if (!empty($data['id'])) {
            $user = User::find($data['id']);

            if ($user) {
                $this->updateUser($user, $data);
                $this->updated++;
                return;
            }
        }

        // Có id nhưng id không tồn tại → tìm theo email, Không có id và email tồn tại → update theo email
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            $this->updateUser($user, $data);
            $this->updated++;
        } else { // Cả id và email không tồn tại → tạo mới
            $this->createUser($data);
            $this->created++;
        }
    }

    protected function createUser(array $data)
    {
        User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'role_id' => $data['role_id'] ?? null,
            'password' => Hash::make("123456"),
            'status' => $this->mapStatus($data['status'] ?? null)->value,
        ]);
    }

    protected function updateUser(User $user, array $data)
    {
        $user->update([
            'username' => $data['username'],
            'role_id' => $data['role_id'] ?? $user->role_id,
            'status' => $this->mapStatus($data['status'] ?? $user->status)->value,
        ]);
    }

    protected function mapStatus($value)
    {
        return match (strtolower($value)) {
            'active' => UserStatus::ACTIVE,
            'inactive' => UserStatus::INACTIVE,
            default => UserStatus::ACTIVE,
        };
    }
}
