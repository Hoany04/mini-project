<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected $userService;
     public function __construct(UserService $userService)
     {
        $this->userService = $userService;
     }
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'role_id', 'status']);
        $users = $this->userService->getUsersWithFilters($filters);
        $roles = Role::all();
        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'Them user thanh cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = $this->userService->getUserById($id);

        if(!$user) {
            return redirect()->route('admin.users.index')->with('error', 'User không tồn tại!');
        }
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $data = $request->validated();

        if ($data['status'] == 'inactive') {
            DB::table('sessions')->where('user_id', $id)->delete();
        }

        User::findOrFail($id)->update($data);

        return redirect()->route('admin.users.index')->with('success', 'Cap nhat thong tin user thanh cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users.index')->with('success', 'Da xoa user');
    }
}
