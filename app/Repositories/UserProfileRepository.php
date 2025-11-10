<?php
namespace App\Repositories;

use App\Models\UserProfile;

class UserProfileRepository
{
    public function updateOrCreate($userId, array $data)
    {
        return UserProfile::updateOrCreate(
            ['user_id' => $userId],
            $data
        );
    }

    public function findByUserId($userId)
    {
        return UserProfile::where('user_id', $userId)->first();
    }
}
?>