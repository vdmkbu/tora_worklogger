<?php

namespace App\Modules\User\Service;

use App\Modules\User\Dto\CreateUserData;
use App\Modules\User\Dto\UpdateUserData;
use App\Modules\User\Dto\UserFilterData;
use App\Modules\User\Factory\UserFactory;
use App\Modules\User\Models\User;
use App\Modules\User\Repository\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        private readonly UserRepository $repository,
        private readonly UserFactory $factory,
    ) {}

    public function paginate(UserFilterData $filter): LengthAwarePaginator
    {
        return $this->repository->paginateFiltered($filter);
    }

    public function activeOrdered(): Collection
    {
        return $this->repository->activeOrdered();
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(CreateUserData $data): User
    {
        $user = $this->factory->make($data);
        $this->repository->save($user);

        return $user;
    }

    public function update(User $user, UpdateUserData $data): void
    {
        $user->fill([
            'name' => $data->name,
            'email' => $data->email,
            'position_id' => $data->positionId,
        ]);

        if ($user->role !== $data->role) {
            $user->changeRole($data->role);
        }

        $this->repository->save($user);
    }

    public function switchStatus(User $user): void
    {
        $user->switchStatus();
        $this->repository->save($user);
    }

    public function delete(User $user): void
    {
        $this->repository->delete($user);
    }
}
