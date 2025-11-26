<?php
namespace App\Services\Client;

use App\Repositories\UserProfileRepository;
use Illuminate\Support\Facades\Storage;

class UserProfileService
{
    protected UserProfileRepository $userProfileRepo;

    public function __construct(UserProfileRepository $userProfileRepo)
    {
        $this->userProfileRepo = $userProfileRepo;
    }

    public function updateProfile($user, array $validatedData)
    {
        // Nếu có ảnh đại diện thì lưu lại file
        if (isset($validatedData['avatar']) && $validatedData['avatar'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $validatedData['avatar']->store('avatars', 'public');
            $validatedData['avatar'] = $path;
        }

        return $this->userProfileRepo->updateOrCreate($user->id, $validatedData);
    }
}
?>
