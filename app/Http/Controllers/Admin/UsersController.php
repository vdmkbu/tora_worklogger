<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Position;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $query = User::with('position')->orderByDesc('id');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }
        if (!empty($value = $request->get('role'))) {
            $query->where('role', $value);
        }

        $statuses = User::statusesList();
        $roles = User::rolesList();

        $users = $query->paginate(20);


        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }


    public function create()
    {
        $positions = Position::active()->get();

        return view('admin.users.create', compact('positions'));
    }


    public function store(CreateRequest $request)
    {
        $user = User::register(
            $request['name'],
            $request['email'],
            $request['password']
        );

        return redirect()->route('admin.users.show', compact('user'));
    }


    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }


    public function edit(User $user)
    {
        $roles = User::rolesList();
        $positions = Position::get();

        return view('admin.users.edit', compact('user', 'roles', 'positions'));
    }


    public function update(UpdateRequest $request, User $user)
    {

        $user->update($request->only(['name', 'email', 'position_id']));

        if ($request['role'] !== $user->role) {
            $user->changeRole($request['role']);
        }

        return redirect()->route('admin.users.show', $user);
    }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }

    public function switch(User $user)
    {
        $user->switchStatus();
        return redirect()->route('admin.users.show', $user);
    }
}
