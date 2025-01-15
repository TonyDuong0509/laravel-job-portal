<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Services\Notify;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:access management']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $admins = Admin::all();
        return view('admin.access-management.role-user.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $roles = Role::all();
        return view('admin.access-management.role-user.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'unique:admins,email'],
                'password' => ['required', 'confirmed'],
                'role' => ['required']
            ]
        );

        $user = new Admin();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        $user->assignRole($request->role);

        Notify::createdNotification();

        return to_route('admin.role-user.index');
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
    public function edit(string $id): View
    {
        $admin = Admin::findOrFail($id);
        $roles = Role::all();
        return view('admin.access-management.role-user.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $request->validate(
            [
                'name' => ['required', 'max:255'],
                'email' => ['required', 'email', 'unique:admins,email,' . $id],
                'password' => ['confirmed'],
                'role' => ['required']
            ]
        );

        $user = Admin::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->password) $user->password = bcrypt($request->password);
        $user->save();

        $user->syncRoles($request->role);

        Notify::updatedNotification();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {
        $admin = Admin::findOrFail($id);
        if ($admin->getRoleNames()->first() === 'Super Admin') {
            return response(['message' => 'You can\'t delete super admin! 🚫'], 500);
        }

        try {
            Admin::findOrFail($id)->delete();
            Notify::deletedNotification();
            return response(['message' => 'success'], 200);
        } catch (Exception $e) {
            logger($e);
            return response(['message' => 'Something went wrong, please try again'], 500);
        }
    }
}
