<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Modules\Position\FormRequest\CreateRequest;
use App\Modules\Position\FormRequest\IndexRequest;
use App\Modules\Position\Models\Position;
use App\Modules\Position\Service\PositionService;

class PositionsController extends Controller
{
    public function __construct(
        private readonly PositionService $positions,
    ) {}

    public function index(IndexRequest $request)
    {
        $positions = $this->positions->paginate($request->toDto());
        $statuses = Position::statusesList();

        return view('admin.positions.index', compact('positions', 'statuses'));
    }

    public function create()
    {
        return view('admin.positions.create');
    }

    public function store(CreateRequest $request)
    {
        $this->positions->create($request->toDto());

        return redirect()->route('admin.positions.index');
    }

    public function edit(Position $position)
    {
        $statuses = Position::statusesList();

        return view('admin.positions.edit', compact('position', 'statuses'));
    }

    public function update(CreateRequest $request, Position $position)
    {
        $this->positions->update($position, $request->toDto());

        return redirect()->route('admin.positions.index');
    }

    public function switch(Position $position)
    {
        $this->positions->switchStatus($position);

        return redirect()->route('admin.positions.index');
    }
}
