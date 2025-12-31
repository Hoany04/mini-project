<?php

namespace App\Http\Controllers\Admin;

use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Models\Role;
use App\Models\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     protected UserService $userService;
     public function __construct(UserService $userService)
     {
        $this->userService = $userService;
     }
    public function index(Request $request)
    {
        $this->authorize('viewAny', User::class);
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
        $this->authorize('create', User::class);
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $this->userService->createUser($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User added successfully.');
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
            return redirect()->route('admin.users.index')->with('error', 'The user does not exist!');
        }

        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->can('update', User::class);
        $this->userService->updateUser($id, $request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User information updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('delete', $user);
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users.index')->with('success', 'User has been deleted.');
    }

    public function import(Request $request)
    {
        $this->authorize('import', User::class);
        $request->validate([
            'file' => 'required|file|mimes:xlsx,csv',
        ]);

        $import = new UsersImport();
        Excel::import($import, $request->file('file'), 'private');

        return back()->with([
            'success' => 'Import complete',
            'import_summary' => [
                'total' => $import->total,
                'created' => $import->created,
                'updated' => $import->updated,
                'errors' => count($import->errors),
            ],
            'import_errors' => $import->errors,
        ]);
    }

    public function export()
    {
        $this->authorize('export', User::class);
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
