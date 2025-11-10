<?php
namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Client\UserProfileService;
class ClientProfileController extends Controller
{
    protected $userProfileService;

    public function __construct(UserProfileService $userProfileService)
    {
        $this->userProfileService = $userProfileService;
    }
    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $validated = $request->validated();

        // Nếu có upload ảnh đại diện
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar');
        }

        $this->userProfileService->updateProfile($user, $validated);

        return redirect()->back()->with('success', 'Cập nhật hồ sơ thành công!');
    }
}

?>