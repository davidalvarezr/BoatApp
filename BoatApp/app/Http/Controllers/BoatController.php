<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBoatRequest;
use App\Models\Boat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BoatController extends Controller
{

    // VIEW ------------------------------------------------------------------------------------------------------------

    public function list()
    {
        return view('modules.boat.list', ['token' => Session::get('token')]);
    }

    public function create()
    {
        return $this->getView('create');
    }

    public function show($id)
    {
        return $this->getView('show', $id);
    }

    public function edit($id)
    {
        return $this->getView('edit', $id);
    }

    private function getView($mode, $id = null)
    {
        return view('modules.boat.boat')->with([
            'mode' => $mode,
            'id' => $id,
        ]);
    }

    // API -------------------------------------------------------------------------------------------------------------

    // TODO
    public function store(StoreBoatRequest $r)
    {
        $data = $r->validated();
        $boat = Boat::create($data);
        return response()->json(['boat' => $boat]);
    }

    // TODO
    public function update(Request $r, $id)
    {
        return response()->json('todo');
    }

    // TODO
    public function delete()
    {

    }
}
