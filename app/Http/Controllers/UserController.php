<?php
namespace App\Http\Controllers;

use App\Constants\Roles as RolesConstant;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        $users = User::paginate(1);
        info($users);
        return Inertia::render('User/Index', [
            'users' =>  $users,
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('User/Edit', [
            'options' => RolesConstant::roles(),
            'title' => 'Create',
            'selectedRoles' => [2]]
        );
    }

    public function edit(User $user): Response
    {
        $roleIds = $user->roleIds();
        return Inertia::render('User/Edit', [
            'options' => RolesConstant::roles(),
            'title' => "Edit",
            'selectedRoles' => $roleIds,
            'user' => $user
        ]);
    }

    public function store(UserRequest $request): RedirectResponse
    {
        if ($request->filled('password')) {
            $request->merge([
                'password' => Hash::make($request->input('password'))
            ]);
        }
        $user = User::create($request->only(['name', 'email', 'password']));
        $role_ids = array_values($request->get('roles', []));
        $user->roles()->sync($role_ids);
        event(new Registered($user));
        return redirect('/users');
    }

    public function update(UserRequest $request, User $user): RedirectResponse
    {
        if ($request->filled('password')) {
            $request->merge([
                'password' => Hash::make($request->input('password'))
            ]);
        }
        $user->update(array_filter($request->only(['name', 'email', 'password'])));
        $role_ids = array_values($request->get('roles', []));
        $user->roles()->sync($role_ids);
        return redirect('/users');
    }

    public function destroy(User $user)
    {
        $user->roles()->detach($user->roleIds());
        $user->delete();
    }
}
