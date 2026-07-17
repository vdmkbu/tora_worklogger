<?php

namespace App\Modules\Position\Repository;

use App\Modules\Position\Dto\PositionFilterData;
use App\Modules\Position\Models\Position;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class PositionRepository
{
    public function paginateFiltered(PositionFilterData $filter, int $perPage = 20): LengthAwarePaginator
    {
        $query = Position::query()->orderBy('status', 'asc')->orderBy('name', 'asc');

        if ($filter->id !== null) {
            $query->where('id', $filter->id);
        }
        if ($filter->name !== null) {
            $query->where('name', 'like', '%'.$filter->name.'%');
        }
        if ($filter->status !== null) {
            $query->where('status', $filter->status);
        }

        return $query->paginate($perPage);
    }

    public function activeList(): Collection
    {
        return Position::active()->get();
    }

    public function all(): Collection
    {
        return Position::query()->get();
    }

    public function ordered(): Collection
    {
        return Position::query()->orderBy('name', 'asc')->get();
    }

    public function save(Position $position): void
    {
        $position->save();
    }
}
