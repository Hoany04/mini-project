<?php
namespace App\Imports;

use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\{
    ToCollection,
    WithHeadingRow,
    WithChunkReading
};
use Illuminate\Support\Collection;

class UsersImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public int $total = 0;
    public int $created = 0;
    public int $updated = 0;

    public array $errors = [];

    protected array $usersById = [];

    protected array $usersByEmail = [];

    public function __construct()
    {
        $this->usersById = User::pluck('id')->flip()->toArray();
        $this->usersByEmail = User::pluck('id','email')->toArray();
    }

    public function collection(Collection $rows)
    {
        DB::transaction(function () use ($rows) {
            foreach ($rows as $row) {
                $this->handleRow($row->toArray());
            }
        });
    }

    public function chunkSize(): int
    {
        return 500;
    }

    protected function handleRow(array $data)
    {
        $this->total++;

        if (
            empty($data['username']) ||
            empty($data['email']) ||
            !filter_var($data['email'], FILTER_VALIDATE_EMAIL)
        ) {
            $this->logError('Invalid username or email');
            return;
        }

        // Có id và id tồn tại trong DB → update theo \id
        if (!empty($data['id']) && isset($this->usersById[$data['id']])) {
            $user = User::find($data['id']);

            if ($user) {
                $this->updateUser($user, $data);
                $this->updated++;
                return;
            }
        }

        // Có id nhưng id không tồn tại → tìm theo email, Không có id và email tồn tại → update theo email

        if (isset($this->usersByEmail[$data['email']])) {
            $user = User::find($this->usersByEmail[$data['email']]);
            if ($user) {
                $this->updateUser($user, $data);
                $this->updated++;
                return;
            }
        }

        $user = $this->createUser($data);
        $this->created++;

        $this->usersById[$user->id] = true;
        $this->usersByEmail[$user->email] = $user->id;
    }

    protected function createUser(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'role_id' => $data['role_id'] ?? null,
            'password' => Hash::make(Str::random(12)),
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
        $value = strtolower((string) $value);
        return match ($value) {
            'active' => UserStatus::ACTIVE,
            'inactive' => UserStatus::INACTIVE,
            default => UserStatus::ACTIVE,
        };
    }

    protected function logError(string $message)
    {
        $this->errors[] = [
            'row' => $this->total,
            'message' => $message,
        ];
    }
}
