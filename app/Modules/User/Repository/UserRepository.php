<?php

namespace App\Modules\User\Repository;

use App\Modules\User\Dto\UserFilterData;
use App\Modules\User\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    public function all(): Collection
    {
        return User::all();
    }

    public function activeOrdered(): Collection
    {
        return User::active()->orderBy('name', 'asc')->get();
    }

    public function paginateFiltered(UserFilterData $filter, int $perPage = 20): LengthAwarePaginator
    {
        $query = User::with('position')->orderByDesc('id');

        if ($filter->id !== null) {
            $query->where('id', $filter->id);
        }
        if ($filter->name !== null) {
            $query->where('name', 'like', '%'.$filter->name.'%');
        }
        if ($filter->email !== null) {
            $query->where('email', 'like', '%'.$filter->email.'%');
        }
        if ($filter->status !== null) {
            $query->where('status', $filter->status);
        }
        if ($filter->role !== null) {
            $query->where('role', $filter->role);
        }

        return $query->paginate($perPage);
    }

    public function save(User $user): void
    {
        $user->save();
    }

    public function delete(User $user): void
    {
        $user->delete();
    }
}
