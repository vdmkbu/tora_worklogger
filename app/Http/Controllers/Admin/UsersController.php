<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Position\Service\PositionService;
use App\Modules\User\FormRequest\CreateRequest;
use App\Modules\User\FormRequest\IndexRequest;
use App\Modules\User\FormRequest\UpdateRequest;
use App\Modules\User\Models\User;
use App\Modules\User\Service\UserService;

class UsersController extends Controller
{
    public function __construct(
        private readonly UserService $users,
        private readonly PositionService $positions,
    ) {}

    public function index(IndexRequest $request)
    {
        $users = $this->users->paginate($request->toDto());
        $statuses = User::statusesList();
        $roles = User::rolesList();

        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function create()
    {
        $positions = $this->positions->activeList();

        return view('admin.users.create', compact('positions'));
    }

    public function store(CreateRequest $request)
    {
        $user = $this->users->create($request->toDto());

        return redirect()->route('admin.users.show', compact('user'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = User::rolesList();
        $positions = $this->positions->all();

        return view('admin.users.edit', compact('user', 'roles', 'positions'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $this->users->update($user, $request->toDto());

        return redirect()->route('admin.users.show', $user);
    }

    public function destroy(User $user)
    {
        $this->users->delete($user);

        return redirect()->route('admin.users.index');
    }

    public function switch(User $user)
    {
        $this->users->switchStatus($user);

        return redirect()->route('admin.users.show', $user);
    }
}
