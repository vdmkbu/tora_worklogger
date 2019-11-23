<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Positions\CreateRequest;
use App\Position;
use Illuminate\Http\Request;

class PositionsController extends Controller
{

    public function index(Request $request)
    {
        $query = Position::orderBy('status', 'asc')->orderBy('name', 'asc');

        if (!empty($value = $request->get('id'))) {
            $query->where('id', $value);
        }

        if (!empty($value = $request->get('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }

        if (!empty($value = $request->get('status'))) {
            $query->where('status', $value);
        }

        $statuses = Position::statusesList();
        $positions = $query->paginate(20);

        return view('admin.positions.index', compact('positions', 'statuses'));
    }


    public function create()
    {
        return view('admin.positions.create');
    }


    public function store(CreateRequest $request)
    {
        Position::create([
            'name' => $request->name,
            'status' => Position::STATUS_ACTIVE
        ]);

        return redirect()->route('admin.positions.index');
    }




    public function edit(Position $position)
    {
        $statuses = Position::statusesList();
        return view('admin.positions.edit', compact('position', 'statuses'));
    }


    public function update(CreateRequest $request, Position $position)
    {
        $position->update($request->only(['name']));

        return redirect()->route('admin.positions.index');
    }

    public function switch(Position $position)
    {
        $position->switchStatus();
        return redirect()->route('admin.positions.index');
    }

}
